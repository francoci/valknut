<?php  

include('dbcon.php');
include('functions.php');

//Valores de errores
//0 -> No hay errores, cuenta activada    
//1 -> Codigo incorrecto o cuenta activada          
//2 -> Error de conexion o similar
//3 -> Campo no completado
$result = "";

if(isset($_POST['submit']))
{
	if(empty($_POST['cod']))
	{
		header("Location: ../activar.php?result=3");
	}
	else
	{
		$codigo = test_input($_POST['cod']);

		//Abro la conexion con la base de datos
		$conn = mysqli_connect($host, $user, $password, $db);

		//Verifico conexion
		if (mysqli_connect_errno()) 
		{
		    header("Location: ../activar.php?result=2");
		}

		$query = "SELECT * FROM usuarios WHERE cod = '$codigo'  AND activado = 0 LIMIT 1;";

		$resultQuery = mysqli_query($conn, $query);

		//Si tengo algun tipo de problema con la query
		if (!$resultQuery) 
		{
			header("Location: ../activar.php?result=2");
		}

		if(mysqli_num_rows($resultQuery) > 0)
		{
			$query = "UPDATE usuarios SET activado = 1 WHERE cod = '$codigo' LIMIT 1;";

			$resultQuery = mysqli_query($conn, $query);

			if (!$resultQuery) 
			{
				header("Location: ../activar.php?result=2");
			}
			else
			{
				header("Location: registered.php?success=2");
			}
		}
		else
		{
			header("Location: ../activar.php?result=1");
		}

		//Cierro la conexion con la BD
		mysqli_close($conn);
	}
}

?>