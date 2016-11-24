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
        <link type="text/css" rel="stylesheet" href="../Resources/Style/tabs_style.css">
        <link type="text/css" rel="stylesheet" href="../Resources/Style/tabs_style02.css">

        <script src="../Resources/Scripts/scripts.js"></script>
        <script src="../Resources/Scripts/tabsO.js"></script>
        <script src="../Resources/Scripts/tabs.js"></script>
        <script src="../Resources/Scripts/$Funciones.js"></script>
        <script src="../Resources/Scripts/validaciones.js"></script>
        <script>    
            $(function() {
                console.log( "1readysss!" ); // Lo hice para comprobar que el ajax estaba funcioando sin recargar la pagina. 
            });
            var id_nombre = <?php get_Personas();?>; 
            var id = [];
            var nombre = [];
            var nombre_low = [];
            $(function(){
                $("#tabs").tabs();
            });
            $(function() {            
                for (var x = 0; x < id_nombre.length; x++)
                {
                    id.push(id_nombre[x][0]) ;    
                    nombre.push(id_nombre[x][1]);    
                    nombre_low.push(id_nombre[x][1].toLowerCase());
                }                        
                $("#Rut").autocomplete({
                source: nombre,
                change: function(){   // Esto detecta el canbio en el campo de texto. Cuando se usa el autocompletado. Funcioa en chrome y firefox, IE NO LO HE PROBADO.
                AsignarId($(this));
                }
                });
                 $('#Rut').on('input', function(){
                 $Persona = AsignarId($(this));
                 if($Persona != null)
                 {
                     $('#Rut').val($Persona[1]);
                 }
               
             });
            });
        </script>
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
                if($_SESSION['Tipo']!=="supervisor") // Pregunta el tipo de usuario 
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
            <div style="margin-bottom:-15px;"><ul>
				<li>
				<form action="./Contacto.php" method="post">
                        <input type="text"  id="Rut" name="c_Buscar"  required placeholder="Buscar personal por Nombre...">
                        <input type="submit" id="btn" formmethod="post" value="Buscar Persona">
                    </form>
                </li>  
                <li>
                    <form action="./Contacto.php" method="post">
                       <input type="submit" value="Mostrar Todos.">
                        
                    </form>
				</li>
				</ul></div>
			<div id="tabs-1">
            <div class="divplanilla">
                <table>
					<h3 id="tCso">Contacto funcionarios</h3>
                    <th >Rut</th>
                    <th >Nombre</th>
                    <th >Telefono</th>
                    <?php Mostrar_Contacto();?>
                </table>
            </div>
    </div>
        
        </div>
    <?php
        include("footer.php");
    ?>