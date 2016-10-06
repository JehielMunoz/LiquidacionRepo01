<body>
	<div id="top-header">
		<h1><?php global $html_titulo_barra;print_Variable($html_titulo_barra);?></h1>
		<div id="user-status">
			Nombre Usuario
		</div>
	</div>
	<div class="menudiv">
		<a href="./index.php">Agregar Nuevo</a>
		<a href="./index.php">Planilla Liquidacion</a>
		<a href="#">Horario</a>
		<a href="#">Licencias</a>
		<a href="#">AFP</a>
		<a href="#">IPS</a>
		<a href="#">Contacto</a>
		<a href="#">Servicio Tecnico</a>
	</div>
	<div id="tabs" class="barradiv">
			<ul>
				<li class="button"><a href="#tabs-1">Planilla</a></li>
				<li class="button" onclick='TraerDatos_Gratificaciones("0")'><a href="#tabs-2">Gratificaciones</a></li>
				<li class="button" onclick='TraerDatos("0")'><a href="#tabs-3">Descuentos</a></li>
				<li class="button"><a href="#tabs-4">Guardar</a></li>
				<li class="button"><a href="#tabs-5">Vista Previa</a></li>
                <!--Agregar Botones//Listas//Tabs aquí, El contenido va en contenido.php.-->
			</ul>
    