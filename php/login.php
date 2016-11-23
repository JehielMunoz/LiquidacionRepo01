<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Página de Inicio</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
		<!--Estilos-->
		<link type="text/css" rel="stylesheet" href="./Resources/Style/style.css"/>
		<link type="text/css" rel="stylesheet" href="./Resources/Style/supersized.css"/>
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'/>
		<!--Scripts-->
		<script src="./Resources/Scripts/jquery-1.8.2.min.js"></script>
		<script src="./Resources/Scripts/supersized.3.2.7.js"></script>
		<script src="./Resources/Scripts/supersized-init.js"></script>
		<script src="./Resources/Scripts/script.js"></script>
		<script src="./Resources/Scripts/validaciones.js"></script>
	</head>
	<body>
		<div class="page-container">
			<h1>Login</h1>
			<form action="index.php" method="post">
				<input type="text" name="Usuario" class="username" placeholder="Username" id="Usuario">
				<input type="password" name="Password" class="password" placeholder="Contraseña" id="Password">
				<button type="submit" value="Logear" name="login">Ingresar</button>
				<div class="error"><span>+</span></div>
			</form>
		</div>
	</body>
</html>