<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    $rut = $_POST["id_rut1"];
    $num = $_POST["num1"];
    $dbServer = 'localhost';
    $dbUser = 'postgres';
    $dbPass = 'wii360';
    $dbName = 'prueba';
    $dbPort = '5432';
    echo"<div class =\"divplanilla\">";
    echo"<form>";
    echo    "<table id =\"gratificaciones\">";   
    $conn_string =("host=$dbServer port=$dbPort dbname=$dbName user=$dbUser password=$dbPass ");
    if($rut!="null"){ 
        $dbconn = pg_connect($conn_string); 
        if (!$dbconn){
            echo "Error en la conexion";
            exit;
            }
        if($num!='0'){
            $query = pg_query($dbconn,"insert into \"rel_tEmpleados_tBonos\"(\"Rut\",\"id_Bono\",\"Monto\") values('$rut',$num,0);"); 
            if (!$query) {
                echo "Falla en la consulta.\n";
                exit;
            }
            
        }
        $query = pg_query($dbconn, " SELECT \"tEmpleados\".\"Rut\", \"tBonos\".\"Bono\", \"tBonos\".\"Activo\", \"tBonos\".\"id_Bono\", \"tBonos\".\"Imponible\" FROM \"tBonos\" JOIN \"rel_tEmpleados_tBonos\" ON \"tBonos\".\"id_Bono\" = \"rel_tEmpleados_tBonos\".\"id_Bono\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tBonos\".\"Rut\" = \"tEmpleados\".\"Rut\" WHERE \"tEmpleados\".\"Rut\" = '$rut'::bpchar;"); // falta el rut del usuario
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
                    echo"<td><input type=\"text\" name=\"hExtras\" placeholder=\"Monto\"></td>";
                        echo"<td>Imponible</td>";
                echo"</tr>"; 
                    }						
				                  
        echo "</table>";
        $query = pg_query($dbconn, "SELECT * FROM \"tBonos\"; ");
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
                echo"<td>Imponible</td>";
                echo "<td><div class=\"bAgregar\" onclick=\"TraerDatos_Gratificaciones(".$row2['id_Bono'].")\"></div></td>"	;
                echo "</tr>";
            }   
        
        echo "</table>";
        echo "<br/>";
        echo "<div class=\"buttonSave\" onclick=\"plSave()\">Guardar</div><div class=\"buttonSave\">Agregar Gratificación</div>";
        }
    else{
        echo "</table>";
        echo "Elija a un empleado primero";
    }
    
    echo    "</form>";
    echo    "<br />";
    echo "</div>  ";

?>