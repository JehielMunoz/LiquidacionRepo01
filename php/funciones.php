<?php
if(empty($_SESSION))
{
    session_start();
}

 if (!empty($_POST["Rut"])) 
  {
     $_SESSION['Rut'] =  $_POST["Rut"];
     $_SESSION['Datos'] = get_Datos();
     $_SESSION['Nombre'] = trim($_SESSION['Datos']['Nombre']," ");     
     $_SESSION['Afp'] = get_AFP();
     $_SESSION['Isapre'] = get_ISAPRE();
     $_SESSION['Contrato'] = get_Contrato();
     cal_Total_Imponible();
     cal_Total_Descuentos();
     cal_sub_total();
     Liquido_Pagar();
     Liquido_Alcansado();
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
        include("conex.php");
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
            include("conex.php");
            $query = pg_query($dbconn, "SELECT * FROM \"tEmpleados\" where \"Rut\" = '".$_SESSION['Rut']."' ");
            $row = pg_fetch_assoc($query);
            return $row;
    }
      
#------------------------------------------------------------------------------------------------------------------
# Funciones para mostrar los datos
#-----------------------------------------------------------------------------------------------------------------
    function Formato_Dinero($dinerint)
    {
    $string = $dinerint;
    $len = round(strlen($string)/3, 0, PHP_ROUND_HALF_DOWN);
    $contador = -3;
    for ($i=0; $i<($len);$i++)
    {
        $string = substr_replace($string,'.',$contador,0);
        $contador= $contador - 3 - 1;
    }                    // 3 por la separacion de los puntos. y 1 por el nuevo caracter que se agrega.
    
        if ($string[0]==".")
        {
            $string = substr($string,1);
        }
        
        $string = substr_replace($string,'$',0,0);
        
        return $string;        
    }
    
    function Formato_Rut($rut)
    {
        # Easy fix if the rut has less than 10 characters. strlen
        $rut = substr_replace($rut,'.',2,0);
        $rut = substr_replace($rut,'.',6,0);
        $rut = substr_replace($rut,'-',10,0);
        
        return $rut;
    }
   function Formato_Tel_Cel($telefono)
   {
        $telefono = substr_replace($telefono,' ',3,0);
        $telefono = substr_replace($telefono,' ',6,0); 
        $telefono = substr_replace($telefono,'(09) ',0,0); 
        return $telefono;
   }
    function Rut()
    {
      if (!empty($_SESSION["Rut"]))
        {
            echo Formato_Rut($_SESSION['Rut']);
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
            echo Formato_Dinero($_SESSION['Datos']["Sueldo_base"]);
        }
        
    }  
    
     function Sueldo_Bruto()
    {   
       
         if (!empty($_SESSION['Total_Haberes']))
       {   
            echo Formato_Dinero($_SESSION['Total_Haberes']);
        }
        
    }
