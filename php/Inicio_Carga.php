<?php
	get_Header(); // Primera en ser llamada
    get_Estructura(); // Carga la estructura (Barra lateral, barra superior, usuario, numero de pestañas )
    get_Contenido(); // Carga el  contenido de las pestañas.
    get_Footer(); // Ultima en ser llamada
?>