<?php  
	include('../php/functions.php');
	include('cargaConsult.php');
	session_start();
	$login = revisa_login();

	if($login == 0 || $login == 1)
	{
		cerrarSesion();
		header("Location: ../admin.php");
	}
?>

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

	<link href="https://fonts.googleapis.com/css?family=Bree+Serif|Lato|Lobster" rel="stylesheet">

	<link rel="apple-touch-icon" sizes="180x180" href="../img/icons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../img/icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../img/icons/favicon-16x16.png">
	<link rel="manifest" href="../img/icons/site.webmanifest">
	<link rel="mask-icon" href="../img/icons/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="../img/icons/favicon.ico">

	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/stylesAdmin.css">
	<link rel="stylesheet" href="../css/stylesConsultas.css">
</head>
<body>
	<nav>
		<div class = "barraLateral">
			<div class = "contenedorPerfil">
				<div class = "imgPerfil">
					<a href="../perfil.php" title=""><img alt="ProfPic" src="<?php echo '../'.imagen($_SESSION['idusuario']); ?>"></a>
				</div>
				<h4><?php echo nombre_usuario($_SESSION['idusuario']); ?></h4>
			</div>
			<ul>
				<li><a href="adminPanel.php" title="">Inicio</a></li>
				<li><a href="consultas.php" title="">Consultas</a></li>
				<li><a href="subArt.php" title="">Subir artículo</a></li>
				<li><a href="../home.php" title="">Home Valknut</a></li>
				<li><a href="../php/salir.php" title="">Log Out</a></li>
			</ul>
		</div>
	</nav>

	<main>
		<div class = "panel" style = "background-color: #aeb77b;">
			<h3>Consultas</h3>
			<?php cargarConsultas(); ?>
		</div>
	</main>

</body>
</html>