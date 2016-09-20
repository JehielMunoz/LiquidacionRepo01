<?php
// inicia la session de usuario
session_start();

//Requiere que cargue el archivo conexion, con la informacion de la DB, para que el resto de la pagina carge.
require "./php/conexion.php";

// Carga las variables y las funciones

require './php/Variables.php';
require './php/funciones.php';

// Arma el html de la pagina.
require './php/Inicio_Carga.php';


?>