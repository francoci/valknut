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
	<link rel="stylesheet" href="css/stylesBlog.css">
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
				<li><a href="home.php" title="">Home</a></li><li><a href="nosotros.php" title="">Nosotros</a></li><li><a href="destinos.php" title="">Destinos</a></li><li><a class = "activo" href="blog.php" title="">Blog</a></li><li><a href="contacto.php" title="">Contacto</a></li>
			</ul>
		</div>
	</nav>

	<main>
		<div class = "holder">
			<div class = "central">

				<h2>Blog</h2>

				<?php  

					$conn = mysqli_connect($host, $user, $password, $db);

					//Verifico conexion exitosa
					if (mysqli_connect_errno()) 
					{
						echo "Error en conexion con BD";
					}

					$query = "SELECT * FROM articulos;";

					$result = mysqli_query($conn, $query);

					if (mysqli_num_rows($result) > 0) 
					{
						while($row = mysqli_fetch_array($result)) 
						{	
							$texto = substr($row['contenido'],0,250)."...";
						?>
							<article class = "post" style="background-image: url(<?php echo $row['banner'];?>)">
								<h3><?php echo $row['lugar']; ?></h3>
								<p><?php echo $texto; ?></p>
								<a href="<?php echo 'articulo.php?numArt='.$row['id_art']; ?>" title="">
									<button type="" class = "boton"><span>Leer más</span></button>
								</a>
							</article>
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
	</main>
	
	<footer>
		<a href="secret.php" title=""><img src="img/logos/odin.png" alt="" width = 200px></a>
		<p>Copyright 2019 - Valknut Travel</p>
	</footer>
</body>
</html>