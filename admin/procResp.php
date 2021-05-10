<?php  
	
	include("../php/dbcon.php");

	$mensaje = $id = $mailDest = $nom = "";

	if(isset($_POST['submit']))
	{
		$mensaje = $_POST['resp'];
		$id = $_POST['id'];

		$conn = mysqli_connect($host, $user, $password, $db);

		//Verifico conexion exitosa
		if (mysqli_connect_errno()) 
		{
		    echo "Error en conexion con BD";
		}
	
		//query para que devuelva el email asociado a la consulta
		$query = "SELECT nombre, email FROM consultas WHERE id_consult='$id';";

		$resultQuery = mysqli_query($conn, $query);

		//capturo la fila
		$row = mysqli_fetch_array($resultQuery);

		$mailDest = $row['email'];
		$nom = $row['nombre'];

		$exito = enviarMailResp();

		if($exito == 1)
		{
			//query para actualizar el registro
			$query = "UPDATE consultas SET respondida = 1 WHERE id_consult='$id';";

			$resultQuery = mysqli_query($conn, $query);

			if($resultQuery)
			{
				mysqli_close($conn);
				header("Location: respConsulta.php?result=0&numCons=".$id);
			}
			else
			{
				mysqli_close($conn);
				header("Location: respConsulta.php?result=2&numCons=".$id);
			}
		}
		else
		{
			//Cierro la conexion con la BD
			mysqli_close($conn);
			header("Location: respConsulta.php?result=1&numCons=".$id);
		}

		

	}

	function enviarMailResp()
	{
		global $mensaje; global $mailDest; global $nom;

		$result = "0";

		//Datos mail
		//Mail 1
		$head = "De: <Valknut Travels>";

		//Para poder usar HTML en el mail
		$head .= "MIME-Version: 1.0"."\r\n";
		$head .= "Content-type:text/html;charset=UTF-8"."\r\n";

		$subj = "Respuesta a tu consulta - Valknut Travels";

		$txt = '<html>
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
						Valida tu cuenta de Valknut
					</div>

					<div class="email-container" style="max-width: 500px;background-color: #F5F6F6;padding: 1em;margin: 0 auto;overflow: hidden;border-radius: 5px;">
						
					<div class="contenedorImg" style="width: 100px;height: 100px;margin: 0.5em auto;">
						<img src="https://cursoutnpwm.000webhostapp.com/img/mail/logo2.png" alt="" style="width: 100%;height: 100%;">
					</div>

					<p style="font-family: &quot;Lato&quot;, sans-serif;color: #30baa4;font-weight: 700;text-align: center;font-size: 2.2em;margin: 0.5em auto;">

					¡Gracias por tu consulta!

					</p>

					<p class="parrafo2" style="font-family: &quot;Lato&quot;, sans-serif;color: #4a9186;font-weight: 500;text-align: justify;font-size: 1.4em;margin: 0.5em auto;width: 400px;margin: 0 auto 0.5em;">

					Hola, '.$nom.'!<br>'.$mensaje.'<br><br>-Valknut Travels</p>

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

		if(mail($mailDest, $subj, $txt, $head))
		{
			$result = "1";
		}

		return $result;
	}

?>