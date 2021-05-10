<?php  

	include('dbcon.php');
	include('functions.php');

	//Valores de errores
	//0 -> No hay errores   	    		1 -> Campos vacios           	2 -> Error en el nombre
	//3 -> Error en el apellido     		4 -> Error en el mail			5 -> Error en la conf.
	//6 -> Error en el usuario      		7 -> Error en password      	8 -> Mail existente
	//9 -> Nombre de usuario existente
	$result = "";

	//Declaro las variables como globales para que puedan ser usadas por las funciones
	//y poder modularizar

	$nom = $ape = $mail = $mailConf = $usr = $pass = $nombre = $img = "";

	//Codigo de activacion
	$cod = "";


	if(isset($_POST['submit']))
	{
		if(empty($_POST['nom']) || empty($_POST['ape']) || empty($_POST['mail']) || empty($_POST['confMail']) || empty($_POST['usr']) || empty($_POST['pass']))
		{
			header("Location: ../registro.php?result=1");
		}
		else
		{	
			//Validacion del nombre
			$nom = test_input($_POST['nom']);

			//Chequeo con una expresion regular que solo contenga letras y espacios
			if(!preg_match("/^[a-zA-Z\s]*$/", $nom))
			{
				$result .= "2";
			}

			//Validacion del apellido
			$ape = test_input($_POST['ape']);

			//Chequeo con una expresion regular que solo contenga letras y espacios
			if(!preg_match("/^[a-zA-Z\s]*$/", $ape))
			{
				$result .= "3";
			}

			//Validacion mail
			$mail = test_input($_POST['mail']);

			//Convierto a minusculas
			$mail = strtolower($mail);

			//Con filter_var() chequeo que el formato del email sea correcto.
			//Es una funcion propia de PHP, y se usa el filtro FILTER_VALIDATE_EMAIL que ya esta predefinido en PHP.
			if(!filter_var($mail, FILTER_VALIDATE_EMAIL))
			{
				$result .= "4";
			}
			else
			{
				$existe = validarExistMail($mail);
				if($existe == 1)
				{
					$result .= "8";
				}
			}

			//Validacion mail
			$mailConf = test_input($_POST['confMail']);

			//Convierto a minusculas
			$mailConf = strtolower($mailConf);

			//Con filter_var() chequeo que el formato del email sea correcto.
			//Es una funcion propia de PHP, y se usa el filtro FILTER_VALIDATE_EMAIL que ya esta predefinido en PHP.
			if(!filter_var($mailConf, FILTER_VALIDATE_EMAIL) || $mailConf != $mail)
			{
				$result .= "5";
			}
			else
			{
				$existe = validarExistMail($mailConf);
				if($existe == 1)
				{
					$result .= "8";
				}
			}

			//Validacion nombre de usuario
			$usr = test_input($_POST['usr']);

			$long = strlen($usr);

			//Chequeo con una expresion regular que solo contenga letras y/o numeros
			//Que tenga como minimo 5 caracteres y como maximo 15
			if(!preg_match("/^[a-zA-Z0-9]*$/", $usr) || $long < 5 || $long > 15)
			{
				$result .= "6";
			}
			else
			{
				$existe = validarExistUsr($usr);
				if($existe == 1)
				{
					$result .= "9";
				}
			}

			//Validacion de la contraseña
			$pass = test_input($_POST['pass']);

			$longPass = strlen($pass);

			//Solo valido que tenga entre 5 y 30 caracteres y letras/numeros
			if(!preg_match("/^[a-zA-Z0-9]*$/", $pass) || $longPass < 5 || $longPass > 30)
			{
				$result .= "7";
			}

			if($result != "")
			{
				header("Location: ../registro.php?result=$result");
			}
			else
			{
				$nombre = test_input($_POST['nom']." ".$_POST['ape']);
				$img = "img/img_usuarios/placeholder.png";

				$success = insertarEnBase();

				if($success == 1)
				{
					$success = enviarMailReg();
					header("Location: registered.php?success=$success");	
				}
				else
				{
					header("Location: registered.php?success=$success");
				}
			}
			
			
		}
	}


	//Funcion que se encarga de insertar en la base de datos

	function insertarEnBase()
	{
		global $host; global $user; global $password; global $db;
		global $mail; global $usr; global $pass; global $nombre; global $img;
		global $cod;

		//Variable para confirmar que se pudieron hacer las queries
		$exito = "1";

		$cod = generarCodigoMD5();

		//Abro la conexion con la base de datos
		$conn = mysqli_connect($host, $user, $password, $db);

		//Verifico conexion
		if (mysqli_connect_errno()) 
		{
		    echo "Conexión con bd fallida: ". mysqli_connect_error();
		    exit();
		}

		$query = "SELECT id_usr FROM usuarios;";
		$resultQuery = mysqli_query($conn, $query);

		//Si tengo algun tipo de problema con la query
		if (!$resultQuery) 
		{
			die('Error: ' . mysqli_error($conn));
			$exito = "0";
		}

		$id = 0;

		if(mysqli_num_rows($resultQuery) > 0)
		{
			while($row = mysqli_fetch_assoc($resultQuery))
			{
				if($row['id_usr'] > $id)
				{
					$id = $row['id_usr'];
				}
			}
		}

		$id++;

		$query = "INSERT INTO usuarios(id_usr, nombre, email, usr, pass, admin, cod, activado, imagen)
		VALUES ('$id','$nombre','$mail','$usr','$pass',0, '$cod',0,'$img');";

		$resultQuery = mysqli_query($conn, $query);

		//Si tengo algun tipo de problema con la query
		if (!$resultQuery) 
		{
			die('Error: ' . mysqli_error($conn));
			$exito = "0";
		}

		//Cierro la conexion con la BD
		mysqli_close($conn);

		return $exito;
	}

	//Funcion para generar el código de activación mediante el algoritmo MD5

	function generarCodigoMD5()
	{

		global $host; global $user; global $password; global $db; global $nombre;

		//Genera una clave de activacion, aplicando el algoritmo de encriptacion MD5 a la concatenacion del horario en el cual se crea
		//y el nombre del cliente. La utilizacion del tiempo mejora la seguridad de la clave, hace que la misma sea unica y
		//muy dificil de replicar mediante ataques por fuerza bruta.
		$codigo = md5(time().$nombre);

		//Abro la conexion con la BD

	 	$conn = mysqli_connect($host, $user, $password, $db);

		// Chequeo que la conexion se haya hecho correctamente
		
		if (mysqli_connect_errno()) 
		{
		  echo "Conexión con bd fallida: ". mysqli_connect_error();
		  exit();
		}

		//Armo el query para asegurarme que el codigo no este siendo usado.
		$query = "SELECT cod FROM usuarios WHERE cod='$codigo';";

		//Ejecuto el query
		$resultQuery = mysqli_query($conn,$query);

		$resultRows = mysqli_num_rows($resultQuery);

		while($resultRows > 0)
		{
			//Genero otro codigo.
			$codigo = md5(time().$nombre);
			$query = "SELECT cod FROM usuarios WHERE cod='$codigo';";
			$resultQuery = mysqli_query($conn,$query);
			$resultRows = mysqli_num_rows($resultQuery);
		}
	    
	    //Cierro la conexion con la BD
		mysqli_close($conn);
		
		return $codigo;
	}


	function enviarMailReg()
	{
		global $cod; global $nom; global $mail;

		$exito = 0;

		$txt = '<html>
				<head>
					<style type="text/css">
						
						@import url("https://fonts.googleapis.com/css?family=Lato:400,900,900i");

						.email-background
						{
						  background-color: #c6c6c6;
						  padding: 1em 1em 0;
						  max-width: 532px;
						}

						.pre-header
						{
						  background-color: #c6c6c6;
						  color: #c6c6c6;
						  font-size: 2px;
						}

						.email-container
						{
						  max-width: 500px;
						  background-color: #F5F6F6;
						  padding: 1em;
						  margin: 0 auto;
						  overflow: hidden;
						  border-radius: 5px;
						}

						.contenedorImg
						{
							width: 100px;
							height: 100px;
							margin: 0.5em auto;
						}

						.contenedorImg img
						{
							width: 100%;
							height: 100%;
						}

						p
						{
							font-family: "Lato", sans-serif;
							color: #30baa4;
							font-weight: 700;
							text-align: center;
							font-size: 2.2em;
							margin: 0.5em auto;
						}

						.parrafo2
						{
							font-family: "Lato", sans-serif;
							color: #4a9186;
							font-weight: 600;
							text-align: center;
							font-size: 1em;
							width: 400px;
							margin: 0 auto 0.5em;
						}

						.activBtn
						{
							width: 80px;
							height: 30px;
							background-color: #238777;
							border-radius: 5px;
							margin: 0.5em auto 2em;
							padding: 0.5em;
							cursor: pointer;
						}

						.activBtn a
						{
							color: white;
							text-decoration: none;
							font-family: "Lato", sans-serif;
							font-size: 1.3em;
							text-align: center;
						}

						footer
						{
						  font-family: "Lato", sans-serif;
						  font-weight: 500;
						  font-size: 14px;
						  text-align: center;
						  color: #8B8BA7;
						  margin: 0 auto;
						  padding: 0.5em 0;
						  height: 40px;
						}

						.contenedorRedes
						{
							width: 100px;
							height: 30px;
							padding: 5px 0;
							float: left;
						}

						.logoRed
						{
							width: 30px;
							height: 30px;
						}

						.copyright
						{
							float: left;
							width: 332px;
							text-align: center;
							margin: 0.5em auto;
						}

					</style>

				</head>

				<body>
					
					<div class="email-background">

						<div class="pre-header" style="background-color: #c6c6c6;color: #c6c6c6;font-size: 2px;">
							Valida tu cuenta de Valknut
						</div>

						<div class="email-container" style="max-width: 500px;background-color: #F5F6F6;padding: 1em;margin: 0 auto;overflow: hidden;border-radius: 5px;">
							
							<div class="contenedorImg" style="width: 100px;height: 100px;margin: 0.5em auto;">
								<img src="https://cursoutnpwm.000webhostapp.com/img/mail/logo2.png" alt="" style="width: 100%;height: 100%;">
							</div>

							<p style="font-family: &quot;Lato&quot;, sans-serif;color: #30baa4;font-weight: 700;text-align: center;font-size: 2.2em;margin: 0.5em auto;">

							¡Gracias por inscribirte!

							</p>
							
							<p class="parrafo2" style="font-family: &quot;Lato&quot;, sans-serif;color: #4a9186;font-weight: 500;text-align: justify;font-size: 1.4em;margin: 0.5em auto;width: 400px;margin: 0 auto 0.5em;">

							Hola, '.$nom.', solo resta un último paso para que seas parte de Valknut. Clickea en el botón e ingresá tu código de activación para activar tu cuenta.<br><br></p>

							<div class="activBtn" style="width: 80px;height: 30px;background-color: #238777;border-radius: 5px;margin: 0.5em auto 2em;padding: 0.5em;cursor: pointer;">

								<a href="https://cursoutnpwm.000webhostapp.com/activar.php" class="linkBoton" style="color: white;text-decoration: none;font-family: &quot;Lato&quot;, sans-serif;font-size: 1.3em;text-align: center;">
									
									¡Activar!

								</a>
								
							</div>

							<p class="parrafo2" style="font-family: &quot;Lato&quot;, sans-serif;color: #4a9186;font-weight: 500;text-align: center;font-size: 1.4em;margin: 0.5em auto;width: 400px;margin: 0 auto 0.5em;">

				 				Tu código de activación es <br><span style="color: #5bbaab;">'.$cod.'</span><br><br>
				 			</p>
						</div>

						<footer style="font-family: &quot;Lato&quot;, sans-serif;font-weight: 500;font-size: 14px;text-align: center;color: #8B8BA7;margin: 0 auto;padding: 0.5em 0;height: 40px;">
							
							<div class="contenedorRedes" style="width: 100px;height: 30px;padding: 5px 0;float: left;">
								<a href="#"><img src="https://cursoutnpwm.000webhostapp.com/img/mail/fb2.png" alt="fb" class="logoRed" style="width: 30px;height: 30px;"></a>
								<a href="#"><img src="https://cursoutnpwm.000webhostapp.com/img/mail/tw2.png" alt="tw" class="logoRed" style="width: 30px;height: 30px;"></a>
								<a href="#"><img src="https://cursoutnpwm.000webhostapp.com/img/mail/ig2.png" alt="ig" class="logoRed" style="width: 30px;height: 30px;"></a>
							</div>

							<div class="copyright" style="float: left;width: 332px;text-align: center;margin: 0.5em auto;">
								Valknut Travels - 2019
							</div>

						</footer>
					</div>
				</body>
				</html>';


		$dest = $mail;

		$subj = "Activación de cuenta";
		//Para poder usar HTML en el mail
		$header = "From: Valknut Travels"."\r\n";
		$header .= "MIME-Version: 1.0"."\r\n";
		$header .= "Content-type:text/html;charset=UTF-8"."\r\n";	

		if(mail($dest, $subj, $txt, $header))
		{
			$exito = 1;
		}

		return $exito;

	}

?>