<?php
$_SESSION['Descuentos_Legal'] = 0; # suma de descuentos legales
$_SESSION['Descuentos_Otros'] = 0; # suma de otros descuentos
$_SESSION['Total_Imponible']= 0; # suma de Sueldo_base+gratificaciones_Imponible
$_SESSION['Total_Haberes'] = 0; # suma de Sueldo_base+gratificaiones_Imponible + gratificaciones_no_imponible
$_SESSION['Asignacion_Familiar'] = 0; # asignacion familiar se suma alfinal
$_SESSION['Liquido_Alcansado'] = 0; # liquido a pagar + Descuentos otros
$_SESSION['sub_Total'] = 0; #total de haberes - descuento legal - descuento otros (asignacion familiar es lo unico que no se toma)
$_SESSION['Liquido_pagar'] = 0; #(total de haberes+ asignacion familiar)-descuento legal-descuentos otros
$_SESSION['id_AFP'] = 6;
$_SESSION['Total_AFP'] = 0;
$_SESSION['Total_Tributable'] = 0; #total imponible - descuento legal
function cal_Total_Imponible(){
    $rut = $_SESSION['Rut'];
    include("conex.inc");
    $query = pg_query($dbconn, " SELECT \"tEmpleados\".\"Rut\", \"tBonos\".\"Bono\", \"tBonos\".\"Activo\", \"tBonos\".\"id_Bono\", \"tBonos\".\"Imponible\",\"rel_tEmpleados_tBonos\".\"Monto\" FROM \"tBonos\" JOIN \"rel_tEmpleados_tBonos\" ON \"tBonos\".\"id_Bono\" = \"rel_tEmpleados_tBonos\".\"id_Bono\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tBonos\".\"Rut\" = \"tEmpleados\".\"Rut\" WHERE \"tEmpleados\".\"Rut\" = '$rut'::bpchar;");
    while ($row1 = pg_fetch_assoc($query)) {
        if($row1['Imponible']=='t'){
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
    $_SESSION['Total_Imponible']= $_SESSION['Sueldo_base'] + $_SESSION['Gratificaciones_Imponible'];
    $_SESSION['Total_Haberes'] =  $_SESSION['Sueldo_base'] + $_SESSION['Gratificaciones_Imponible']+ $_SESSION['Gratificaciones_no_Imponible']; 
}

function cal_Total_Descuentos(){
    $rut = $_SESSION['Rut'];
    include("conex.inc");
    $query = pg_query($dbconn, "SELECT \"tEmpleados\".\"Rut\",\"tEmpleados\".\"Nombre\",\"tDescuentos\".\"Descuento\",\"tDescuentos\".\"Tipo\",\"rel_tEmpleados_tDescuentos\".\"Monto\",\"tDescuentos\".\"id_Descuento\" FROM \"rel_tEmpleados_tDescuentos\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tDescuentos\".\"Rut\" = \"tEmpleados\".\"Rut\" JOIN \"tDescuentos\" ON \"rel_tEmpleados_tDescuentos\".\"id_Descuento\" = \"tDescuentos\".\"id_Descuento\" WHERE \"tEmpleados\".\"Rut\" = '$rut'::bpchar;");
    while  ($row1 = pg_fetch_assoc($query)){
        if($row1['Tipo'] == 'Legal'){
            if($row1['id_Descuento']== 1){
                $_SESSION['Descuentos_Legal'] += $row1['Monto'];
            }
            else{
                 $_SESSION['Descuentos_Legal'] += $row1['Monto'];
            }
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
    $rut = $_SESSION['Rut'];
    if ($_SESSION['Total_Haberes'] - $_SESSION['Descuentos_Legal'] - $_SESSION['Descuentos_Otros']>0){
        $_SESSION['Liquido_pagar'] = ($_SESSION['Total_Haberes']+$_SESSION['Asignacion_Familiar'])- $_SESSION['Descuentos_Legal'] -$_SESSION['Descuentos_Otros'];
        
    }
      
}
function Total_AFP(){
    include("conex.inc");
    $query = pg_query($dbconn, " SELECT * FROM \"tAFP\" WHERE \"tAFP\".\"id_AFP\" = '".$_SESSION['id_AFP']."';");
    $row1 = pg_fetch_assoc($query);
    $_SESSION['Total_AFP'] = intval(($row1['Tasa'] * $_SESSION['Total_Imponible'])/100);
}


cal_Total_Imponible();
Total_AFP();
cal_Total_Descuentos();
cal_sub_total();
Liquido_Alcansado();
Liquido_Pagar();

    
echo "Total imponible=",$_SESSION['Total_Imponible'];
echo "<br />";
echo "Total haberes= ",$_SESSION['Total_Haberes'];
echo "<br />";
echo "sum_Gratificacion_imponible=",$_SESSION['Gratificaciones_Imponible'];
echo "<br />";
echo "Sum_gratificaiones_no_Imponible=",$_SESSION['Gratificaciones_no_Imponible'];
echo "<br />";
echo "Sueldo mensual ",$_SESSION['Sueldo_base'] ;
echo "<br />";
echo "Descuentos legales = ",$_SESSION['Descuentos_Legal'];
echo "<br />";
echo "Descuentos otros = ",$_SESSION['Descuentos_Otros'];
echo "<br />";
echo "Asignacion_Familiar = ", $_SESSION['Asignacion_Familiar'];
echo "<br />";
echo "Total tributable = ", $_SESSION['Total_Tributable'];
echo "<br />";
echo "sub total = ", $_SESSION['sub_Total'] ;
echo "<br />";
echo "Total_AFP= ",$_SESSION['Total_AFP'] ;
echo "<br />";
echo "Total lquido a pagar = ", $_SESSION['Liquido_pagar'];
?>
