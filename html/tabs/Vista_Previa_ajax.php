<?php include '../../php/funciones.php';

?>
<table id="tabla_vista_previa">
    <tr id="fila_1"><td>
        <table id="tabla_head">
            <tr><td></td><td></td></tr>
            <tr><td></td><td></td></tr>
            <tr><td  class="letra_pequena">Sociedad Jardin infantil Mi Mundo</td><td></td></tr>
            <tr><td  class="letra_pequena">77556-430-k</td><td></td></tr>
            <tr><td  class="letra_pequena">Santa Cruz N°1064-Triguén</td><td></td></tr>
            <tr><td  class="letra_pequena">(045)2869521</td><td></td></tr>
            <tr><td  class="letra_pequena"></td><td></td></tr>
            <tr><td colspan="2" rowspan="2" id="titulo"><h1>LIQUIDACIÓN DE SUELDOS</h1></td></tr>
        </table>
            </td></tr>
            <tr id="fila_2"><td>
            <table id="tabla_head_datos" >
                <tr>
                    <td colspan="2" class="head_datos_letra_col1"> NOMBRE</td>
                    <td colspan="4" class="head_datos_letra_col2"><?php Nombre();?></td>
                    <td colspan="3" class="head_datos_horas">HORA CLASES</td>
                    <td class="head_datos_horas"><?php Hora();?></td>
                </tr>
                <tr>
                    <td colspan="2" class="head_datos_letra_col1">RUT</td>
                    <td colspan="4" class="head_datos_letra_col2"><?php Rut();?></td>
                    <td colspan="3" class="head_datos_horas">HORA REFORZAMIENTO, LEY SEP</td>
                    <td class="head_datos_horas"></td>
                </tr>
                <tr>
                    <td colspan="2" class="head_datos_letra_col1">FECHA DE INGRESO</td>
                    <td colspan="4" class="head_datos_letra_col2"></td>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td colspan="2" class="head_datos_letra_col1">TIPO DE CONTRATO</td>
                    <td colspan="4" class="head_datos_letra_col2"><?php Tipo_Contrato();?></td>
                    <td class="head_datos_letra_col3"></td>
                    <td colspan="3" rowspan="3" id="head_col4" class="head_datos_letra_col4"></td>

                </tr>
                <tr>
                    <td colspan="2" class="head_datos_letra_col1">CARGO DE DESEMPEÑO</td>
                    <td colspan="4" class="head_datos_letra_col2"></td>
                    <td class="head_datos_letra_col3"></td>
                </tr>
                <tr>
                    <td colspan="2" class="head_datos_letra_col1">CENTRO DE COSTOS</td>
                    <td colspan="4" class="head_datos_letra_col2"></td>
                    <td class="head_datos_letra_col3"></td>
                </tr>
                <tr>
                    <td colspan="2" class="head_datos_letra_col1">SUELDO BASE</td>
                    <td colspan="4" class="head_datos_letra_col2"><?php Sueldo_Base();?></td>
                    <td colspan="4"></td>
                </tr>                    
            </table>              
        </td></tr>
    <tr><td>
    <?php include "../../php/conex.php"?>
    <table  id="tabla_bonos_descuentos">
        <tr>
            <td colspan="6" ></td>
        </tr>
        <tr>
            <td colspan="3" id="Haberes">HABERES</td>
            <td colspan="3" id="Descuentos">DESCUENTOS</td>
        </tr>
        <tr>
                            <td class="Haberes_column1">30 DÍAS</td>
                            <td class="Haberes_column2">Sueldo Mensual</td>
                            <td class="Haberes_column3"> <?php Sueldo_Base();?></td>

                            <td class="Descuentos_column1"><?php tasa_AFP();?>%</td>
                            <td class="Descuentos_column2"><?php nombre_AFP();?></td>
                            <td class="Descuentos_column3"><?php Valor_AFP();?></td>
        </tr>
    <?php
    $contador = 0;  
    if(!empty($_SESSION['Rut']))   
    {
        $query1 = pg_query($dbconn, " SELECT * FROM \"tBonos\" JOIN \"rel_tEmpleados_tBonos\" ON \"tBonos\".\"id_Bono\" = \"rel_tEmpleados_tBonos\".\"id_Bono\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tBonos\".\"Rut\" = \"tEmpleados\".\"Rut\" WHERE \"tEmpleados\".\"Rut\" = '".$_SESSION['Rut']."'::bpchar;"); 
        $query2 = pg_query($dbconn, "SELECT * FROM \"rel_tEmpleados_tDescuentos\" JOIN \"tEmpleados\" ON \"rel_tEmpleados_tDescuentos\".\"Rut\" = \"tEmpleados\".\"Rut\" JOIN \"tDescuentos\" ON \"rel_tEmpleados_tDescuentos\".\"id_Descuento\" = \"tDescuentos\".\"id_Descuento\" WHERE \"tEmpleados\".\"Rut\" = '".$_SESSION['Rut']."'::bpchar;");         
        while ($contador<20){
            $row1 = pg_fetch_assoc($query1);
            echo "<tr>";
            echo "<td class='Haberes_column1'></td>";
            echo "<td class='Haberes_column2'>";
                if(!empty($row1['Bono'])){ 
                    echo  $row1['Bono'];
                }
            echo "</td>";
            echo "<td class='Haberes_column3'>";
                if(!empty($row1['Monto'])){
                    echo Formato_Dinero($row1['Monto']); 
                }
            echo "</td>";
            echo "<td class='Descuentos_column1'>";
            if($contador==0){
                echo tasa_ISAPRE()."%";
            }
            echo "</td>";
            echo "<td class='Descuentos_column2'>";
            if($contador==0){
                echo nombre_ISAPRE();
            }
            if($contador==1){
                echo "Seguro Cesantia";
            }
            if($contador>=2){
                $row2 = pg_fetch_assoc($query2);
                if(!empty($row2['Descuento'])){
                    if($row2['Descuento']=="Seguro cesantia               "){
                        $row2 = pg_fetch_assoc($query2);
                        echo $row2['Descuento'];}
                }
            }
            echo "</td>";
            echo "<td class='Descuentos_column3'>";
            if($contador==0){
                echo Valor_Isapre();
            }
            if($contador==1){
                echo Valor_seguro_cesantia();
            }
            if($contador>=2 && $row2['Descuento']!="Seguro cesantia               "){
                if(!empty($row2["Monto"])){
                    echo Formato_Dinero($row2["Monto"]);
                    }
            }
            echo "</td>";
            echo "</tr>";
            $contador+=1;
        }
    }
    while($contador<20){
            echo "<tr>";
            echo "<td class='Haberes_column1'></td>";
            echo "<td class='Haberes_column2'></td>";
            echo "<td class='Haberes_column3'></td>";
            echo "<td class='Descuentos_column1'></td>";
            echo "<td class='Descuentos_column2'></td>";
            echo "<td class='Descuentos_column3'></td>";
            echo "</tr>";
            $contador+=1;             
    }
                        
    ?>


                        <tr>
                            <td colspan="2" id="total_haberes" class="negrita">TOTAL HABERES</td>
                            <td class="total_valores"><?php Sueldo_Bruto();?></td>
                            <td colspan="2" id="total_descuento" class="negrita">TOTAL DESCUENTOS</td>
                            <td class="total_valores"><?php Total_Descuentos();?></td>
                        </tr>




                    </table>
                </td></tr>
                <tr><td>
                    <table id="tabla_resultados" >


                        <tr>
                            <td colspan="6"></td>
                        </tr>


                        <tr>
                            <td class="resultados2_column1" colspan="3" >TOTAL IMPONIBLE</td>
                            <td class="total_valores"><?php Total_Imponible();?></td>
                            <td class="resultados2_column4" colspan="3">TOTAL HABERES</td>
                            <td class="total_valores"><?php Sueldo_Bruto();?></td>

                        </tr>
                        <tr>
                            <td class="resultados1_column1" colspan="3">TOTAL TRIBUTABLE</td>
                            <td class="total_valores"><?php Total_Tributable();?></td>
                            <td class="resultados2_column4" colspan="3">DESCUENTOS LEGALES</td>
                            <td class="resultados2_column5"><?php descuentos_legales()?></td>

                        </tr>


                        <tr>
                            <td class="resultados2_column1">MUTUAL</td>
                            <td  class="resultados2_column2" colspan="2">CESANTIA</td>
                            <td class="resultados2_column3">SIS</td>

                            <td colspan="3" class="resultados2_column4">DESCUENTOS VARIOS</td>
                            <td class="resultados2_column5"> $</td>
                        </tr>
                        <tr>
                            <td class="resultados3_column"> $</td>
                            <td  class="resultados3_column" colspan="2"> $</td>
                            <td class="resultados3_column"> $</td>

                            <td colspan="3" class="resultados2_column4">SUB TOTAL</td>
                            <td class="resultados2_column5"> $</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td  class="resultados2_column2" colspan="2">LIQUIDO ALCANZADO</td>
                            <td class="resultados3_column"> $</td>

                            <td colspan="3" class="resultados2_column4">ASIGNACIÓN FAMILIAR</td>
                            <td class="resultados2_column5"> $</td>
                        </tr>
                        <tr>
                            <td ></td>
                            <td colspan="2"></td>
                            <td></td>

                            <td colspan="3" class="resultados2_column4">LIQUIDO A PAGAR</td>
                            <td class="resultados2_column5"> $</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2"></td>
                            <td></td>

                            <td colspan="3" class="resultados2_column4">SOBREGIRO</td>
                            <td class="total_valores"> $</td>
                        </tr>
                        <tr>
                            <td colspan="8"></td>
                        </tr>
                        <tr>
                            <td colspan="2" id="final1_tabla_resultados">SON:</td>
                            <td colspan="6" id="final2_tabla_resultados"></td>
                        </tr>
                    </table>    
                </td></tr>
                <tr><td>
                    <table id="tabla_footer">
                        <tr>
                            <td colspan="6" id="tabla_footer_acuerdo"><br/><p>
                                <div>Certifico he recibido de mi empleador a mi entera satisfacción la </div>
                                <div>Suma indicada y declaro tener pleno conocimiento de los descuentos reflejados en este documento,</div>
                                <div>los cuales han sido autorizados por ley y/o mutuo acuerdo y no tengo cargo ni cobro alguno posterior que</div>
                                <div>hacer, por ninguno de los conectos comprendidos en esta liquidación.</div>                            
                                </p><br/><br/><br></td>
                        </tr>
                        <tr>
                            <td class="espacios_blanco1"></td>
                            <td id="firma_contador">
                                <div class="negrita">REVISADO POR</div>
                                <div >Paola Lucía Naguil Sánchez</div>
                                <div>11.657.401-2</div>                        
                            </td>
                            <td class="espacios_blanco"></td>
                            <td class="espacios_blanco"></td>

                            <td id="firma_empleado" class="negrita">
                                <div>RECIBI CONFORME</div>
                                <br />
                                <br />
                            </td>
                            <td class="espacios_blanco2"></td>
                        </tr>
                        <tr>
                            <td coldspan="6"><br/><br/><br/></td>
                        </tr>
                    </table>    
                </td></tr>
            </table>
<input type="submit" value="imprimir" onclick="Imprimir_tabla()" />