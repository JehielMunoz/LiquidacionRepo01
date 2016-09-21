<!DOCTYPE html>
<html lang="es">
<head>
	<title><?php global $html_titulo; print_Variable($html_titulo); ?></title> <!-- arreglar -->
	<link type="text/css" rel="stylesheet" href="./Resources/Style/estilo.css"/>
	<link type="text/css" rel="stylesheet" href="./Resources/Style/tabs_style.css">
	<link type="text/css" rel="stylesheet" href="./Resources/Style/tabs_style02.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
    <script src="./Resources/Scripts/scripts.js"></script>
	<script src="./Resources/Scripts/tabsO.js"></script>
	<script src="./Resources/Scripts/tabs.js"></script>
	<script>
        
        $(function(){
            $("#tabs").tabs();
        });

        $(function() {
            var obj = <?php get_Personas();?> ; 
            $( "#AutoNombre" ).autocomplete({
            source: obj
            });
            });
    </script>
	</script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<!-- Hasta aquí llega el header -->
    