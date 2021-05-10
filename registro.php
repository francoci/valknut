<?php  
	include('php/dbcon.php');
	include('php/functions.php');
	session_start();
	cerrarSesion();
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
	<link rel="stylesheet" href="css/stylesRegistro.css">

</head>
<body>
	<div class = "contenedor">
		<form action="php/procRegistro.php" method="POST">
			<div class = "titulo">
				<h3>Registro</h3>
			</div>

			<div class = 'contenedorMensaje'>
				<?php 
					if(isset($_GET['result']) && $_GET['result'] == "1")
					{
						echo "<h4>Complete todos los campos.</h4>";
					}
				?>
			</div>

			<div class = "linea">
				<div class = "campo">
					<label for="nom">Nombre</label>
					<div class = menError>
						<?php 
							if(isset($_GET['result']) && strpos($_GET['result'], '2') !== false)
							{
								echo "<h2>Solo se aceptan letras y espacios.</h2>";
							}
						?>
					</div>
					<input type="text" name="nom" placeholder = "Nombre..">
				</div>

				<div class = "campo">
					<label for="ape">Apellido</label>
					<div class = menError>
						<?php 
							if(isset($_GET['result']) && strpos($_GET['result'], '3') !== false)
							{
								echo "<h2>Solo se aceptan letras y espacios.</h2>";
							}
						?>
					</div>
					<input type="text" name="ape" placeholder = "Apellido..">
				</div>
			</div>

			<div class = "linea">
				<div class = "campo">
					<label for="mail">Email</label>
					<div class = menError>
						<?php 
							if(isset($_GET['result']) && strpos($_GET['result'], '4') !== false)
							{
								echo "<h2>Mail inválido.</h2>";
							}
							elseif(isset($_GET['result']) && strpos($_GET['result'], '8') !== false)
							{
								echo "<h2>Mail ya en uso.</h2>";
							}
						?>
					</div>
					<input type="text" name="mail" placeholder = "Email..">
				</div>
				
				<div class = "campo">
					<label for="confMail">Confirmar Email</label>
					<div class = menError>
						<?php 
							if(isset($_GET['result']) && strpos($_GET['result'], '5') !== false)
							{
								echo "<h2>Mail inválido o no coincide.</h2>";
							}
							elseif(isset($_GET['result']) && strpos($_GET['result'], '8') !== false)
							{
								echo "<h2>Mail ya en uso.</h2>";
							}
						?>
					</div>
					<input type="text" name="confMail" placeholder = "Email..">
				</div>
			</div>

			<div class = "linea">
				<div class = "campo">
					<label for="usr">Usuario</label>
					<div class = menError>
						<?php 
							if(isset($_GET['result']) && strpos($_GET['result'], '6') !== false)
							{
								echo "<h2>Solo letras y números, 5-15 caracteres.</h2>";
							}
							elseif(isset($_GET['result']) && strpos($_GET['result'], '9') !== false)
							{
								echo "<h2>Nombre de usuario ya en uso.</h2>";
							}
						?>
					</div>
					<input type="text" name="usr" placeholder = "Usuario..">
				</div>
				
				<div class = "campo">
					<label for="pass">Contraseña</label>
					<div class = menError>
						<?php 
							if(isset($_GET['result']) && strpos($_GET['result'], '7') !== false)
							{
								echo "<h2>Solo letras y números, 5-15 caracteres.</h2>";
							}
						?>
					</div>
					<input type="password" name="pass" placeholder = "Contraseña..">
				</div>
			</div>
			<div class = "boton">
				<input type="submit" name="submit" value = "Registrar">
			</div>

		</form>
	</div>

	<div class = "fondo">
			
	</div>

</body>
</html>