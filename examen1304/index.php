<!-- http://localhost/examen1304/index.php -->

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
            MENU FPPRO
        </p>
    </header>

    <!-- Línea de separación -->
    <hr class="m-3 border border-primary border-5 w-50">

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