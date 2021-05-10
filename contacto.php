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
	<link rel="stylesheet" href="css/stylesContacto.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

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
				<li><a href="home.php" title="">Home</a></li><li><a href="nosotros.php" title="">Nosotros</a></li><li><a href="destinos.php" title="">Destinos</a></li><li><a href="blog.php" title="">Blog</a></li><li><a class = "activo" href="contacto.php" title="">Contacto</a></li>
			</ul>
		</div>
	</nav>

	<main>
		
		<div class = "holder">

			<div class = "central">

				<h2>¡Mantengámonos en contacto!</h2>
				<div class = "menErrorGeneral">
					<?php 
						if(isset($_GET['error']) && $_GET['error'] == 0)
						{
							echo "<span class = 'error' style = 'color: #71d60c;'>Su mensaje ha sido enviado.</span>";
						}

						if(isset($_GET['error']) && $_GET['error'] == 1)
						{
							echo "<span class = 'error'>Complete todos los campos.</span>";
						}

						if(isset($_GET['error']) && $_GET['error'] == 5)
						{
							echo "<span class = 'error'>Su mensaje no pudo ser enviado, inténtelo nuevamente más tarde.</span>";
						}  
					?>
				</div>
				
				<form class = "formulario" action="php/contactform.php" method="post" accept-charset="utf-8">
				
				<div class = "contCampo">
					<label for = "nombre">Nombre</label>
					<div class = "menError">
						<?php 
							if(isset($_GET['error']))
							{
								if($_GET['error'] == 2 || $_GET['error'] == 23)
								echo "<span class = 'error'>Valor inválido, solo se aceptan letras.</span>";
							}
						?>
					</div>
					<input type="text" name="nombre" placeholder="Nombre..">
				</div>
				
				<div class = "contCampo">
					<label for = "email">Email</label>
					<div class = "menError">
						<?php 
							if(isset($_GET['error']))
							{
								if($_GET['error'] == 3 || $_GET['error'] == 23)
								echo "<span class = 'error'>Formato de mail inválido.</span>";
							}
						?>
					</div>
					<input type="text" name="email" placeholder="Email..">
				</div>
				
				<div class = "contCampo">
					<label for = "mensaje">Mensaje</label>
					<textarea name="mensaje" placeholder = "Tu mensaje.." id="message_area" maxlength= "200"></textarea>
					<span class="hint" id="textarea_message">Caracteres restantes: <span id = "num">200</span></span>
				</div>
				
				<div class = "acciones">
					<input type="submit" name="submit" value="Enviar">
				</div>

				</form>

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

				<div class = "info">
					<h2>Para más información, seguinos en nuestras redes o visita nuestras <a href="faqs.html">FAQs</a></h2>
					
					<div class = "iconos">
						<div class = "iconofb">
							<a class = "azul icon-fb" href="#"></a>
						</div>
						
						<div class = "iconotw">
							<a class = "celeste icon-tw" href="#"></a>
						</div>
						<div class = "iconoig">
							<a class = "rosa icon-ig" href="#"></a>
						</div>
					</div>
					
				</div>

			</div>
			
		</div>
		
	</main>
	
	<footer>
		<a href="secret.php" title=""><img src="img/logos/odin.png" alt="" width = 200px></a>
		<p>Copyright 2019 - Valknut Travel</p>
	</footer>

</body>
</html>