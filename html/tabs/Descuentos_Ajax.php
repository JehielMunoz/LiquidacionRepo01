<?php
    $rut = $_POST["id_rut"];
    $num = $_POST["num"];
    $dbServer = 'localhost';
    $dbUser = 'postgres';
    $dbPass = 'wii360';
    $dbName = 'prueba';
    $dbPort = '5432';
    $conn_string =("host=$dbServer port=$dbPort dbname=$dbName user=$dbUser password=$dbPass ");
    $dbconn = pg_connect($conn_string);
    if($rut!="null"){ 
        if (!$dbconn){
            echo "Error en la conexion";
            exit;
            }
        if($num!='0'){
            $query = pg_query($dbconn,"insert into \"rel_tEmpleados_tDescuentos\"(\"id_Descuento\",\"Monto\",\"Rut\" ) values($num,0,'$rut');"); 
            if (!$query) {
                echo "Falla en la consulta.\n";
                exit;
            }
            
        }
        $query = pg_query($dbconn, "SELECT \"tEmpleados\".\"Rut\",\"tEmpleados\".\"Nombre\",\"tDescuentos\".\"Descuento\",\"rel_tEmpleados_tDescuentos\".\"Monto\" FROM \"rel_tEmpleados_tDescuentos\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tDescuentos\".\"Rut\" = \"tEmpleados\".\"Rut\" JOIN \"tDescuentos\" ON \"rel_tEmpleados_tDescuentos\".\"id_Descuento\" = \"tDescuentos\".\"id_Descuento\" WHERE \"tEmpleados\".\"Rut\" = '$rut'::bpchar;"); // falta el rut del usuario
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
                echo "<td><input type=\"text\" name=\"Mutual\" placeholder=".$row1["Monto"]."></td>";						
                echo "</tr>";
            }
        echo "</table>";
        $query = pg_query($dbconn, "SELECT * FROM \"tDescuentos\"; ");
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
                echo "<td><div class=\"bAgregar\" onclick=\"TraerDatos(".$row2['id_Descuento'].")\"></div></td>"	;				
                echo "</tr>";
            }   
        
        echo "</table>";
        echo "<br/>";
        echo "<div class=\"buttonSave\" onclick=\"plSave()\">Guardar</div><div class=\"buttonSave\">Agregar Descuento</div>";
        }
    else{
        echo "</table>";
        echo "Elija a un empleado primero";
    }

?>