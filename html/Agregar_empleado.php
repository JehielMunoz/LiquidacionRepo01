<?php 
if(!empty($_SESSION['Tipo']))
{   
    if($_SESSION['Tipo']==="contador") // Pregunta el tipo de usuario 
    {   
        header('location: ../index.php');
        exit();
    }
}
else
{
    header('location: ../index.php');
    exit();
}
?>


<html>

</html>