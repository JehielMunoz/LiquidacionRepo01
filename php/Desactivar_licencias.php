<?php 

$url = explode("/",$_SERVER['HTTP_REFERER']);

if (end($url)=="Licencias.php")
{
    if(!empty($_GET['id_licencia']))
    {
        include "./conex.php";
        $query = pg_query($dbconn, "UPDATE \"tLicencias\" SET \"Activo\"='FALSE' where \"id_Licencia\" =".$_GET['id_licencia']);
        header('location: ../html/Licencias.php');
        exit();
    }
    elseif (!empty($_GET['id_modificar']) && !empty($_GET['dias']) )
    {
        $query = pg_query($dbconn, "UPDATE \"tLicencias\" SET \"Dias\"=".$_GET['dias']." where \"id_Licencia\" =".$_GET['id_modificar']);
        header('location: ../html/Licencias.php');
        exit();
    }
    else
    {
        header('location: ../index.php');    
    }
}
else
{
    header('location: ../index.php');      
}
?>