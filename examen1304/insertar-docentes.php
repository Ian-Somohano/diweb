<!-- http://localhost/Curso/PHP/insertar-docentes.php -->
<?php
// Llamar a errores y funciones
require("errores.php");
require("funciones.php");

/* Recogemos datos del formulario */
$alerta = "Mensaje...";

// Solo si se envía el formulario, se definen las variables del alert
if (isset($_REQUEST['enviar'])) {
    // Llamamos a la BBDD
    $conexion = conectarBBDD();

    $nif = $_REQUEST['nif'] ?? '';
    $nombre = $_REQUEST['nombre'] ?? '';
    $edad = $_REQUEST['edad'] ?? '';
   
    $alerta = " NIF: $nif
        Nombre: $nombre
        Edad: $edad";

    // Ahora introducimos lo de arriba en la BBDD
    // Defino una Sentencia preparada (? por cada campo!)
    $sentenciaSQL = "INSERT INTO docentes 
                    (nif,nombre,edad) 
                    VALUES (?,?,?)";
    $sentenciaPreparada = $conexion->prepare($sentenciaSQL);
    // Encriptamos la sentencia (bind_param)
    $sentenciaPreparada->bind_param("ssi", 
    $nif,$nombre,$edad);

    // ejecutaSQL es booleano; true (correcto), false (error)
    $ejecutaSQL = $sentenciaPreparada->execute();
    if($ejecutaSQL){
        $alerta .= "<br> Inserción correcta";
    } else {
        $alerta .= "<br> ERROR FATAL (explota!)";
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

    <!-- Línea de separación -->
    <hr class="m-3 border border-primary border-5 w-50">

    <form action="#" method="post" class="m-3 shadow-lg">
        <!-- Campo NIF -->
        <label for="nif" class="form-label">NIF:</label>
        <input type="text" name="nif" id="nif"
            class="form-control w-50" required><br>
        <!-- -->
        <!-- Campo Nombre -->
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" name="nombre" id="nombre"
            class="form-control w-50" required><br>
        <!-- -->
        <!-- -->
        <!-- Campo Edad -->
        <label for="edad" class="form-label">Dime la edad:</label>
        <input type="number" name="edad" id="edad"
            class="form-control w-50" required><br>
        <!-- -->
        <hr class="border border-primary border-5 w-50">
        <button type="submit" class="btn btn-success" name="enviar">Insertar</button>
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