        <div id="tabs-1">					<!--Div Planilla Liquidacion-->
			<div class="divplanilla">
				<form>	
					<table>	
						<tr>
							<td><input type="text" name="lname" placeholder="Busqueda Personal"></td>
							<td><input type="text" disabled name="lname" placeholder="Sueldo Base"></td>
							<td><input type="text" disabled name="lname" placeholder="Sueldo Bruto"></td>
							<td><input type="text" disabled name="lname" placeholder="Sueldo Liquido"></td>
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
		<div id="tabs-2"> 					<!--Div Gratificaciones-->
			<div class ="divplanilla">
				<form>
					<table>
						<tr>
							<td>Horas Extras</td>
							<td><input type="text" name="hExtras" placeholder="Monto"></td>
							<td><div class="bAgregar" id="bAgregar1" onmousedown="cBoton('bAgregar1')"></div></td>
							<td>Imponible</td>
							<td>
								<label class="switch">
								  <input type="checkbox" checked>
								  <span class="slider round"></span>
								</label>
							</td>							
						</tr>
						<tr>
							<td>Bono Movilizacion</td>
							<td><input type="text" name="BMovi" placeholder="Monto"></td>
							<td><div class="bAgregar" id="bAgregar2" onmousedown="cBoton('bAgregar2')"></div></td>
							<td>Imponible</td>
							<td>
								<label class="switch">
								  <input type="checkbox" checked>
								  <span class="slider round"></span>
								</label>
							</td>							
						</tr>
						<tr>
							<td>Bono Alimentacion</td>
							<td><input type="text" name="BMovi" placeholder="Monto"></td>
							<td><div class="bAgregar" id="bAgregar3" onmousedown="cBoton('bAgregar3')"></div></td>
							<td>Imponible</td>
							<td>
								<label class="switch">
								  <input type="checkbox" checked>
								  <span class="slider round"></span>
								</label>
							</td>							
						</tr>
						<tr>
							<td>Bono Ley [numeroLey]</td>
							<td><input type="text" name="BMovi" placeholder="Monto"></td>
							<td><div class="bAgregar" id="bAgregar4" onmousedown="cBoton('bAgregar4')"></div></td>
							<td>Imponible</td>
							<td>
								<label class="switch">
								  <input type="checkbox" checked>
								  <span class="slider round"></span>
								</label>
							</td>							
						</tr>
						<tr>
							<td>Bono Ley [numeroLey]</td>
							<td><input type="text" name="BMovi" placeholder="Monto"></td>
							<td><div class="bAgregar" id="bAgregar5" onmousedown="cBoton('bAgregar5')"></div></td>
							<td>Imponible</td>
							<td>
								<label class="switch">
								  <input type="checkbox" checked>
								  <span class="slider round"></span>
								</label>
							</td>							
						</tr>
						<tr>
							<td>BRP Titulo</td>
							<td><input type="text" name="BMovi" placeholder="Monto"></td>
							<td><div class="bAgregar" id="bAgregar6" onmousedown="cBoton('bAgregar6')"></div></td>
							<td>Imponible</td>
							<td>
								<label class="switch">
								  <input type="checkbox" checked>
								  <span class="slider round"></span>
								</label>
							</td>							
						</tr>
						<tr>
							<td>BRP Mencion</td>
							<td><input type="text" name="BMovi" placeholder="Monto"></td>
							<td><div class="bAgregar" id="bAgregar7" onmousedown="cBoton('bAgregar7')"></div></td>
							<td>Imponible</td>
							<td>
								<label class="switch">
								  <input type="checkbox" checked>
								  <span class="slider round"></span>
								</label>
							</td>							
						</tr>
						<tr>
							<td>Asignacion de Zona</td>
							<td><input type="text" name="BMovi" placeholder="Monto"></td>
							<td><div class="bAgregar" id="bAgregar8" onmousedown="cBoton('bAgregar8')"></div></td>
							<td>Imponible</td>
							<td>
								<label class="switch">
								  <input type="checkbox" checked>
								  <span class="slider round"></span>
								</label>
							</td>							
						</tr>
						
					</table>
					<br/>
					<div class="buttonSave" onclick="plSave()">Guardar</div><div class="buttonSave" onclick="plAdd()">Agregar Bono</div>
				</form>
			</div>
		</div>
		<div id="tabs-3"> 					<!-- Div Descuentos -->
			<div class ="divplanilla">
				<form>
					<table>
						<tr>
							<td>Mutual (Accidentes de Trabajo)</td>
							<td><input type="text" name="Mutual" placeholder="Monto"></td>
							<td><div class="bAgregar" onclick="cboton()"></div></td>							
						</tr>
						<tr>
							<td>Seguro de Invalides y Sobrevivencia</td>
							<td><input type="text" name="Mutual" placeholder="Monto"></td>
							<td><div class="bAgregar" onclick="cboton()"></div></td>
						</tr>
						<tr>
							<td>Seguro de cesantia</td>
							<td><input type="text" name="sCesantia" placeholder="Monto"></td>
							<td><div class="bAgregar" onclick="cboton()"></div></td>
						</tr>
						<tr>
							<td>Adicional Salud (Isapres)</td>
							<td><input type="text" name="asIsapre" placeholder="Monto"></td>
							<td><div class="bAgregar" onclick="cboton()"></div></td>
						</tr>
					</table>
					<br/>
					<div class="buttonSave" onclick="plSave()">Guardar</div><div class="buttonSave" onclick="plAdd()">Agregar Descuento</div>
				</form>
			</div>
		</div>
		<div id="tabs-4"><br/>
			<h1>En construccion...</h1>
		</div>
		<div id="tabs-5"><br/>				<!-- Div Vista Previa -->
			<div class ="divVistaPrevia">
				<div class="prueba">asd</div>
				<form>
				</form>
			</div>
		</div>
	</div>