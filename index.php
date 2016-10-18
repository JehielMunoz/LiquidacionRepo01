<?php
// inicia la session de usuario
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
function verificar_login($user,$password,&$result){
    include("./php/conex.inc");
    $query = pg_query($dbconn, "SELECT * FROM \"tUsuarios\" WHERE \"Usuario\" = '$user' and \"Password\" = '$password'");
    $count = 0;
    if(!empty($row = pg_fetch_object($query))) #Aqui habia un while. Esto es kinda redunte. El nombre del usuario deberia ser unico, por lo tanto, Siempre va a haber 1 asi que lo arregle, para que solo haga la consulta. Sin necesidad de usar un ciclo while.
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
            echo '<div class="divError">Su usuario es incorrecto, intente nuevamente.</div>';
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
    // Arma el html de la pagina.
    require './php/Inicio_Carga.php';
}
?>