<?php
// funciones.php

function conectar() {
    // Variables de conexión
    $servidor = "localhost";
    $usuario = "root";
    $clave = "root";

    // A) Formato procedimental
    // $conexion = mysqli_connect($servidor, $usuario, $clave);

    // B) Formato POO (Programación Orientada a Objetos)
    // new -> Constructor, para crear objetos
    $conexion = new mysqli($servidor, $usuario, $clave);

    if($conexion->connect_error) {
        die("ERROR!,".$conexion->connect_errno);
    } else {
        echo "La conexión es correcta";
    }

    return $conexion;
}


function conectarBBDD() {
    // Variables de conexión
    $servidor = "localhost";
    $usuario = "root";
    $clave = "root";
    $bbdd = "fp_pro";

    // A) Formato procedimental
    // $conexion = mysqli_connect($servidor, $usuario, $clave, $bbdd);

    // B) Formato POO (Programación Orientada a Objetos)
    // new -> Constructor, para crear objetos
    $conexion = new mysqli($servidor, $usuario, $clave, $bbdd);

    if($conexion->connect_error) {
        die("ERROR!,".$conexion->connect_errno);
    } else {
        echo "La conexión es correcta";
    }

    return $conexion;
}



// errores.php
ini_set('display_errors',1);            // Muestra errores por pantalla
ini_set('display_startup_errors',1);    // Muestra al inicio
error_reporting(E_ALL);                 // Muestra TODOS los errores

ini_set('error_log','errores.log');     // Graba errores en archivo
ini_set('log_errors',1);                // Activa el grabado errores

/**
 * Comentario Multilínea
 * Debemos configurar errores a nivel de servidor:
 * Consola:
 * sudo nano /etc/php/8.3/cli/php.ini
 * Las siguientes secciones se les quita los ;
 * - display_errors
 * - display_startup_errors
 * - error_reporting
 * - log_errors
 * Al final guardar y salir: CTRL + O y CTRL + X
 * Y por último reiniciar el apache
 * sudo service apache2 restart
 */

//  echo $variable;
//  require "miarchivo.php";
//  echo "Hola clase";