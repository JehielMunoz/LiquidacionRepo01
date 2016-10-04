<?php

// VARIABLES

// titulo de la pagina
$html_titulo = "Liquidaciones de sueldo.";
// titulo de la barra ejemplo
$html_titulo_barra = "Lugar X";
// descripcion de la pagina
$html_descripcion = "";

// FUNCION DE VARIABLES 
function get_Variable($var)
    {
        global $html_titulo;
        return $var;
    }

function print_Variable($var)
    {
        get_Variable($var);
        echo $var;   
        // ME QUIERO MATAR. ES MÁS COMPLICADO DE LO QUE DEBERIA., Me rindo por ahora.
    }
  


/*
function get_html_titulo(){
    global $html_titulo;
	return $html_titulo;
	}
function fun_html_titulo_barra(){
    global $pag_html_titulo_barra;
	return $pag_html_titulo_barra;
	}
*/

// otras variables de la pagina faltan agregar a medida que la vamos creando



?>