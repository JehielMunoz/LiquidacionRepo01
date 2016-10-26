<?php
   // destruye la session 
    session_start();
    session_destroy();
    session_unset();

    if(file_exists("./index.php"))
    {
        header('location: ./index.php');   
        
    }
    else
    {
        header('location: ../index.php');   
    }
?>