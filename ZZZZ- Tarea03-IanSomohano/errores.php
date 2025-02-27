<?php

// Errores PHP
ini_set('display_errors', 1); // Esto muestra errorres por pantalla
ini_set('display_startup_errors', 1); // Esto muestra al inicio
error_reporting(E_ALL);

ini_set('error_log','errores.log'); // Esto graba los errores en archivo
ini_set('log_errors', 1); // Activa el grabado errores

// Comprobar si sale los errores con esto:

/*
 echo $variable;
 require "miarchivo.php";

 echo "Hola clase";
*/