<?php
    
	function html_llamada($archivo){
		if (file_exists('./html/'.$archivo)) {
			include('./html/'.$archivo);
			}
		else {
			exit(1);
			}
		
	}
    function php_llamada($archivo){
		if (file_exists('./php/'.$archivo)) {
			include('./php/'.$archivo);
			}
		else {
			exit(1);
			}	
	}
	// llama a partes de la pagina (cabeza, cuerpo y cierre)
	function get_Header()
	{  
		html_llamada("header.php");
	}
    // LLama a la estructura de la pagina(todas las paginas)
    function get_Estructura() 
	{
		html_llamada("estructura.php");
	}
    // LLama a la estructura de la pagina(todas las paginas)
    function get_Contenido() 
	{
		html_llamada("contenido.php");
	}

	// lama al pie de pagina
	function get_Footer(){
		html_llamada("footer.php");		
	}	

    // include './Variables.php';
    //print_Variable($html_titulo); Aqui funciona pero no en las en html

    // datos de planilla

?>