<!DOCTYPE html>
<html lang="es">
<head>
<title>Página de Inicio</title>
<meta charset="UTF-8">

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