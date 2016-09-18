<?php
	//include_once "/../conexion.php";
	
	// funciones que contengan Arrays
	//*** 
	//***
	// funcion que llama a las partes de las paginas que estan en tema
	function fun_html_llamada($archivo){
		if (file_exists('./html/'.$archivo)) {
			include('./html/'.$archivo);
			}
		else {
			exit(1);
			}
		
	}
    function fun_llamada($archivo){
		if (file_exists('./php/'.$archivo)) {
			include('./php/'.$archivo);
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
		fun_html_llamada("header.php");
	}
    // LLama a la estructura de la pagina(todas las paginas)
    function fun_get_Estructura() 
	{
		fun_html_llamada("estructura.php");
	}
    
    // LLama a la estructura de la pagina(todas las paginas)
    function fun_get_Contenido() 
	{
		fun_html_llamada("contenido.php");
	}

	// lama al pie de pagina
	function fun_get_footer(){
		fun_html_llamada("footer.php");		
	}	

	// llama a una pagina cualquier este es un ejemplo
	function fun_consultas(){
		fun_llamada("consultas.php");		
	}

?>