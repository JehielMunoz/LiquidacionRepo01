<?php 
session_start();
if(!empty($_SESSION['Usuario']))
{   
    if($_SESSION['Tipo']==="supervisor") // Pregunta el tipo de usuario 
    {   
        header('location: ../index.php');
        exit();
    }
    else
    {
        chdir("../");
        require_once "./php/variables.php";
        require_once "./php/funciones.php";        
    }
}
else
{
    header('location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
    <head> 
        <title><?php global $html_titulo; print_Variable($html_titulo); ?></title> <!-- arreglar -->
        <link type="text/css" rel="stylesheet" href="../Resources/Style/estilo.css"/>
        <link type="text/css" rel="stylesheet" href="../Resources/Style/tabs_style.css">
        <link type="text/css" rel="stylesheet" href="../Resources/Style/tabs_style02.css">
        <script src="../Resources/Scripts/tabsO.js"></script>
        <script src="../Resources/Scripts/tabs.js"></script>
		<script src="../Resources/Scripts/validaciones.js"></script>
        <style>
            .divError{
                position: absolute;
                left: 30px;
                border: 3px solid red;
            }
        </style>
        <script>
            $(function(){
                $("#tabs").tabs();
                
            });

            
            $(function(){ 
                $("#Guardar").click(function(){ 
                    Selecionado = $("input[type=checkbox]:checked").length;
                    if(Selecionado<1) 
                    {
                        alert("Debes selecionar un Cargo.");
                        return false;
                    }
                    $("#Guardar_Empleado").find('[type="submit"]').trigger('click');
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
                    <input type="submit"  id="user-status" name="Desconectar" formmethod="post" value="<?php echo $_SESSION['Usuario'];?>"> 
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
            <?php
            if(!empty($_SESSION['Tipo']))
            {   
                if($_SESSION['Tipo']!="contador") // Pregunta el tipo de usuario 
                {   
                    echo "<a href='impuesto_unico.php'>Impuesto unico a la renta</a>";     // Y muestra el contenido segun el tipo que sea.
                }
            }
            ?>
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
                <li class="button" id="tab-1"><a href="#tabs-1">Planilla</a></li>
   
                <li class="button" id="Guardar"><input type="submit" value="Guardar Empleado"></li>

                <!--Agregar Botones//Listas//Tabs aquí, El contenido va en contenido.php.-->
            </ul>
            <form id="Guardar_Empleado" method="post" action="../php/Registro.php">
                <div id="tabs-1">					
                        <?php
                            if(!empty($_SESSION["Error_Registro"]))
                            {
                                echo '<div class="divError">No se pudo agregar el empleado.</div>';
                                unset($_SESSION["Error_Registro"]);
                            }
                        ?>
                    <div class="divplanilla">
                        <table>
                            <tr>
                                <td>Nombre</td>
                                <td><input required type="text" size="61" class="entrega-dato" id="Nombre" name="r_Nombre" placeholder="Nombre empleado"></td>
                            </tr>
                            <tr>
                                <td>Rut</td>
                                <td><input type="text" required class="entrega-dato" placeholder="Ingrese rut, sin puntos ni guión." id="Registro_Rut" name="r_Rut"></td>
                            </tr>
                            <tr>
                                <td>Número de teléfono</td>
                                <td><input type="text" required class="entrega-dato" placeholder="Ingrese número de teléfono o celular." id="Telefono" name="r_Telefono"></td>
                            </tr>
                            <tr>
                                <td>Fecha de Nacimiento</td>
                                <td><input type="date" required class="entrega-dato" placeholder="Año/Mes/Dia" id="Cumpleaños" name="r_Cumpleaños"></td>
                            </tr> 
                            <tr>
                                <td>Dirección</td>
                                <td><input type="text" class="entrega-dato" placeholder="ej: Calle Falsa 123" id="Direccion" name="r_Direccion"></td>
                            </tr> 
                            <tr>
                                <td>Fecha de Contrato (?)</td>
                                <td><input type="date" class="entrega-dato" required placeholder="Año/Mes/Dia" id="f_contrato" name="r_fContrato"></td>
                            </tr>
                            <tr>
                                <td>Tipo de contrato</td>
                                <td>
                                    <input type="radio" id="indefinido" required value="1" name="Tipo_Contrato">Indefinido<br>
                                    <input type="radio" id="plazo" required value="2" name="Tipo_Contrato">A plazo fijo
                                </td> 
                            </tr>
                            <tr>
                                <td>Cargo</td>
                                <td>
                                    <?php get_Empleo_Registro();?>
                                </td>
                            </tr>
                            <tr>
                                <td>Sueldo base</td>
                                <td><input type="number" min="0" required class="entrega-dato" name="r_SueldoBase" placeholder="Sueldo base" id="s_Base"></td>
                            </tr>
                            <tr>
                                <td>Horas de trabajo</td>
                                <td><input type="number" min="0" required class="entrega-dato" name="HTrabajo" placeholder="Total horas" id="h_Trabajo"></td>
                            </tr>
                            <tr>
                                <td>Valor hora</td>
                                <td><input type="number" min="0" required class="entrega-dato" name="V_HTrabajo" placeholder="Valor" id="v_Hora"></td>
                            </tr>
                            <tr>
                                <td>N° de cargas</td>
                                <td><input type="number" min="0" max="10" required class="entrega-dato" name="nCargas" placeholder="Cargas" id="n_Cargas"></td>
                            </tr>
                        </table>
                        <br/>
                        <table>
                            <tr>
                                <td>Cotización AFP</td>
                                <td><select name="r_AFP"><?php get_AFP_Registro()?></select></td>
                            <tr>
                                <td>Cotización de Salud</td>
                                 <td><select name="r_ISAPRE"><?php get_ISAPRE_Registro()?></select></td>
                            </tr>
                        </table>

                    </div>
                </div>
                <input hidden="true" type="submit">
            </form>
        </div>
    <?php
        include("footer.php");
    ?>