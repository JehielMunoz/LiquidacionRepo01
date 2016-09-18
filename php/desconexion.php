<?php
   // destruye la session 
    session_start();
    session_destroy();
    session_unset();
    header('location: index.php');
?>