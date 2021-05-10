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
	<link rel="stylesheet" href="css/stylesHome.css">

	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.cycle2.min.js"></script>
	<script src="js/jquery.cycle2.tile.js"></script>
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
				<div class="slidershow">

					<div class="cycle-slideshow" data-cycle-fx="tileSlide" data-cycle-timeout="5000" data-cycle-slides="> a"  data-cycle-pause-on-hover="true" data-cycle-prev="#prev" data-cycle-next="#next">

				        <a href="galeria.php?numGal=1" title=""><img src="img/slider/nepal3.jpg" alt="Nepal"></a> 
				        <a href="galeria.php?numGal=2" title=""><img src="img/slider/india3.jpg" alt="India"></a> 
				        <a href="galeria.php?numGal=3" title=""><img src="img/slider/egipto3.jpg" alt="Egipto"></a>
				        <a href="galeria.php?numGal=4" title=""><img src="img/slider/petra3.jpg" alt="Petra"></a> 
				        <a href="galeria.php?numGal=5" title=""><img src="img/slider/israel2.jpg" alt="Israel"></a> 

		       		</div>

		    	</div>

		    	<div class="slideNavigation">
		    		<div id="prev"><a class="icon-circle-right" href="#"></a></div>
    				<div id="next"><a class="icon-circle-left" href="#"></a></div>
		    	</div>

			    <h2>¡Bienvenido de vuelta!</h2>
			    <div class = "articulos">
			    	<div class = "articulo">
			    		<div class = "imagen">
			    			<img src="img/posters/nepal.jpg" alt="Nepal Poster">
			    		</div>
			    		<div class = "contenedorTexto">
			    			<h3>Nepal</h3>
			    			<a href="articulo.php?numArt=1"><span>Leer más</span></a>
			    		</div>
			    	</div>

			    	<div class = "articulo">
			    		<div class = "imagen">
			    			<img src="img/posters/egipto.jpg" alt="Egipto Poster">
			    		</div>
			    		<div class = "contenedorTexto">
			    			<h3>Egipto</h3>
			    			<a href="articulo.php?numArt=4"><span>Leer más</span></a>
			    		</div>
			    	</div>

			    	<div class = "articulo">
			    		<div class = "imagen">
			    			<img src="img/posters/paris.jpg" alt="Paris Poster">
			    		</div>
			    		<div class = "contenedorTexto">
			    			<h3>Paris</h3>
			    			<a href="articulo.php?numArt=6"><span>Leer más</span></a>
			    		</div>
			    	</div>

			    	<div class = "articulo">
			    		<div class = "imagen">
			    			<img src="img/posters/india.jpg" alt="India Poster">
			    		</div>
			    		<div class = "contenedorTexto">
			    			<h3>India</h3>
			    			<a href="articulo.php?numArt=5"><span>Leer más</span></a>
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