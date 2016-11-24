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
     get_cargos();
     cal_Total_Imponible();
     licencias();
     cal_Total_Descuentos();
     cal_sub_total();
     Liquido_Pagar();
     Liquido_Alcansado();
     gastos_extras();
     calculo_impuesto_unico();
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

 //chdir($_SERVER['DOCUMENT_ROOT']."/Liquidaciones-de-Sueldo/"); 

 
    function Iniciar_Reporte()
    {
        $Carpeta = "./Reporte";
        $File = "/".$_SESSION['Usuario'].".txt";
        $Inicio = "#############################################".PHP_EOL."[".$_SESSION['Usuario']."]".PHP_EOL;
        $Inicio_Hora = date("[H:i:s] ").$_SESSION['Usuario']." inicio session.".PHP_EOL;
        // IMPORTANTE CONFIGURAR BIEN LA HORA EN EL SERVIDOR PHP .INI
        if(!is_dir($Carpeta))
        {   
            mkdir($Carpeta,0777);
        }       

        file_put_contents($Carpeta.$File, $Inicio.$Inicio_Hora, FILE_APPEND);
    }

    function Escribir_Reporte($Accion ="Hola mundo")
    {
        chdir($_SERVER['DOCUMENT_ROOT']."/LiquidacionRepo01/"); //Posible fix(?) NO , Hay que arreglarlo
        
        $Carpeta = "./Reporte";
        $Hora = date("[H:i:s] ");
        $File = "/".$_SESSION['Usuario'].".txt";
        file_put_contents($Carpeta.$File,$Hora.$Accion.PHP_EOL, FILE_APPEND);
    }

    function Guardar_Reporte()
    {
        $Carpeta = "../Reporte";
        $Reporte = "/".$_SESSION['Usuario'].".txt";
        $Destino = "/".date("d-m-y").".txt";
        $Termino = "#############################################".PHP_EOL;
        $Termino_Hora = date("[H:i:s] ").$_SESSION['Usuario']." Termino session.".PHP_EOL;

        file_put_contents($Carpeta.$Reporte, $Termino_Hora.$Termino, FILE_APPEND);
       
        if($Archivo = file_get_contents($Carpeta.$Reporte))
        {
            echo $Archivo;
            file_put_contents($Carpeta.$Destino,$Archivo, FILE_APPEND);
            unlink($Carpeta.$Reporte);  
        }

    }

    function diferencia_Fecha($date1,$date2)
    {
        $Fecha_Inicio = strtotime($date1);
        $Fecha_Termino = strtotime($date2);
        return ($Fecha_Termino-$Fecha_Inicio)/(60*60*24); //  Dividido en dias
    }

    function get_Descuento($id)
    {
        
        include '../../php/conex.php';
        $sql = "SELECT \"Descuento\" FROM \"tDescuentos\" WHERE \"id_Descuento\" =".$id."";
        $query = pg_query($dbconn,$sql);
        if(!$query){
            echo "<script>alert('Error en la busqueda
                ')</script>";
        }
        return trim(pg_fetch_assoc($query)['Descuento']," ");
    }

    function get_Bono($id)
    {
        
        include '../../php/conex.php';
        $sql = "SELECT \"Bono\" FROM \"tBonos\" WHERE \"id_Bono\" =".$id."";
        $query = pg_query($dbconn,$sql);
        if(!$query){
            echo "<script>alert('Error en la busqueda
                ')</script>";
        }
        return trim(pg_fetch_assoc($query)['Bono']," ");
    }

