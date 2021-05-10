<?php 
	
	include('dbcon.php');
	session_start();

	$idArt = $idUsr = $fecha = $coment = "";

	if(isset($_POST['submit']))
	{

		$coment = $_POST['coment'];
		$idArt = $_POST['idArt'];
		$fecha = date("Y-m-d H:i:s");
		$idUsr = $_SESSION['idusuario'];

		$result = insertarComentario();

		if($result == 1)
		{
			header("Location: ../articulo.php?numArt=$idArt&result=1#comentBox");
		}
		else
		{
			header("Location: ../articulo.php?numArt=$idArt&result=0#comentBox");
		}

	}



	function insertarComentario()
	{
		global $host; global $user; global $password; global $db;
		global $idArt; global $idUsr; global $fecha; global $coment;

		//Variable para confirmar que se pudieron hacer las queries
		$exito = "1";

		//Abro la conexion con la base de datos
		$conn = mysqli_connect($host, $user, $password, $db);

		//Verifico conexion
		if (mysqli_connect_errno()) 
		{
		    $exito = "0";
		}

		$query = "SELECT id_com FROM comentarios;";
		$resultQuery = mysqli_query($conn, $query);

		//Si tengo algun tipo de problema con la query
		if (!$resultQuery) 
		{
			$exito = "0";
		}

		$idCom = 0;

		if(mysqli_num_rows($resultQuery) > 0)
		{
			while($row = mysqli_fetch_assoc($resultQuery))
			{
				if($row['id_com'] > $idCom)
				{
					$idCom = $row['id_com'];
				}
			}
		}

		$idCom++;

		$query = "INSERT INTO comentarios(id_com, id_art_id, id_autor, fecha, comentario) 
				  VALUES ('$idCom','$idArt','$idUsr','$fecha','$coment');";

		$resultQuery = mysqli_query($conn, $query);

		//Si tengo algun tipo de problema con la query
		if (!$resultQuery) 
		{
			$exito = "0";
		}

		//Cierro la conexion con la BD
		mysqli_close($conn);

		return $exito;
	}



?>