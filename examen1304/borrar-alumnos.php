<!-- http://localhost/Curso/PHP/borrar-alumnos.php -->

<?php
// Llamar a errores y funciones
require("errores.php");
require("funciones.php");

/* Recogemos datos del formulario */
$alerta = "";

// Llamamos a la BBDD
$conexion = conectarBBDD();



// Si se pulsa SI, se elimina por referencia
if (isset($_REQUEST['eliminar'])) {
    // Desactivo las excepciones por error en el driver MYSQLi
    mysqli_report(MYSQLI_REPORT_OFF);

    // Borramos el registro con una SENTENCIA PREPARADA
    $nif = $_REQUEST['nif'];
    $sql = "DELETE FROM alumnos WHERE nif = ?";
    $sentenciaPreparada = $conexion->prepare($sql);
    $sentenciaPreparada->bind_param("s", $nif);

    $ejecutaSQL = $sentenciaPreparada->execute();
    if($ejecutaSQL) {
        $alerta .= "<br> Registro eliminado!";
    } else {
        $alerta .= "<br> ERROR en el borrado: " . $conexion->error;
    }

}

// Si se pulsa NO, concateno este mensaje
if (isset($_REQUEST['volver'])) {
    $alerta .= "<br>No se ha borrado nada";
}

// Hacemos la consulta
$consulta = "SELECT * FROM alumnos";
$filas = $conexion->query($consulta);
$numFilas = $filas->num_rows;
$alerta .= "<br> Nº de Registros: " . $numFilas;
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
    <style>
        table td form {
            display: inline;
        }
    </style>
</head>

<body>
    <!-- En el alert presentamos los datos recogidos del formulario -->
    <header>
        <p class="alert alert-primary m-3 w-50" style="white-space: pre-line;">
            <?php echo $alerta; ?>
        </p>
    </header>

    <!-- En el class defino bootstrap-->
    <section class="container align-center m-3 w-70 bg-primary">

        <table class="table">
            <thead>
                <tr>
                    <th>NIF</th>
                    <th>Nombre</th>
                    <th>Fecha Nacimiento</th>
                    <th>Pagado</th>
                    <th>Importe</th>
                    <th></th>
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
                                <input type="hidden" name="nombre"
                                    value="<?php echo $alumno['nombre']; ?>">
                                <button type="submit" name="confirmar" class="btn btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </section>
    <hr class="m-3 border border-primary border-5 w-50">

    <?php
    if (isset($_REQUEST['confirmar'])) {
    ?>
        <p>¿Desea eliminar <?php echo $_REQUEST['nombre']; ?>?</p>
        <form action="#" method="post">
            <input type="hidden" name="nif"
                value="<?php echo $_REQUEST['nif']; ?>">
            <button type="submit" name="eliminar"
                class="btn btn-outline-danger">SI</button>
            <button type="submit" name="volver"
                class="btn btn-outline-success">NO</button>
        </form>
    <?php
    }
    ?>

    <form action="#" method="post" class="m-3 shadow-lg">
        <button type="submit" class="btn btn-success" name="enviar">Consultar</button>
    </form>
    
    <!-- Defino enlaces de navegación -->
    <section class="row">
        <nav class="col">
            <a href="index.php"
                class="btn btn-sm btn-success w-100">Ir al Inicio</a>
        </nav>
    </section>
</body>

</html>