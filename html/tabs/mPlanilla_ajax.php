<?php
    if(file_exists('../../php/funciones.php'))
    {
        require '../../php/funciones.php';  # Obligatoriamente hay que volver a cargar las funciones, al cargar este documento con ajax. Es como si fuera un espacio diferente al index.php, por lo tanto. Todas las funciones que estan abajo no existen.
    }
        
?>
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
	