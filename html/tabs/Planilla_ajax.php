<?php
    if(file_exists('../../php/funciones.php'))
    {
        require '../../php/funciones.php';  # Obligatoriamente hay que volver a cargar las funciones, al cargar este documento con ajax. Es como si fuera un espacio diferente al index.php, por lo tanto. Todas las funciones que estan abajo no existen.
    }
        
?>
    
			<form>
				<table>
					<tr><th colspan="2">Datos empleado</th></tr>
					<tr>
						<td>Nombre</td>
						<td style="text-align:left;"><input type="text" size="61" class="entrega-dato" id="Nombre" name="nombre" disabled placeholder="Nombre empleado" disable value="<?php Nombre();?>"></td>
					</tr>
					<tr>
						<td>Rut</td>
						<td><input type="text" class="entrega-dato"  disable placeholder="Rut" disabled id="Ruta" name="rut" value="<?php Rut();?>"></td>
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
		
		