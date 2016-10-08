<?php
// inicia la session de usuario
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
function verificar_login($user,$password,&$result){
    include("./php/conex.inc");
    $query = pg_query($dbconn, "SELECT * FROM \"tUsuarios\" WHERE \"Usuario\" = '$user' and \"Password\" = '$password'");
    $count = 0;
    while($row = pg_fetch_object($query))
    {
        $count++;
        $result = $row;
    }
    if($count == 1){
        return 1;
    }
    else{
        return 0;
    }
}

if (!isset($_SESSION['Usuario'])){
    if(isset($_POST['login'])){
        if(verificar_login($_POST['Usuario'],$_POST['Password'],$result) == 1)
        {
            $_SESSION['Tipo'] = $result->Tipo;
            $_SESSION['Usuario'] = $result->Usuario;
            echo '<script language= "JavaScript">location.href="index.php" </script>';
            header("location:index.php");
                }
        else
            {
            echo '<div class="error">Su usuario es incorrecto, intente nuevamente.</div>';
        }
    }
    require 'login.php';
}
else
{
    //Requiere que cargue el archivo conexion, con la informacion de la DB, para que el resto de la pagina carge.
    // Carga las variables y las funciones
    require './php/Variables.php';
    require './php/funciones.php';
    get_datos();

    // Arma el html de la pagina.
    require './php/Inicio_Carga.php';
}
?>