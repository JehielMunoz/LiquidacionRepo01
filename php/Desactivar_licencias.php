<?php 
include("funciones.php");
$url = explode("/",$_SERVER['HTTP_REFERER']);
if (end($url)=="Licencias.php")
{


    if (!empty($_POST['id_modificar']) && !empty($_POST['dias']) )
    {
            include "./conex.php";
            $sql1 = "UPDATE \"tLicencias\" SET \"Dias\"=".$_POST['dias']." where \"id_Licencia\" =".$_POST['id_modificar']."";
            $query = pg_query($dbconn, $sql1);
            if(!$query){
                echo "<script>alert('Error al modificar los dias
                ')</script>";
                
            }
            header('location: ../html/Licencias.php');
            echo "1";
        
            $query = pg_query($dbconn, "SELECT * FROM \"tLicencias\" where \"id_Licencia\" =".$_POST['id_modificar']);
            $fila = pg_fetch_assoc($query);
            Escribir_Reporte("Se han modificado los dias de licencia del empleado con rut: ".$fila['Rut']." a ".$_POST['dias']." dias.");
        
            exit();
    }


    if(!empty($_GET['id_licencia']))
    {
        include "./conex.php";
        $sql1="UPDATE \"tLicencias\" SET \"Activo\"='FALSE' where \"id_Licencia\" =".$_GET['id_licencia']." ";
        $query = pg_query($dbconn, "UPDATE \"tLicencias\" SET \"Activo\"='FALSE' where \"id_Licencia\" =".$_GET['id_licencia']);
        if(!$query){
            echo "<script>alert('Error al desactivar la licencia.
                ')</script>";
        }
        header('location: ../html/Licencias.php');
        echo "2";
        
        $query2 = pg_query($dbconn, "SELECT * FROM \"tLicencias\" where \"id_Licencia\" =".$_GET['id_licencia']);
        $fila = pg_fetch_assoc($query2);
        Escribir_Reporte("Se ha eliminado una licencia del empleado con rut: ".$fila['Rut'].".");
        
        exit();
    }
    else
    {   
        echo "3";
        header('location: ../index.php');    
    }
}
else
{
    header('location: ../index.php');      
}
?>