<!-- http://localhost/Curso/PHP/consultar-alumnos.php -->

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

    // Hacemos la consulta
    $consulta = "SELECT * 
                FROM alumnos,docentes
                WHERE docentes.nif = alumnos.docentes_nif";
    $filas = $conexion->query($consulta);
    $numFilas = $filas->num_rows;
    $alerta = "Nº de Registros: " . $numFilas;
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
    <style>
        header p.alert {
            background-color: pink;
        }

        table.table tr th {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 20px;
        }

        button.btn {
            color: black;
        }

        /* Al pasar por encima */
        button.btn:hover {
            transform: scale(2);
        }

        /* Quiero un fondo degradado de izquierda a derecha rojo a azul 
        para toda la página */
        body {
            background: linear-gradient(to right, red, blue);
        }

        /* Todos los elementos de la página en cursiva */
        * {
            font-style: italic;
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
        <!-- Inyección de script (PHP)-->
        <?php
        // Si se envia el formulario, cargo la tabla
        if (isset($_REQUEST['enviar'])) {
        ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nif Alumno</th>
                        <th>Nombre</th>
                        <th>Fecha Nacimiento</th>
                        <th>Pagado</th>
                        <th>Importe</th>
                        <th>Nif Docente</th>
                        <th>Nombre Docente</th>
                        <th>Edad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php       // Asocio la salida a su campo
                    $alumnos = $filas->fetch_all(MYSQLI_NUM);
                    foreach ($alumnos as $alumno) {
                    ?>
                        <!-- tr>td*5  -->
                        <tr>
                            <td><?php echo $alumno[0]; ?></td>
                            <td><?php echo $alumno[1]; ?></td>
                            <td><?php echo $alumno[2]; ?></td>
                            <td><?php echo $alumno[3]; ?></td>
                            <td><?php echo $alumno[4]; ?></td>
                            <td><?php echo $alumno[5]; ?></td>
                            <td><?php echo $alumno[7]; ?></td>
                            <td><?php echo $alumno[8]; ?></td>
                        </tr>
                    <?php 
                    } 
                    ?>
                </tbody>
            </table>
        <?php
        }
        ?>
    </section>
    <hr class="m-3 border border-primary border-5 w-50">
    
    <form action="#" method="post" class="m-3 shadow-lg">
        <button type="submit" class="btn btn-success" name="enviar">Ver alumnos</button>
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