<?php
// datos para la conexion a mysql

// Crea Constantes para la base de datos
    
    
    function get_Personas(){
        $dbServer = 'localhost';
        $dbUser = 'root';
        $dbPass = '';
        $dbName = 'prueba';
        $db = new mysqli($dbServer,$dbUser,$dbPass,$dbName);
        $query = $db->query("SELECT * FROM persona");
        while ($row = $query->fetch_assoc()) {
            $data[] = $row['nombre'];
        }
        echo json_encode($data);    
    }
    //return json data
    
    
?>