<!-- http://localhost/Curso/PHP/Ejemplo_00_Plantilla.php -->

<?php
/* Recogemos datos del formulario */
$alerta = "Mensaje...";

// Solo si se envía el formulario, se definen las variables del alert
if (isset($_REQUEST['enviar'])) {
    
    $comentario = $_REQUEST['comentario'] ?? '';
    $numEmpleado = $_REQUEST['numEmpleado'] ?? '';
    $entradaSalida = $_REQUEST['entradaSalida'] ?? '';

    // En el caso del checkbox se envía un array
    $turno = $_REQUEST['turno'] ?? [];
    $incidencia = $_REQUEST['incidencia'] ?? '';

    // ?? '' es para cuando NO se envía el dato...
    $fecha = $_REQUEST['fecha'] ?? '';

    // implode sirve para escribir los elementos del array
    $turnoValores = implode(', ', $turno);
    $alerta = " Comentarios: $comentario
        NºEmpleado: $numEmpleado
        Entrada/Salida: $entradaSalida
        Turno: $turnoValores
        Incidencia: $incidencia
        Fecha: $fecha";
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
        <!-- -->
        <!-- Campo comentario -->
        <label for="comentario" class="form-label">Comentarios:</label>
        <input type="text" name="comentario" id="comentario" 
        class="form-control w-50" required><br>
        <!-- -->
        <!-- Campo NumEmpleado -->
        <label for="numEmpleado" class="form-label">Nº Empleado:</label>
        <input type="number" name="numEmpleado" id="numEmpleado" 
        class="form-control w-50" required><br>
        <!-- -->
        <!-- Campo Entrada/Salida -->
        <label class="form-label">Entrada/Salida</label><br>
        <input type="radio" name="entradaSalida" value="Entrada" id="entrada">
        <label for="entrada">Entrada</label><br>
        <input type="radio" name="entradaSalida" value="Salida" id="salida">
        <label for="salida">Salida</label><br><br>
        <!-- -->
        <!-- Campo Turno -->
        <label class="form-label">Turno</label><br>
        <input type="checkbox" name="turno[]" value="Dia" id="dia">
        <label for="dia">Día</label><br>
        <input type="checkbox" name="turno[]" value="Noche" id="noche">
        <label for="noche">Noche</label><br><br>
        <!-- -->
        <hr class="border border-primary border-5 w-50">
        <!-- -->
        <!-- Campo Incidencia -->
        <label for="incidencia" class="form-label">Incidencia</label>
        <select name="incidencia" id="incidencia" class="form-select w-50">
            <option value="">Seleccione...</option>
            <option value="Falta">Falta</option>
            <option value="HorasExtra">Horas Extra</option>
        </select><br>
        <!-- -->
        <!-- Campo Fecha -->
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" name="fecha" id="fecha" class="form-control w-50"><br>
        <!-- -->
        <hr class="border border-primary border-5 w-50">
        <button type="submit" class="btn btn-success" name="enviar">Enviar</button>
    </form>
</body>
</html>
