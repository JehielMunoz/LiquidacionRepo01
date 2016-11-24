<?php
require "./conex.php";
require "./funciones.php";

if(!empty($_POST)){
    $id=1;
    while($id<=8){
        if($id==8){
            $sql= "UPDATE \"tImpuesto\" SET \"fDesde\"=".$_POST[$id.'fdesde'].",  \"Factor\"=".$_POST[$id.'factor'].", \"nDesde\"=".$_POST[$id.'ndesde'].",  \"fRebaja\"=".$_POST[$id.'frebaja'].", \"nRebaja\"=".$_POST[$id.'nrebaja']." WHERE \"id_Impuesto\"=$id;";
            $query = pg_query($dbconn,$sql);
            
        }
        else{
            $sql= "UPDATE \"tImpuesto\" SET \"fDesde\"=".$_POST[$id.'fdesde'].", \"fHasta\"=".$_POST[$id.'fhasta'].", \"Factor\"=".$_POST[$id.'factor'].", \"nDesde\"=".$_POST[$id.'ndesde'].", \"nHasta\"=".$_POST[$id.'nhasta'].", \"fRebaja\"=".$_POST[$id.'frebaja'].", \"nRebaja\"=".$_POST[$id.'nrebaja']." WHERE \"id_Impuesto\"=$id;";
            $query = pg_query($dbconn,$sql);
            
        }
        $id+=1;
    }
    
    Escribir_Reporte("Se han hecho cambios en la tabla de Impuesto unico a la renta.");
    
    header('location: ../html/impuesto_unico.php');             
}
?>
