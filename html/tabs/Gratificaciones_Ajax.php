<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../../php/funciones.php';
$rut = $_POST["id_rut1"];
$num = $_POST["num1"];
$num2 = $_POST["num2"];
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
$dbServer = 'localhost';
$dbUser = 'postgres';
$dbPass = 'wii360';
$dbName = 'prueba';
$dbPort = '5432';
echo"<div class =\"divplanilla\">";
echo"<form>";
echo"<table id =\"gratificaciones\">";   
$conn_string =("host=$dbServer port=$dbPort dbname=$dbName user=$dbUser password=$dbPass ");
$dbconn = pg_connect($conn_string);
// Aquí Comienza lo del Tipo de Usuario.
if(!empty($_SESSION['Tipo']))
{   
    if($_SESSION['Tipo']==="supervisor") // Pregunta el tipo de usuario 
    {   
        if(!empty($rut))
        {
            $sql = " SELECT \"tEmpleados\".\"Rut\", \"tBonos\".\"Bono\", \"tBonos\".\"Activo\", \"tBonos\".\"id_Bono\", \"tBonos\".\"Imponible\",\"rel_tEmpleados_tBonos\".\"Monto\" FROM \"tBonos\" JOIN \"rel_tEmpleados_tBonos\" ON \"tBonos\".\"id_Bono\" = \"rel_tEmpleados_tBonos\".\"id_Bono\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tBonos\".\"Rut\" = \"tEmpleados\".\"Rut\" WHERE \"tEmpleados\".\"Rut\" = '$rut'::bpchar;";
            $query = pg_query($dbconn, $sql );
            echo "<br />";
            echo "<h2>Gratificaciones del usuario</h2>";
            echo "<br />";
            while ($row1 = pg_fetch_assoc($query)) {
                echo"<tr>";
                echo"<td>".$row1['Bono']."</td>";
                echo"<td><input type=\"text\" disabled class=\"entrega-dato\" placeholder=".Formato_Dinero($row1['Monto'])." ></td>";
                if($row1['Imponible']=='t'){
                    echo"<td>Imponible</td>";
                }
                else{
                    echo"<td>No Imponible</td>";
                }

                echo"</tr>"; 
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
            if($num!='0' && $num2==1){
                $sql = "insert into \"rel_tEmpleados_tBonos\"(\"Rut\",\"id_Bono\",\"Monto\") values('$rut',$num,$monto);";
                $query = pg_query($dbconn,$sql); 
                Recargar_datos();
                if (!$query) {
                    echo "Falla en la consulta.\n";
                    exit;
                }
                else{
                    $Nombre_Bono = get_Bono($num);
                    Escribir_Reporte("Se agrego una gratificacion de ".$Nombre_Bono." con un monto de $monto al empleado $rut.");
                }
                pg_free_result($query);
            }
            if($num!='0' && $num2==2){
                $Nombre_Bono = get_Bono($num);
                $sql = "delete from  \"rel_tEmpleados_tBonos\" where \"rel_tEmpleados_tBonos\".\"id_Bono\"=$num and \"rel_tEmpleados_tBonos\".\"Rut\" = '$rut' ;";
                $query = pg_query($dbconn,$sql); 
                Recargar_datos();
                if (!$query) {
                    echo "Falla en la consulta.\n";
                    exit;
                }
                else{
                    Escribir_Reporte("Se le quito una gratificacion de ".$Nombre_Bono." al empleado $rut.");
                }
                pg_free_result($query);
            }
            if($num!='0' && $num2==3){
                if($tipo=='Imponible'){
                    $query = pg_query("insert into \"tBonos\"(\"Bono\",\"Imponible\",\"Activo\") values('$nombre','t','t');"); 
                    Escribir_Reporte("Se creo una gratificacion de ".$nombre." de tipo imponible.");
                }
                else{
                    $query = pg_query("insert into \"tBonos\"(\"Bono\",\"Imponible\",\"Activo\") values('$nombre','f','t');");
                    Escribir_Reporte("Se creo una gratificacion de ".$nombre." de tipo no imponible.");
                }


            }
            $sql = " SELECT \"tEmpleados\".\"Rut\", \"tBonos\".\"Bono\", \"tBonos\".\"Activo\", \"tBonos\".\"id_Bono\", \"tBonos\".\"Imponible\",\"rel_tEmpleados_tBonos\".\"Monto\" FROM \"tBonos\" JOIN \"rel_tEmpleados_tBonos\" ON \"tBonos\".\"id_Bono\" = \"rel_tEmpleados_tBonos\".\"id_Bono\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tBonos\".\"Rut\" = \"tEmpleados\".\"Rut\" WHERE \"tEmpleados\".\"Rut\" = '$rut'::bpchar;";
            $query = pg_query($dbconn, $sql); // falta el rut del usuario
            if (!$query) {
                echo "Error en la consulta.\n";
                exit;
            }
            echo "<br />";
            echo "<h2>Gratificaciones del usuario</h2>";
            echo "<br />";
            while ($row1 = pg_fetch_assoc($query)) {
                echo"<tr>";
                echo"<td>".$row1['Bono']."</td>";
                echo"<td><input type=\"text\" disabled class=\"entrega-dato\" placeholder=".Formato_Dinero($row1['Monto'])."></td>";
                if($row1['Imponible']=='t'){
                    echo"<td>Imponible</td>";
                }
                else{
                    echo"<td>No Imponible</td>";
                }
                echo "<td><div class=\"bEliminar\" onclick=\"TraerDatos_Gratificaciones(".$row1['id_Bono'].",'2')\"></div></td>";
                echo"</tr>"; 
            }							                  
            echo "</table>";
            $sql = "SELECT * FROM public.\"tBonos\" WHERE \"tBonos\".\"id_Bono\"  NOT IN (SELECT \"tBonos\".\"id_Bono\" FROM public.\"rel_tEmpleados_tBonos\", public.\"tEmpleados\", public.\"tBonos\" WHERE \"tEmpleados\".\"Rut\" = \"rel_tEmpleados_tBonos\".\"Rut\" AND \"tBonos\".\"id_Bono\" = \"rel_tEmpleados_tBonos\".\"id_Bono\" AND \"tEmpleados\".\"Rut\" = '$rut');";
            $query = pg_query($dbconn, $sql);
            if (!$query) {
                echo "Error en la consulta.\n";
                exit;
            }
            echo "<br />";
            echo "<h2>Agregar Gratificacion al usuario</h2>";
            echo "<br />";
            echo "<table>";
            while ($row2 = pg_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>".$row2['Bono']."</td>";
                if($row2['Imponible']=='t'){
                    echo"<td>Imponible</td>";
                }
                else{
                    echo"<td>No Imponible</td>";
                }
                echo "<td><input id='bono".$row2['id_Bono']."' type=\"number\" min='0' placeholder='Ingresar monto' class=\"entrega-dato\"></input></td>";
					echo "<td><div class=\"bAgregar\" onclick=\"TraerDatos_Gratificaciones(".$row2['id_Bono'].",'1')\"></div></td>";
                echo "</tr>";
            }   
            echo "</table>";
            echo "<br/>";
            echo "<h2>Crear Gratificación</h2>";
            echo "<table>";
            echo "<tr>";
            echo "<td>Nombre</td>";
            echo "<td>Tipo</td>";
            echo "<td>Agregar</div></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><input type=\"text\" class=\"entrega-dato\" id=\"Nombre_nueva_gratificacion\" name=\"Nombre_nueva_gratificacion\" placeholder='Ingresar el nombre'></input></td>";
            echo "<td><select id=\"Tipo_nueva_gratificacion\" name=\"Tipo_nueva_gratificacion\">";
            echo            "<option value='Imponible'>Imponible</option>";
            echo            "<option value='no Imponible'>No Imponible</option>";
            echo "</select>";
            echo "</td>";
            echo "<td><div class=\"bAgregar\" class=\"entrega-dato\" onclick=\"TraerDatos_Gratificaciones('3','3')\"></div></td>";
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