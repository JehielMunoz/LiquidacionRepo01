<?php
    if(file_exists('../../php/funciones.php'))
    {
        require '../../php/funciones.php';  # Obligatoriamente hay que volver a cargar las funciones, al cargar este documento con ajax. Es como si fuera un espacio diferente al index.php, por lo tanto. Todas las funciones que estan abajo no existen.
    }
        
?>
    <div id="tabs-1">					<!--Div Planilla Liquidacion-->
		<div id = "Planilla" class="divplanilla">
			<form>
				<table>
					<tr><th colspan="2">Datos empleado</th></tr>
					<tr>
						<td>Nombre</td>
						<td style="text-align:left;"><input type="text" size="61" class="entrega-dato" id="Nombre" name="nombre" disabled placeholder="Nombre empleado" disable value="<?php Nombre();?>"></td>
					</tr>
					<tr>
						<td>Rut</td>
						<td><input type="text" class="entrega-dato" disable placeholder="Rut" disabled id="Ruta" name="rut" value="<?php Rut();?>"></td>
					</tr>
					<tr>
						<td>Sueldo base</td>
						<td><input type="text" class="entrega-dato" disabled name="lname" placeholder="Sueldo base" value="<?php Sueldo_Base();?>"></td>
					</tr>
					<tr>
						<td>Sueldo bruto</td>
						<td><input type="text" class="entrega-dato" disabled name="lname" placeholder="Sueldo bruto" value="<?php Sueldo_Bruto();?>"></td>
					</tr>
					<tr>
						<td>Sueldo líquido</td>
						<td><input type="text" class="entrega-dato" disabled name="lname" placeholder="Sueldo líquido" value="<?php Sueldo_Liquido();?>"></td>
					</tr>
					<tr>
						<td>Horas de trabajo</td>
						<td><input type="text" class="entrega-dato" disabled name="HTrabajo" placeholder="Total horas" value="<?php Hora();?>"></td>
					</tr>
					<tr>
						<td>Valor hora</td>
						<td><input type="text" class="entrega-dato" disabled name="HTrabajo" placeholder="Valor" value="<?php Valor_Hora()?>"></td>
					</tr>
					<tr>
						<td>Tipo de contrato</td>
						<td><input type="text" class="entrega-dato" disabled name="Tipo_Contrato" placeholder="Tipo" value="<?php Tipo_Contrato();?>"></td>
					</tr>
					<tr>
						<td>N° de cargas</td>
						<td><input type="text" class="entrega-dato" disabled name="nCargas" placeholder="Cargas" value="<?php nCargas();?>"></td>
					</tr>
				</table>
				<br/>
                    <table>
						<tr>
							<td>Cotizacion AFP:</td>
							<td><input type="text" class="entrega-dato" disabled name="lname" placeholder="Nombre AFP" value="<?php nombre_AFP();?>"></td>
                            <td><input type="text" class="entrega-dato" disabled name="lname" placeholder="SIS" value="<?php Valor_AFP();?>"></td>
							<td><input type="text" class="entrega-dato" disabled  placeholder="Tasa" name="lname" value="<?php tasa_AFP();?>"></td>
							
						<tr>
							<td>Cotizacion de Salud:</td>
							
							<td><input type="text" class="entrega-dato" disabled name="lname" placeholder="Nombre ISAPRE" value="<?php nombre_ISAPRE();?>"></td>
							<td><input type="text" class="entrega-dato" disabled  placeholder="Valor" name="lname"  value="<?php Valor_Isapre();?>"></td>
							<td><input type="text" class="entrega-dato" disabled name="lname" placeholder="%" value="<?php tasa_ISAPRE();?>"></td>
						</tr>
						<tr>
							<td>Total Bonos:</td>
							<td><input type="text" class="entrega-dato" disabled name="lname" value="<?php Total_Bonos();?>"></td>
							<td colspan=2></td>
						</tr>
						<tr>
							<td>Total Descuentos:</td>
							<td><input type="text" class="entrega-dato" disabled name="lname" value="<?php Total_Descuentos();?>"></td>
							<td colspan=2></td>
						</tr>
						<tr>
							<td>Total Asignaciones:</td>
							<td><input type="text" class="entrega-dato" disabled name="lname" value="<?php Total_Asignacion();?>"></td>
							<td colspan=2></td>
						</tr>
						<tr>
							<td>Total Seguros:</td>
							<td><input type="text" class="entrega-dato" disabled name="lname" value="<?php Valor_seguro_cesantia();?>"></td>
							<td colspan=2></td>
						</tr>
					</table>
			</form>
		</div>
			<button class="boton_toggle" id="ModificarPlanilla">Modificar Planilla</button>
		<div id="m_Planilla" style="display:none">
		<h1>Modificar informacion empleado </h1>
		<form action="./php/Modificar_datos.php" method="post">
				<table>
					<tr><th colspan="2">Datos empleado</th></tr>
					<tr>
						<td>Nombre</td>
						<td style="text-align:left;"><input type="text" size="61" class="entrega-dato" id="Nombre" name="mNombre"  placeholder="Nombre empleado" value="<?php Nombre();?>"></td>
					</tr>
					<tr>
						<td>Rut</td>
						<td><input type="text" class="entrega-dato" placeholder="Rut" disabled id="Ruta" name="mRut" value="<?php mRut();?>"></td>
						<input type="text" class="entrega-dato" placeholder="Rut" hidden id="Ruta" name="mRut" value="<?php mRut();?>">
					</tr>
					<tr>
						<td>Sueldo base</td>
						<td><input type="text" class="entrega-dato" name="mSueldo" placeholder="Sueldo base" value="<?php mSueldo_Base();?>"></td>
					</tr>
					<tr>
						<td>Horas de trabajo</td>
						<td><input type="text" class="entrega-dato" name="mHTrabajo" placeholder="Total horas" value="<?php Hora();?>"></td>
					</tr>
					<tr>
						<td>Valor hora</td>
						<td><input type="text" class="entrega-dato" name="mValorHora" placeholder="Valor" value="<?php mValor_Hora()?>"></td>
					</tr>
					<tr>
						<td>Tipo de contrato</td>
						<td> 
							<select name = "mContrato">
								<?php get_Contrato_Modificador(); ?>
							</select>
						</td>
					</tr>
					<!--<tr>
						<td>N° de cargas</td>
						<td><input type="text" class="entrega-dato" name="nCargas" placeholder="Cargas" value="></td>
					</tr>    QUE NO SE UTILIZA  -->  
						<tr>
							<td>Cotizacion AFP:</td>
							<td>
							<select name="mAFP">
								<?php get_AFP_Modificador();?> 							
							</select> 
							</td>
						<tr>
							<td>Cotizacion de Salud:</td>
							
							<td>
							<select name="mIPS">
								<?php get_IPS_Modificador();?> 							
							</select> 
							</td>
						</tr>
						
						</table>
		<button type="submit" id="ModificarPlanilla">Modificar Planilla</button>
			</form>
		</div>
		<button style="display:none" class="boton_toggle" id="VolverPlanilla">Volver</button>
		
	</div>