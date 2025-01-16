<!-- http://localhost/php/05-eliminar.php -->

<?php
// Llamar a errores y funciones
require("errores.php");
require("funciones.php");


/* Recogemos datos del formulario */
$alerta = "Mensaje...";

// Lamamos a la base de datos
$conexion = conectarBBDD();

// Si sel pulsa Si se envia la referencia
if (isset($_REQUEST['eliminar'])) {
    $eliminarSLQ = "DELETE FROM productos WHERE Referencia = $_REQUEST[Referencia]";
    // Desactivo las excepciones por errores en el driver mysqli
    mysqli_report(MYSQLI_REPORT_OFF);

    // Borramos el registro con una sentencia preparada
    $referencia = $_REQUEST['Referencia'];
    $sql = "DELETE FROM productos WHERE Referencia = ?";

    $sentenciaPreparada = $conexion->prepare($sql);
    $sentenciaPreparada->bind_param('i', $referencia);

    $ejecutaSQL = $sentenciaPreparada->execute();

    if ($ejecutaSQL) {
        $alerta .= "<br> Producto eliminado correctamente";
    } else {
        $alerta .= "<br> Error en el BORRADO: " . $conexion->error;
    }
}


// Si se pulsa NO se concatena el mensaje
if (isset($_REQUEST['volver'])) {
    $alerta .= "<br> No se ha borrado nada";
}

// Hacemos la consulta
$consulta = "SELECT * FROM productos";
$filas = $conexion->query($consulta);
$numFilas = $filas->num_rows;

$alerta .= "<br> Numero de registros:  " . $numFilas;

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

    <section class="container aling-center m-3 w-70 bg-primary">
        <?php
        if (isset($_REQUEST['enviar'])) {
        }
        ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Referencia</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categorías</th>
                    <th></th>
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
                        <!-- Añadimos un boton para eliminar -->
                        <td>
                            <form action="#" method="post" style="display: inline;">

                                <input type="hidden" name="Referencia" value="<?php echo $producto["Referencia"] ?>">

                                <input type="hidden" name="Descripcion" value="<?php echo $producto["Descripcion"] ?>">

                                <button type="submit" name="confirmar" class="btn 
                                btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>

                <?php
                }
                ?>
            </tbody>
        </table>

    </section>

    <!-- Línea de separación -->
    <hr class="m-3 border border-primary border-5 w-50">

    <?php
    if (isset($_REQUEST['confirmar'])) {
    ?>
        <p>¿Desea eliminar <?php echo $_REQUEST['Descripcion'] ?>?</p>

        <form action="#" method="post" class="m-3 shadow-lg">

            <input type="hidden" name="Referencia" value="<?php echo $_REQUEST["Referencia"] ?>">

            <button type="submit" name="eliminar" class="btn btn-outline-danger">SI</button>

            <button type="submit" name="volver" class="btn btn-outline-success">NO</button>
        </form>

    <?php
    }
    ?>


    <!-- Defino enlaces de navegación -->
    <section class="row">
        <nav class="col">
            <a href="01-cargar-bbdd.php" class="btn btn-sm btn-success w-100">Cargar base de datos</a>

            <a href="03-insertar.php" class="btn btn-sm btn-warning w-100">Insertar Producto</a>
        </nav>

        <nav class="col">
            <a href="04-actualizar.php" class="btn btn-sm btn-secondary w-100">Actualizar Producto</a>

            <a href="Ejemplo_02_consultar.php" class="btn btn-sm btn-danger w-100">Consultar base de datos</a>
        </nav>
    </section>
</body>

</html>