<?php
// inicia la session de session
// Version: 0.22
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
function verificar_login($user,$password,&$result){
    include("./php/conex.php");
    $query = pg_query($dbconn, "SELECT * FROM \"tUsuarios\" WHERE \"Usuario\" = '$user' and \"Password\" = '$password'");
    $count = 0;
    if(!empty($row = pg_fetch_object($query))) 
    {
        $result = $row;
        return 1;
    }
    else
    {
        return 0;    
    }
}

if (!isset($_SESSION['Usuario'])){
    if(isset($_POST['login']))
    {
        if(verificar_login($_POST['Usuario'],$_POST['Password'],$result) == 1)
        {
            $_SESSION['Tipo'] = trim($result->Tipo," ");
            $_SESSION['Usuario'] = trim($result->Usuario," ");
            echo '<script language= "JavaScript">location.href="index.php" </script>';
            header("location:index.php");
        }
        else
        {
            echo '<div class="divError">Su usuario es incorrecto, intente nuevamente.</div>';
        }
    }
    require './php/login.php';
}
else
{   
   
    require './php/funciones.php';
    //Requiere que cargue el archivo conexion, con la informacion de la DB, para que el resto de la pagina carge.
    // Carga las variables y las funciones
    require './php/funciones.php';
    desactivar_licencias();
    desactivar_Prestamos();
    require './php/Variables.php';
  
    // Arma el html de la pagina.
    require './php/Inicio_Carga.php';
}
?>