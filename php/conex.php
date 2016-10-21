<?php
    $dbServer = 'localhost';
    $dbUser = 'postgres';
    $dbPass = 'wii360';
    $dbName = 'prueba';
    $dbPort = '5432';
    $conn_string =("host=$dbServer port=$dbPort dbname=$dbName user=$dbUser password=$dbPass ");
    $dbconn = pg_connect($conn_string);
    if(!$dbconn){
        echo "Error de conexión A la base de datos"; 
        exit;
    }
?>
