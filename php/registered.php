<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximumscale=1.0; user-scalable=0;"/>
	
	<meta name="msapplication-TileColor" content="#00aba9">
	<meta name="msapplication-config" content="../img/icons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">

	<title>Valknut Travels</title>
	
	<link href="https://fonts.googleapis.com/css?family=Bree+Serif|Courgette" rel="stylesheet">

	<link rel="apple-touch-icon" sizes="180x180" href="../img/icons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../img/icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../img/icons/favicon-16x16.png">
	<link rel="manifest" href="../img/icons/site.webmanifest">
	<link rel="mask-icon" href="../img/icons/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="../img/icons/favicon.ico">

	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/stylesRegistered.css">
</head>
<body>
	<div class = "contenedor">
		<?php 
			if(isset($_GET['success']) && $_GET['success'] == 2)
			{
				echo "<h4>¡Tu cuenta fue activada!</h4>";
				echo "<h3>Ya podés iniciar sesión.</h3>";
				echo "<div class = 'boton'>
						  <a href='https://cursoutnpwm.000webhostapp.com/login.php'>Log In</a>
					  </div>";
			}

			if(isset($_GET['success']) && $_GET['success'] == 1)
			{
				echo "<h4>¡Gracias por registrarte!</h4>";
				echo "<h3>Por favor, revisa tu correo para activar tu cuenta.</h3>";
			}

			if(isset($_GET['success']) && $_GET['success'] == 0)
			{
				echo "<h4>Hubo un error en el proceso de registro.</h4>";
				echo "<h3>Por favor, inténtalo nuevamente más tarde.</h3>";
			}
		?>
	</div>
	<div class = "fondo">
		
	</div>

</body>
</html>