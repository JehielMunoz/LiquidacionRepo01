<?php

	include_once "/../conexion.php";
	
	// funciones que contengan Arrays
	//*** 
	//***
	// funcion que llama a las partes de las paginas que estan en tema
	function fun_tema_llamada($archivo){
		if (file_exists('./tema/'.$archivo)) {
			include('./tema/'.$archivo);
			}
		else {
			exit(1);
			}
		
	}
	// funciones de que devuelve arrays
	function fun_html_titulo(){
		global $pag_html_titulo;
		return $pag_html_titulo;
	}
	function fun_html_titulo_barra(){
		global $pag_html_titulo_barra;
		return $pag_html_titulo_barra;
	}
	
	// llama a partes de la pagina (cabeza, cuerpo y cierre)
	
	// llama a la cabezera 
	function fun_get_header()
	{
		fun_tema_llamada("header.php");
	}
	// lama al pie de pagina
	function fun_get_footer(){
		fun_tema_llamada("footer.php");		
	}	

	// llama a una pagina cualquier este es un ejemplo
	function fun_get_consultas(){
		fun_tema_llamada("consultas.php");		
	}

?>