<?php 

	include("../php/dbcon.php");
	include('../php/functions.php');
	session_start();

	//Posibles errores
	//1 -> Campos vacios        2 -> Titulo invalido         3 -> Lugar inválido
	//4 -> Problema con imagen  5 -> Extension invalida      6 -> Problema con BD 
	//7 -> Exito

	$result = "";

	$tit = $cont = $fecha = $idUsr = $lug = "";

	//Target lo uso para generar la ruta donde se guarda la imagen
	//imgArt es la imagen en si
	//destino es la ruta a la imagen guardada finalmente, 
	//es lo que voy a insertar en la base.

	$imgArt = $target = $destino = "";
	
	if(isset($_POST['submit']))
	{
		if(empty($_POST['tit']) || empty($_POST['cont']) || empty($_POST['lug']))
		{
			header("Location: subArt.php?result=1");
		}
		else
		{
			//Validacion del titulo
			$tit = test_input($_POST['tit']);

			//Chequeo con una expresion regular que solo contenga letras, numeros, signos de puntuacion y espacios
			if(!preg_match("/^[a-zA-Z0-9.,!\s]*$/", $tit))
			{
				$result .= "2";
			}

			//Validacion del titulo
			$lug = test_input($_POST['lug']);

			//Chequeo con una expresion regular que solo contenga letras o espacios
			if(!preg_match("/^[a-zA-Z\s]*$/", $lug))
			{
				$result .= "3";
			}

			//Validacion del contenido
			//No hago validacion del contenido
			$cont = $_POST['cont'];

			//Validacion de la imagen
			if($_FILES['imgArt']['name'] != "")
			{
				//La voy a guardar con el nombre original y el horario en
				//el cual la subio concantenados para evitar problemas de nombres iguales de imagenes
				$imgArt = $_FILES['imgArt']['tmp_name'];

				$nomImgFin = time().'_'.$_FILES['imgArt']['name'];

				//Cuando la persona selecciona una imagen con el dialogo de
				//busqueda del input type file, php la guarda en una carpeta temporal
				//Tiene que ser movida a la carpeta donde se guarden todas las imagenes
				//Para eso usamos el target
				$target = "../img/blog/$nomImgFin";

				$imgExt = strtolower(pathinfo($target,PATHINFO_EXTENSION));

				if($imgExt != "jpg" && $imgExt != "png" && $imgExt != "jpeg") 
				{
				    $result .= 5;
				}

				//Uso la variable subir para saber si la imagen
				//reune las condiciones para ser subida (Extension)
				//Esta funcion es propia de PHP y permite mover la imagen
				if(!move_uploaded_file($imgArt, $target))
				{
					$result .= 4;
				}
				else
				{
					$destino = "img/blog/$nomImgFin";
				}
				
			}
			else
			{
				$result .= 1;
			}

			//Fecha de subida
			$fecha = date("Y-m-d H:i:s");

			//if del autor
			$idUsr = $_SESSION['idusuario'];

			if($result != "")
			{
				header("Location: subArt.php?result=$result");
			}
			else
			{
				$resultSubArt = subirArticulo();

				if($resultSubArt == 1)
				{
					header("Location: subArt.php?result=7");
				}
				else
				{
					header("Location: subArt.php?result=6");
				}
			}

			
		}
	}

	function subirArticulo()
	{
		global $host; global $user; global $password; global $db;
		global $destino; global $tit; global $cont; global $fecha; global $idUsr; global $lug;

		$exito = "1";

		$conn = mysqli_connect($host, $user, $password, $db);

		//Verifico conexion exitosa
		if (mysqli_connect_errno()) 
		{
		    echo "Error en conexion con BD";
		}

		$query = "SELECT id_art FROM articulos;";
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
				if($row['id_art'] > $id)
				{
					$id = $row['id_art'];
				}
			}
		}

		$id++;
		
		//query para insertar el articulo
		$query = "INSERT INTO articulos(id_art, lugar, titulo, img, banner, autor, fecha, contenido)
		VALUES ('$id', '$lug', '$tit','$destino', '$destino', '$idUsr','$fecha','$cont');";

		$resultQuery = mysqli_query($conn, $query);

		//Si tengo algun tipo de problema con la query
		if (!$resultQuery) 
		{
			die('Error: ' . mysqli_error($conn));
			$exito = "0";
		}

		return $exito;

	}

?>