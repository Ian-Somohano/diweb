<?php
// Funciones PHP

function conectar() {
    // Variables de conexion
    $servidor = "localhost";
    $usuario = "root";
    $clave = "root";

    // A. Formato procedimental
    // $conexion = mysqli_connect($servidor, $usuario, $clave);

    // B. Formato POO
    // new es el constructor parar crear objetos
    $conexion = new mysqli($servidor, $usuario, $clave);

    if($conexion -> connect_error) {
        die("ERROR, ".$conexion ->connect_errno);
    } else {
        // La conexion es correcta
        echo "La conexion es correcta";
    }

    return $conexion;
}

 function conectarBBDD() {
    // Variables de conexion
    $servidor = "localhost";
    $usuario = "root";
    $clave = "root";
    $bbdd = "simplificando";

    // A. Formato procedimental
    // $conexion = mysqli_connect($servidor, $usuario, $clave, $bbdd);

    // B. Formato POO
    // new es el constructor parar crear objetos
    $conexion = new mysqli($servidor, $usuario, $clave, $bbdd);

    if($conexion -> connect_error) {
        die("ERROR, ".$conexion ->connect_errno);
    } else {
        // La conexion es correcta
        echo "La conexion es correcta";
    }

    return $conexion;
}