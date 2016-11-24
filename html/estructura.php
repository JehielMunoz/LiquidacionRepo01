<?php 
    if(empty($_SESSION))
    {
        session_start();
    }
?>

<body>
    <div id="top-header">
        <h1>
            <?php global $html_titulo_barra;print_Variable($html_titulo_barra); ?> - <span id="n_Empleado"> <?php if(!empty($_SESSION['Rut'])){ echo "[ ".$_SESSION['Nombre']." ]";}?> </span> 
        </h1> 

        <div>
            <form action="./php/desconexion.php" method="post">
                <input type="submit" id="user-status" name="Desconectar" formmethod="post" value="<?php echo $_SESSION['Usuario'];?>">
            </form>
        </div>

    </div>
    <div class="menudiv">
        <?php 
            if(!empty($_SESSION['Tipo']))
            {   
                if($_SESSION['Tipo']!=="supervisor") // Pregunta el tipo de usuario 
                {   
                    echo "<a href=\"./html/Agregar_empleado.php\">Agregar Nuevo Empleado</a>";     // Y muestra el contenido segun el tipo que sea.
                }
            }
        
        ?>
        <a href="./index.php">Planilla Liquidacion</a>
        <a href="./html/Licencias.php">Licencias</a>
        <a href="./html/Afp.php">AFP</a>
        <a href="./html/Ips.php">IPS</a>
        <a href="./html/Contacto.php">Contacto</a>
    <?php
        if(!empty($_SESSION['Tipo']))
            {   
                if($_SESSION['Tipo']!="contador") // Pregunta el tipo de usuario 
                {   
                    echo "<a href='./html/impuesto_unico.php'>Impuesto unico a la renta</a>";     // Y muestra el contenido segun el tipo que sea.
                }
            }
    ?>
        
    </div>
    <div id="tabs" class="barradiv">
        <ul>
            <li class="button" id="tab-1"><a href="#tabs-1">Planilla</a></li>
            <li class="button" onclick='TraerDatos_Gratificaciones("0","0")'><a href="#tabs-2">Gratificaciones</a></li>
            <li class="button" onclick='TraerDatos("0","0")'><a href="#tabs-3">Descuentos</a></li>
            <li class="button" id="tab-5"><a href="#tabs-5">Vista Previa</a></li>
            <li>
                <form id="Buscar_Persona" method="post">
                    <input type="text" id="AutoNombre" name="AutoNombre" placeholder="Buscar personal...">
                    <button type="submit" id="btn-buscar" >Buscar Persona</button>
                </form>
            </li>
            <!--Agregar Botones//Listas//Tabs aquí, El contenido va en contenido.php.-->
        </ul>
