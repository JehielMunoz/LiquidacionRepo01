
<?php

if (!empty($_POST["Rut"]))   # SI SE ENVIAN DATOS POR POST, CARGA TODA LA INFORMACION RELACIONDA A la persona en las variables globales.
 {
    $_SESSION['rut'] =  $_POST["Rut"];
    $_SESSION['nombre'] = $_POST["AutoNombre"];         
    $_SESSION['datos'] = get_Datos();
    $_SESSION['afp'] = get_AFP();
    $_SESSION['isapre'] = get_ISAPRE();
    $_SESSION['contrato'] = get_Contrato();
 }
else
{
    echo ("Error RUT");
} 

// datos para la conexion a mysql
// Crea Constantes para la base de datos
    function get_Personas(){ 
      
        $dbServer = 'localhost';
        $dbUser = 'postgres';
        $dbPass = '852456';
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
            
            $data [] = [$row["Rut"],$row["Nombre"]];   
           
        }
        
        echo json_encode($data);
    }


function get_Datos(){
        $dbServer = 'localhost';
        $dbUser = 'postgres';
        $dbPass = '852456';
        $dbName = 'prueba';
        $dbPort = '5432';
        $conn_string =("host=$dbServer port=$dbPort dbname=$dbName user=$dbUser password=$dbPass ");
        $dbconn = pg_connect($conn_string);
       
        $query = pg_query($dbconn, "SELECT * FROM \"tEmpleados\" where \"Rut\" = '".$_SESSION['rut']."' ");
        $row = pg_fetch_assoc($query);
        return $row;
}

function Rut()
{
  if (!empty($_SESSION["rut"]))
    {
        echo $_SESSION['rut'];
    }     
}
function Nombre()
{
  if (!empty($_SESSION["nombre"]))
    {
        echo $_SESSION['nombre'];
    }
   
    
}


    function Sueldo_Base()
    {   if (!empty($_SESSION['datos'])) // Es una paja tener que comprobar, pero  es la unica forma de que no se quiebre la pagina cuando carga sin la función
       {   
           
            echo ($_SESSION['datos']["Sueldo_base"]);
        }
        
    }  
    
     function Sueldo_Bruto()
    {   if (!empty($_POST["AutoNombre"])) // Es una paja tener que comprobar, pero  es la unica forma de que no se quiebre la pagina cuando carga sin la función
       {   
        
        }
        
    } 
     function Sueldo_Liquido()
    {   if (!empty($_POST[""])) // Es una paja tener que comprobar, pero  es la unica forma de que no se quiebre la pagina cuando //carga sin la función
        {   
           
        }
        
    } 
    
function Hora()
{
    if(!empty($_SESSION['datos']))
    {
        echo $_SESSION['datos']["N_horas"];    
    }
}
function Valor_Hora()
{
    if(!empty($_SESSION['datos']))
    {
        echo $_SESSION['datos']["Paga_por_hora"];    
    }
}

function nombre_AFP()
{
    if(!empty($_SESSION['afp']))
    {
        echo $_SESSION['afp']['AFP'];
    }
}
function tasa_AFP()
{
    if(!empty($_SESSION['afp']))
    {
        echo $_SESSION['afp']['Tasa'];
    }
}
function sis_AFP()
{
    if(!empty($_SESSION['afp']))
    {
        echo $_SESSION['afp']['SIS'];
    }
}
function nombre_ISAPRE()
{
    if(!empty($_SESSION['isapre']))
    {
        echo $_SESSION['isapre']['ISAPRE'];
    }
}
function tasa_ISAPRE()
{
    if(!empty($_SESSION['isapre']))
    {
        echo $_SESSION['isapre']['Tasa'];
    }
}
function Tipo_Contrato()
{
    if(!empty($_SESSION['contrato']))
    {
        echo $_SESSION['contrato']['Contrato'];
    }
   
}



# Estan funciones se tienen que  conectar a la base de datos por qué tienen que sacar informacion de otras tablas.
function get_AFP() 
{
        $dbServer = 'localhost';
        $dbUser = 'postgres';
        $dbPass = '852456';
        $dbName = 'prueba';
        $dbPort = '5432';
        $conn_string =("host=$dbServer port=$dbPort dbname=$dbName user=$dbUser password=$dbPass ");
        $dbconn = pg_connect($conn_string);
        $query = pg_query($dbconn, "SELECT * FROM \"tAFP\" where \"id_AFP\" = '".$_SESSION['datos']['id_AFP']."' ");
        $row = pg_fetch_assoc($query);
        return $row;    
}

function get_ISAPRE()
{
        $dbServer = 'localhost';
        $dbUser = 'postgres';
        $dbPass = '852456';
        $dbName = 'prueba';
        $dbPort = '5432';
        $conn_string =("host=$dbServer port=$dbPort dbname=$dbName user=$dbUser password=$dbPass ");
        $dbconn = pg_connect($conn_string);
        $query = pg_query($dbconn, "SELECT * FROM \"tISAPRE\" where \"id_ISAPRE\" = '".$_SESSION['datos']['id_ISAPRE']."' ");
        $row = pg_fetch_assoc($query);
        return $row;    
}

function get_Contrato()
{
        $dbServer = 'localhost';
        $dbUser = 'postgres';
        $dbPass = '852456';
        $dbName = 'prueba';
        $dbPort = '5432';
        $conn_string =("host=$dbServer port=$dbPort dbname=$dbName user=$dbUser password=$dbPass ");
        $dbconn = pg_connect($conn_string);
        $query = pg_query($dbconn, "SELECT * FROM \"tContratos\" where \"id_Contrato\" = '".$_SESSION['datos']['id_Contrato']."' ");
        $row = pg_fetch_assoc($query);
        return $row;    
}

?>