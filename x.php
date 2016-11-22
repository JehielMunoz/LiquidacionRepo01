<?php 

    function Formato_Dinero($dinerint)
    {
    $string = $dinerint;
    $len = round(strlen($string)/3, 0, PHP_ROUND_HALF_DOWN);
    $contador = -3;
    for ($i=0; $i<($len);$i++)
    {
        $string = substr_replace($string,'.',$contador,0);
        $contador= $contador - 3 - 1;
    }                    // 3 por la separacion de los puntos. y 1 por el nuevo caracter que se agrega.
    
        if ($string[0]==".")
        {
            $string = substr($string,1);
        }
        
        $string = substr_replace($string,'$',0,0);
        
        return $string;        
    }
    

    $s1 = strtotime("2016-11-30");
    $s2 = strtotime("2016-11-15");
    echo ($s1 - $s2)/(60*60*24);
    
   

?>