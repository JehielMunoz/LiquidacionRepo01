<?php
    session_start();
    if(empty($_SESSION['Usuario']))
    {
        echo "Para ver esta pagina Necesita estar Logeado....";    
        exit(); 
    }
    chdir("../");
    include "./php/variables.php";
    include "./php/funciones.php";
    

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title><?php global $html_titulo; print_Variable($html_titulo); ?></title> <!-- arreglar -->
        <link type="text/css" rel="stylesheet" href="../Resources/Style/estilo.css"/>
        <link type="text/css" rel="stylesheet" href="../Resources/Style/tabs_style.css"/>
        <link type="text/css" rel="stylesheet" href="../Resources/Style/tabs_style02.css"/>

        <script src="../Resources/Scripts/scripts.js"></script>
        <script src="../Resources/Scripts/tabsO.js"></script>
        <script src="../Resources/Scripts/tabs.js"></script>
        <script>
            $(function(){
                $("#tabs").tabs();
            });
            
            $(function(){
                $('#Modificar_Impuestos').click(Mostrar_y_ocultar);
                $('#Mostrar_impuestos').click(Mostrar_y_ocultar);
                $("input.t_modDatonum").bind("keyup blur",bloqueaInput);
            });
            
            function Mostrar_y_ocultar(){
                $('#div_Mostrador').toggle("slow");
                $('#div_editar').toggle("slow");
                
            }
            
            function bloqueaInput(){
                $(this).val( $(this).val().replace(/[^0-9]/,"") );}
        </script>
        <script src="../Resources/Scripts/Asignar_datos_db.js"></script>   
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
    </head>
    <body>
	<div id="top-header">
		<h1><?php global $html_titulo_barra;print_Variable($html_titulo_barra);?></h1>
		 <form action="../php/desconexion.php" method="post">
        <div >       
            <input type="submit"  id="user-status" name="Desconectar" formmethod="post" value="<?php echo $_SESSION['Usuario'];?>" > 
		</div>
        </form>
	</div>
	<div class="menudiv">
	<?php
		if(!empty($_SESSION['Tipo']))
            {   
                if($_SESSION['Tipo']!="contador") // Pregunta el tipo de usuario 
                {   
                    echo "<a href=\"../html/Agregar_empleado.php\">Agregar Nuevo Empleado</a>";     // Y muestra el contenido segun el tipo que sea.
                }
            }
    ?>
        <a href="../index.php">Planilla Liquidacion</a>
		<a href="Licencias.php">Licencias</a>
		<a href="Afp.php">AFP</a>
		<a href="Ips.php">IPS</a>
        <a href="Contacto.php">Contacto</a>
        <?php
            if(!empty($_SESSION['Tipo']))
                {   
                    if($_SESSION['Tipo']!="contador") // Pregunta el tipo de usuario 
                    {   
                        echo "<a href='impuesto_unico.php'>Impuesto unico a la renta</a>";     // Y muestra el contenido segun el tipo que sea.
                    }
                }
        ?>
	</div>
	<div id="tabs" class="barradiv">
            <ul>
                <li class="button" id="tabs-1" ><a href="#tabs-1">Licencias</a></li>
                
			</ul>
			<div id="tabs-1">
                <div id="div_Mostrador">
                    <table class="t_impuesto">
                        <th>Desde</th>
                        <th>Hasta</th>
                        <th>Factor</th>
                        <th>Desde</th>
                        <th>Hasta</th>
                        <th>Rebaja</th>
                        <th>$ Rebaja</th>
                        <?php 
                        mostrar_impuesto();
                        ?>
                    </table>

                    <input type="submit" value="Modificar" id="Modificar_Impuestos">
                </div>
                <div id="div_editar" style="display:none">
                    <form action='../php/Impuesto_updates.php' method='POST'>
						<table class="t_modImpuesto">
							<th>id</th>
							<th>Desde</th>
							<th>Hasta</th>
							<th>Factor</th>
							<th>Desde</th>
							<th>Hasta</th>
							<th>Rebaja</th>
							<th>$ Rebaja</th>
							<?php
							mostrar_impuesto_editar();
							?>
						</table>
                    <input type="submit" value="Guardar Cambios" id="Guardar"></form>
                    <br/>
                    <input type="submit" value="Volver" id="Mostrar_impuestos">
                </div>
            </div>
        </div>   
    </div>
    <?php
        include("footer.php");
    ?>