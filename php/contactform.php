<?php 
	
	include('dbcon.php');
	include('functions.php');

	$nom = $mail = $men = "";

	//Posibles errores
	//0 -> Sin errores          1 -> Algun campo incompleto          2 -> Error en el nombre
	//3 -> Error en el mail     4 -> Error en el mensaje             5 -> Error en el envio
	$error = "";

	//$_SERVER["REQUEST_METHOD"] == "POST"
	if(isset($_POST['submit']))
	{
		if(empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['mensaje']))
		{
			header("Location: ../contacto.php?error=1");
			exit();
		}
		else
		{
			//Validacion nombre
			$nom = test_input($_POST['nombre']);

			if(!preg_match("/^[a-zA-Z\s]*$/", $nom))
			{
				$error .= 2;
			}

			//Validacion mail
			$mail = test_input($_POST['email']);

			//Convierto a minusculas
			$mail = strtolower($mail);

			//Con filter_var() chequeo que el formato del email sea correcto.
			//Es una funcion propia de PHP, y se usa el filtro FILTER_VALIDATE_EMAIL que ya esta predefinido en PHP.
			if(!filter_var($mail, FILTER_VALIDATE_EMAIL))
			{
				$error .= 3;
			}

			$men = test_input($_POST['mensaje']);
		}
		
		if($error == "")
		{
			$exito = insertarConsulta();

			if($exito == 1)
			{
				enviarMail();
			}
			else
			{
				header("Location:../contacto.php?error=5");
				exit();
			}
		
		}
		else
		{
			header("Location: ../contacto.php?error=$error");
			exit();
		}
	}

	

	function insertarConsulta()
	{
		global $nom; global $mail; global $men;
		global $host; global $user; global $password; global $db;

		$result = "1";

		$conn = mysqli_connect($host, $user, $password, $db);

		//Verifico conexion exitosa
		if (mysqli_connect_errno()) 
		{
		    echo "Error en conexion con BD";
		    $result = "0";
		}
		
		$query = "SELECT id_consult FROM consultas;";
		$resultQuery = mysqli_query($conn, $query);

		//Si tengo algun tipo de problema con la query
		if (!$resultQuery) 
		{
			echo 'Error: ' . mysqli_error($conn);
			$result = "0";
		}

		$id = 0;

		if(mysqli_num_rows($resultQuery) > 0)
		{
			while($row = mysqli_fetch_assoc($resultQuery))
			{
				if($row['id_consult'] > $id)
				{
					$id = $row['id_consult'];
				}
			}
		}

		$id++;

		$query = "INSERT INTO consultas(id_consult, nombre, email, consulta, respondida)
		VALUES ('$id','$nom','$mail','$men', 0);";

		$resultQuery = mysqli_query($conn, $query);

		//Si tengo algun tipo de problema con la query
		if (!$resultQuery) 
		{
			echo 'Error: ' . mysqli_error($conn);
			$result = "0";
		}

		//Cierro la conexion con la BD
		mysqli_close($conn);

		return $result;
	}




	function enviarMail()
	{
		global $nom; global $mail; global $men; global $error;
		
		//Mail 1

		$head1 = "De: <".$nom." ".$mail.">";

		//Para poder usar HTML en el mail
		$head1 .= "MIME-Version: 1.0"."\r\n";
		$head1 .= "Content-type:text/html;charset=UTF-8"."\r\n";

		$dest1 = "francoacipolla@gmail.com";

		$subj1 = "Nuevo mensaje en Valknut";

		$txt1 = '<html>
					<head>
					<style type="text/css">
						
						@import url("https://fonts.googleapis.com/css?family=Lato:400,900,900i");

						.email-background
						{
						  background-color: #c6c6c6;
						  padding: 1em 1em 0;
						  max-width: 532px;
						  height: auto;
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
						  height: 500px;
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
						Nuevo mensaje en Valknut
					</div>

					<div class="email-container" style="max-width: 500px;background-color: #F5F6F6;padding: 1em;margin: 0 auto;overflow: hidden;border-radius: 5px;">
						
					<div class="contenedorImg" style="width: 100px;height: 100px;margin: 0.5em auto;">
						<img src="https://cursoutnpwm.000webhostapp.com/img/mail/logo2.png" alt="" style="width: 100%;height: 100%;">
					</div>

					<p style="font-family: &quot;Lato&quot;, sans-serif;color: #30baa4;font-weight: 700;text-align: center;font-size: 2.2em;margin: 0.5em auto;">

					¡Nuevo mensaje en Valknut!

					</p>

					<p class="parrafo2" style="font-family: &quot;Lato&quot;, sans-serif;color: #4a9186;font-weight: 500;text-align: justify;font-size: 1.4em;margin: 0.5em auto;width: 400px;margin: 0 auto 0.5em;">

					De: '.$nom.' <'.$mail.'> 
					<br>Mensaje: <br><br>'.$men.'</p>

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


		//Mail 2

		$head2 = "De: Valknut Travels";

		//Para poder usar HTML en el mail
		$head2 .= "MIME-Version: 1.0"."\r\n";
		$head2 .= "Content-type:text/html;charset=UTF-8"."\r\n";

		$dest2 = $mail;

		$subj2 = "Gracias por tu mensaje";

		$txt2 = '<html>
					<head>
					<style type="text/css">
						
						@import url("https://fonts.googleapis.com/css?family=Lato:400,900,900i");

						.email-background
						{
						  background-color: #c6c6c6;
						  padding: 1em 1em 0;
						  max-width: 532px;
						  height: auto;
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
						  height: 500px;
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
						Gracias por tu mensaje
					</div>

					<div class="email-container" style="max-width: 500px;background-color: #F5F6F6;padding: 1em;margin: 0 auto;overflow: hidden;border-radius: 5px;">
						
					<div class="contenedorImg" style="width: 100px;height: 100px;margin: 0.5em auto;">
						<img src="https://cursoutnpwm.000webhostapp.com/img/mail/logo2.png" alt="" style="width: 100%;height: 100%;">
					</div>

					<p style="font-family: &quot;Lato&quot;, sans-serif;color: #30baa4;font-weight: 700;text-align: center;font-size: 2.2em;margin: 0.5em auto;">

					¡Gracias por tu consulta!

					</p>

					<p class="parrafo2" style="font-family: &quot;Lato&quot;, sans-serif;color: #4a9186;font-weight: 500;text-align: justify;font-size: 1.4em;margin: 0.5em auto;width: 400px;margin: 0 auto 0.5em;">

					Hola, '.$nom.', este es un mail autogenerado para confirmarte que recibimos tu consulta y nos pondremos en contacto pronto.
					<br><br>-Valknut Travels</p>

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

		if(mail($dest1, $subj1, $txt1, $head1) && mail($dest2, $subj2, $txt2, $head2))
		{
			header("Location:../contacto.php?error=0");
			exit();
		}
		else
		{
			header("Location:../contacto.php?error=5");
			exit();
		}	
		
	}

?>