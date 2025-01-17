<!-- http://localhost/Curso/PHP/04-actualizar.php -->

<?php
// Llamar a errores y funciones
require("errores.php");
require("funciones.php");



/* Recogemos datos del formulario */
$alerta = "Mensaje...";


// Conectamos la base de datos
$conexion = conectarBBDD();

// Hacemos la consulta
$consulta = "SELECT * FROM productos";
$filas = $conexion->query($consulta);
$numFilas = $filas->num_rows;

$alerta = "Numero de registros:  " . $numFilas;


// Solo si se envía el formulario, se definen las variables del alert
if (isset($_REQUEST['enviar'])) {
    // Lo primero siempre es cargar la BBDD
    $conexion = conectarBBDD();

    $referencia = $_REQUEST['Referencia'] ?? '';
    $descripcion = $_REQUEST['Descripcion'] ?? '';
    $precio = $_REQUEST['Precio'] ?? '';
    $stock = $_REQUEST['Stock'] ?? '';

    // En el caso del checkbox se envía un array
    $categorias = $_REQUEST['Categorias'] ?? [];

    // implode sirve para escribir los elementos del array
    $categoriasValores = implode(', ', $categorias);
    $alerta = " Comentarios: $referencia
        Descripción: $descripcion
        Precio: $precio
        Stock: $stock
        Categorías: $categoriasValores";

    // Ahora introducimos lo de arriba en la BBDD
    // Defino una sentencia preparada
    $sentenciaSQL = "UPDATE INTO 
    productos (Referencia, Descripcion, Precio, Stock, Categorias) 
    VALUES (?, ?, ?, ?, ?)";
    //$referencia, $descripcion, $precio, $stock, $categorias

    $sentenciaPreparada = $conexion->prepare($sentenciaSQL);

    // Encriptamos la sentencia (bind_param)
    $sentenciaPreparada->bind_param('isdis', $referencia, $descripcion, $precio, $stock, $categoriasValores);

    // EjecutaSQL es un booleano
    $ejecutaSQL = $sentenciaPreparada->execute();

    if ($ejecutaSQL) {
        $alerta .= "<br> Producto insertado correctamente";
    } else {
        $alerta .= "Error fatal, EXPLOTA";
    }
}
?>

<!-- Comenzamos la sección HTML -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- En el alert presentamos los datos recogidos del formulario -->
    <header>
        <p class="alert alert-primary m-3 w-50" style="white-space: pre-line;">
            <?php echo $alerta; ?>
        </p>
    </header>

    <hr class="m-3 border border-primary border-5 w-100">

    <table class="table ">
        <thead>
            <tr>
                <th>Referencia</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categorías</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>
            <?php
            // Asocio la salida a su campo
            $productos = $filas->fetch_all(MYSQLI_ASSOC);
            foreach ($productos as $producto) {
            ?>

                <tr>
                    <td><?php echo $producto["Referencia"]; ?></td>
                    <td><?php echo $producto["Descripcion"]; ?></td>
                    <td><?php echo $producto["Precio"]; ?></td>
                    <td><?php echo $producto["Stock"]; ?></td>
                    <td><?php echo $producto["Categorias"]; ?></td>
                    <td>
                            <form action="#" method="post" style="display: inline;">

                                <input type="hidden" name="Referencia" value="<?php echo $producto["Referencia"] ?>">

                                <input type="hidden" name="Descripcion" value="<?php echo $producto["Descripcion"] ?>">

                                <input type="hidden" name="Precio" value="<?php echo $producto["Precio"] ?>">

                                <input type="hidden" name="Stock" value="<?php echo $producto["Stock"] ?>">

                                <input type="hidden" name="Categorias" value="<?php echo $producto["Categorias"] ?>">

                                <button type="submit" name="confirmar" class="btn 
                                btn-outline-primary">Actualizar</button>
                            </form>
                        </td>
                </tr>

            <?php
            }
            ?>
        </tbody>
    </table>

    <!-- Línea de separación -->
    <hr class="m-3 border border-primary border-5 w-100">

    <form action="#" method="post" class="m-3 shadow-lg">
        <!-- -->
        <!-- Campo Referencia -->
        <label for="Referencia" class="form-label">Referencia:</label>
        <input type="number" name="Referencia" id="Referencia" class="form-control w-50" min="0" required><br>
        <!-- -->

        <!-- Campo Descripcion -->
        <label for="Descripcion" class="form-label">Descripción:</label>
        <input type="text" name="Descripcion" id="Descripcion" class="form-control w-50" required><br>
        <!-- -->

        <!-- Campo Precio -->
        <label for="Precio" class="form-label">Precio:</label>
        <input type="number" name="Precio" id="Precio" class="form-control w-50" step="0.05" min="0" required><br>
        <!-- -->

        <!-- Campo Stock -->
        <label for="Stock" class="form-label">Stock:</label>
        <input type="number" name="Stock" id="Stock" class="form-control w-50" min="0" required><br>
        <!-- -->

        <!-- Campo Categorias -->
        <label class="form-label">Categorias:</label><br>
        <input type="checkbox" name="Categorias[]" value="oficina" id="oficina">
        <label for="oficina">Oficina</label><br>
        <input type="checkbox" name="Categorias[]" value="escolar" id="escolar">
        <label for="escolar">Escolar</label><br>
        <input type="checkbox" name="Categorias[]" value="papelería" id="papelería">
        <label for="papelería">Papelería</label><br><br>
        <!-- -->
        <button type="submit" class="btn btn-success" name="enviar">Insertar</button>
        <!--  -->
        <hr class="border border-primary border-5 w-50">
        <!-- -->

    </form>
    <!-- Seccion de botones con enlaces -->
    <section class="row">
        <nav class="col">
            <a href="Ejemplo_02_consultar.php" class="btn btn-sm btn-primary w-100">Consultar Productos</a>

            <a href="01-cargar.php" class="btn btn-sm btn-warning w-100">Cargar BBDD</a>
        </nav>

        <nav class="col">
            <a href="04-actualizar.php" class="btn btn-sm btn-secondary w-100">Actualizar Producto</a>

            <a href="05-eliminar.php" class="btn btn-sm btn-danger w-100">Eliminar Producto</a>
        </nav>
    </section>
</body>

</html>