<?php
    include $_SERVER["DOCUMENT_ROOT"].'/desarrollo-php/php/funciones.php';  # Obligatoriamente hay que volver a cargar las funciones, al cargar este documento con ajax. Es como si fuera un espacio diferente al index.php, por lo tanto. Todas las funciones que estan abajo no existen.
?>
			<div class="divplanilla">
				<form>	
					<table>	
						<tr>                            
							<td>                               
                                <input type="text" disable placeholder="Rut" disabled id="Ruta" name="rut" value="<?php Rut();?>">
                                <input type="text" id="Nombre" name="nombre" disabled placeholder="Nombre" disable value="<?php Nombre();?>">
                            </td>
							<td>
                                <input type="text" disabled name="lname" placeholder="Sueldo Base" value="<?php Sueldo_Base();?>"></td>
							<td><input type="text" disabled name="lname" placeholder="Sueldo Bruto" value="<?php Sueldo_Bruto();?>"></td>
							<td><input type="text" disabled name="lname" placeholder="Sueldo Liquido" value="<?php Sueldo_Liquido();?>"></td>
						</tr>
						<tr>
							<td>Horas De Trabajo</td>
							<td><input type="text" disabled name="HTrabajo" placeholder="Total Horas" value="<?php Hora();?>"></td>
							<td>Valor Hora</td>
							<td><input type="text" disabled name="HTrabajo" placeholder="Valor" value="<?php Valor_Hora()?>"></td>
						</tr>
						<tr>
							<td>Tipo Contrato</td>
							<td><input type="text" disabled name="Tipo_Contrato" placeholder="Tipo" value="<?php Tipo_Contrato();?>"></td>
							<td>N° Cargas</td>
							<td><input type="text" disabled name="nCargas" placeholder="Cargas"></td>
						</tr>
				</form>
			</div>
			<div class ="divplanilla">
				<form>
                    <table>
						<tr>
							<td>Cotizacion AFP:</td>
							<td><input type="text" disabled name="lname" placeholder="Nombre AFP" value="<?php nombre_AFP();?>"></td>
							<td><input type="text" disabled  placeholder="Tasa" name="lname" value="<?php tasa_AFP();?>"></td>
							<td><input type="text" disabled name="lname" placeholder="SIS" value="<?php sis_AFP();?>"></td>
						<tr>
							<td>Cotizacion de Salud:</td>
							
							<td><input type="text" disabled name="lname" placeholder="Nombre ISAPRE" value="<?php nombre_ISAPRE();?>"></td>
							<td><input type="text" disabled  placeholder="Valor" name="lname"  value="<?php tasa_ISAPRE();?>"></td>
							<td><input type="text" disabled name="lname" placeholder="%"></td>
						</tr>
						<tr>
							<td>Total Bonos:</td>
							<td><input type="text" disabled name="lname"></td>
							<td colspan=2></td>
						</tr>
						<tr>
							<td>Total Descuentos:</td>
							<td><input type="text" disabled name="lname"></td>
							<td colspan=2></td>
						</tr>
						<tr>
							<td>Total Asignaciones:</td>
							<td><input type="text" disabled name="lname"></td>
							<td colspan=2></td>
						</tr>
						<tr>
							<td>Total Seguros:</td>
							<td><input type="text" disabled name="lname" value="<?php echo $_SESSION['Rut'];?>"></td>
							<td colspan=2></td>
						</tr>
					</table>
				</form>
			</div>
		