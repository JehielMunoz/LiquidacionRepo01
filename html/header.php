<!DOCTYPE html>
<html lang="es">
<head>
	<title><?php global $html_titulo; print_Variable($html_titulo); ?></title> <!-- arreglar -->
	<link type="text/css" rel="stylesheet" href="./Resources/Style/estilo.css"/>
	<link type="text/css" rel="stylesheet" href="./Resources/Style/tabs_style.css">
	<link type="text/css" rel="stylesheet" href="./Resources/Style/tabs_style02.css">
    <link type="text/css" rel="stylesheet" href="./Resources/Style/estilo_tabla.css">
    <link type="text/css" rel="stylesheet" href="./Resources/Style/imprimir.css">
    <meta charset='utf-8'>
    <script src="./Resources/Scripts/scripts.js"></script>
	<script src="./Resources/Scripts/tabsO.js"></script>
	<script src="./Resources/Scripts/tabs.js"></script>
    <script src="./Resources/Scripts/$Funciones.js"></script>   

	<script>
            function Imprimir_tabla(){
            var cabezera="<!DOCTYPE html><html lang='es'><head><link type='text/css' rel='stylesheet' href='./Resources/Style/estilo_tabla.css'></head><body>"
            var objeto=document.getElementById("tabla_vista_previa");  //obtenemos el objeto a imprimir
            var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
            var footer="</body></html>"
            ventana.document.write(cabezera.innerHTML);   
            ventana.document.write(objeto.innerHTML);
            ventana.document.write(footer.innerHTML);//imprimimos el HTML del objeto en la nueva ventana
            ventana.document.close();  //cerramos el documento
            ventana.print();  //imprimimos la ventana
            ventana.close();  //cerramos la ventana
            }
        $(function() {
            console.log( "1readysss!" ); // Lo hice para comprobar que el ajax estaba funcioando sin recargar la pagina. 
        });
        var $Persona = null; // Variable que guarda el rut y el nombre
        var id_nombre = <?php get_Personas();?>; 
        var id = [];
        var nombre = [];
        var nombre_low = [];   
        $(function(){
            $("#tabs").tabs();
        });
        $(function() {            
            for (var x = 0; x < id_nombre.length; x++)
            {
                id.push(id_nombre[x][0]) ;    
                nombre.push(id_nombre[x][1]) ;
                nombre_low.push(id_nombre[x][1].toLowerCase()) ;

            }                        
            $("#AutoNombre").autocomplete({
            source: nombre,
            change: function(){   // Esto detecta el canbio en el campo de texto. Cuando se usa el autocompletado. Funcioa en chrome y firefox, IE NO LO HE PROBADO.
                $Persona = AsignarId($(this));
            }
            });
            $('#AutoNombre').on('input', function(){
                $Persona = AsignarId($(this));
            });

        });

         
         $(function(){
                $('#ModificarPlanilla').click(Mostrar_y_ocultar);
                $('#VolverPlanilla').click(Mostrar_y_ocultar);
                
            });
            
            function Mostrar_y_ocultar(){
                $('#Planilla').toggle("slow");
                $('#m_Planilla').toggle("slow");
                $('#ModificarPlanilla').toggle("slow");
                $('#VolverPlanilla').toggle("slow");
            }
        
            function bloqueaInput(){
                $(this).val( $(this).val().replace(/[^0-9]/,"") );}
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
                if(monto!=0){ objAjax1.send("id_rut1="+rut3+"&num1="+num+"&num2="+num2+"&monto="+monto);}
            }
            if(num2=='2'){
                objAjax1.send("id_rut1="+rut3+"&num1="+num+"&num2="+num2);		
            }
            if(num2=='3'){
                var nombre = document.getElementById('Nombre_nueva_gratificacion').value;
                var tipo = document.getElementById('Tipo_nueva_gratificacion').value;
            if(nombre!=""){ objAjax1.send("id_rut1="+rut3+"&num1="+num+"&num2="+num2+"&nombre="+nombre+"&tipo="+tipo);}
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
            
            if(num2=='7'){
                var monto = document.getElementById('Monto_Credito').value;
                var id_prestamo = num;
                objAjax2.send("id_rut2="+rut3+"&num2="+num+"&num3="+num2+"&id_prestamo="+id_prestamo+"&monto="+monto);
            }

            if(num2=='6'){
                var monto = document.getElementById('Monto_Descuento').value;
                var id_descuento = num;
                objAjax2.send("id_rut2="+rut3+"&num2="+num+"&num3="+num2+"&id_descuento="+id_descuento+"&monto="+monto);
            }
            
            if(num2=='4'){
                var nombre = document.getElementById('Nombre_nuevo_credito').value;
                var monto = document.getElementById('Monto_nuevo_credito').value;
                var inicio = document.getElementById('Inicio_nuevo_credito').value;
                var final = document.getElementById('Termino_nuevo_credito').value;
                objAjax2.send("id_rut2="+rut3+"&num2="+num+"&num3="+num2+"&Nombre="+nombre+"&Monto="+monto+"&Inicio="+inicio+"&Final="+final);
            }
            if(num2=='0'){
                objAjax2.send("id_rut2="+rut3+"&num2="+num+"&num3="+num2);		
            }
            if(num2=='1'){
                var monto=document.getElementById("descuento"+num).value;
                if(monto!=0){ objAjax2.send("id_rut2="+rut3+"&num2="+num+"&num3="+num2+"&monto="+monto);}
            }
            if(num2=='2'){
                objAjax2.send("id_rut2="+rut3+"&num2="+num+"&num3="+num2);
            }
            if(num2=='3'){
                var nombre = document.getElementById('Nombre_nuevo_descuento').value;
                var tipo = document.getElementById('Tipo_nuevo_descuento').value;
               if(nombre!=""){ objAjax2.send("id_rut2="+rut3+"&num2="+num+"&num3="+num2+"&nombre="+nombre+"&tipo="+tipo);}
            }
			if(num2=='5'){ 
                var dias = document.getElementById('dias').value; 
                var descuenta = document.getElementById('descuenta').value; 
                var inicio = document.getElementById('Inicio_Licencia').value; 
                var final = document.getElementById('Termino_Licencia').value; 
                objAjax2.send("id_rut2="+rut3+"&num2="+num+"&num3="+num2+"&Dias="+dias+"&Descuenta="+descuenta+"&Inicio_l="+inicio+"&Final_l="+final); 
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
</head>
<!-- Hasta aquí llega el header -->
    