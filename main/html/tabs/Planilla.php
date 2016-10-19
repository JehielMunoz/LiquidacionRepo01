    <div id="tabs-1">					<!--Div Planilla Liquidacion-->
		<div class="divplanilla">
			<form>
				<table>
					<tr><th colspan="2">A</th></tr>
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
						<td><input type="text" class="entrega-dato" disabled name="nCargas" placeholder="Cargas"></td>
					</tr>
				</table>
				<br/>
				<table>
					<tr><th colspan="4">B</th></tr>
					<tr>
						<td>Cotización AFP</td>
						<td><input type="text" class="entrega-dato" disabled name="lname" placeholder="Nombre AFP" value="<?php nombre_AFP();?>"></td>
						<td><input type="text" class="entrega-dato" disabled  placeholder="Tasa" name="lname" value="<?php tasa_AFP();?>"></td>
						<td><input type="text" class="entrega-dato" disabled name="lname" placeholder="SIS" value="<?php sis_AFP();?>"></td>
					<tr>
						<td>Cotización de salud</td>
						<td><input type="text" class="entrega-dato" disabled name="lname" placeholder="Nombre ISAPRE" value="<?php nombre_ISAPRE();?>"></td>
						<td><input type="text" class="entrega-dato" disabled  placeholder="Valor" name="lname"  value="<?php tasa_ISAPRE();?>"></td>
						<td><input type="text" class="entrega-dato" disabled name="lname" placeholder="Porcentaje (%)"></td>
					</tr>
					<tr>
						<td>Total bonos</td>
						<td><input type="text" class="entrega-dato" disabled name="lname"></td>
					</tr>
					<tr>
						<td>Total descuentos</td>
						<td><input type="text" class="entrega-dato" disabled name="lname"></td>
					</tr>
					<tr>
						<td>Total asignaciones</td>
						<td><input type="text" class="entrega-dato" disabled name="lname"></td>
					</tr>
					<tr>
						<td>Total seguros</td>
						<td><input type="text" class="entrega-dato" disabled name="lname"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>