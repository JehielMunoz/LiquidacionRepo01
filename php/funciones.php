<?php
# Rut inicial
    #$_SESSION['Rut']=""; # ??? Cual es la necesidad de eso? I mean, que ocupa más recursos? Crear una variable que ocupa memoria? o hacer una consulta if isset? ademas ya haces la pregunta si esta vacia.
# Si resive un rut completa los datos
if(!isset($_SESSION['Rut']))
{
    if (!empty($_POST["Rut"])) 
     {
        $_SESSION['Rut'] =  $_POST["Rut"];
        $_SESSION['Nombre'] = $_POST["AutoNombre"];         
        $_SESSION['Datos'] = get_Datos();
        $_SESSION['Afp'] = get_AFP();
        $_SESSION['Isapre'] = get_ISAPRE();
        $_SESSION['Contrato'] = get_Contrato();
     }
}
#si no inicia en 0 la informacion // LO IDEAL SERIA DESTRUIR LAS VARIABLES CUANDO DEJEMOS DE USARLAS, AKA CUANDO LAS SUBIMOS A LA BASE DE DATOS. 
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
        if(!empty($_SESSION['Rut']))
        {
            echo json_encode($_SESSION["Rut"]);
        }
        else
        {
            echo ('""');    
        }
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
        if(!empty($_POST['Rut']))
        {
            include("conex.inc");
            $query = pg_query($dbconn, "SELECT * FROM \"tEmpleados\" where \"Rut\" = '".$_SESSION['Rut']."' ");
            $row = pg_fetch_assoc($query);
            return $row;
        }
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
    {   
        cal_Total_Imponible();
        Total_AFP();
        cal_Total_Descuentos();
        cal_sub_total();
        Liquido_Pagar();
        Liquido_Alcansado();
         if (!empty($_SESSION['Total_Haberes']))
       {   
            echo ($_SESSION['Total_Haberes']);
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
    {       if(!empty($_SESSION['Rut']))
            {
            include("conex.inc");
            $query = pg_query($dbconn, "SELECT * FROM \"tAFP\" where \"id_AFP\" = '".$_SESSION['Datos']['id_AFP']."' ");
            $row = pg_fetch_assoc($query);
            return $row;
            }
    }

    function get_ISAPRE()
    {       if(!empty($_SESSION['Rut']))
            {
            include("conex.inc");
            $query = pg_query($dbconn, "SELECT * FROM \"tISAPRE\" where \"id_ISAPRE\" = '".$_SESSION['Datos']['id_ISAPRE']."' ");
            $row = pg_fetch_assoc($query);
            return $row; 
            }
    }

    function get_Contrato()
    {       if(!empty($_SESSION['Rut']))
            {
            include("conex.inc");
            $query = pg_query($dbconn, "SELECT * FROM \"tContratos\" where \"id_Contrato\" = '".$_SESSION['Datos']['id_Contrato']."' ");
            $row = pg_fetch_assoc($query);
            return $row;  
            }
    }
#------------------------------------------------------------------------------------------------------------------------

    function Desconectar(){
        if (!empty($_POST["Desconectar"])){ 
        include("desconexion.php");}
        
    }

#--------------------------------------------------------------------------------------------------------------------------
#---------- Funciones de ecuaciones --------------------------------------------
#------------------------------------------------------------------------------------------

function cal_Total_Imponible(){
    include("conex.inc");
    $_SESSION['Gratificaciones_Imponible']=0;
    $_SESSION['Gratificaciones_no_Imponible']=0;
    $_SESSION['Asignacion_Familiar']=0;
    $query = pg_query($dbconn, " SELECT \"tEmpleados\".\"Rut\", \"tBonos\".\"Bono\", \"tBonos\".\"Activo\", \"tBonos\".\"id_Bono\", \"tBonos\".\"Imponible\",\"rel_tEmpleados_tBonos\".\"Monto\" FROM \"tBonos\" JOIN \"rel_tEmpleados_tBonos\" ON \"tBonos\".\"id_Bono\" = \"rel_tEmpleados_tBonos\".\"id_Bono\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tBonos\".\"Rut\" = \"tEmpleados\".\"Rut\" WHERE \"tEmpleados\".\"Rut\" = '".$_SESSION['Rut']."'::bpchar;");
    while ($row1 = pg_fetch_assoc($query)) {
        if($row1['Imponible']){
        $_SESSION['Gratificaciones_Imponible'] += $row1['Monto'];
        }
        else{
            if($row1['id_Bono']==9){
                $_SESSION['Asignacion_Familiar'] = $_SESSION['Total_AFP'];
            }
            else{
                $_SESSION['Gratificaciones_no_Imponible'] += $row1['Monto'];
            }
        }
    }
    $_SESSION['Total_Imponible']= $_SESSION['Datos']["Sueldo_base"] + $_SESSION['Gratificaciones_Imponible'];
    $_SESSION['Total_Haberes'] =  $_SESSION['Datos']["Sueldo_base"] + $_SESSION['Gratificaciones_Imponible']+ $_SESSION['Gratificaciones_no_Imponible']; 
}





function cal_Total_Descuentos(){
    $rut = $_SESSION['Rut'];
    include("conex.inc");
    $_SESSION['Descuentos_Legal']=0;
    $_SESSION['Descuentos_Otros']=0;
    $query = pg_query($dbconn, "SELECT \"tEmpleados\".\"Rut\",\"tEmpleados\".\"Nombre\",\"tDescuentos\".\"Descuento\",\"tDescuentos\".\"Tipo\",\"rel_tEmpleados_tDescuentos\".\"Monto\",\"tDescuentos\".\"id_Descuento\" FROM \"rel_tEmpleados_tDescuentos\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tDescuentos\".\"Rut\" = \"tEmpleados\".\"Rut\" JOIN \"tDescuentos\" ON \"rel_tEmpleados_tDescuentos\".\"id_Descuento\" = \"tDescuentos\".\"id_Descuento\" WHERE \"tEmpleados\".\"Rut\" = '$rut'::bpchar;");
    while  ($row1 = pg_fetch_assoc($query)){
        if($row1['Tipo'] == 'Legal'){
                 $_SESSION['Descuentos_Legal'] += $row1['Monto'];
        }
        else{
        $_SESSION['Descuentos_Otros'] += $row1['Monto'];
        }
    }
    $_SESSION['Total_Tributable'] = $_SESSION['Total_Imponible']- $_SESSION['Descuentos_Legal'];
    
}

function cal_sub_total(){
    $_SESSION['sub_Total'] = $_SESSION['Total_Haberes'] - $_SESSION['Descuentos_Legal'] - $_SESSION['Descuentos_Otros'];
}

function Liquido_Alcansado(){
   $_SESSION['Liquido_Alcansado'] =  $_SESSION['Liquido_pagar']+ $_SESSION['Descuentos_Otros'];
}

function Liquido_Pagar(){
    if ($_SESSION['Total_Haberes'] - $_SESSION['Descuentos_Legal'] - $_SESSION['Descuentos_Otros']>0){
        $_SESSION['Liquido_pagar'] = ($_SESSION['Total_Haberes']+$_SESSION['Asignacion_Familiar'])- $_SESSION['Descuentos_Legal'] -$_SESSION['Descuentos_Otros'];
        
    }
      
}
function Total_AFP(){
    include("conex.inc");
    $query = pg_query($dbconn, " SELECT * FROM \"tAFP\" WHERE \"tAFP\".\"id_AFP\" = '".$_SESSION['Datos']['id_AFP']."';");
    $row1 = pg_fetch_assoc($query);
    $_SESSION['Total_AFP'] = intval(($row1['Tasa'] * $_SESSION['Total_Imponible'])/100);
}

?>