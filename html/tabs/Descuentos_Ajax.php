<?php
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
    if($_SESSION['Tipo']==="contador") // Pregunta el tipo de usuario 
    {   
        if(!empty($rut))
        {
            $query = pg_query($dbconn, "SELECT * FROM \"rel_tEmpleados_tDescuentos\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tDescuentos\".\"Rut\" = \"tEmpleados\".\"Rut\" JOIN \"tDescuentos\" ON \"rel_tEmpleados_tDescuentos\".\"id_Descuento\" = \"tDescuentos\".\"id_Descuento\" WHERE \"tEmpleados\".\"Rut\" = '$rut'::bpchar;");
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
            if($num!='0' && $num2==1){
                $query = pg_query($dbconn,"insert into \"rel_tEmpleados_tDescuentos\"(\"id_Descuento\",\"Monto\",\"Rut\" ) values($num,$monto,'$rut');"); 
                if (!$query) {
                    echo "Falla en la consulta.\n";
                    exit;
                }
            }
            if($num!='0' && $num2==2){
                $query = pg_query($dbconn,"delete from  \"rel_tEmpleados_tDescuentos\" where \"rel_tEmpleados_tDescuentos\".\"id_Descuento\"=$num and \"rel_tEmpleados_tDescuentos\".\"Rut\" = '$rut' ;"); 
                if (!$query) {
                    echo "Falla en la consulta.\n";
                    exit;
                }
                pg_free_result($query);
            }
            if($num!='0' && $num2==3){
                if($tipo=='Legal'){
                    $query = pg_query("insert into \"tDescuentos\"(\"Descuento\",\"Tipo\",\"Activo\") values('$nombre','legal','t');"); 
                }
                else{
                    $query = pg_query("insert into \"tDescuentos\"(\"Descuento\",\"Tipo\",\"Activo\") values('$nombre','vario','t');");
                }
            }
            $query = pg_query($dbconn, "SELECT * FROM \"rel_tEmpleados_tDescuentos\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tDescuentos\".\"Rut\" = \"tEmpleados\".\"Rut\" JOIN \"tDescuentos\" ON \"rel_tEmpleados_tDescuentos\".\"id_Descuento\" = \"tDescuentos\".\"id_Descuento\" WHERE \"tEmpleados\".\"Rut\" = '$rut'::bpchar;");
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
                echo "<td><input type=\"text\" class=\"entrega-dato\" name=\"Mutual\" placeholder=".Formato_Dinero($row1["Monto"])."></td>";
                echo "<td><div class=\"bEliminar\" onclick=\"TraerDatos(".$row1['id_Descuento'].",'2')\"></div></td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</td>";
            echo "<td>";
            $query = pg_query($dbconn, "SELECT *FROM public.\"tDescuentos\" WHERE \"tDescuentos\".\"id_Descuento\"  NOT IN (SELECT \"tDescuentos\".\"id_Descuento\" FROM public.\"tEmpleados\", public.\"rel_tEmpleados_tDescuentos\", public.\"tDescuentos\" WHERE (\"tEmpleados\".\"Rut\" = \"rel_tEmpleados_tDescuentos\".\"Rut\" AND \"tDescuentos\".\"id_Descuento\" = \"rel_tEmpleados_tDescuentos\".\"id_Descuento\") AND (\"tEmpleados\".\"Rut\" = '$rut')); ");
            if (!$query) {
                echo "Error en la consulta.\n";
                exit;
            }
            echo "<br />";
            echo "<h2>Agregar Descuento al usuario</h2>";
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
                echo "<td><input id='descuento".$row2['id_Descuento']."' type=\"text\" class=\"entrega-dato\"></input></td>";
                echo "<td><div class=\"bAgregar\" onclick=\"TraerDatos(".$row2['id_Descuento'].",'1')\"></div></td>";				
                echo "</tr>";
            }   
            echo "</table>";
            echo "<br/>";
            echo "<table>";
            echo "<tr>";
            echo "<td>Nombre</td>";
            echo "<td>Tipo</td>";
            echo "<td>Agregar</div></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><input type=\"text\" class=\"entrega-dato\" id=\"Nombre_nuevo_descuento\" ></input></td>";
            echo "<td><select id=\"Tipo_nuevo_descuento\">";
            echo            "<option value='Legal'>Legal</option>";
            echo            "<option value='Varios'>Varios</option>";
            echo "</select>";
            echo "</td>";
            echo "<td><div class=\"bAgregar\" class=\"entrega-dato\" onclick=\"TraerDatos('3','3')\"></div></td>";
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