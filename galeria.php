<?php  
	include('php/dbcon.php');
	include('php/functions.php');
	session_start();
	$login = revisa_login();

	$idGal = "";

	if(isset($_GET['numGal']))
	{
		$idGal = $_GET['numGal'];
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximumscale=1.0; user-scalable=0;"/>
	
	<meta name="msapplication-TileColor" content="#00aba9">
	<meta name="msapplication-config" content="img/icons/browserconfig.xml">
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
	<link rel="stylesheet" href="css/stylesGaleria.css">

	<link rel="stylesheet" href="js/fancy/jquery.fancybox.css">
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
				<li><a href="home.php" title="">Home</a></li><li><a href="nosotros.php" title="">Nosotros</a></li><li><a class = "activo" href="destinos.php" title="">Destinos</a></li><li><a href="blog.php" title="">Blog</a></li><li><a href="contacto.php" title="">Contacto</a></li>
			</ul>
		</div>
	</nav>

	<main>
		<div class = "holder">

			<div class = "central">

				<h2>Galeria</h2>

				<div class = "imagenes">

					<?php  

						$conn = mysqli_connect($host, $user, $password, $db);

						//Verifico conexion exitosa
						if (mysqli_connect_errno()) 
						{
						    echo "Error en conexion con BD";
						}

						$query = "SELECT * FROM img_galeria WHERE id_gale = '$idGal';"; //LIMIT 5

						$result = mysqli_query($conn, $query);

						if (mysqli_num_rows($result) > 0) 
						{
							while($row = mysqli_fetch_array($result)) 
							{	
							?>

								<div class = "imagen">
								<a id="single_image" href="<?php echo $row['img']; ?>" rel="galeria" 
								class = "fancybox-media" title = "<?php echo $row['lugar']; ?>">

									<img src="<?php echo $row['img']; ?>" alt=""/>

								</a>
								</div>
							<?php }
						}
						else
						{
							echo '<h2>No se pudieron cargar las imagenes.</h2>';
						}

						//Cierro la conexion con la BD
						mysqli_close($conn);
					?>


				</div>
			</div>
		</div>
	</main>
	
	<footer>
		<a href="secret.php" title=""><img src="img/logos/odin.png" alt="" width = 200px></a>
		<p>Copyright 2019 - Valknut Travel</p>
	</footer>

	<script src="js/jquery.min.js"></script>
	<script src="js/fancy/jquery.fancybox.js"></script>
	<script src="js/galeria.js"></script>

</body>
</html>