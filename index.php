<?php
// inicia la session de usuario
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
//Requiere que cargue el archivo conexion, con la informacion de la DB, para que el resto de la pagina carge.
require "./php/Conexion.php";
get_datos();

// Carga las variables y las funciones

require './php/Variables.php';
require './php/funciones.php';

// Arma el html de la pagina.
require './php/Inicio_Carga.php';

?>