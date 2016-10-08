<?php
# Rut inicial
    $_SESSION['Rut']="";
# Si resive un rut completa los datos
    if (!empty($_POST["Rut"])) 
     {
        $_SESSION['Rut'] =  $_POST["Rut"];
        $_SESSION['Nombre'] = $_POST["AutoNombre"];         
        $_SESSION['Datos'] = get_Datos();
        $_SESSION['Afp'] = get_AFP();
        $_SESSION['Isapre'] = get_ISAPRE();
        $_SESSION['Contrato'] = get_Contrato();
     }
#si no inicia en 0 la informacion
    else{
        $_SESSION['Rut'] = "";
        $_SESSION['Nombre'] ="";         
        $_SESSION['Datos'] = "";
        $_SESSION['Afp'] = "";
        $_SESSION['Isapre'] = "";
        $_SESSION['Contrato'] = "";
     }
    function html_llamada($archivo){
        if (file_exists('./html/'.$archivo)) {
            include('./html/'.$archivo);
        }   
        else {
            exit(1);
        }

    }
    function php_llamada($archivo){
		if (file_exists('./php/'.$archivo)) {
			include('./php/'.$archivo);
			}
		else {
			exit(1);
			}	
	}
	// llama a partes de la pagina (cabeza, cuerpo y cierre)
	function get_Header()
	{  
		html_llamada("header.php");
	}
    // LLama a la estructura de la pagina(todas las paginas)
    function get_Estructura() 
	{
		html_llamada("estructura.php");
	}
    // LLama a la estructura de la pagina(todas las paginas)
    function get_Contenido() 
	{
		html_llamada("contenido.php");
	}
	function get_Footer(){
		html_llamada("footer.php");		
	}	
 #
    function get_session_rut(){
        echo json_encode($_SESSION["Rut"]);
    }

#-----------------------------------------------------------------------------------------------------------------------------
# funciones Para obtener la informacion de las personas
#-----------------------------------------------------------------------------------------------------------------------------
    function get_Personas(){ 
        include("conex.inc");
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
            include("conex.inc");
            $query = pg_query($dbconn, "SELECT * FROM \"tEmpleados\" where \"Rut\" = '".$_SESSION['Rut']."' ");
            $row = pg_fetch_assoc($query);
            return $row;
    }   
#------------------------------------------------------------------------------------------------------------------
# Funciones para mostrar los datos
#-----------------------------------------------------------------------------------------------------------------
    function Rut()
    {
      if (!empty($_SESSION["Rut"]))
        {
            echo $_SESSION['Rut'];
        }     
    }
    function Nombre()
    {
      if (!empty($_SESSION["Nombre"]))
        {
            echo $_SESSION['Nombre'];
        }


    }
    function Sueldo_Base(){   
        if (!empty($_SESSION['Datos'])) 
       {      
            echo ($_SESSION['Datos']["Sueldo_base"]);
        }
        
    }  
    
     function Sueldo_Bruto()
    {   if (!empty($_POST["AutoNombre"]))
       {   
        
        }
        
    } 
# Aun queda ingresar formulas
     function Sueldo_Liquido()
    {   if (!empty($_POST[""])) 
        {   
           
        }
        
    }    
    function Hora()
    {
        if(!empty($_SESSION['Datos']))
        {
            echo $_SESSION['Datos']["N_horas"];    
        }
    }
    function Valor_Hora()
    {
        if(!empty($_SESSION['Datos']))
        {
            echo $_SESSION['Datos']["Paga_por_hora"];    
        }
    }

    function nombre_AFP()
    {
        if(!empty($_SESSION['Afp']))
        {
            echo $_SESSION['Afp']['AFP'];
        }
    }
    function tasa_AFP()
    {
        if(!empty($_SESSION['Afp']))
        {
            echo $_SESSION['Afp']['Tasa'];
        }
    }
    function sis_AFP()
    {
        if(!empty($_SESSION['Afp']))
        {
            echo $_SESSION['Afp']['SIS'];
        }
    }
    function nombre_ISAPRE()
    {
        if(!empty($_SESSION['Isapre']))
        {
            echo $_SESSION['Isapre']['ISAPRE'];
        }
    }
    function tasa_ISAPRE()
    {
        if(!empty($_SESSION['Isapre']))
        {
            echo $_SESSION['Isapre']['Tasa'];
        }
    }
    function Tipo_Contrato()
    {
        if(!empty($_SESSION['Contrato']))
        {
            echo $_SESSION['Contrato']['Contrato'];
        }

    }
#------------------------------------------------------------------------------------------------------------------------
# Estan funciones se tienen que  conectar a la base de datos por qué tienen que sacar informacion de otras tablas.
#------------------------------------------------------------------------------------------------------------------------
    function get_AFP() 
    {
            include("conex.inc");
            $query = pg_query($dbconn, "SELECT * FROM \"tAFP\" where \"id_AFP\" = '".$_SESSION['Datos']['id_AFP']."' ");
            $row = pg_fetch_assoc($query);
            return $row;    
    }

    function get_ISAPRE()
    {
            include("conex.inc");
            $query = pg_query($dbconn, "SELECT * FROM \"tISAPRE\" where \"id_ISAPRE\" = '".$_SESSION['Datos']['id_ISAPRE']."' ");
            $row = pg_fetch_assoc($query);
            return $row;    
    }

    function get_Contrato()
    {
            include("conex.inc");
            $query = pg_query($dbconn, "SELECT * FROM \"tContratos\" where \"id_Contrato\" = '".$_SESSION['Datos']['id_Contrato']."' ");
            $row = pg_fetch_assoc($query);
            return $row;    
    }
#------------------------------------------------------------------------------------------------------------------------

    function Desconectar(){
        if (!empty($_POST["Desconectar"])){ 
        include("desconexion.php");}
        
    }
?>