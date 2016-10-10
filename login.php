<!DOCTYPE html>
<html lang="es">
<head>
<title>Página de Inicio</title>
<meta charset="UTF-8">
<style type="text/CSS">
body{
	font-family:Arial;
	padding:0;
	margin:0;}

a{ color:#0c7abf; text-decoration:none; transition:all 0.3s ease;}
a:hover{ color:#ff6935;}

h3{
	text-align:center;
	margin:4px auto 22px;}

table{ margin:0 auto;}
td{ padding:4px 6px;}

input[type="text"],
input[type="password"]{ width:200px;}

input[type="text"]:focus,
input[type="password"]:focus{
	border:1px solid blue;
	box-shadow:0 0 2px 1px #0c7abf;}

#fondo{
	top:-30px;
	left:-30px;
	position:fixed;
	width:110%;
	height:110%;
	filter:blur(5px);
	z-index:-1;}	

#cuadro-login{
	top:36%;
	left:50%;
	position:absolute;
	color:#fff;
	padding:32px 25px;
	margin-left:-187.5px;
	border-radius:6px;
	background:rgba(128,128,128,0.65);}
	
#index-contacto{
	position:fixed;
	left:0;
	bottom:0;
	padding:8px 15px;
	background-color: #464a4d;
	width:100%;
	color:#ccc;
	z-index:99;}

#logo{
	top:1%;
	left:2%;
	position:absolute;
	width:200px;}
</style>
</head>

<body>
	<img id="fondo" src="./Resources/Imagenes/fondo.jpg"/>
	<img id="logo" src="./Resources/Imagenes/logo.png"/>
	<div id="cuadro-login">
		<h3>Inicie sesión</h3>
        <form method="post" action="index.php">
            <table>
            <tr>
                <td>Usuario</td>
                <td><input type="text" id="Usuario" name="Usuario"></td>
            </tr>
            <tr>
                <td>Contraseña</td>
                <td><input type="password" id="Password" name="Password"></td>
            </tr>
            <tr>
                <td>              
                    <input type="submit" value="Logear" name="login">
                </td>
            </tr>    
            </table>
        </form>
	</div>

	<div id="index-contacto">
		Contacto: <a href="#">e-mail</a>
	</div>
</body>
</html>