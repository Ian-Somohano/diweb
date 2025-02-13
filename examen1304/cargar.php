<!-- http://localhost/examen1304/cargar.php -->

<?php

// Llamar a errores y funciones
require("errores.php");
require("funciones.php");

// Llamamos a la BBDD
// OJO! En este php es el único donde usaremos conectar
$conexion = conectar();

/* Definimos el mensaje por defecto */
$alerta = "Mensaje...";

// Solo si se envía el botón del formulario
// se carga el SQL con el archivo correspondiente...
if (isset($_REQUEST['enviar'])) {
    $archivoSQL = "fp_pro.sql";
    $contenidoSQL = file_get_contents($archivoSQL);

    /* Formato procedimental */
    // $cargaBBDD -> Booleano: true (correcto), false (error)
    // $cargaBBDD = mysqli_multi_query($conexion, $contenidoSQL);

    // Formato POO
    $cargaBBDD = $conexion->multi_query($contenidoSQL);

    // Como $cargaBBDD es booleano, SI es correcto... 
    if($cargaBBDD) {
        $alerta = "Inserción correcta";
    } // Y si no es correcto (false)
    else {
        $alerta = "ERROR, no se ha cargado la BBDD";
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
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <!-- En el alert presentamos los datos recogidos del formulario -->
    <header>
        <p class="alert alert-primary m-3 w-50" style="white-space: pre-line;">
            <?php echo $alerta; ?>
        </p>
    </header>


    <!-- Línea de separación -->
    <hr class="m-3 border border-primary border-5 w-50">

    <form action="#" method="post" class="m-3 shadow-lg">
        <button type="submit" class="btn btn-success" name="enviar">Cargar</button>
    </form>

    <!-- Defino enlaces de navegación -->
    <section class="row">
        <nav class="col">
            <a href="cargar.php"
                class="btn btn-sm btn-success w-100">cargar BBDD</a>
            <a href="insertar-docentes.php"
                class="btn btn-sm btn-warning w-100">Inserta Docente</a>
            <a href="insertar-alumnos.php"
                class="btn btn-sm btn-warning w-100">Inserta Alumno</a>
        </nav>
        <nav class="col">
            <a href="consultar-docentes.php"
                class="btn btn-sm btn-secondary w-100">Consulta Docentes</a>
            <a href="consultar-alumnos.php"
                class="btn btn-sm btn-warning w-100">Consulta Alumnos/Docente</a>
            <a href="actualizar-alumnos.php"
                class="btn btn-sm btn-warning w-100">Actualizar Alumnos</a>
            <a href="borrar-alumnos.php"
                class="btn btn-sm btn-danger w-100">Borrar Alumnos</a>
        </nav>
    </section>
</body>

</html>