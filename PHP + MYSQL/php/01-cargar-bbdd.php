<!-- http://localhost/php/01-cargar-bbdd.php -->

<?php
// Llamar a errores y funciones
require("errores.php");
require("funciones.php");


// Lamamos a la base de datos
$conexion = conectar();


/* Recogemos datos del formulario */
$alerta = "Mensaje...";

// Solo si se envía el formulario, se definen las variables del alert
if (isset($_REQUEST['enviar'])) {
    $archivoSQL = "MiConexion_simplificando.sql";
    $contenidoSQL = file_get_contents($archivoSQL);

    // Formato procedimental
    // cargaBBDD es un boleano
    // $cargaBBDD = mysqli_multi_query($conexion,$contenidoSQL);

    // Formato POO
    $cargaBBDD = $conexion -> multi_query($contenidoSQL);
    if ($cargaBBDD) {
        $alerta = "La carga es correcta";
    } else {
        $alerta = "Error, no se ha cargado la base de datos";
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

        <button type="submit" class="btn btn-primary" name="enviar">Cargar BBDD</button>

    </form>

    <!-- Defino enlaces de navegación -->
    <section class="row">
        <nav class="col">
            <a href="Ejemplo_02_consultar.php" class="btn btn-sm btn-primary w-100">Consultar Productos</a>

            <a href="03-insertar.php" class="btn btn-sm btn-warning w-100">Insertar Producto</a>
        </nav>

        <nav class="col">
            <a href="04-actualizar.php" class="btn btn-sm btn-secondary w-100">Actualizar Producto</a>

            <a href="05-eliminar.php" class="btn btn-sm btn-danger w-100">Eliminar Producto</a>
        </nav>
    </section>
</body>

</html>