<?php  
	include('php/functions.php');
	include('php/procArticulos.php');
	session_start();
	$login = revisa_login();

	$idArt = "";

	if(isset($_GET['numArt']))
	{
		$idArt = $_GET['numArt'];
	}

	$exito = cargarArt($idArt);
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
	<link rel="stylesheet" href="css/stylesArt.css">

	<script src="js/jquery.min.js"></script>
</head>
<body>

	<header>
		<div class = "holder">
			<div class = "logo left">
				<a href="index.html"><img src="img/logos/valknutblanco.png" class = "logoimg" alt="logo"></a>
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
				<li><a href="home.php" title="">Home</a></li><li><a href="nosotros.php" title="">Nosotros</a></li><li><a href="destinos.php" title="">Destinos</a></li><li><a class = "activo" href="blog.php" title="">Blog</a></li><li><a href="contacto.php" title="">Contacto</a></li>
			</ul>
		</div>
	</nav>

	<main>
		<div class = "holder">

			<div class = "central">
				<?php 
					if($exito != 1)
					{
						echo "<h2>No se pudo cargar el articulo.</h2>";
					} 
					else
					{
						echo "<h2>$titulo</h2>";
					}
				?>
				
				<div class = "imagenArt" >
					<img alt="" src="<?php echo $img; ?>">
				</div>
				<article class = "articulo">
					<h3>Autor: <?php echo $autor; ?> <br> Fecha: <?php echo $fecha; ?></h3>
					<p>	<?php echo $contenido; ?></p> <br>
				</article>

				<div class = "contenedorComentario" id="comentBox">
					<form class ="agregCom" method = "POST" action = "php/agregComentario.php" enctype="multipart/form-data">
						<p>
							<label for = "coment">Agregar un comentario</label>
							<?php 
								if(isset($_GET['result']) && $_GET['result'] == 0)
								{
									echo "<h3 class = 'error'>Hubo un error en la conexión, inténtelo nuevamente más tarde.</h3>";
								}

								if(isset($_GET['result']) && $_GET['result'] == 1)
								{
									echo "<h3 class = 'error' style = 'color: #71d60c;'>Comentario agregado.</h3>";
								}

								if($login == 0)
								{
									echo "<h3 class = 'error'>Se debe iniciar sesión para poder comentar.</h3>";
								}
							?>
							
							<span class="hint" id="textarea_message">Caracteres restantes: <span id = "num">300</span></span>
							<textarea name="coment" placeholder = "Comentario.." class = "comentArea" id="message_area" maxlength= "300"></textarea>
							<input type="hidden" name="idArt" value="<?=$idArt;?>">
						</p>

						<?php  

							if($login == 1)
							{
								echo '<input type="submit" name="submit" value="Enviar">';
							}
							else
							{
								echo '<div class = "botonLink">
										<a href="login.php" class = "btnLogin">Log In</a>
									  </div>';
								// echo '<input type="submit" name="submit" value="Enviar" disabled = disabled>';
							}
						?>
						
					</form>

					<div class = "comentarios">

						<?php  

							$conn = mysqli_connect($host, $user, $password, $db);

							//Verifico conexion exitosa
							if (mysqli_connect_errno()) 
							{
							    echo "Error en conexion con BD";
							}

							$query = "SELECT * FROM comentarios INNER JOIN usuarios ON id_usr = id_autor 
							          WHERE id_art_id = '$idArt' ORDER BY fecha DESC;"; //LIMIT 5

							$result = mysqli_query($conn, $query);

							if (mysqli_num_rows($result) > 0) 
							{
								while($row = mysqli_fetch_array($result)) 
								{	
								?>
										<div class = "comentario">
											<img src="<?php echo $row['imagen']; ?>" alt="" class = "imgUsr">
											<div class = "texto">
												<h4><?php echo $row['nombre']; ?></h4>
												<h4>Fecha: <?php echo $row['fecha']; ?></h4>
												<p><?php echo $row['comentario']; ?></p>
											</div>
										</div>
								<?php }
							}
							else
							{
								echo '<div style = "border-top: 2px solid rgba(62, 66, 59,0.7);">
										<h2>No hay comentarios.</h2>
									  </div>';
							}

							//Cierro la conexion con la BD
							mysqli_close($conn);
						?>

					</div>
				</div>
			</div>
		</div>
	</main>
	
	<footer>
		<a href="secret.php" title=""><img src="img/logos/odin.png" alt="" width = 200px></a>
		<p>Copyright 2019 - Valknut Travel</p>
	</footer>

	<script>
		$('textarea#message_area').on('keyup',function() 
		{
        	var maxlen = $(this).attr('maxlength');
				var length = $(this).val().length;
  			var rest = maxlen - length;
  			
  			if(rest < 50)
  			{
  				$('#num').css('color', '#d6250a');
  			}
  			else
  			{
  				$('#num').css('color', '#ddd');
  			}

  			$('#num').text(rest)
  			// document.getElementById("message_area").textContent = 'Caracteres restantes '+rest
		});
	</script>

</body>
</html>