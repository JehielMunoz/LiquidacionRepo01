<!DOCTYPE html>
<html>
<head></head>
<body>
<?php
        $dbServer = 'localhost';
        $dbUser = 'postgres';
        $dbPass = 'wii360';
        $dbName = 'prueba';
        $conn_string =("host=localhost port=5432 dbname=prueba user=postgres password=wii360");
        $dbconn = pg_connect($conn_string);
        if (!$dbconn){
            echo "en el logeo";
            exit;
        }
        $query = pg_query($dbconn, "SELECT * FROM \"tEmpleados\" ");
        if (!$query) {
        echo "en el query.\n";
        exit;
}
        while ($fila = pg_fetch_assoc($query)) {
            echo $fila["N_horas"];
            echo  $fila["Nombre"];
            echo "kñlkñlk $horas $nombre";
        }
                
        
?>
</body>
</html>