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
	<link rel="stylesheet" href="css/stylesActiv.css">

</head>
<body>
	<div class = "contenedor">
		<form action="php/procActiv.php" method="POST">
			<div class = "titulo">
				<h3>Activar cuenta</h3>
			</div>

			<div class = 'contenedorMensaje'>
				<?php 
					if(isset($_GET['result']) && $_GET['result'] == 0)
					{
						echo "<h4 style = 'color: #71d60c;'>Cuenta activada exitosamente.</h4>";
					}
					elseif(isset($_GET['result']) && $_GET['result'] == 1)
					{
						echo "<h4 style = 'font-size: 0.9em;'>El código es incorrecto o la cuenta ya fue activada.</h4>";
					}
					elseif (isset($_GET['result']) && $_GET['result'] == 2) 
					{
						echo "<h4 style = 'font-size: 0.9em;'>Hubo un error, inténtelo nuevamente más tarde.</h4>";
					}
					elseif (isset($_GET['result']) && $_GET['result'] == 3) 
					{
						echo "<h4>Ingrese un código.</h4>";
					}
				?>
			</div>

			<div class = "campo">
				<label for="cod">Código</label>
				<input type="text" name="cod" placeholder = "Usuario..">
			</div>

			<div class = "boton">
				<input type="submit" name="submit" value = "Activar">
			</div>

		</form>
	</div>

	<div class = "fondo">
			
	</div>

</body>
</html>