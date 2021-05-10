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
	<link rel="stylesheet" href="css/stylesNosotros.css">
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
				<li><a href="home.php" title="">Home</a></li><li><a class = "activo" href="nosotros.php" title="">Nosotros</a></li><li><a href="destinos.php" title="">Destinos</a></li><li><a href="blog.php" title="">Blog</a></li><li><a href="contacto.php" title="">Contacto</a></li>
			</ul>
		</div>
	</nav>

	<main>
		<div class = "holder">
			<div class = "central">
				<h2>Nuestra historia</h2>
				<div class = "historia">

					<p>
					<span class = "cursiva">Valknut</span> es una comunidad de viajeros fundada en el año 2019.
					El orígen de nuestro nombre se remonta a un antiguo símbolo nórdico. El significado del mismo
					es algo que ha eludido a arqueólogos una y otra vez a lo largo de los años. Y, si bien
					muchos creen que el mismo estaba asociado con el dios Odin, es esa sensación de misterio, 
					de lo desconocido que rodea al símbolo lo que creemos más representa el viajar.<br><br>

					Cuando uno viaja nunca sabe con que se va a encontrar. Tanto
					experiencias buenas como malas nos esperan al embarcarnos en una nueva
					aventura. Y son esas experiencias las que se quedan con nosotros, y las que 
					venimos a compartir con todos aquí.<br><br>

					Nuestro fin es el de poder proveer recursos que sean útiles e informativos
					para aquellos que esten por emprender un viaje, de manera que se pueda aprovechar
					y conocer al máximo el destino, empaparse en la cultura local y disfrutar. 
					Lo bueno es que todo nuestro contenido está basado en nuestras <span class = "cursiva">experiencias 
					personales</span>, por lo que podrán saber de primera mano tanto los aspectos positivos como negativos
					de cada lugar.
					</p>
					
				</div>

				<div class = "personas">

					<div class = "persona">
						<img src="img/nosotros/franco.jpg" alt="franco">
						<h3>Franco</h3>
						<p>Siempre en la búsqueda de nuevos destinos.</p>
						<div class = "insta">
							<a href="https://www.instagram.com/franco_cipolla/" class = "icon-ig"><h4>@franco_cipolla</h4></a>
						</div>
						
					</div>

					<div class = "persona">
						<img src="img/nosotros/thanos.jpg" alt="franco">
						<h3>Thanos</h3>
						<p>Haciendo del universo un lugar mejor, un chasquido a la vez.</p>
						<div class = "insta">
							<a href="https://www.instagram.com/joshbrolin/" class = "icon-ig"><h4>@joshbrolin</h4></a>
						</div>
					</div>

					<div class = "persona">
						<img src="img/nosotros/obama.jpg" alt="franco">
						<h3>Barack</h3>
						<p>No sé como llegue acá, pero bueno.</p>
						<div class = "insta">
							<a href="https://www.instagram.com/barackobama/" class = "icon-ig"><h4>@barackobama</h4></a>
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