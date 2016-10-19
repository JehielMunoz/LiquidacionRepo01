<body>
	<div id="top-header">
		<h1><?php global $html_titulo_barra;print_Variable($html_titulo_barra);?></h1>
		 <form action="./index.php" method="post">
        <div >       
            <input type="submit" onclick='Desconectar()' id="user-status" name="Desconectar" formmethod="post" value="Nombre Usuario" > 
		</div>
        </form>
	</div>
	<div class="menudiv">
		<a href="./index.php">Agregar Nuevo</a>
		<a href="./index.php">Planilla Liquidación</a>
		<a href="#">Horario</a>
		<a href="#">Licencias</a>
		<a href="#">AFP</a>
		<a href="#">IPS</a>
		<a href="#">Contacto</a>
		<a href="#">Servicio Técnico</a>
	</div>
	<div id="tabs" class="barradiv">
			<ul>
				<li class="button" id="tab-1" ><a href="#tabs-1">Planilla</a></li>
				<li class="button" onclick='TraerDatos_Gratificaciones("0")'><a href="#tabs-2">Gratificaciones</a></li>
				<li class="button" onclick='TraerDatos("0")'><a href="#tabs-3">Descuentos</a></li>
				<li class="button"><a href="#tabs-4">Guardar</a></li>
				<li class="button"><a href="#tabs-5">Vista Previa</a></li>
                <li><form action="#" method="post">
                        <input type="text" hidden id="Rut" name="Rut">
                        <input type="text"  id="AutoNombre" name="AutoNombre" placeholder="Buscar personal...">
                        <input type="submit" id="btn-buscar" formmethod="post" value="Buscar">
                    </form>
                </li>  
                <!--Agregar Botones//Listas//Tabs aquí, El contenido va en contenido.php.-->
			</ul>
    