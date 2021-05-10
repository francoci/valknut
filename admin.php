<?php  
	include('php/dbcon.php');
	include('php/functions.php');
	session_start();
	verificarSesionAdmin();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximumscale=1.0; user-scalable=0;"/>
	
	<meta name="msapplication-TileColor" content="#00aba9">
	<meta name="msapplication-config" content="/img/icons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">

	<title>Valknut Travels</title>
	
	<link href="https://fonts.googleapis.com/css?family=Bree+Serif|Courgette" rel="stylesheet">

	<link rel="apple-touch-icon" sizes="180x180" href="img/icons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/icons/favicon-16x16.png">
	<link rel="manifest" href="img/icons/site.webmanifest">
	<link rel="mask-icon" href="img/icons/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="img/icons/favicon.ico">

	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/stylesLogin.css">

</head>
<body>
	<div class = "contenedor">
		<form action="php/procLoginAdmin.php" method="POST">
			<div class = "titulo">
				<h3>Admin</h3>
			</div>

			<div class = 'contenedorMensaje'>
				<?php 

					if(isset($_GET['result']) && $_GET['result'] == 1)
					{
						echo "<h4>Usuario o contraseña incorrectos.</h4>";
					}
					elseif (isset($_GET['result']) && $_GET['result'] == 2) 
					{
						echo "<h4 style = 'font-size: 0.9em;'>Hubo un error, inténtelo nuevamente más tarde.</h4>";
					}
					elseif (isset($_GET['result']) && $_GET['result'] == 3) 
					{
						echo "<h4 style = 'font-size: 0.9em;'>Tu cuenta no tiene permisos de administrador.</h4>";
					}
					elseif (isset($_GET['result']) && $_GET['result'] == 4) 
					{
						echo "<h4>Ingrese un usuario y contraseña.</h4>";
					}
					elseif (isset($_GET['result']) && $_GET['result'] == 5) 
					{
						echo "<h4>Tu cuenta aún no fue activada, revisa tu mail.</h4>";
					}
				?>
			</div>

			<div class = "campo">
				<label for="usr">Usuario</label>
				<input type="text" name="usr" placeholder = "Usuario..">
			</div>
			
			<div class = "campo">
				<label for="pass">Contraseña</label>
				<input type="password" name="pass" placeholder = "Contraseña..">
			</div>

			<div class = "boton">
				<input type="submit" name="submit" value = "Log In">
			</div>

		</form>

		<div class = "mensaje">
			<h3>Si no estás registrado, hacé click <a href="registro.php">aquí</a></h3>
		</div>
	</div>

	<div class = "fondo">
			
	</div>

</body>
</html>