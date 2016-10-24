<!DOCTYPE html>
<html lang="es">
<head>
	<title><?php global $html_titulo; print_Variable($html_titulo); ?></title> <!-- arreglar -->
	<link type="text/css" rel="stylesheet" href="./Resources/Style/estilo.css"/>
	<link type="text/css" rel="stylesheet" href="./Resources/Style/tabs_style.css">
	<link type="text/css" rel="stylesheet" href="./Resources/Style/tabs_style02.css">
    
    <script src="./Resources/Scripts/scripts.js"></script>
	<script src="./Resources/Scripts/tabsO.js"></script>
	<script src="./Resources/Scripts/tabs.js"></script>
	<script>
        $(function() {
            console.log( "1readysss!" ); // Lo hice para comprobar que el ajax estaba funcioando sin recargar la pagina. 
        });
        var id_nombre = <?php get_Personas();?>; 
        var id = [];
        var nombre = [];   
        $(function(){
            $("#tabs").tabs();
        });
        $(function() {            
            for (var x = 0; x < id_nombre.length; x++)
            {
                id.push(id_nombre[x][0]) ;    
                nombre.push(id_nombre[x][1]) ;    
            }                        
            $( "#AutoNombre" ).autocomplete({
            source: nombre,
            change: function(){   // Esto detecta el canbio en el campo de texto. Cuando se usa el autocompletado. Funcioa en chrome y firefox, IE NO LO HE PROBADO.
                AsignarId($(this));
            }
            });
        });
        $(function(){ 
           $("#btn-buscar,#tab-1").click(function(){ // Esto maneja el ajax. Cuando hago click en el boton para buscar. Hace una consulta por post y remplaza la planilla con la respuesta del pust.
               var url = "./html/tabs/Planilla_ajax.php";
               $.ajax({
                   type:"POST",
                   url:url,
                   data: {Rut: $("#Rut").val(),AutoNombre:$("#AutoNombre").val()}, // Datos del post. Los cuales recupera del campo rut y nombre.
                   success: function (data) { // Si la consulta tiene exito.
                    $("#tabs-1").html(data); // Remplzasa el contedio del div tabs-1
                    $("#tabs").tabs("option", "active", 0);
                    }
            
               });
            return false; // Igual  que al validar formularios, devuelve falso para que se ejecute el enviar del form.
           });
        });
    </script>
	<script>
        function TraerDatos_Gratificaciones(num,num2){
            if (window.XMLHttpRequest) objAjax1 = new XMLHttpRequest() ;//para Mozilla
            else if (window.ActiveXObject) objAjax1 = new ActiveXObject("Microsoft.XMLHTTP");
 			var rut = document.getElementById('Ruta').value; 
            var rut1 = rut.replace(".","");
            var rut2 = rut1.replace(".","");
            var rut3 = rut2.replace("-","");
            // Tuve que hacer unos cambios para que funcionara. lo voy a explicar en la descripción del comit.
            objAjax1.open("POST","./html/tabs/Gratificaciones_Ajax.php");
			objAjax1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            if(num2=='0'){
                objAjax1.send("id_rut1="+rut3+"&num1="+num+"&num2="+num2);		
            }
            if(num2=='1'){
                var monto=document.getElementById("bono"+num).value;
                objAjax1.send("id_rut1="+rut3+"&num1="+num+"&num2="+num2+"&monto="+monto);
            }
            if(num2=='2'){
                objAjax1.send("id_rut1="+rut3+"&num1="+num+"&num2="+num2);		
            }
            if(num2=='3'){
                var nombre = document.getElementById('Nombre_nueva_gratificacion').value;
                var tipo = document.getElementById('Tipo_nueva_gratificacion').value;
                objAjax1.send("id_rut1="+rut3+"&num1="+num+"&num2="+num2+"&nombre="+nombre+"&tipo="+tipo);
            }
			objAjax1.onreadystatechange = MotrarDatos_Gratificaciones;
			}
        function MotrarDatos_Gratificaciones(){
            if(objAjax1.readyState == 4){
				document.getElementById("tabs-2").innerHTML = objAjax1.responseText;
				}
        }
        function TraerDatos(num,num2){     
            if (window.XMLHttpRequest) objAjax2 = new XMLHttpRequest() ;//para Mozilla
            else if (window.ActiveXObject) objAjax2 = new ActiveXObject("Microsoft.XMLHTTP");
            var rut = document.getElementById('Ruta').value;
            var rut1 = rut.replace(".","");
            var rut2 = rut1.replace(".","");
            var rut3 = rut2.replace("-","");
 			objAjax2.open("POST","./html/tabs/Descuentos_Ajax.php");
			objAjax2.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
            if(num2=='0'){
                objAjax2.send("id_rut2="+rut3+"&num2="+num+"&num3="+num2);		
            }
            if(num2=='1'){
                var monto=document.getElementById("descuento"+num).value;
                objAjax2.send("id_rut2="+rut3+"&num2="+num+"&num3="+num2+"&monto="+monto);
            }
            if(num2=='2'){
                objAjax2.send("id_rut2="+rut3+"&num2="+num+"&num3="+num2);
            }
            if(num2=='3'){
                var nombre = document.getElementById('Nombre_nuevo_descuento').value;
                var tipo = document.getElementById('Tipo_nuevo_descuento').value;
                objAjax2.send("id_rut2="+rut3+"&num2="+num+"&num3="+num2+"&nombre="+nombre+"&tipo="+tipo);
            }
			objAjax2.onreadystatechange = MostrarDatos;
			}
		function MostrarDatos(){
			//Chequeamos que la negociación se completó (valor 4)
			if(objAjax2.readyState == 4){
				//Actualizamos la capa div del DOM
				document.getElementById("tabs-3").innerHTML = objAjax2.responseText;
				}
			}
	</script>   
	<script src="./Resources/Scripts/Asignar_datos_db.js"></script>   
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<!-- Hasta aquí llega el header -->
    