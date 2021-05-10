<?php  
	include('php/dbcon.php');
	include('php/functions.php');
	session_start();
	$login = revisa_login();
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

	<link href="https://fonts.googleapis.com/css?family=Bree+Serif|Lato|Lobster" rel="stylesheet">

	<link rel="apple-touch-icon" sizes="180x180" href="img/icons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/icons/favicon-16x16.png">
	<link rel="manifest" href="img/icons/site.webmanifest">
	<link rel="mask-icon" href="img/icons/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="img/icons/favicon.ico">

	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/stylesEdit.css">

</head>
<body>

	<header>
		<div class = "holder">
			<div class = "logo left">
				<a href="index.php"><img src="img/logos/valknutblanco.png" class = "logoimg" alt="logo"></a>
				<h1>Valknut Travels</h1>
			</div>
			<div class = "login right">
				<?php  

					if($login == 2)
					{
						echo "<div class = 'contUsr'>
								<h5 class = 'nomUsr'>".nombre_usuario($_SESSION['idusuario'])."</h5>
								<a href='php/salir.php'>Log Out</a>
								<a href='perfil.php'>Editar</a>
								<a href='admin.php'>Admin</a>
							  </div>
						      <img src=".imagen($_SESSION['idusuario'])." class = 'imgUsr'></img>";
					}
					else
					{
						if($login == 1)
						{
							echo "<div class = 'contUsr'>
									<h5 class = 'nomUsr'>".nombre_usuario($_SESSION['idusuario'])."</h5>
									<a href='php/salir.php'>Log Out</a>
									<a href='perfil.php'>Editar</a>
								  </div>
							      <img src=".imagen($_SESSION['idusuario'])." class = 'imgUsr'></img>";
						}
						else
						{
							echo "<a href='login.php'>Log In</a>
							  <a href='registro.php'>Registro</a>";
						}
					}
				?>
			</div>
		</div>
	</header>

	<nav>
		<div class = "holder">
			<ul>
				<li><a class = "activo" href="home.php" title="">Home</a></li><li><a href="nosotros.php" title="">Nosotros</a></li><li><a href="destinos.php" title="">Destinos</a></li><li><a href="blog.php" title="">Blog</a></li><li><a href="contacto.php" title="">Contacto</a></li>
			</ul>
		</div>
	</nav>

	<main>
		<div class = "holder">
			<div class = "central">
				<h2>Datos</h2>
				<div class = "contMen">
					<?php  
						if(isset($_GET['result']) && strpos($_GET['result'], '5') !== false)
						{
							echo "<h3 class='error Gen'>No se pudo subir su imagen.</h3>";
						}

						if(isset($_GET['result']) && strpos($_GET['result'], '6') !== false)
						{
							echo "<h3 class='error Gen'>No se pudieron grabar los cambios.</h3>";
						}

						if(isset($_GET['result']) && strpos($_GET['result'], '7') !== false)
						{
							echo "<h3 class='error Gen' style = 'color: #71d60c;'>Cambios guardados exitosamente.</h3>";
						}
					?>
				</div>
				<form action="php/procEdit.php" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
					<div class = "campos">

						<div class = "campo">
							<label for="nom">Nombre</label>
							<?php  
								if(isset($_GET['result']) && strpos($_GET['result'], '1') !== false)
								{
									echo "<h3 class='error'>Nombre inválido, solo se aceptan letras y espacios.</h3>";
								}
							?>
							<input type="text" name="nom" value="<?php echo nombre_usuario($_SESSION['idusuario']);?>">
						</div>
						
						<div class = "campo">
							<label for="mail">Email</label>
							<?php  
								if(isset($_GET['result']) && strpos($_GET['result'], '2') !== false)
								{
									echo "<h3 class='error'>Mail inválido.</h3>";
								}

								if(isset($_GET['result']) && strpos($_GET['result'], '8') !== false)
								{
									echo "<h3 class='error'>Mail ya en uso.</h3>";
								}
							?>
							<input type="text" name="mail" value="<?php echo email($_SESSION['idusuario']);?>">
						</div>
						
						<div class = "campo">
							<label for="usr">Usuario</label>
							<?php  
								if(isset($_GET['result']) && strpos($_GET['result'], '3') !== false)
								{
									echo "<h3 class='error'>Solo números y letras, entre 5 y 15 caracteres.</h3>";
								}

								if(isset($_GET['result']) && strpos($_GET['result'], '9') !== false)
								{
									echo "<h3 class='error'>Nombre de usuario ya en uso.</h3>";
								}
							?>
							<input type="text" name="usr" value="<?php echo usr($_SESSION['idusuario']);?>">
						</div>
						
						<div class = "campo">
							<label for="pass">Reestablecer contraseña</label>
							<?php  
								if(isset($_GET['result']) && strpos($_GET['result'], '4') !== false)
								{
									echo "<h3 class='error'>Solo números y letras, entre 5 y 30 caracteres.</h3>";
								}
							?>
							<input type="password" name="pass" placeholder="Contraseña nueva">
						</div>
						
					</div>

					<div class = "editImg">
						<img id = "imgPerfil" src= <?php echo imagen($_SESSION['idusuario']); ?>>
						
						<div class = "contbtn">
							<a class = "btn" onclick="document.getElementById('getFile').click()">
								Cambiar
							</a>
						</div>

  						<input type="file" name = "imgUser" id="getFile" style="display:none;" onchange="mostrarImg(this)">
					</div>

					<div class = "botonSubmit">
						<input type="submit" name="submit" value="Guardar">			
					</div>			
				</form>
			</div>
		</div>
	</main>
	
	<footer>
		<a href="secret.php" title=""><img src="img/logos/odin.png" alt="" width = 200px></a>
		<p>Copyright 2019 - Valknut Travel</p>
	</footer>

	<script type="text/javascript">

		function mostrarImg(e)
		{
			if(e.files[0])
			{
				var reader = new FileReader();

				reader.onload = function(e)
				{
					document.querySelector('#imgPerfil').setAttribute('src', e.target.result);
				}

				reader.readAsDataURL(e.files[0]);
			}
		}
	
	</script>		
</body>
</html>