#-----------------------------------------------------------------------------------------------------------------------------
# funciones Para obtener la informacion de las personas
#-----------------------------------------------------------------------------------------------------------------------------
    function get_Empleado()
    {
         if (!empty($_POST["Rut"])) 
         {
            $_SESSION['Rut'] =  $_POST["Rut"];
            $_SESSION['Datos'] = get_Datos();
            $_SESSION['Nombre'] = trim($_SESSION['Datos']['Nombre']," ");     
            $_SESSION['Afp'] = get_AFP();
            $_SESSION['Isapre'] = get_ISAPRE();
            $_SESSION['Contrato'] = get_Contrato();
            get_cargos();
            cal_Total_Imponible();
            licencias();
            cal_Total_Descuentos();
            cal_sub_total();
            Liquido_Pagar();
            Liquido_Alcansado();
            gastos_extras();
         }
         elseif (!empty($_POST["r_Rut"])) 
         {  
            $_SESSION['Rut'] =  $_POST["r_Rut"];
            $_SESSION['Datos'] = get_Datos();
            $_SESSION['Nombre'] = trim($_SESSION['Datos']['Nombre']," ");     
            Escribir_Reporte("Se ha registrado un empleado con Nombre: [ ".$_SESSION['Nombre']." ] y con rut: ".$_POST["r_Rut"]);
            $_SESSION['Afp'] = get_AFP();
            $_SESSION['Isapre'] = get_ISAPRE();
            $_SESSION['Contrato'] = get_Contrato();
            get_cargos();
            cal_Total_Imponible();
            licencias();
            cal_Total_Descuentos();
            cal_sub_total();
            Liquido_Pagar();
            Liquido_Alcansado();
            gastos_extras();
         }
         
    }
    
    function get_Personas(){ 
        include("conex.php");
        $sql= "SELECT * FROM \"tEmpleados\" ";
        $query = pg_query($dbconn, $sql);
        if (!$query) {
            echo "en el query.\n";
            exit;
        }
        while ($row = pg_fetch_assoc($query)) {
            
            $data [] = [$row["Rut"],trim($row["Nombre"]," ")];   
        }
        echo json_encode($data);
    }
    function get_Datos(){
            include("conex.php");
            $sql = "SELECT * FROM \"tEmpleados\" where \"Rut\" = '".$_SESSION['Rut']."' ";
            $query = pg_query($dbconn, $sql );
            $row = pg_fetch_assoc($query);
            if(!empty($row))
         {
                Escribir_Reporte("Se busco el rut: ".$row['Rut']." de manera exitosa.");
                Escribir_Reporte("Empleado seleccionado [".trim($row['Nombre']," "). "].");
            }
            else
            {
                Escribir_Reporte("Se busco el rut: ".$row['Rut']." , No se encontro el rut.");
            }
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

    function mRut()
    {
      if (!empty($_SESSION["Rut"]))
        {
            echo $_SESSION['Rut'];
        }     
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

    function mSueldo_Base(){   
        if (!empty($_SESSION['Datos'])) 
       {      
            echo $_SESSION['Datos']["Sueldo_base"];
        }
        
    }  


    function Sueldo_Base(){   
        if (!empty($_SESSION['Datos'])) 
       {      
            echo Formato_Dinero($_SESSION['Datos']["Sueldo_base"]);
        }
        
    }  

    function Fecha_de_ingreso(){
        if (!empty($_SESSION['Datos'])) 
       {      
            echo $_SESSION['Datos']["F_ingreso"];
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
		//echo var_dump($_SESSION['Asignacion_Familiar']);
        if(!empty($_SESSION['Asignacion_Familiar']))
        {  
			if($_SESSION['Asignacion_Familiar']>0){
            	echo Formato_Dinero($_SESSION['Asignacion_Familiar']);
			}
        }
			else{
				echo "$ 0";
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
    function mValor_Hora()
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

   function descuentos_legales(){
        if(!empty($_SESSION['Descuentos_Legal'])){
            echo Formato_Dinero($_SESSION['Descuentos_Legal']);
        }
        
    }
    function Total_Imponible(){
        if(!empty($_SESSION['Total_Imponible'])){
            echo Formato_Dinero($_SESSION['Total_Imponible']);
        }
        
    }
    function Total_Tributable(){
        if(!empty($_SESSION['Total_Tributable'])){
            echo Formato_Dinero($_SESSION['Total_Tributable']);
        }
        
    }
    function Otros_descuentos(){
		//echo var_dump($_SESSION['Descuentos_Otros']);
        if(!empty($_SESSION['Descuentos_Otros'])){
            if($_SESSION['Descuentos_Otros']>0){
                echo Formato_Dinero($_SESSION['Descuentos_Otros']);
            }
		}
		else{
			echo "$ 0";
		}        
    }
    function sub_Total(){
        if(!empty($_SESSION['sub_Total'])){
            echo Formato_Dinero($_SESSION['sub_Total']);
        }
        
    }
    function mostrar_liquido_alcansado(){
        if(!empty($_SESSION['Liquido_Alcansado'])){
            echo Formato_Dinero($_SESSION['Liquido_Alcansado']);
        }
    }
    function mostrar_Sobre_giro(){
		//echo var_dump($_SESSION['Sobre_giro']);
        if(!empty($_SESSION['Sobre_giro'] )){
            if($_SESSION['Sobre_giro']>0){
                echo Formato_Dinero($_SESSION['Sobre_giro'] );
                }
            }            
            else{
                echo "$ 0";
        }
    }
    function Mostrar_gasto_extra_SIS(){
        if(!empty($_SESSION['Gastos_extras_SIS'])){
            echo Formato_Dinero($_SESSION['Gastos_extras_SIS']);
        }
    }
    function Mostrar_gasto_extra_Mutual(){
        if(!empty( $_SESSION['Gastos_extras_Mutual'])){
            echo Formato_Dinero( $_SESSION['Gastos_extras_Mutual']);
        }
    }
    function Mostrar_gasto_extra_Seguro_cesantia(){
        if(!empty($_SESSION['Gastos_extras_Seguro_cesantia'])){
            echo Formato_Dinero($_SESSION['Gastos_extras_Seguro_cesantia']);
        }
    }
    function Mostrar_Cargos_empleado(){
        if(!empty($_SESSION['Cargos_empleado'])){
            echo $_SESSION['Cargos_empleado'];
        }
    }
    
    function get_son(){
        if(!empty($_SESSION['Liquido_pagar'])){
            echo numtoletras($_SESSION['Liquido_pagar']);
        }
    }
    function Mostrar_licencia(){
        if(!empty($_SESSION['Descuentos_Licencias'])){
            echo Formato_Dinero($_SESSION['Descuentos_Licencias']);
        }
    }

    function Recargar_datos(){
        get_cargos();
        cal_Total_Imponible();
        licencias();
        cal_Total_Descuentos();
        cal_sub_total();
        Liquido_Pagar();
        Liquido_Alcansado();
        gastos_extras();
        
    }
    function get_fecha_php(){
        setlocale(LC_ALL,"es_ES");
        date_default_timezone_set('America/Santiago');
        # si el servidor es incompatible con setlocale
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        
        echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        #echo strftime("%A %d de %B del %Y");

        
    }
#------------------------------------------------------------------------------------------------------------------------
# Estan funciones se tienen que  conectar a la base de datos por qué tienen que sacar informacion de otras tablas.
#------------------------------------------------------------------------------------------------------------------------
    function get_AFP() 
    {       if(!empty($_SESSION['Datos']))
            {
            include("conex.php");
            $sql= "SELECT * FROM \"tAFP\" where \"id_AFP\" = '".$_SESSION['Datos']['id_AFP']."'";
            $query = pg_query($dbconn,$sql);
            $row = pg_fetch_assoc($query);
            return $row;
            }
    }
    function get_AFP_Registro() 
    {     
            include("conex.php");
            $sql= "SELECT * FROM \"tAFP\"";
            $query = pg_query($dbconn, $sql);
            while($row = pg_fetch_assoc($query))
            {
                echo "<option value=\"".$row['id_AFP']."\">".$row['AFP']."</option>";
            }
    }
    function get_AFP_Modificador() 
    {     
            if(!empty($_SESSION['Rut']))
            {
            include("conex.php");
            $sql = "SELECT * FROM \"tAFP\"";
            $query = pg_query($dbconn, $sql);
            while($row = pg_fetch_assoc($query))
            {   if($row['id_AFP'] == $_SESSION['Datos']['id_AFP'])
                {   
                echo "<option selected value=\"".$row['id_AFP']."\">".$row['AFP']."</option>";
                }
                else
                {
                echo "<option value=\"".$row['id_AFP']."\">".$row['AFP']."</option>";

                }
            }
            }
    }

	function Mostrar_Licencias()
		{
			include("conex.php");
            $sql = "SELECT * FROM \"tLicencias\" where \"Activo\"='t'";
			$query = pg_query($dbconn,$sql);
			while($row = pg_fetch_assoc($query))
			{
				echo "<tr>
				<td>".Formato_Rut($row['Rut'])."</td>";
				if($row['Descuenta'])
				{
				    echo "<td>Si.</td>";
				}
				else
				{
					echo "<td>No.</td>";
				}
                // PUEDES BUSCAR LOS READONLY DE EL FORM cuando se activa el submit.
				echo "
                <form method=\"post\" action=\"../php/Desactivar_licencias.php\"> 
                <input name=\"id_modificar\" hidden type=text value=\"".$row['id_Licencia']."\">
				<td><input name=\"dias\" type=text readonly value=\"".$row['Dias']."\"></td>
				<td>".$row['F_inicio']."</td>
				<td>".$row['F_final']."</td>
				<td><button type=\"submit\">Modficar Dias</button></td></form>
                <td><a href=\"../php/Desactivar_licencias.php?id_licencia=".$row['id_Licencia']."\"><button>Desactivar</button></a></td>
				
                
				</tr>";
			}
		}


    function mostrar_impuesto()
    {
            include("conex.php");
            $id=1;
			while($row = pg_fetch_assoc(pg_query($dbconn, "SELECT * FROM \"tImpuesto\" where \"id_Impuesto\"=$id ")))
			{
				echo "
                <tr>
				    <td>".$row['fDesde']."</td>
                    <td>".$row['fHasta']."</td>
				    <td>".$row['Factor']."</td>
				    <td>".$row['nDesde']."</td>
				    <td>".$row['nHasta']."</td>
				    <td>".$row['fRebaja']."</td>
				    <td>".$row['nRebaja']."</td>
				</tr>";
                $id+=1;
			}
        
    }
    function mostrar_impuesto_editar()
    {
            include("conex.php");
            $id=1;
			while($row = pg_fetch_assoc(pg_query($dbconn, "SELECT * FROM \"tImpuesto\" where \"id_Impuesto\"=$id ")))
			{
                if($id==8){
                echo "
                    <tr>
                        <td>".$row['id_Impuesto']."</td>
                        <td><input name='".$row['id_Impuesto']."fdesde' type='number' min='0' step='0.00001' class='t_modDatonum' value='".$row['fDesde']."'></td>
                        <td></td>
                        <td><input name='".$row['id_Impuesto']."factor' type='number' min='0' step='0.00001' class='t_modDatonum' value='".$row['Factor']."'></td>
                        <td><input name='".$row['id_Impuesto']."ndesde' type='number' min='0' class='t_modDatonum' value='".$row['nDesde']."'></td>
                        <td></td>
                        <td><input name='".$row['id_Impuesto']."frebaja' type='number' min='0' step='0.00001' class='t_modDatonum' value='".$row['fRebaja']."'></td>
                        <td><input name='".$row['id_Impuesto']."nrebaja' type='number' min='0' class='t_modDatonum' value='".$row['nRebaja']."'></td>

                    </tr>";
                }
                else 
                {
                echo "
                    <tr>
                        <td>".$row['id_Impuesto']."</td>
                        <td><input name='".$row['id_Impuesto']."fdesde' type='number' min='0' step='0.00001' class='t_modDatonum' value='".$row['fDesde']."'></td>
                        <td><input name='".$row['id_Impuesto']."fhasta' type='number' min='0' step='0.00001' class='t_modDatonum' value='".$row['fHasta']."'></td>
                        <td><input name='".$row['id_Impuesto']."factor' type='number' min='0' step='0.00001' class='t_modDatonum' value='".$row['Factor']."'></td>
                        <td><input name='".$row['id_Impuesto']."ndesde' type='number' min='0' class='t_modDatonum' value='".$row['nDesde']."'></td>
                        <td><input name='".$row['id_Impuesto']."nhasta' type='number' min='0' class='t_modDatonum' value='".$row['nHasta']."'></td>
                        <td><input name='".$row['id_Impuesto']."frebaja' type='number' min='0' class='t_modDatonum' step='0.00001' value='".$row['fRebaja']."'></td>
                        <td><input name='".$row['id_Impuesto']."nrebaja' type='number' min='0' class='t_modDatonum' value='".$row['nRebaja']."'></td>

                    </tr>";
                }

                $id+=1;
			}
        
        }
    function Mostrar_ISAPRE()
    {   
        
        include("conex.php");
        $sql= "SELECT * FROM \"tISAPRE\"";
        $query = pg_query($dbconn, $sql);
        while($row = pg_fetch_assoc($query))
        {
            echo "<tr>
            <td>".$row['ISAPRE']."</td>
            <td>".$row['Tasa']."%</td>
            </tr>";
        }
    }
    function Mostrar_AFP()
    {   
        
        include("conex.php");
        $sql = "SELECT * FROM \"tAFP\"";
        $query = pg_query($dbconn,$sql );
        while($row = pg_fetch_assoc($query))
        {
            echo "<tr>
            <td>".$row['AFP']."</td>
            <td>".$row['Tasa']."%</td>
            </tr>";
        }
    }

    function get_ISAPRE()
    {       if(!empty($_SESSION['Datos']))
            {
            include("conex.php");
            $sql = "SELECT * FROM \"tISAPRE\" where \"id_ISAPRE\" = '".$_SESSION['Datos']['id_ISAPRE']."' ";
            $query = pg_query($dbconn,$sql);
            $row = pg_fetch_assoc($query);
            return $row; 
            }
    }


    function get_IPS_Modificador()
    {       if(!empty($_SESSION['Datos']))
            {
            include("conex.php");
            $sql = "SELECT * FROM \"tISAPRE\"";
            $query = pg_query($dbconn, $sql );
            while($row = pg_fetch_assoc($query))
            {   
                if($row['id_ISAPRE'] == $_SESSION['Datos']['id_ISAPRE'])
                {
                    echo "<option selected value=\"".$row['id_ISAPRE']."\">".$row['ISAPRE']."</option>";
                }

                else
                {
                echo "<option value=\"".$row['id_ISAPRE']."\">".$row['ISAPRE']."</option>";
                }
            } 
            }
    }



    function get_ISAPRE_Registro()

    {       
            include("conex.php");
            $sql = "SELECT * FROM \"tISAPRE\"";
            $query = pg_query($dbconn, $sql );
            while($row = pg_fetch_assoc($query))
            {  
                echo "<option value=\"".$row['id_ISAPRE']."\">".$row['ISAPRE']."</option>";
            }
          
            
    }
    function get_Contrato()
    {       
            if(!empty($_SESSION['Datos']))
            {
            include("conex.php");
            $sql = "SELECT * FROM \"tContratos\" where \"id_Contrato\" = '".$_SESSION['Datos']['id_Contrato']."' ";
            $query = pg_query($dbconn, $sql);
            $row = pg_fetch_assoc($query);
            return $row;  
            }

    }
    function get_Contrato_Modificador()
    {       
            if(!empty($_SESSION['Rut']))
            {
            include("conex.php");
            $sql= "SELECT * FROM \"tContratos\" ";
            $query = pg_query($dbconn,$sql );
            while($row = pg_fetch_assoc($query))
                {   
                    if($row['id_Contrato'] == $_SESSION['Contrato']['id_Contrato'])
                    {
                        echo "<option selected value=\"".$row['id_Contrato']."\">".$row['Contrato']."</option>";
                    }

                    else
                    {
                    echo "<option value=\"".$row['id_Contrato']."\">".$row['Contrato']."</option>";
                    }
                }
            }
    }

    function get_Empleo_Registro()
    {
      include("conex.php");
            $sql = "SELECT * FROM \"tCargos\" ";
            $query = pg_query($dbconn, $sql);
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
                      Where \"tEmpleados\".\"Nombre\" = '".$_POST['c_Buscar']."'
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
    function get_cargos(){
        include("conex.php");
        $sql = "SELECT \"tEmpleados\".\"Rut\", \"rel_tEmpleados_tCargos\".\"Rut\", \"tCargos\".\"Cargo\", \"rel_tEmpleados_tCargos\".\"id_Cargo\", \"tCargos\".\"id_Cargo\"FROM public.\"tEmpleados\", public.\"rel_tEmpleados_tCargos\", public.\"tCargos\" WHERE \"tEmpleados\".\"Rut\" = \"rel_tEmpleados_tCargos\".\"Rut\" AND\"rel_tEmpleados_tCargos\".\"id_Cargo\" = \"tCargos\".\"id_Cargo\" AND \"tEmpleados\".\"Rut\" = '".$_SESSION['Rut']."';";
        $query = pg_query($dbconn, $sql );
        $c=0;
        $_SESSION['Cargos_empleado'] = " ";
        while($row1 = pg_fetch_assoc($query)){
            if($c==0){
                $_SESSION['Cargos_empleado'] = $_SESSION['Cargos_empleado'].$row1['Cargo'];
                $c+=1;
            }
            else{
                $_SESSION['Cargos_empleado'] = $_SESSION['Cargos_empleado']." - ".$row1['Cargo'];
            }
        }
        
        
    }

#--------------------------------------------------------------------------------------------------------------------------
#---------- Funciones de ecuaciones --------------------------------------------
#------------------------------------------------------------------------------------------


function cal_Total_Imponible(){
    include("conex.php");
    $_SESSION['Gratificaciones_Imponible']=0;
    $_SESSION['Gratificaciones_no_Imponible']=0;
    $_SESSION['Asignacion_Familiar']= 0;
    $sql = " SELECT \"tEmpleados\".\"Rut\", \"tBonos\".\"Bono\", \"tBonos\".\"Activo\", \"tBonos\".\"id_Bono\", \"tBonos\".\"Imponible\",\"rel_tEmpleados_tBonos\".\"Monto\" FROM \"tBonos\" JOIN \"rel_tEmpleados_tBonos\" ON \"tBonos\".\"id_Bono\" = \"rel_tEmpleados_tBonos\".\"id_Bono\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tBonos\".\"Rut\" = \"tEmpleados\".\"Rut\" WHERE \"tEmpleados\".\"Rut\" = '".$_SESSION['Rut']."'::bpchar;";
    $query = pg_query($dbconn, $sql );
    while ($row1 = pg_fetch_assoc($query)) {
        if($row1['Imponible']=="t"){
        $_SESSION['Gratificaciones_Imponible'] += $row1['Monto'];
        }
        else{
                if($row1['id_Bono']==26){
                    $_SESSION['Asignacion_Familiar'] = $row1['Monto'];
                }
                else{
                $_SESSION['Gratificaciones_no_Imponible'] += $row1['Monto'];}
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
    $sql = "SELECT \"tEmpleados\".\"Rut\",\"tEmpleados\".\"Nombre\",\"tDescuentos\".\"Descuento\",\"tDescuentos\".\"Tipo\",\"rel_tEmpleados_tDescuentos\".\"Monto\",\"tDescuentos\".\"id_Descuento\" FROM \"rel_tEmpleados_tDescuentos\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tDescuentos\".\"Rut\" = \"tEmpleados\".\"Rut\" JOIN \"tDescuentos\" ON \"rel_tEmpleados_tDescuentos\".\"id_Descuento\" = \"tDescuentos\".\"id_Descuento\" WHERE \"tEmpleados\".\"Rut\" = '$rut'::bpchar;";
    $query = pg_query($dbconn, $sql);
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
    $_SESSION['Total_Tributable'] = $_SESSION['Total_Imponible'] - $_SESSION['Total_seguro']- $_SESSION['Total_Isapre']-$_SESSION['Total_AFP'];
    calculo_Descuentos_varios();
    $_SESSION['Total_Descuentos'] = $_SESSION['Descuentos_Otros'] + $_SESSION['Descuentos_Legal'];
	if($_SESSION['Total_Descuentos']==0){$_SESSION['Total_Descuentos']="$0";}
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
    else {
        $_SESSION['Liquido_pagar']=0;
    }
      
}
function Total_AFP(){
    include("conex.php");
    $sql = " SELECT * FROM \"tAFP\" WHERE \"tAFP\".\"id_AFP\" = '".$_SESSION['Datos']['id_AFP']."';";
    $query = pg_query($dbconn,$sql );
    $row1 = pg_fetch_assoc($query);
    $_SESSION['Total_AFP'] = round(($row1['Tasa'] * $_SESSION['Total_Imponible'])/100,0);
    $_SESSION['Descuentos_Legal'] += $_SESSION['Total_AFP'] ;
}
function Total_Isapre(){
    include("conex.php");
    $sql =  " SELECT * FROM \"tISAPRE\" WHERE \"tISAPRE\".\"id_ISAPRE\" = '".$_SESSION['Isapre']['id_ISAPRE']."';";
    $query = pg_query($dbconn,$sql);
    $row1 = pg_fetch_assoc($query);
    $_SESSION['Total_Isapre'] = round(($row1['Tasa'] * $_SESSION['Total_Imponible'])/100,0);
    $_SESSION['Descuentos_Legal'] +=$_SESSION['Total_Isapre'];
}

function Total_Seguro(){
    include("conex.php");
    $sql =  " SELECT * FROM \"tContratos\" WHERE \"tContratos\".\"id_Contrato\" = '".$_SESSION['Contrato']['id_Contrato']."';";
    $query = pg_query($dbconn,$sql);
    $row1 = pg_fetch_assoc($query);
    $_SESSION['Total_seguro'] = round(($row1['Tasa_seguro_cesantia'] * $_SESSION['Total_Imponible'])/100,0);
    $_SESSION['Descuentos_Legal'] +=$_SESSION['Total_seguro'];
}
function Sobre_giro(){
    if ($_SESSION['Total_Haberes'] - $_SESSION['Descuentos_Legal'] - $_SESSION['Descuentos_Otros']<0){
        $_SESSION['Sobre_giro'] =$_SESSION['Total_Haberes']- $_SESSION['Descuentos_Legal'] -$_SESSION['Descuentos_Otros'];
        
    }
    else{
        $_SESSION['Sobre_giro'] = "$ 0";
    }
}

function calculo_Descuentos_varios(){
    include("conex.php");
    $sql = "SELECT * FROM \"tPrestamos\" where \"Rut\" ='".$_SESSION['Rut']."' and \"Activo\"='t'";
    $query = pg_query($dbconn, $sql);
    while($row1 = pg_fetch_assoc($query)){
    $_SESSION['Descuentos_Otros'] += $row1["Monto"];
    }
    $_SESSION['Descuentos_Otros'] += $_SESSION['Descuentos_Licencias'];
}

function gastos_extras(){
    include("conex.php");
    $sql = "SELECT * FROM \"rel_tEmpleados_tGastos_extra\" where \"Rut\" ='".$_SESSION['Rut']."'" ;
    $query = pg_query($dbconn, $sql);
    while($row1 = pg_fetch_assoc($query)){
        if($row1['id_Gasto']==4){
            $_SESSION['Gastos_extras_Seguro_cesantia'] = $row1['Monto'];
        }
        if($row1['id_Gasto']==5){
            $_SESSION['Gastos_extras_Mutual'] = $row1['Monto'];
        }
        if($row1['id_Gasto']==1){
            $_SESSION['Gastos_extras_SIS'] = $row1['Monto'];
        }
    }
    
}

function desactivar_Prestamos(){
    include("conex.php"); 
    $sql = "SELECT * FROM \"tPrestamos\" where \"Activo\"='t'";
    $query = pg_query($dbconn, $sql);
    while($row1 =pg_fetch_assoc($query)){
        list($year_final,$Mes_final,$Dia_final)= explode("-",$row1['F_final']);
        if(intval(date('Y'))==intval($year_final) and intval($Mes_final)<12){
            if(intval(date('n'))>intval($Mes_final) and intval(date('j'))>5){  
                $sql2= "UPDATE \"tPrestamos\" set \"Activo\" = 'f' where \"id_Prestamo\" =".$row1['id_Prestamo'].";";
                $query = pg_query($dbconn, $sql2 );
                if(!$query){
                echo "<script>alert('Error al modificar los datos.
                ')</script>";
                
                }
            }
        }
        else{
            if(intval(date('Y'))>intval($year_final) and intval($Mes_final)==12 and intval(date('j'))>5){
                $sql2 =  "UPDATE \"tPrestamos\" set \"Activo\" = 'f' where \"id_Prestamo\" =".$row1['id_Prestamo'].";";
                $query = pg_query($dbconn,$sql2);
                if(!$query){
                echo "<script>alert('Error al modificar los datos.
                ')</script>";
                
                }
            }
        }
    }
}                   
function desactivar_licencias(){
    include("conex.php"); 
    $sql = "SELECT * FROM \"tLicencias\" where \"Activo\" ='t'";
    $query = pg_query($dbconn, $sql);
    while($row1 = pg_fetch_assoc($query)){
        list($year_inicial,$Mes_inicial,$Dia_inicial)= explode("-",$row1['F_inicio']);
        $year=intval($year_inicial);
        $Mes=intval($Mes_inicial);
        $Dias=($Dia_inicial-1)+$row1['Dias'];
        while(true){
            if($Mes==intval(date('n')) and $year==intval(date('Y'))){
                if($Dias<1 and intval(date('j'))>5){
                    $sql2 =  "UPDATE \"tLicencias\" set \"Activo\" = 'f' where \"id_Licencia\" =".$row1['id_Licencia'].";";
                    $query = pg_query($dbconn, $sql2 );
                    if(!$query){
                        echo "<script>alert('Error al modificar al desactivar')</script>";
                    }
                    break;
                }
                else{
                    break;
                }
            }
            $Dias=$Dias-30;
            $Mes=$Mes+1;
            if($Mes>12){
                $Mes=1;
                $year=$year+1;
            }
        }                  
    }   
}

function licencias(){
    include("conex.php"); 
    $_SESSION['Descuentos_Licencias'] =0;
    $query = pg_query($dbconn, "SELECT * FROM \"tLicencias\" where \"Rut\" ='".$_SESSION['Rut']."' AND \"Activo\" ='t'");
    $ultimo_val=0;
    while($row1 = pg_fetch_assoc($query)){       
        if($row1['Descuenta']=='t'){
            if(intval(date('j'))<=5){
                if($row1['Ultimo_val']>$ultimo_val){
                    $ultimo_val=$row1['Ultimo_val'];
                    $_SESSION['Descuentos_Licencias']=$row1['Ultimo_val']; 
                }
                else{
                    break;
                }
            }
            else{
                list($year_inicial,$Mes_inicial,$Dia_inicial)= explode("-",$row1['F_inicio']);
                $Mes=intval($Mes_inicial);
                $Dias=($Dia_inicial-1)+$row1['Dias'];
                $year= intval($year_inicial);
                if($Dias<31){
                    $_SESSION['Descuentos_Licencias'] += round(($_SESSION['Total_Haberes']/30) * $row1['Dias']);
                    $query2= pg_query($dbconn, "UPDATE \"tLicencias\" SET \"Ultimo_val\"=".$_SESSION['Descuentos_Licencias']." WHERE \"id_Licencia\"=".$row1['id_Licencia'].";");
                }
                else
                {
                    if($Mes==intval(date('n')) and $year==intval(date('Y'))){
                        $_SESSION['Descuentos_Licencias'] += round(($_SESSION['Total_Haberes']/30)*(30-($Dia_inicial-1))); 
                        $query2= pg_query($dbconn, "UPDATE \"tLicencias\" SET \"Ultimo_val\"=".$_SESSION['Descuentos_Licencias']." WHERE \"id_Licencia\"=".$row1['id_Licencia'].";");
                    }
                    else{
                        while(true){
                        $Mes=$Mes+1;
                        if($Mes>12){
                            $Mes=1;
                            $year=$year+1;
                        }
                        $Dias= $Dias-30;
                        if($Mes==intval(date('n')) and $year==intval(date('Y'))){
                            if($Dias<31){
                                $_SESSION['Descuentos_Licencias'] += round(($_SESSION['Total_Haberes']/30) * $Dias);
                                $query2= pg_query($dbconn, "UPDATE \"tLicencias\" SET \"Ultimo_val\"=".$_SESSION['Descuentos_Licencias']." WHERE \"id_Licencia\"=".$row1['id_Licencia'].";");
                                break;
                            }
                            else{
                                $_SESSION['Descuentos_Licencias'] += round(($_SESSION['Total_Haberes']/30) * 30);
                                $query2= pg_query($dbconn, "UPDATE \"tLicencias\" SET \"Ultimo_val\"=".$_SESSION['Descuentos_Licencias']." WHERE \"id_Licencia\"=".$row1['id_Licencia'].";");
                                break;
                                }
                            }
                        }
                    }
                } 
            }
        }
    }
}

function calculo_impuesto_unico(){
    include("conex.php");
    $id=1;
    while($row = pg_fetch_assoc(pg_query($dbconn, "SELECT * FROM \"tImpuesto\" where \"id_Impuesto\"=$id ")))
    {
        if($id==1){
            if($_SESSION['Total_Tributable']>=$row['nDesde'] and $_SESSION['Total_Tributable']<$row['nHasta'] ){
                break;
            }
            
        }
        else 
        {
            if($id==8){
                if($_SESSION['Total_Tributable']>=$row['nDesde']){
                    $query = pg_query($dbconn,"UPDATE \"rel_tEmpleados_tDescuentos\" SET \"Monto\"=".(($_SESSION['Total_Tributable']*$row['Factor'])-$row['nRebaja'])." where \"id_Descuento\"=4 and \"Rut\"='".$_SESSION['Rut']."' ");
                    if(!$query){
                        $query2= pg_query($dbconn,"INSERT INTO \"rel_tEmpleados_tDescuentos\" (\"id_Descuento\",\"Monto\",\"Rut\") Values (4,".(($_SESSION['Total_Tributable']*$row['Factor'])-$row['nRebaja']).",'".$_SESSION['Rut']."')" );
                    }
                }
            }
            else
            {
                if($_SESSION['Total_Tributable']>=$row['nDesde'] and $_SESSION['Total_Tributable']<$row['nHasta'] ){
                    $query = pg_query($dbconn,"UPDATE \"rel_tEmpleados_tDescuentos\" SET \"Monto\"=".(($_SESSION['Total_Tributable']*$row['Factor'])-$row['nRebaja'])." where \"id_Descuento\"=4 and \"Rut\"='".$_SESSION['Rut']."' ");
                    if(!$query){
                        $query2= pg_query($dbconn,"INSERT INTO \"rel_tEmpleados_tDescuentos\" (\"id_Descuento\",\"Monto\",\"Rut\") Values (4,".(($_SESSION['Total_Tributable']*$row['Factor'])-$row['nRebaja']).",'".$_SESSION['Rut']."')" );
                    }
                }
            }
        }
        $id+=1;
    }     
}
#-----------------------------------------------------------------------------------------------------------------------
#     conversion numeros
#-------------------------------------------------------------------------------------------------------------------

function numtoletras($xcifra)
{ 
$xarray = array(0 => "Cero",
1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE", 
"DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE", 
"VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA", 
100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
);
//
$xcifra = trim($xcifra);
$xlength = strlen($xcifra);
$xpos_punto = strpos($xcifra, ".");
$xaux_int = $xcifra;
$xdecimales = "00";
if (!($xpos_punto === false))
	{
	if ($xpos_punto == 0)
		{
		$xcifra = "0".$xcifra;
		$xpos_punto = strpos($xcifra, ".");
		}
	$xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
	$xdecimales = substr($xcifra."00", $xpos_punto + 1, 2); // obtengo los valores decimales
	}
 
$XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
$xcadena = "";
for($xz = 0; $xz < 3; $xz++)
	{
	$xaux = substr($XAUX, $xz * 6, 6);
	$xi = 0; $xlimite = 6; // inicializo el contador de centenas xi y establezco el l�mite a 6 d�gitos en la parte entera
	$xexit = true; // bandera para controlar el ciclo del While	
	while ($xexit)
		{
		if ($xi == $xlimite) // si ya lleg� al l�mite m�ximo de enteros
			{
			break; // termina el ciclo
			}
 
		$x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
		$xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dgitos)
		for ($xy = 1; $xy < 4; $xy++) // ciclo para revisar centenas, decenas y unidades, en ese orden
			{
			switch ($xy) 
				{
				case 1: // checa las centenas
					if (substr($xaux, 0, 3) < 100) // si el grupo de tres dgitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
						{
						}
					else
						{
						$xseek = $xarray[substr($xaux, 0, 3)];
						if ($xseek)
							{
							$xsub = subfijo($xaux); 
							if (substr($xaux,0,3)==100) 
								$xcadena = " ".$xcadena." CIEN ".$xsub;
							else
								$xcadena = " ".$xcadena." ".$xseek." ".$xsub;
							$xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
							}
						else 
							{
							$xseek = $xarray[substr($xaux, 0, 1) * 100]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
							$xcadena = " ".$xcadena." ".$xseek;
							} // ENDIF ($xseek)
						} // ENDIF (substr($xaux, 0, 3) < 100)
					break;
				case 2: // checa las decenas (con la misma lgica que las centenas)
					if (substr($xaux, 1, 2) < 10){
                        
                    }
					else
						{
						$xseek = $xarray[substr($xaux, 1, 2)];
						if ($xseek)
							{
							$xsub = subfijo($xaux);
							if (substr($xaux, 1, 2) == 20){
								$xcadena = " ".$xcadena." VEINTE ".$xsub;
                                }
							else{
								$xcadena = " ".$xcadena." ".$xseek." ".$xsub;
                                }
							$xy = 3;
							}
						else
							{
							$xseek = $xarray[substr($xaux, 1, 1) * 10];
							if (substr($xaux, 1, 1) * 10 == 20)
								$xcadena = " ".$xcadena." ".$xseek;
							else	
								$xcadena = " ".$xcadena." ".$xseek." Y ";
							} // ENDIF ($xseek)
						} // ENDIF (substr($xaux, 1, 2) < 10)
					break;
				case 3: // checa las unidades
					if (substr($xaux, 2, 1) < 1) // si la unidad es cero, ya no hace nada
						{
						}
					else
						{
						$xseek = $xarray[substr($xaux, 2, 1)]; // obtengo directamente el valor de la unidad (del uno al nueve)
						$xsub = subfijo($xaux);
						$xcadena = " ".$xcadena." ".$xseek." ".$xsub;
						} // ENDIF (substr($xaux, 2, 1) < 1)
					break;
				} // END SWITCH
			} // END FOR
			$xi = $xi + 3;
		} // ENDDO
 
		if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
			$xcadena.= " DE";
 
		if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
			$xcadena.= " DE";
 
		// ----------- esta l�nea la puedes cambiar de acuerdo a tus necesidades o a tu pa�s -------
		if (trim($xaux) != "")
			{
			switch ($xz)
				{
				case 0:
					if (trim(substr($XAUX, $xz * 6, 6)) == "1")
						$xcadena.= "UN BILLON ";
					else
						$xcadena.= " BILLONES ";
					break;
				case 1:
					if (trim(substr($XAUX, $xz * 6, 6)) == "1")
						$xcadena.= "UN MILLON ";
					else
						$xcadena.= " MILLONES ";
					break;
				case 2:
					if ($xcifra < 1 )
						{
						$xcadena = "CERO PESOS ";
						}
					if ($xcifra >= 1 && $xcifra < 2)
						{
						$xcadena = "UN PESO ";
						}
					if ($xcifra >= 2)
						{
						$xcadena.= " PESOS "; // 
						}
					break;
				} // endswitch ($xz)
			} // ENDIF (trim($xaux) != "")
		// ------------------      en este caso, para M�xico se usa esta leyenda     ----------------
		$xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
		$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles 
		$xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
		$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles 
		$xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
		$xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
		$xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
	} // ENDFOR	($xz)
	return trim($xcadena);
} // END FUNCTION
 
 
function subfijo($xx)
	{ // esta funci�n regresa un subfijo para la cifra
	$xx = trim($xx);
	$xstrlen = strlen($xx);
	if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
		$xsub = "";
	//	
	if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
		$xsub = "MIL";
	//
	return $xsub;
	} 

?>
