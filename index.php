<?php
// inicia la session de usuario
session_start();
header('Content-type: text/html; charset=utf-8');

include_once "./php/conexion.php";

$pag_base_directorio = dirname(__FILE__);

include('./php/configuraciones.php');
include('./php/funciones/inicio.php');

?>