<?php 

	include('../php/dbcon.php');

	function cargarConsultas()
	{
		global $nom; global $mail;
		global $host; global $user; global $password; global $db;

		$conn = mysqli_connect($host, $user, $password, $db);

		//Verifico conexion exitosa
		if (mysqli_connect_errno()) 
		{
			echo "<h2>No se pudieron cargar las consultas.</h2>";
		}
		
		//query para que devuelva los datos del articulo
		$query = "SELECT id_consult, nombre, email FROM consultas WHERE respondida = 0 ORDER BY id_consult ASC LIMIT 5;";

		$resultQuery = mysqli_query($conn, $query);

		if(!$resultQuery)
		{
			echo "<h2>No se pudieron cargar las consultas.</h2>";
		}

		if(mysqli_num_rows($resultQuery) > 0)
		{

			echo "<table>
				  <tr>
					<td class = 'titulo'>Nro.</td>
					<td class = 'titulo'>Nombre</td>
					<td class = 'titulo'>Mail</td>
					<td class = 'titulo'>Responder</td>
				  </tr>";

			while($row = mysqli_fetch_array($resultQuery)) 
			{	
							
				echo "<tr>";
				echo "<td class = 'dato'>".$row['id_consult']."</td>";
				echo "<td class = 'dato'>".$row['nombre']."</td>";
				echo "<td class = 'dato'>".$row['email']."</td>";
				echo "<td><a class = 'boton' href = 'respConsulta.php?numCons=".$row['id_consult']."'>Responder</a></td>";
				echo "</tr>";
							 
			}

			echo "</table>";
		}
		else
		{
			echo "<h2>No hay consultas pendientes.</h2>";
		}
	}


	function consulta($idconsulta)
	{
		global $host; global $user; global $password; global $db;

		$conn = mysqli_connect($host, $user, $password, $db);

		//Verifico conexion exitosa
		if (mysqli_connect_errno()) 
		{
			echo "<h2>No se pudo cargar la consulta.</h2>";
		}
		
		//query para que devuelva los datos del articulo
		$query = "SELECT id_consult, nombre, email, consulta FROM consultas WHERE id_consult = '$idconsulta' LIMIT 1;";

		$resultQuery = mysqli_query($conn, $query);

		if(!$resultQuery)
		{
			echo "<h2>No se pudo cargar la consulta.</h2>";
		}

		if(mysqli_num_rows($resultQuery) > 0)
		{
			$row = mysqli_fetch_array($resultQuery);

			echo "<h4>Respondiendo a: ".$row['nombre']." - ".$row['email']."</h4>
				  <p class = 'contConsult'>Consulta:<br><br>".$row['consulta']."</p>";
		}

	}
?>