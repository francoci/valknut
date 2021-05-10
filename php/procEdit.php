<?php 
	
	include('dbcon.php');
	include('functions.php');
	session_start();

	//Posibles Errores
	//1 -> Nombre invalido                     2 -> Mail invalido                 3 -> Usuario invalido
	//4 -> Contraseña invalida                 5 -> Problema con la imagen        6 -> Problema conexion BD
	//7 -> Cambios guardados correctamente     8 -> Mail ya en uso                9 -> Usuario ya en uso

	$nom = $mail = $usr = $pass = "";
	$result = "";

	//Target lo utilizo para la funcion que permite mover la imagen
	//Destino es lo que voy a grabar en la BD
	$profImg = $target = $destino = "";
	
	if(isset($_POST['submit']))
	{
		//mail, usr, pass
		if(!empty($_POST['nom']))
		{
			//Validacion del nombre
			$nom = test_input($_POST['nom']);

			//Chequeo con una expresion regular que solo contenga letras y espacios
			if(!preg_match("/^[a-zA-Z\s]*$/", $nom))
			{
				$result .= "1";
			}

		}

		if(!empty($_POST['mail']))
		{
			//Validacion mail
			$mail = test_input($_POST['mail']);

			//Convierto a minusculas
			$mail = strtolower($mail);

			//Con filter_var() chequeo que el formato del email sea correcto.
			//Es una funcion propia de PHP, y se usa el filtro FILTER_VALIDATE_EMAIL que ya esta predefinido en PHP.
			if(!filter_var($mail, FILTER_VALIDATE_EMAIL))
			{
				$result .= "2";
			}
			else
			{
				$existe = validExistMail($mail);
				if($existe == 1)
				{
					$result .= "8";
				}
			}
		}

		if(!empty($_POST['usr']))
		{

			//Validacion nombre de usuario
			$usr = test_input($_POST['usr']);

			$long = strlen($usr);

			//Chequeo con una expresion regular que solo contenga letras y/o numeros
			//Que tenga como minimo 5 caracteres y como maximo 15
			if(!preg_match("/^[a-zA-Z0-9]*$/", $usr) || $long < 5 || $long > 15)
			{
				$result .= "3";
			}
			else
			{
				$existe = validExistUsr($usr);
				if($existe == 1)
				{
					$result .= "9";
				}
			}
		}

		if(!empty($_POST['pass']))
		{
			//Validacion de la contraseña
			$pass = test_input($_POST['pass']);

			$longPass = strlen($pass);

			//Solo valido que tenga entre 5 y 30 caracteres y letras/numeros
			if(!preg_match("/^[a-zA-Z0-9]*$/", $pass) || $longPass < 5 || $longPass > 30)
			{
				$result .= "4";
			}
		}

		if($_FILES['imgUser']['name'] != "")
		{
			//La voy a guardar con el nombre original y el horario en
			//el cual la subio concantenados para evitar problemas de nombres iguales de imagenes
			$profImg = $_FILES['imgUser']['tmp_name'];

			$nomImgFin = time().'_'.$_FILES['imgUser']['name'];

			//Cuando la persona selecciona una imagen con el dialogo de
			//busqueda del input type file, php la guarda en una carpeta temporal
			//Tiene que ser movida a la carpeta donde se guarden todas las imagenes
			//Para eso usamos el target
			$target = "../img/img_usuarios/$nomImgFin";

			//Esta funcion es propia de PHP y permite mover la imagen
			if(!move_uploaded_file($profImg, $target))
			{
				$result .= 5;
			}
			else
			{
				$destino = "img/img_usuarios/$nomImgFin";
			}
		}

		if($result != "")
		{
			header("Location: ../perfil.php?result=$result");
		}
		else
		{
			$resultActu = actualizarDatos();

			if($resultActu == 1)
			{
				header("Location: ../perfil.php?result=7");
			}
			else
			{
				header("Location: ../perfil.php?result=6");
			}
		}

	}


	function validExistMail($email)
	{
		global $host; global $user; global $password; global $db;

		$exist = 0;

		$id = $_SESSION['idusuario'];

		//Abro la conexion con la BD

	 	$conn = mysqli_connect($host, $user, $password, $db);

		// Chequeo que la conexion se haya hecho correctamente
		
		if (mysqli_connect_errno()) 
		{
		  echo "Conexión con bd fallida: ". mysqli_connect_error();
		  exit();
		}

		//Armo el query para asegurarme que el codigo no este siendo usado.
		$query = "SELECT id_usr, email FROM usuarios WHERE email='$email';";

		//Ejecuto el query
		$resultQuery = mysqli_query($conn,$query);

		if(mysqli_num_rows($resultQuery) > 0)
		{
			$row = mysqli_fetch_array($resultQuery);
			if($row['id_usr'] != $id)
			{
				$exist = 1;
			}
		}

		//Cierro la conexion con la BD
		mysqli_close($conn);

		return $exist;
	}



	function validExistUsr($usuario)
	{
		global $host; global $user; global $password; global $db;

		$exist = 0;

		$id = $_SESSION['idusuario'];

		//Abro la conexion con la BD

	 	$conn = mysqli_connect($host, $user, $password, $db);

		// Chequeo que la conexion se haya hecho correctamente
		
		if (mysqli_connect_errno()) 
		{
		  echo "Conexión con bd fallida: ". mysqli_connect_error();
		  exit();
		}

		//Armo el query para asegurarme que el codigo no este siendo usado.
		$query = "SELECT id_usr, usr FROM usuarios WHERE usr='$usuario';";

		//Ejecuto el query
		$resultQuery = mysqli_query($conn,$query);

		if(mysqli_num_rows($resultQuery) > 0)
		{
			$row = mysqli_fetch_array($resultQuery);
			if($row['id_usr'] != $id)
			{
				$exist = 1;
			}
		}

		//Cierro la conexion con la BD
		mysqli_close($conn);

		return $exist;
	}



	function actualizarDatos()
	{
		global $host; global $user; global $password; global $db;
		global $nom; global $mail; global $usr; global $pass; global $destino;

		$id = $_SESSION['idusuario'];

		$query = "UPDATE usuarios SET nombre = '$nom', email = '$mail', usr = '$usr' WHERE id_usr = '$id';";

		if($pass != "" && $destino != "")
		{
			$query = "UPDATE usuarios SET nombre = '$nom', email = '$mail', usr = '$usr', 
			pass = '$pass', imagen = '$destino' WHERE id_usr = '$id';";
		}
		
		if($pass == "" && $destino != "")
		{
			$query = "UPDATE usuarios SET nombre = '$nom', email = '$mail', usr = '$usr', 
			imagen = '$destino' WHERE id_usr = '$id';";
		}

		if($pass != "" && $destino == "")
		{
			$query = "UPDATE usuarios SET nombre = '$nom', email = '$mail', usr = '$usr', 
			pass = '$pass' WHERE id_usr = '$id';";
		}

		$resultUpd = "1";

		$conn = mysqli_connect($host, $user, $password, $db);

		//Verifico conexion exitosa
		if (mysqli_connect_errno()) 
		{
			$resultUpd = "0";
		}

		$resultQuery = mysqli_query($conn, $query);

		if(!$resultQuery)
		{
			$resultUpd = "0";
		}

		return $resultUpd;
		
	}

?>