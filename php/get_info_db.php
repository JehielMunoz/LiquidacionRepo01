
         
<?php 
    function get_Datos(){
        $dbServer = 'localhost';
        $dbUser = 'postgres';
        $dbPass = '852456';
        $dbName = 'prueba';
        $conn_string = "host=$dbServer port=5432 dbname=$dbName user=$dbUser password=$dbPass";
        $dbconn = new pg_connect($conn_string);
        if (isset($_POST["Rut"]))
            {
                $Rut= $_POST["Rut"];   
                $_SESSION['rut'] = $Rut;
                $query = $dbconn->pg_query($dbconn, "SELECT * FROM tEmpleados where Rut=".$Rut or die('connection failed'));
                $row = $query->pg_fetch_assoc();
                return $row;
        
                
            }
        else
        {
            echo "Error en recuperar el rut." ;   
        }
      
        
    }

?>