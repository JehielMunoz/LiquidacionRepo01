<?php 
$url = explode("/",$_SERVER['HTTP_REFERER']);
if (end($url)=="Licencias.php")
{


    if (!empty($_POST['id_modificar']) && !empty($_POST['dias']) )
    {
            include "./conex.php";
            $query = pg_query($dbconn, "UPDATE \"tLicencias\" SET \"Dias\"=".$_POST['dias']." where \"id_Licencia\" =".$_POST['id_modificar']);
            header('location: ../html/Licencias.php');
            echo "1";
            exit();
    }


    if(!empty($_GET['id_licencia']))
    {
        include "./conex.php";
        $query = pg_query($dbconn, "UPDATE \"tLicencias\" SET \"Activo\"='FALSE' where \"id_Licencia\" =".$_GET['id_licencia']);
        header('location: ../html/Licencias.php');
        echo "2";
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