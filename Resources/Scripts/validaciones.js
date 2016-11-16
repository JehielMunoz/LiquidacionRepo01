$(function(){
	/* NOMBRE EMPLEADO
	---------------------------------------------*/
	$("#Nombre").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^A-Z a-zÁ-Úá-úñÑ]/g,"") );}
	);
	$("#Nombre").change(
		function (){
			if($(this).val().length < 1){
				$(this).addClass("alerta");
			}else{ $(this).removeClass("alerta");}
		}
	);
	
	/* RUT
	---------------------------------------------*/
	$("#Registro_Rut").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^0-9k-]/g,"") );}
	);
	$("#Registro_Rut").change(
		function (){
			if($(this).val().length < 1){
				$(this).addClass("alerta");}
			
			if($(this).val().length < 8){
				$(this).addClass("alerta");
				$(this).focus();}
			
			if($(this).val().length > 9){
				alert("El rut no puede ser mayor a 9 dígitos");
				$(this).addClass("alerta");
				$(this).focus();}
			
			else if( ($(this).val().length == 8) || ($(this).val().length == 9) ){
				$(this).removeClass("alerta");}
		}
	);
	
	/* NÚMERO DE TELÉFONO (no estoy segura de cómo ingresan los números así que lo dejé así)
	---------------------------------------------*/
	$("#Telefono").change(
		function (){
			if($(this).val().length < 1){
				$(this).attr("placeholder", "Número de teléfono/celular obligatorio");
				$(this).addClass("alerta");}
			
			if($(this).val().length < 8){
				$(this).addClass("alerta");
				$(this).focus();}
			
			if($(this).val().length > 11){
				alert("El número de teléfono/celular no puede ser mayor a 11 dígitos");
				$(this).addClass("alerta");
				$(this).focus();}
			
			else if($(this).val().length >= 8){
				$(this).removeClass("alerta");}
		}
	);
	
	/* FECHA DE NACIMIENTO
	---------------------------------------------*/
	$("#Cumpleaños").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^0-9/-]/g,"") );}
	);
	
	/* FECHA DE CONTRATO
	---------------------------------------------*/
	$("#f_contrato").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^0-9/-]/g,"") );}
	);
	
	/* SUELDO BASE
	---------------------------------------------*/
	$("#s_Base").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^0-9]/g,"") );}
	);
	
	/* HORAS DE TRABAJO
	---------------------------------------------*/
	$("#h_Trabajo").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^0-9]/g,"") );}
	);
	
	/* VALOR HORA
	---------------------------------------------*/
	$("#v_Hora").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^0-9]/g,"") );}
	);
	
	/* NÚMERO DE CARGAS
	---------------------------------------------*/
	$("#n_Cargas").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^0-9]/g,"") );}
	);
});