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
            $data[] = [$row['id'],$row['nombre']];
        }
        echo json_encode($data);    //return variable php a javascript
    }
    
    if (!empty($_POST["AutoNombre"]))
    {
        // Si se envio nombre por el formulario, carga la informacion relacionada con el nombre desde la base de datos.
        include './php/get_info_db.php' ;
        
        
        
        
    }
    function Sueldo_Base()
    {   if (!empty($_POST["AutoNombre"])) // Es una paja tener que comprobar, pero  es la unica forma de que no se quiebre la pagina cuando carga sin la función
        {   
            $DATOS = get_Datos();
            echo ($DATOS['sueldo_base']);
        }
        
    }  
    
     function Sueldo_Bruto()
    {   if (!empty($_POST["AutoNombre"])) // Es una paja tener que comprobar, pero  es la unica forma de que no se quiebre la pagina cuando carga sin la función
        {   
            $DATOS = get_Datos();
            echo ($DATOS['sueldo_bruto']);
        }
        
    } 
     function Sueldo_Liquido()
    {   if (!empty($_POST["AutoNombre"])) // Es una paja tener que comprobar, pero  es la unica forma de que no se quiebre la pagina cuando carga sin la función
        {   
            $DATOS = get_Datos();
            echo ($DATOS['sueldo_liquido']);
        }
        
    } 
    
?>