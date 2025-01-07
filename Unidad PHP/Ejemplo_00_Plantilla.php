<!-- http://localhost/Curso/PHP/Ejemplo_00_Plantilla.php -->
<?php
/* Recogemos datos del formulario */
$alerta = "Mensaje...";
if (isset($_REQUEST['enviar'])) {
    $alerta = $_REQUEST['usuario'];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla</title>
    <link rel="stylesheet" href="Bootstrap/bootstrap.min.css">
    <script src="bootstrap.bundle.min.js"></script>
</head>
<body>
    <header>
        <p class="alert alert-primary m-3 w-50">
            <?php echo $alerta ?>
        </p>
    </header>
    <form action="#" method="post" class="m-3 shadow-lg">
        <label for="usuario" class="form-label">usuario</label>
        <input type="text" name="usuario" id="usuario" 
        class="form-control w-50"><br>
        <hr class="border border-primary border-5 w-50">
        <button type="submit" class="btn btn-success" name="enviar">Enviar</button>
    </form>
</body>
</html>