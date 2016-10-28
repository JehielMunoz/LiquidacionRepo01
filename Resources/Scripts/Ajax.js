        function TraerDatos_Gratificaciones(num){
            if (window.XMLHttpRequest) objAjax1 = new XMLHttpRequest() ;//para Mozilla
            else if (window.ActiveXObject) objAjax1 = new ActiveXObject("Microsoft.XMLHTTP");
            var rut=<?php get_session_rut(); ?>;
 			objAjax1.open("POST","./html/tabs/Gratificaciones_Ajax.php");
			objAjax1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			objAjax1.send("id_rut1="+rut+"&num1="+num);
			objAjax1.onreadystatechange = MotrarDatos_Gratificaciones;
			}
        function MotrarDatos_Gratificaciones(){
            if(objAjax1.readyState == 4){
				document.getElementById("tabs-2").innerHTML = objAjax1.responseText;
				}
        }
                function TraerDatos(num){
                    
            if (window.XMLHttpRequest) objAjax2 = new XMLHttpRequest() ;//para Mozilla
            else if (window.ActiveXObject) objAjax2 = new ActiveXObject("Microsoft.XMLHTTP");
            var rut=<?php get_session_rut(); ?>;
 			objAjax2.open("POST","./html/tabs/Descuentos_Ajax.php");
			objAjax2.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			objAjax2.send("id_rut2="+rut+"&num2="+num);		
			objAjax2.onreadystatechange = MostrarDatos;
			}
		function MostrarDatos(){
			//Chequeamos que la negociación se completó (valor 4)
			if(objAjax2.readyState == 4){
				//Actualizamos la capa div del DOM
				document.getElementById("tabs-3").innerHTML = objAjax2.responseText;
				}
			}