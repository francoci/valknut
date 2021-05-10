<?php  
	include('../php/dbcon.php');
	include('../php/functions.php');
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
	<link rel="stylesheet" href="../css/stylesSubArt.css">
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
		<div class = "panel" style="height: 550px;">
			<h3 style = "margin-bottom: 0.2em;">Subir articulo</h3>
			<div class = "contMen">
				<?php  
					if(isset($_GET['result']) && $_GET['result'] == 1)
					{
						echo "<h4 class='errorGen'>Complete todo los campos.</h3>";
					}

					if(isset($_GET['result']) && strpos($_GET['result'], '2') !== false)
					{
						echo "<h4 class='errorGen'>Título inválido. Solo letras, números y espacios.</h3>";
					}

					if(isset($_GET['result']) && strpos($_GET['result'], '3') !== false)
					{
						echo "<h4 class='errorGen'>Nombre de ciudad o país inválido. Solo letras y espacios.</h3>";
					}

					if(isset($_GET['result']) && strpos($_GET['result'], '4') !== false)
					{
						echo "<h4 class='errorGen'>No se pudo subir la imagen.</h3>";
					}

					if(isset($_GET['result']) && strpos($_GET['result'], '5') !== false)
					{
						echo "<h4 class='errorGen'>Extensión inválida, solo JPG o PNG.</h3>";
					}

					if(isset($_GET['result']) && $_GET['result'] == '6')
					{
						echo "<h4 class='errorGen'>No se pudo subir el artículo. Inténtelo nuevamente más tarde.</h3>";
					}

					if(isset($_GET['result']) && $_GET['result'] == '7')
					{
						echo "<h4 class='errorGen' style = 'color: #71d60c;'>Artículo subido exitosamente.</h3>";
					}
				?>
			</div>

			<form action="procSubArt.php" method="POST" accept-charset="utf-8" enctype="multipart/form-data">

				<div class = "contCampos">
					<label for="tit">Titulo</label>
					<input type="text" name="tit" placeholder = "Titulo..">

					<label for="lug">Lugar</label>
					<input type="text" name="lug" placeholder = "Lugar..">

					<label for="cont">Contenido</label>
					<textarea name="cont" placeholder = "Contenido del articulo.."></textarea>
				</div>

				<div class = "editImg">
					<label for="imgArt" style = "text-align: center;">Imagen</label>

					<div class = "contImg">
						<img src="../img/articulos/placeholder.png">
					</div>
					
					<h4>Resolución preferida: <br>1000x600, jpg o png.</h4>

					<div class = "contbtn">
						<a class = "btn" onclick="document.getElementById('getFile').click()">
								Seleccionar imagen
						</a>
					</div>

  					<input type="file" name = "imgArt" id="getFile" style="display:none;">
				</div>

				<div class = "botonSubmit">
					<input type="submit" name="submit" value="Enviar">
				</div>
				
			</form>
		</div>
	</main>

</body>
</html>