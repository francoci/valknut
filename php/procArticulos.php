<?php 

	include('dbcon.php');

	$titulo = $img = $autor = $fecha = $contenido = "";



	function cargarArt($idArticulo)
	{
		global $titulo; global $img; global $autor; global $fecha; global $contenido;
		global $host; global $user; global $password; global $db;

		$result = "1";

		$conn = mysqli_connect($host, $user, $password, $db);

		//Verifico conexion exitosa
		if (mysqli_connect_errno()) 
		{
		    echo "Error en conexion con BD";
		    $result = "0";
		}
	
		//query para que devuelva los datos del articulo
		$query = "SELECT * FROM articulos INNER JOIN usuarios ON autor = id_usr WHERE id_art='$idArticulo' LIMIT 1;";

		$resultQuery = mysqli_query($conn, $query);

		if(!$resultQuery)
		{
			echo "Error en la query";
		    $result = "0";
		}

		//capturo la fila
		$row = mysqli_fetch_array($resultQuery);

		$titulo = $row['titulo'];
		$img = $row['img'];
		$autor = $row['nombre'];
		$fecha = $row['fecha'];
		$contenido = $row['contenido'];	

		return $result;
	}


?>