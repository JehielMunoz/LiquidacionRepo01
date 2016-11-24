$(document).ready(function(){
	/* NOMBRE EMPLEADO
	---------------------------------------------*/
	$("#Nombre,#Rut").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^A-Z a-zÁ-Úá-úñÑ]/,"") );}
	);
	$("#Nombre,#Rut").change(
		function (){
			if($(this).val().length < 1){
				$(this).addClass("alerta");
				return false;
			}else{ $(this).removeClass("alerta");
				return false;}
		}
	);
	
	/* RUT
	---------------------------------------------*/
	$("#Registro_Rut").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^0-9k]/,"") );}
	);
	$("#Registro_Rut").change(
		function (){
			if($(this).val().length < 1){
				$(this).addClass("alerta");
				return false;}
			
			if(($(this).val().length >= 1) && ($(this).val().length <= 7)){
				alert("El rut NO puede ser MENOR a 8 dígitos");
				$(this).addClass("alerta");
				return false;}
			
			if($(this).val().length > 9){
				alert("El rut NO puede ser MAYOR a 9 dígitos");
				$(this).addClass("alerta");
				return false;}
			
			if($(this).val().length == 8){
				$(this).val("0" + $(this).val());
				$(this).removeClass("alerta");
				return false;}
			
			if($(this).val().length == 9){
				$(this).removeClass("alerta");
				return false;}
		}
	);
	
	/* NÚMERO DE TELÉFONO
	---------------------------------------------*/
	$("#Telefono").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^0-9]/,"") );}
	);
	$("#Telefono").change(
		function (){
			if($(this).val().length < 1){
				$(this).addClass("alerta");
				return false;}
			
			if(($(this).val().length >= 1) && ($(this).val().length <= 7)){
				alert("El número de teléfono/celular NO puede ser MENOR a 8 dígitos");
				$(this).addClass("alerta");
				return false;}
			
			if($(this).val().length > 8){
				alert("El número de teléfono/celular NO puede ser MAYOR a 8 dígitos");
				$(this).addClass("alerta");
				return false;}
			
			else if($(this).val().length == 8){
				$(this).removeClass("alerta");
				return false;}
		}
	);
	
	/* FECHA DE NACIMIENTO
	---------------------------------------------*/
	$("#Cumpleaños").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^0-9/-]/,"") );}
	);
	$("#Cumpleaños").change(
		function (){
			if($(this).val().length < 1){
				$(this).addClass("alerta");
				return false;}
			
			if(($(this).val().length >= 1) && ($(this).val().length <= 7)){
				alert("La fecha de nacimiento NO puede ser MENOR a 8 caracteres");
				$(this).addClass("alerta");
				return false;}
			
			if($(this).val().length > 10){
				alert("La fecha de nacimiento NO puede ser MAYOR a 10 caracteres");
				$(this).addClass("alerta");
				return false;}
			
			else if(($(this).val().length == 8) || ($(this).val().length == 10)){
				$(this).removeClass("alerta");
				return false;}
		}
	);
	
	/* FECHA DE CONTRATO
	---------------------------------------------*/
	$("#f_contrato").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^0-9/-]/,"") );}
	);
	$("#f_contrato").change(
		function (){
			if($(this).val().length < 1){
				$(this).addClass("alerta");
				return false;}
			
			if(($(this).val().length >= 1) && ($(this).val().length <= 7)){
				alert("La fecha de contrato NO puede ser MENOR a 8 caracteres");
				$(this).addClass("alerta");
				return false;}
			
			if($(this).val().length > 10){
				alert("La fecha de contrato NO puede ser MAYOR a 10 caracteres");
				$(this).addClass("alerta");
				return false;}
			
			else if(($(this).val().length == 8) || ($(this).val().length == 10)){
				$(this).removeClass("alerta");
				return false;}
		}
	);
	
	/* SUELDO BASE
	---------------------------------------------*/
	$("#s_Base").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^0-9]/,"") );}
	);
	
	/* HORAS DE TRABAJO
	---------------------------------------------*/
	$("#h_Trabajo").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^0-9]/,"") );}
	);
	
	/* VALOR HORA
	---------------------------------------------*/
	$("#v_Hora").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^0-9]/,"") );}
	);
	
	/* NÚMERO DE CARGAS
	---------------------------------------------*/
	$("#n_Cargas").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^0-9]/,"") );}
	);
	
	/* LOGIN
	---------------------------------------------*/
	$("#Usuario").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^A-Za-zñÑ_-]/,"") );}
	);
	
	$("#Password").bind("keyup blur",
		function (){
			$(this).val( $(this).val().replace(/[^0-9A-Za-zñÑ]/,"") );}
	);
    
    
});