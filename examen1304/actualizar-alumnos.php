<!-- http://localhost/Curso/PHP/actualizar-alumnos.php -->
<?php
// Llamar a errores y funciones
require("errores.php");
require("funciones.php");

/* Recogemos datos del formulario */
$alerta = "Mensaje...";

// Llamamos a la BBDD
$conexion = conectarBBDD();

// Hacemos la consulta
$consulta = "SELECT * FROM alumnos";
$filas = $conexion->query($consulta);
$numFilas = $filas->num_rows;
$alerta = "Nº de Registros: " . $numFilas;

// Solo si se envía el formulario, se definen las variables del alert
if (isset($_REQUEST['enviar'])) {
    // La clave principal
    $nif = $_REQUEST['nif'] ?? '';

    // El resto de campos a actualizar
    $nombre = $_REQUEST['nombre'] ?? '';
    $fechanac = $_REQUEST['fechanac'] ?? '';
    $pagado = $_REQUEST['pagado'] ?? '';
    $importe = $_REQUEST['importe'] ?? '';

    $alerta = " NIF: $nif
        Nombre: $nombre
        Fecha Nacimiento: $fechanac
        Pagado: $pagado
        Importe: $importe";

    // Ahora introducimos lo de arriba en la BBDD
    // Defino una Sentencia preparada (? por cada campo!)
    $sentenciaSQL = "UPDATE alumnos SET nombre = ?, 
                    fechanac = ?, pagado = ?, importe = ? 
                    WHERE nif = ? ";
    $sentenciaPreparada = $conexion->prepare($sentenciaSQL);
    // Encriptamos la sentencia (bind_param)
    $sentenciaPreparada->bind_param(
        "ssids",

        $nombre,
        $fechanac,
        $pagado,
        $importe,
        $nif
    );

    // ejecutaSQL es booleano; true (correcto), false (error)
    $ejecutaSQL = $sentenciaPreparada->execute();
    if ($ejecutaSQL) {
        $alerta .= "<br> Alumno/a actualizado correctamente";
    } else {
        $alerta .= "<br> ERROR FATAL (explota!)";
    }

    $filas = $conexion->query($consulta);
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
    <link rel="stylesheet" href="examen0950.css">
</head>

<body>
    <!-- En el alert presentamos los datos recogidos del formulario -->
    <header>
        <p class="alert alert-primary m-3 w-50" style="white-space: pre-line;">
            <?php echo $alerta; ?>
        </p>
    </header>

    <!-- Línea de separación -->
    <hr class="m-3 border border-primary border-5">

    <table class="table">
        <thead>
            <tr>
                <th>NIF</th>
                <th>Nombre</th>
                <th>Fecha Nacimiento</th>
                <th>Pagado</th>
                <th>Importe</th>
                <th>--- BOTONES ---</th>
            </tr>
        </thead>
        <tbody>
            <?php       // Asocio la salida a su campo
            $alumnos = $filas->fetch_all(MYSQLI_ASSOC);
            foreach ($alumnos as $alumno) {
            ?>
                <!-- tr>td*5  -->
                <tr>
                    <td><?php echo $alumno['nif']; ?></td>
                    <td><?php echo $alumno['nombre']; ?></td>
                    <td><?php echo $alumno['fechanac']; ?></td>
                    <td><?php echo $alumno['pagado']; ?></td>
                    <td><?php echo $alumno['importe']; ?></td>
                    <!-- En cada fila pongo un botón Eliminar -->
                    <td>
                        <form action="#" method="post">
                            <input type="hidden" name="nif"
                                value="<?php echo $alumno['nif']; ?>">
                            <button type="submit" name="cargar"
                                class="btn btn-outline-primary">Actualizar</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <!-- Línea de separación -->
    <hr class="m-3 border border-primary border-5">

    <?php
    if (isset($_REQUEST['cargar'])) {
        // Cargo el formulario con el registro seleccionado
        // Desactivo las excepciones por error en el driver MYSQLi
        mysqli_report(MYSQLI_REPORT_OFF);

        // Recojo el campo Clave principal
        $nif = $_REQUEST['nif'];

        $sql = "SELECT * FROM alumnos WHERE nif = ?";
        $sentenciaPreparada = $conexion->prepare($sql);
        $sentenciaPreparada->bind_param("s", $nif);
        $ejecutaSQL = $sentenciaPreparada->execute();

        $fila = $sentenciaPreparada->get_result();
        $alumno = $fila->fetch_assoc();

    ?>

        <form action="#" method="post" class="m-3 shadow-lg">
            <!-- Campo NIF -->
            <label for="nif" class="form-label">NIF:</label>
            <input type="text" name="nif" id="nif"
                class="form-control w-50" required disabled
                value="<?php echo $alumno['nif']; ?>"><br>
            <!-- -->
            <!-- Campo Nombre -->
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre"
                class="form-control w-50" required
                value="<?php echo $alumno['nombre']; ?>"><br>
            <!-- -->
            <!-- Campo FechaNac -->
            <label for="fechanac" class="form-label">Fecha Nacimiento:</label>
            <input type="date" name="fechanac" id="fechanac"
                class="form-control w-50" required
                value="<?php echo $alumno['fechanac']; ?>"><br>
            <!-- -->
            <!-- -->
            <!-- Campo Pagado -->
            <label class="form-label">Pagado?</label><br>
            <input type="radio" name="pagado" value="si" id="si">
            <label for="si">SI</label><br>
            <input type="radio" name="pagado" value="no" id="no">
            <label for="no">NO</label><br><br>
            <!-- -->
            <!-- -->
            <!-- Campo Importe -->
            <label for="importe" class="form-label">Importe:</label>
            <input type="number" name="importe" id="importe"
                class="form-control w-50" required step="0.05"
                value="<?php echo $alumno['importe']; ?>"><br>
            <!-- -->
            <hr class="border border-primary border-5 w-50">
            <button type="submit" class="btn btn-success" name="enviar">Enviar</button>
        </form>

    <?php
    }
    ?>

    <!-- Defino enlaces de navegación -->
    <section class="row">
        <nav class="col">
            <a href="01-cargar-bbdd.php"
                class="btn btn-sm btn-warning w-100">Cargar BBDD</a>
            <a href="02-consultar.php"
                class="btn btn-sm btn-success w-100">Consultar Productos</a>
        </nav>
        <nav class="col">
            <a href="04-actualizar.php"
                class="btn btn-sm btn-secondary w-100">Actualizar Producto</a>
            <a href="05-eliminar.php"
                class="btn btn-sm btn-danger w-100">Eliminar Producto</a>
        </nav>A a<
    </section>
</body>

</html>