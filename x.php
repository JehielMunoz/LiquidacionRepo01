<?php
    session_start();
    $_SESSION['Usuario'] = "Javier";
    chdir($_SERVER['DOCUMENT_ROOT']."/Liquidaciones-de-Sueldo/"); 

 
    function Iniciar_Reporte()
    {
        $Carpeta = "./Reporte";
        $File = "/".$_SESSION['Usuario'].".txt";
        $Inicio = "#############################################".PHP_EOL."[".$_SESSION['Usuario']."]".PHP_EOL;
        $Inicio_Hora = date("[H:m:s] ").$_SESSION['Usuario']." inicio session.".PHP_EOL;
        // IMPORTANTE CONFIGURAR BIEN LA HORA EN EL SERVIDOR PHP .INI
        if(!is_dir($Carpeta))
        {   
            mkdir($Carpeta,0777);
        }       

        file_put_contents($Carpeta.$File, $Inicio.$Inicio_Hora, FILE_APPEND);
    }

    function Escribir_Reporte($Accion ="Hola mundo")
    {
        $Carpeta = "./Reporte";
        $Hora = date("[H:m:s] ");
        $File = "/".$_SESSION['Usuario'].".txt";
        file_put_contents($Carpeta.$File,$Hora.$Accion.PHP_EOL, FILE_APPEND);
    }

    function Guardar_Reporte()
    {
        $Carpeta = "./Reporte";
        $Reporte = "/".$_SESSION['Usuario'].".txt";
        $Destino = "/".date("d-m-y").".txt";
        $Termino = "#############################################".PHP_EOL;
        $Termino_Hora = date("[H:i:s] ").$_SESSION['Usuario']." Termino session.".PHP_EOL;

        file_put_contents($Carpeta.$Reporte, $Termino_Hora.$Termino, FILE_APPEND);
       
        if($Archivo = file_get_contents($Carpeta.$Reporte))
        {
            echo $Archivo;
            file_put_contents($Carpeta.$Destino,$Archivo, FILE_APPEND);
            unlink($Carpeta.$Reporte);  
        }

    }
    

    $s1 = strtotime("2016-11-30");
    $s2 = strtotime("2016-11-15");
    echo ($s1 - $s2)/(60*60*24);
    
   

?>