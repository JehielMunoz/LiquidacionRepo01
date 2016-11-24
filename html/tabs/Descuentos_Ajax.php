
<?php
echo "
<script>
$('.entrega-dato').bind('keyup blur',bloqueaInput);
</script>
";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../../php/funciones.php';
$rut = $_POST["id_rut2"];
$num = $_POST["num2"];
$num2= $_POST["num3"];
if(!empty($_POST['nombre'])){
    $nombre = $_POST["nombre"];
}
if(!empty($_POST['tipo'])){
    $tipo = $_POST['tipo'];
}
if(!empty($_POST['monto'])){
    $monto = $_POST['monto'];
}
else
{
    $monto=0;
}
if(!empty($_POST['id_descuento'])){
    $id_descuento = $_POST['id_descuento'];
}
if(!empty($_POST['id_prestamo'])){
    $id_prestamo = $_POST['id_prestamo'];
}


$dbServer = 'localhost';
$dbUser = 'postgres';
$dbPass = 'wii360';
$dbName = 'prueba';
$dbPort = '5432';
$conn_string =("host=$dbServer port=$dbPort dbname=$dbName user=$dbUser password=$dbPass ");
$dbconn = pg_connect($conn_string); 
echo"<div class =\"divplanilla\">";
echo"<form>";
echo    "<table id =\"descuentos\">";
// Aquí Comienza lo del Tipo de Usuario.
if(!empty($_SESSION['Tipo']))
{   
    if($_SESSION['Tipo']==="supervisor") // Pregunta el tipo de usuario 
    {   
        if(!empty($rut))
        {
            $sql = "SELECT * FROM \"rel_tEmpleados_tDescuentos\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tDescuentos\".\"Rut\" = \"tEmpleados\".\"Rut\" JOIN \"tDescuentos\" ON \"rel_tEmpleados_tDescuentos\".\"id_Descuento\" = \"tDescuentos\".\"id_Descuento\" WHERE \"tEmpleados\".\"Rut\" = '$rut'::bpchar;";
            $query = pg_query($dbconn, $sql);
            echo "<h2>Descuentos del usuario</h2>";
            echo "<br/>";
            while ($row1 = pg_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>".$row1['Descuento']."</td>";
                echo "<td><input type=\"text\" disabled class=\"entrega-dato\" name=\"Mutual\" placeholder=".Formato_Dinero($row1["Monto"])."></td>";
                echo "</tr>";
            }
            
            echo "</table>";

        }
        else
        {
            echo "Seleccione Empleado...";
        }
    }
    else // Aqui Termina lo del Tipode Usuario. Intente no meterme con la logica de tu pagina. Asi que lo pege talcual en este else.
    {
        if($rut!=""){ 
            if (!$dbconn){
                echo "Error en la conexion";
                exit;
            }

            
            if($num!='0' && $num2==7){
                $sql = "UPDATE  \"tPrestamos\" SET \"Monto\" = $monto WHERE \"id_Prestamo\" = $id_prestamo AND \"Rut\"='".$_SESSION["Rut"]."'" ;
                $query = pg_query($dbconn, $sql);
                if (!$query) {
                    echo "Falla en la consulta.\n";
                    exit;
                }
                else
                {
                    Escribir_Reporte("Se modifico el Prestamo/Credito  X . Nuevo Monto  : ".$_POST['monto']. " para el empleado".$_SESSION['Rut']); // Quizas el nombre del credito
                 }   
            }         
            
            if($num!='0' && $num2==6){
                $sql = "UPDATE  \"rel_tEmpleados_tDescuentos\" SET \"Monto\" = $monto WHERE \"id_Descuento\" = $id_descuento AND \"Rut\"='".$_SESSION["Rut"]."'";
                $query = pg_query($dbconn, $sql );
                if (!$query) {
                    echo "Falla en la consulta.\n";
                    exit;
                }
                else
                {
                    Escribir_Reporte("Se modifico el descuento X . Nuevo Monto  : ".$_POST['monto']. " para el empleado".$_SESSION['Rut']); // Quizas el nombre del DEscuento
                 }   
            }

            if($num!='0' && $num2==4){
                $values = "('$rut','".$_POST['Nombre']."','".$_POST['Inicio']."','".$_POST['Final']."',".$_POST['Monto'].")";
                $sql = "insert into \"tPrestamos\"(\"Rut\",\"Nombre\",\"F_inicio\",\"F_final\",\"Monto\") values".$values." ";
                $query = pg_query($dbconn, $sql);
                Recargar_datos();
                if (!$query) {
                    echo "Falla en la consulta.\n";
                    exit;
                }
                else
                {
                    Escribir_Reporte("Se agrego un credito llamado  ".$_POST['Nombre']." Por un Monto mensual: ".$_POST['Monto']. " para el empleado ".$_SESSION['Rut']); // Quizas agregar fecha
                 }   
            }
             if($num!='0' && $num2==5){
                $values = "('$rut','".$_POST['Descuenta']."',".$_POST['Dias'].",'".$_POST['Inicio_l']."','".$_POST['Final_l']."')";
                $sql = "insert into \"tLicencias\"(\"Rut\",\"Descuenta\",\"Dias\",\"F_inicio\",\"F_final\") values".$values."";
                $query = pg_query($dbconn,$Sql);
                Recargar_datos();
                if (!$query) {
                    echo "Falla en la consulta.\n";
                    exit;
                }
                else
                {
                    Escribir_Reporte("Se creo una licencia de ". diferencia_Fecha($_POST['Inicio_l'],$_POST['Final_l']) ." días para el empleado: ".$_SESSION['Rut'].".");
                }
            }
            
            if($num!='0' && $num2==1){
                $sql = "insert into \"rel_tEmpleados_tDescuentos\"(\"id_Descuento\",\"Monto\",\"Rut\" ) values($num,$monto,'$rut');";
                $query = pg_query($dbconn, $sql); 
                Recargar_datos();
                if (!$query) {
                    echo "Falla en la consulta.\n";
                    exit;
                }
                else
                {
                    $Nombre_Descuento = get_Descuento($num);
                    Escribir_Reporte("Se agrego un descuento de ".$Nombre_Descuento." con un monto de $monto al empleado $rut.");
                }
            }
            if($num!='0' && $num2==2){
                $Nombre_Descuento = get_Descuento($num);
                $sql = "delete from  \"rel_tEmpleados_tDescuentos\" where \"rel_tEmpleados_tDescuentos\".\"id_Descuento\"=$num and \"rel_tEmpleados_tDescuentos\".\"Rut\" = '$rut' ;";
                $query = pg_query($dbconn, $sql); 
                Recargar_datos();
                if (!$query) {
                    echo "Falla en la consulta.\n";
                    exit;
                }
                else{
                    Escribir_Reporte("Se borro un descuento de ".$Nombre_Descuento." del empleado $rut.");
                }
                pg_free_result($query);
            }
            if($num!='0' && $num2==3){
                if($tipo=='Legal'){
                    $sql="insert into \"tDescuentos\"(\"Descuento\",\"Tipo\",\"Activo\") values('$nombre','legal','t');";
                    $query = pg_query($dbconn,$sql);
                    Escribir_Reporte("Se creo un descuento de ".$nombre." de tipo legal.");
                }
                else{
                    $sql = "insert into \"tDescuentos\"(\"Descuento\",\"Tipo\",\"Activo\") values('$nombre','vario','t');";
                    $query = pg_query($dbconn,$sql);
                    Escribir_Reporte("Se creo un descuento de ".$nombre." de tipo vario.");
                }
            }
            $sql = "SELECT * FROM \"rel_tEmpleados_tDescuentos\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tDescuentos\".\"Rut\" = \"tEmpleados\".\"Rut\" JOIN \"tDescuentos\" ON \"rel_tEmpleados_tDescuentos\".\"id_Descuento\" = \"tDescuentos\".\"id_Descuento\" WHERE \"tEmpleados\".\"Rut\" = '$rut'::bpchar;";
            $query = pg_query($dbconn, $sql);
            if (!$query) {
                echo "Error en la consulta.\n";
                exit;
            }
            echo "<br />";
            echo "<h2>Descuentos del usuario</h2>";
            echo "<br />";
            while ($row1 = pg_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>".$row1['Descuento']."</td>";
                echo "<td><input type=\"number\" min='0' class=\"entrega-dato\" name=\"Mutual\" placeholder=".Formato_Dinero($row1["Monto"])."></td>";
                echo "<td><div class=\"bEliminar\" onclick=\"TraerDatos(".$row1['id_Descuento'].",'2')\"></div></td>";
                echo "<td><div><button  onclick=\"TraerDatos(".$row1['id_Descuento'].",'6')\">Modificar Monto </button></div></td>";
                echo "</tr>";
            }
            $sql = "Select * FROM \"tLicencias\" WHERE \"Rut\" ='$rut' and \"Activo\" ='t'";
            $query = pg_query($dbconn, $sql);
            while ($row1 = pg_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>Licencias Medicas</td>";
                if(!empty($_SESSION['Descuentos_Licencias']))
                {
                    echo "<td><input type=\"text\" disabled class=\"entrega-dato\" name=\"Mutual\" placeholder=".Formato_Dinero($_SESSION['Descuentos_Licencias'])."></td>"; 
                }
                else{
                echo "<td><input type=\"text\" disabled class=\"entrega-dato\" name=\"Mutual\" placeholder=\"$0\"></td>";}
                echo "</tr>";
            }
            
        
            
            echo "</table>";
            echo "</td>";
            echo "<td>";
            $sql = "SELECT *FROM public.\"tDescuentos\" WHERE \"tDescuentos\".\"id_Descuento\"  NOT IN (SELECT \"tDescuentos\".\"id_Descuento\" FROM public.\"tEmpleados\", public.\"rel_tEmpleados_tDescuentos\", public.\"tDescuentos\" WHERE (\"tEmpleados\".\"Rut\" = \"rel_tEmpleados_tDescuentos\".\"Rut\" AND \"tDescuentos\".\"id_Descuento\" = \"rel_tEmpleados_tDescuentos\".\"id_Descuento\") AND (\"tEmpleados\".\"Rut\" = '$rut')); ";
            $query = pg_query($dbconn, $sql);
            if (!$query) {
                echo "Error en la consulta.\n";
                exit;
            }
            echo "<br />";
            echo "<h2>Credito y Prestamos del Empleado</h2>";
            echo "<br />";
            echo "<table>";
            /////// CALCULAR VALOR TOTAL DE MESES,.
            $sql = "SELECT * FROM \"tPrestamos\" where \"Rut\" ='$rut' and \"Activo\"='t' ";
            $query = pg_query($dbconn, $sql );
            if (!$query) {
                echo "Error en la consulta.\n";
                exit;
            }
            while ($row1 = pg_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>".$row1['Nombre']."</td>";
                echo "<td><input type=\"number\" min='0' class=\"entrega-dato\" id=\"Monto_Credito\" disable name=\"Monto_Credito\" placeholder=".Formato_Dinero($row1["Monto"])."></td>";
                echo "<td><input type=\"text\" class=\"entrega-dato\" disable name=\"inicio_credito\" placeholder=".$row1["F_inicio"]."></td>";
                echo "<td><input type=\"text\" class=\"entrega-dato\" disable name=\"final_credito\" placeholder=".$row1["F_final"]."></td>";
                echo "<td><button onclick=\"TraerDatos(".$row1['id_Prestamo'].",'7')\"> Modificar Valor</button></td>";
            
                echo "</tr>";
            }
            echo "</table>";
            echo "</td>";
            $sql = "SELECT *FROM public.\"tDescuentos\" WHERE \"tDescuentos\".\"id_Descuento\"  NOT IN (SELECT \"tDescuentos\".\"id_Descuento\" FROM public.\"tEmpleados\", public.\"rel_tEmpleados_tDescuentos\", public.\"tDescuentos\" WHERE (\"tEmpleados\".\"Rut\" = \"rel_tEmpleados_tDescuentos\".\"Rut\" AND \"tDescuentos\".\"id_Descuento\" = \"rel_tEmpleados_tDescuentos\".\"id_Descuento\") AND (\"tEmpleados\".\"Rut\" = '$rut')); ";
            $query = pg_query($dbconn,$sql );
            if (!$query) {
                echo "Error en la consulta.\n";
                exit;
            }
            echo "<br />";
            echo "<h2>Agregar Descuento al empleado</h2>";
            echo "<br />";
            echo "<table>";
            while ($row2 = pg_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>".$row2['Descuento']."</td>";
                if($row2['Tipo']=='legal '){
                    echo "<td>Legal</td>";
                }
                else{
                    echo "<td>Varios</td>";
                }
                echo "<td><input id='descuento".$row2['id_Descuento']."' type=\"number\" min='0' class=\"entrega-dato\"placeholder='Ingresar monto' ></input></td>";
                echo "<td><div class=\"bAgregar\" onclick=\"TraerDatos(".$row2['id_Descuento'].",'1')\"></div></td>";				
                echo "</tr>";
            }   
            echo "</table>";
            echo "<br/>";
            echo "<h2>Crear Descuento </h2>";
            echo "<table>";
            echo "<tr>";
            echo "<td>Nombre</td>";
            echo "<td>Tipo</td>";
            echo "<td>Agregar</div></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><input type=\"text\" class=\"entrega-dato\" id=\"Nombre_nuevo_descuento\" placeholder='Ingrese el nombre'></input></td>";
            echo "<td><select id=\"Tipo_nuevo_descuento\">";
            echo            "<option value='Legal'>Legal</option>";
            echo            "<option value='Varios'>Varios</option>";
            echo "</select>";
            echo "</td>";
            echo "<td><div class=\"bAgregar\" class=\"entrega-dato\" onclick=\"TraerDatos('3','3')\"></div></td>";
            echo "</tr>";
            echo "</table>";
            ///// CREDITO Y PRESSTAMO
            echo "<br/>";
            echo "<h2>Agregar Credito o Prestamo </h2>";
            echo "<table>";
            echo "<tr>";
            echo "<td>Nombre</td>";
            echo "<td>Monto Mensual</td>";
            echo "<td>Fecha de inicio.</td>";
            echo "<td>Fecha final.</div></td>";
            echo "</tr>";
            echo "<tr>";
             echo "<td><input type=\"text\" name=\"nombre_credito\" class=\"entrega-dato\" id=\"Nombre_nuevo_credito\" placeholder='Ingrese el nombre del Credito'></input></td>";
            echo "<td><input type=\"number\" name=\"monto_credito\" class=\"entrega-dato\" id=\"Monto_nuevo_credito\" placeholder='Monto Mensual del Prestamo'></input></td>";
            echo "<td><input type=\"date\" name=\"inicio_credito\" class=\"entrega-dato\" id=\"Inicio_nuevo_credito\" placeholder='Año/Mes/Dia'></input></td>";
            echo "<td><input type=\"date\" name=\"final_credito\" class=\"entrega-dato\" id=\"Termino_nuevo_credito\" placeholder='Año/Mes/Dia'></input></td>";
            echo "<td><div class=\"bAgregar\" class=\"entrega-dato\" onclick=\"TraerDatos('4','4')\"></div></td>";
            echo "</tr>";
            echo "</table>";
            
             ///// Licencias
            echo "<br/>";
            echo "<h2>Agregar Licencias </h2>";
            echo "<table>";
            echo "<tr>";
            echo "<td>Dias de licencia.</td>";
            echo "<td>Descuenta.</td>";
            echo "<td>Fecha Inicial.</div></td>";
            echo "<td>Fecha Final.</div></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><input type=\"number\" name=\"dias\" class=\"entrega-dato\" id=\"dias\" placeholder='Numero de dias de Licencia'></input></td>";
            echo "<td>Si<input type=\"checkbox\" name=\"descuenta\" value=\"True\" class=\"entrega-dato\" id=\"descuenta\"></input>No<input type=\"checkbox\" name=\"descuenta\" class=\"entrega-dato\" value=\"False\" id=\"descuenta\"></input></td>";
            echo "<td><input type=\"date\" name=\"inicio_credito\" class=\"entrega-dato\" id=\"Inicio_Licencia\" ></input></td>";
            echo "<td><input type=\"date\" name=\"final_credito\" class=\"entrega-dato\" id=\"Termino_Licencia\" ></input></td>";
            echo "<td><div class=\"bAgregar\" class=\"entrega-dato\" onclick=\"TraerDatos('4','5')\"></div></td>";
            echo "</tr>";
            echo "</table>";
        }
        else{
            echo "</table>";
            echo "Elija a un empleado primero";
        }

        echo    "</form>";
        echo    "<br />";
        echo "</div>  ";

    }
}   

?>