# Aun queda ingresar formulas
     function Sueldo_Liquido()
    {   if (!empty($_SESSION['Liquido_pagar'])) 
        {   
           echo Formato_Dinero($_SESSION['Liquido_pagar']);
        }
        
    }    
    function Total_Bonos()
    {
        if (!empty($_SESSION['Total_Bonos'])) 
       {      
            echo Formato_Dinero($_SESSION['Total_Bonos']);
        }
    }
    
    
    function Total_Descuentos()
    {
        if (!empty($_SESSION['Total_Descuentos'])) 
       {      
            echo Formato_Dinero($_SESSION['Total_Descuentos']);
        }
    }
    function Total_Asignacion()
    {
        if(!empty($_SESSION['Asignacion_Familiar']))
        {  
            echo Formato_Dinero($_SESSION['Asignacion_Familiar']);
           
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
            echo Formato_Dinero($_SESSION['Datos']["Paga_por_hora"]);    
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
    function Valor_AFP()
    {
        if(!empty($_SESSION['Total_AFP']))
        {
            echo Formato_Dinero($_SESSION['Total_AFP']);
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
    function Valor_Isapre()
    {
        if(!empty($_SESSION['Total_Isapre']))
        {
            echo Formato_Dinero($_SESSION['Total_Isapre']);
        }
    }
    function Tipo_Contrato()
    {
        if(!empty($_SESSION['Contrato']))
        {
            echo $_SESSION['Contrato']['Contrato'];
        }

    }

    function Valor_seguro_cesantia()
    {
        if(!empty($_SESSION['Total_seguro']))
        {
            echo Formato_Dinero($_SESSION['Total_seguro']);
        }

    }
    function nCargas()
    {
        if(!empty($_SESSION['Datos']["Cargas"]))
        {  
            echo $_SESSION['Datos']["Cargas"];
           
        }
        else
        {
            echo "No posee.";
        }
    }
#------------------------------------------------------------------------------------------------------------------------
# Estan funciones se tienen que  conectar a la base de datos por qué tienen que sacar informacion de otras tablas.
#------------------------------------------------------------------------------------------------------------------------
    function get_AFP() 
    {       if(!empty($_SESSION['Datos']))
            {
            include("conex.php");
            $query = pg_query($dbconn, "SELECT * FROM \"tAFP\" where \"id_AFP\" = '".$_SESSION['Datos']['id_AFP']."'");
            $row = pg_fetch_assoc($query);
            return $row;
            }
    }
    function get_AFP_Registro() 
    {     
            include("conex.php");
            $query = pg_query($dbconn, "SELECT * FROM \"tAFP\"");
            while($row = pg_fetch_assoc($query))
            {
                echo "<option value=\"".$row['id_AFP']."\">".$row['AFP']."</option>";
            }
            
        
    }

    function get_ISAPRE()
    {       if(!empty($_SESSION['Datos']))
            {
            include("conex.php");
            $query = pg_query($dbconn, "SELECT * FROM \"tISAPRE\" where \"id_ISAPRE\" = '".$_SESSION['Datos']['id_ISAPRE']."' ");
            $row = pg_fetch_assoc($query);
            return $row; 
            }
    }

    function get_ISAPRE_Registro()
    {       
            include("conex.php");
            $query = pg_query($dbconn, "SELECT * FROM \"tISAPRE\"");
            while($row = pg_fetch_assoc($query))
            {
                echo "<option value=\"".$row['id_ISAPRE']."\">".$row['ISAPRE']."</option>";
            }
          
            
    }
    function get_Contrato()
    {       if(!empty($_SESSION['Datos']))
            {
            include("conex.php");
            $query = pg_query($dbconn, "SELECT * FROM \"tContratos\" where \"id_Contrato\" = '".$_SESSION['Datos']['id_Contrato']."' ");
            $row = pg_fetch_assoc($query);
            return $row;  
            }
    }
    function get_Empleo_Registro()
    {
      include("conex.php");
            $query = pg_query($dbconn, "SELECT * FROM \"tCargos\"");
            while($row = pg_fetch_assoc($query))
            {
                echo "<input type=\"checkbox\"  name=Cargo[] value=\"".$row['id_Cargo']."\">".$row['Cargo']."<br>";
            }
    }
    function Mostrar_Contacto()
    {   
        
        include("conex.php");
        
        if(!empty($_POST['c_Buscar']))
        {
            $query ="Select \"tEmpleados\".\"Rut\",\"tEmpleados\".\"Nombre\", \"tEmpleado_Fono\".\"N_telefono\" 
                      From \"tEmpleados\" Inner Join \"tEmpleado_Fono\" ON \"tEmpleados\".\"Rut\" = \"tEmpleado_Fono\".\"Rut\"
                      Where \"tEmpleados\".\"Rut\" = '".$_POST['c_Buscar']."'
                      order by \"tEmpleados\".\"Rut\"";
        }
        else
        {
            $query = "Select \"tEmpleados\".\"Rut\",\"tEmpleados\".\"Nombre\", \"tEmpleado_Fono\".\"N_telefono\" 
                      From \"tEmpleados\" Inner Join \"tEmpleado_Fono\" ON \"tEmpleados\".\"Rut\" = \"tEmpleado_Fono\".\"Rut\"
                      order by \"tEmpleados\".\"Rut\"";
        }
        $execQuery=pg_query($dbconn,$query);
        
        while($row = pg_fetch_assoc($execQuery))
        {
            echo "<tr>
                    <td>".Formato_Rut($row['Rut'])."</td>    
                    <td>".$row['Nombre']."</td>   
                    <td>".$row['N_telefono']."</td>    
                </tr>";
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
    include("conex.php");
    $_SESSION['Gratificaciones_Imponible']=0;
    $_SESSION['Gratificaciones_no_Imponible']=0;
    $_SESSION['Asignacion_Familiar']= 0;
    $query = pg_query($dbconn, " SELECT \"tEmpleados\".\"Rut\", \"tBonos\".\"Bono\", \"tBonos\".\"Activo\", \"tBonos\".\"id_Bono\", \"tBonos\".\"Imponible\",\"rel_tEmpleados_tBonos\".\"Monto\" FROM \"tBonos\" JOIN \"rel_tEmpleados_tBonos\" ON \"tBonos\".\"id_Bono\" = \"rel_tEmpleados_tBonos\".\"id_Bono\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tBonos\".\"Rut\" = \"tEmpleados\".\"Rut\" WHERE \"tEmpleados\".\"Rut\" = '".$_SESSION['Rut']."'::bpchar;");
    while ($row1 = pg_fetch_assoc($query)) {
        if($row1['Imponible']=="t"){
        $_SESSION['Gratificaciones_Imponible'] += $row1['Monto'];
        }
        else{
                $_SESSION['Gratificaciones_no_Imponible'] += $row1['Monto'];
            }
    }
    $_SESSION['Total_Imponible']= $_SESSION['Datos']["Sueldo_base"] + $_SESSION['Gratificaciones_Imponible'];
    $_SESSION['Total_Haberes'] =  $_SESSION['Datos']["Sueldo_base"]+$_SESSION['Gratificaciones_Imponible']+$_SESSION['Gratificaciones_no_Imponible']; 
    $_SESSION['Total_Bonos'] = $_SESSION['Gratificaciones_Imponible']+ $_SESSION['Gratificaciones_no_Imponible'];
}

    



function cal_Total_Descuentos(){
    $rut = $_SESSION['Rut'];
    include("conex.php");
    $_SESSION['Descuentos_Legal']=0;
    $_SESSION['Descuentos_Otros']=0;
    $query = pg_query($dbconn, "SELECT \"tEmpleados\".\"Rut\",\"tEmpleados\".\"Nombre\",\"tDescuentos\".\"Descuento\",\"tDescuentos\".\"Tipo\",\"rel_tEmpleados_tDescuentos\".\"Monto\",\"tDescuentos\".\"id_Descuento\" FROM \"rel_tEmpleados_tDescuentos\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tDescuentos\".\"Rut\" = \"tEmpleados\".\"Rut\" JOIN \"tDescuentos\" ON \"rel_tEmpleados_tDescuentos\".\"id_Descuento\" = \"tDescuentos\".\"id_Descuento\" WHERE \"tEmpleados\".\"Rut\" = '$rut'::bpchar;");
    while  ($row1 = pg_fetch_assoc($query)){
        if($row1['Tipo'] == 'legal '){
                if($row1['id_Descuento']<>2){
                 $_SESSION['Descuentos_Legal'] += $row1['Monto'];
                }
        }
        else{
        $_SESSION['Descuentos_Otros'] += $row1['Monto'];
        }
    }
    Total_AFP();
    Total_Isapre();
    Total_Seguro();
    $_SESSION['Total_Tributable'] = $_SESSION['Total_Imponible']- $_SESSION['Descuentos_Legal'];
    $_SESSION['Total_Descuentos'] = $_SESSION['Descuentos_Otros'] + $_SESSION['Descuentos_Legal'];
    
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
    include("conex.php");
    $query = pg_query($dbconn, " SELECT * FROM \"tAFP\" WHERE \"tAFP\".\"id_AFP\" = '".$_SESSION['Datos']['id_AFP']."';");
    $row1 = pg_fetch_assoc($query);
    $_SESSION['Total_AFP'] = round(($row1['Tasa'] * $_SESSION['Total_Imponible'])/100,0);
    $_SESSION['Descuentos_Legal'] += $_SESSION['Total_AFP'] ;
}
function Total_Isapre(){
    include("conex.php");
    $query = pg_query($dbconn, " SELECT * FROM \"tISAPRE\" WHERE \"tISAPRE\".\"id_ISAPRE\" = '".$_SESSION['Isapre']['id_ISAPRE']."';");
    $row1 = pg_fetch_assoc($query);
    $_SESSION['Total_Isapre'] = round(($row1['Tasa'] * $_SESSION['Total_Imponible'])/100,0);
    $_SESSION['Descuentos_Legal'] +=$_SESSION['Total_Isapre'];
}

function Total_Seguro(){
    include("conex.php");
    $query = pg_query($dbconn, " SELECT * FROM \"tContratos\" WHERE \"tContratos\".\"id_Contrato\" = '".$_SESSION['Contrato']['id_Contrato']."';");
    $row1 = pg_fetch_assoc($query);
    $_SESSION['Total_seguro'] = round(($row1['Tasa_seguro_cesantia'] * $_SESSION['Total_Imponible'])/100,0);
    $_SESSION['Descuentos_Legal'] +=$_SESSION['Total_seguro'];
}



?>