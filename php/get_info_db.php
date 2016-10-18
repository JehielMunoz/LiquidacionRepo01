
         
<?php 
    function get_Datos(){
        $dbServer = 'localhost';
        $dbUser = 'postgres';
        $dbPass = 'wii360';
        $dbName = 'prueba';
        $conn_string = "host=$dbServer port=5432 dbname=$dbName user=$dbUser password=$dbPass";
        $dbconn = new pg_connect($conn_string);
        if (!empty($_POST["id_nombre"]))
            {
                $id = $_POST["id_nombre"];   
                
            }
        else
        {
            $id = 1;    
        } 
        $query = $dbconn->pg_query($dbconn, "SELECT * FROM tEmpleados where id_Nombre=".$id or die('connection failed'));
        $row = $query->pg_fetch_assoc();
        return $row;
        
        
    }

?>