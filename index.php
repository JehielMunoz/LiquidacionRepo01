<?php
// inicia la session de usuario
session_start();
header('Content-type: text/html; charset=utf-8');

include_once "conexion.php";

$pag_base_directorio = dirname(__FILE__);

include('configuraciones.php');
include('funciones/inicio.php');

?>