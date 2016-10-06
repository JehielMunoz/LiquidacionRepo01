<?php 
    $id_Descuento = 0;
    $id_Rut = "";
    $id_Descuento = $_POST["num"];
    $id_Rut = $_POST["rut"];
    $dbServer = 'localhost';
    $dbUser = 'postgres';
    $dbPass = 'wii360';
    $dbName = 'prueba';
    $dbPort = '5432';  
    $conn_string =("host=$dbServer port=$dbPort dbname=$dbName user=$dbUser password=$dbPass ");
    $dbconn = pg_connect($conn_string);
    if (!$dbconn){
        echo "Falla en la conexion a la base de datos";
        exit;
    }

?>
