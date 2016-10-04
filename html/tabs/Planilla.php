        <div id="tabs-1">					<!--Div Planilla Liquidacion-->
			<div class="divplanilla">
				<form>	
					<table>	
						<tr>
                            
							<td><form action="./index.php" method="post">
                                    <input type="text" hidden id="id_nombre" name="id_nombre">
                                    <input onchange="AsignarId(this)" type="text"  id="AutoNombre" name="AutoNombre" placeholder="Busqueda Personal">
                                    <input type="submit" formmethod="post">
                                </form>
                            </td>
							<td>
                                <input type="text" disabled name="lname" placeholder="Sueldo Base" value="<?php Sueldo_Base();?>"></td>
							<td><input type="text" disabled name="lname" placeholder="Sueldo Bruto" value="<?php Sueldo_Bruto();?>"></td>
							<td><input type="text" disabled name="lname" placeholder="Sueldo Liquido" value="<?php Sueldo_Liquido();?>"></td>
						</tr>
						<tr>
							<td>Horas De Trabajo</td>
							<td><input type="text" disabled name="HTrabajo" placeholder="Total Horas"></td>
							<td>Valor Hora</td>
							<td><input type="text" disabled name="HTrabajo" placeholder="Valor"></td>
						</tr>
						<tr>
							<td>Tipo Contrato</td>
							<td><input type="text" disabled name="Tipo_Contrato" placeholder="Tipo"></td>
							<td>N° Cargas</td>
							<td><input type="text" disabled name="nCargas" placeholder="Cargas"></td>
						</tr>
					</table>
				</form>
			</div>
			<div class ="divplanilla">
				<form>
					<table>
						<tr>
							<td>Cotizacion AFP:</td>
							<td><select name="AFP">
								  <option value="No Cotiza"  id="AFP0">No Cotiza</option>
								  <option value="Capital" 	 id="AFP1">Capital</option>
								  <option value="Cuprum" 	 id="AFP2">Cuprum</option>
								  <option value="Hábitat" 	 id="AFP3">Hábitat</option>
								  <option value="Plan Vital" id="AFP4">Plan Vital</option>
								  <option value="Próvida" 	 id="AFP5">Próvida</option>
								  <option value="Modelo" 	 id="AFP6">Modelo</option>
								  <option value="Otra AFP"   id="AFP7">Otra AFP</option>
								</select>
							</td>
							<td><input type="text" disabled name="lname"></td>
							<td><input type="text" disabled name="lname"></td>
						<tr>
							<td>Cotizacion de Salud:</td>
							<td><select name="IPS">
								  <option value="No Cotiza"   id="IPS0">No Cotiza</option>
								  <option value="Fonasa" 	  id="IPS1">Fonasa</option>
								  <option value="Banmedica"   id="IPS2">Banmedica</option>
								  <option value="Colmena" 	  id="IPS3">Colmena</option>
								  <option value="Consalud" 	  id="IPS4">Consalud</option>
								  <option value="Cruz Blanca" id="IPS5">Cruz Blanca</option>
								  <option value="Ferrosalud"  id="IPS6">Ferrosalud</option>
								  <option value="Fundacion"   id="IPS7">Fundacion</option>
								  <option value="Fusat" 	  id="IPS8">Fusat</option>
								  <option value="Masvida" 	  id="IPS9">Masvida</option>
								  <option value="Normedica"   id="IPS10">Normedica</option>
								  <option value="Sfera" 	  id="IPS11">Sfera</option>
								  <option value="Vida Tres"   id="IPS12">Vida Tres</option>
								  <option value="Otra AFP"    id="IPS13">Otra AFP</option>
								</select></td>
								<td><input type="text" disabled name="lname"></td>
								<td><input type="text" disabled name="lname"></td>
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
							<td><input type="text" disabled name="lname"></td>
							<td colspan=2></td>
						</tr>
					</table>
				</form>
			</div>
		</div>