var ctrl = true;

function cBoton(Id){
	if(ctrl==true){
		ctrl=false;
		document.getElementById(Id).style.backgroundColor = "#2196F3";}
	else{
		ctrl=true;
		document.getElementById(Id).style.backgroundColor = "transparent";}
	}
function dBoton(){
	document.getElementByClassName("bAgregar").style.backgroundColor = "transparent";}
function plSave(){
	alert("Guardado");
}

function plAdd(){
	alert("Funcion en construccion");
}