
<?php
// datos para la conexion a mysql
// Crea Constantes para la base de datos
    function get_Personas(){ 
        $id = 0;
        $dbServer = 'localhost';
        $dbUser = 'postgres';
        $dbPass = 'wii360';
        $dbName = 'prueba';
        $dbPort = '5432';
        $conn_string =("host=$dbServer port=$dbPort dbname=$dbName user=$dbUser password=$dbPass ");
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
        while ($row = pg_fetch_assoc($query)) {
            
            $data [] = [$id,$row["Nombre"]];   
            $id=$id+1;
        }
        
        echo json_encode($data);
    }


function get_Datos(){
        $dbServer = 'localhost';
        $dbUser = 'postgres';
        $dbPass = 'wii360';
        $dbName = 'prueba';
        $dbPort = '5432';
        $conn_string =("host=$dbServer port=$dbPort dbname=$dbName user=$dbUser password=$dbPass ");
        $dbconn = pg_connect($conn_string);
        if (!empty($_POST["id_nombre"]))
            {
                $id = $_POST["id_nombre"];   
                
            }
        else
        {
            $id = 1;    
        } 
        $query = pg_query($dbconn, "SELECT * FROM \"tEmpleados\" where \"Nombre\" = '$id' ");
        $row = pg_fetch_assoc($query);
        return $row;
}   
    
    
    function Sueldo_Base()
    {   if (!empty($_POST["AutoNombre"])) // Es una paja tener que comprobar, pero  es la unica forma de que no se quiebre la pagina cuando carga sin la función
       {   
           $DATOS = get_Datos();
            echo ($DATOS["Sueldo_base"]);
        }
        
    }  
    
     function Sueldo_Bruto()
    {   if (!empty($_POST["AutoNombre"])) // Es una paja tener que comprobar, pero  es la unica forma de que no se quiebre la pagina cuando carga sin la función
       {   
            $DATOS = get_Datos();
            echo ($DATOS[""]);
        }
        
    } 
     function Sueldo_Liquido()
    {   if (!empty($_POST[""])) // Es una paja tener que comprobar, pero  es la unica forma de que no se quiebre la pagina cuando //carga sin la función
        {   
            $DATOS = get_Datos();
            echo ($DATOS[""]);
        }
        
    } 
    
?>