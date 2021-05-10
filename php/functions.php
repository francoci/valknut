<?php  

	include('dbcon.php');

	function nombre_usuario($idusuario)
	{
		global $host; global $user; global $password; global $db;

		$conn = mysqli_connect($host, $user, $password, $db);

		//Verifico conexion exitosa
		if (mysqli_connect_errno()) 
		{
		    echo "Error en conexion con BD";
		}
	
		//query para que devuelva nombre y apellido
		$query = "SELECT nombre FROM usuarios WHERE id_usr='$idusuario';";

		$resultQuery = mysqli_query($conn, $query);

		//capturo la fila
		$row = mysqli_fetch_array($resultQuery);

		//Cierro la conexion con la BD
		mysqli_close($conn);

		return $row['nombre'];
	}


	function imagen($idusuario)
	{
		global $host; global $user; global $password; global $db;

		$conn = mysqli_connect($host, $user, $password, $db);

		//Verifico conexion exitosa
		if (mysqli_connect_errno()) 
		{
		    echo "Error en conexion con BD";
		}
	
		$query = "SELECT imagen FROM usuarios WHERE id_usr='$idusuario';";

		$resultQuery = mysqli_query($conn, $query);

		//capturo la fila
		$row = mysqli_fetch_array($resultQuery);

		//Cierro la conexion con la BD
		mysqli_close($conn);

		return $row['imagen'];
	}


	function email($idusuario)
	{
		global $host; global $user; global $password; global $db;

		$conn = mysqli_connect($host, $user, $password, $db);

		//Verifico conexion exitosa
		if (mysqli_connect_errno()) 
		{
		    echo "Error en conexion con BD";
		}
	
		$query = "SELECT email FROM usuarios WHERE id_usr='$idusuario';";

		$resultQuery = mysqli_query($conn, $query);

		//capturo la fila
		$row = mysqli_fetch_array($resultQuery);

		//Cierro la conexion con la BD
		mysqli_close($conn);

		return $row['email'];
	}


	function usr($idusuario)
	{
		global $host; global $user; global $password; global $db;

		$conn = mysqli_connect($host, $user, $password, $db);

		//Verifico conexion exitosa
		if (mysqli_connect_errno()) 
		{
		    echo "Error en conexion con BD";
		}
	
		$query = "SELECT usr FROM usuarios WHERE id_usr='$idusuario';";

		$resultQuery = mysqli_query($conn, $query);

		//capturo la fila
		$row = mysqli_fetch_array($resultQuery);

		//Cierro la conexion con la BD
		mysqli_close($conn);

		return $row['usr'];
	}


	function revisa_login()
	{
		global $host; global $user; global $password; global $db;

		$login = "";
		//isset -> Si la variable existe y tiene un valor puesto.
		if(isset($_SESSION['idusuario']) == false)
		{
			$login = 0;
		}
		else
		{
			$idusuario = $_SESSION['idusuario'];

			$conn = mysqli_connect($host, $user, $password, $db);

			//Verifico conexion exitosa
			if (mysqli_connect_errno()) 
			{
		   		echo "Error en conexion con BD";
			}
	
			$query = "SELECT admin FROM usuarios WHERE id_usr='$idusuario';";

			$resultQuery = mysqli_query($conn, $query);

			//capturo la fila
			$row = mysqli_fetch_array($resultQuery);

			if($row['admin'] == 0)
			{
				$login = 1;
			}
			else
			{
				$login = 2;
			}

			//Cierro la conexion con la BD
			mysqli_close($conn);
			
		}

		return $login;
	}

	function verificarSesionAdmin()
	{
		global $host; global $user; global $password; global $db;

		//isset -> Si la variable existe y tiene un valor puesto.
		if(isset($_SESSION['idusuario']))
		{
			$idusuario = $_SESSION['idusuario'];

			$conn = mysqli_connect($host, $user, $password, $db);

			//Verifico conexion exitosa
			if (mysqli_connect_errno()) 
			{
		   		echo "Error en conexion con BD";
			}
	
			$query = "SELECT admin FROM usuarios WHERE id_usr='$idusuario';";

			$resultQuery = mysqli_query($conn, $query);

			//capturo la fila
			$row = mysqli_fetch_array($resultQuery);

			if($row['admin'] == 0)
			{
				cerrarSesion();
			}
			else
			{
				header("Location: admin/adminPanel.php");
			}

			//Cierro la conexion con la BD
			mysqli_close($conn);
		}

	}


	function cerrarSesion()
	{
		if(isset($_SESSION['idusuario']))
		{
			session_destroy();
		}
	}


	function validarExistMail($email)
	{
		global $host; global $user; global $password; global $db;

		$exist = 0;

		//Abro la conexion con la BD

	 	$conn = mysqli_connect($host, $user, $password, $db);

		// Chequeo que la conexion se haya hecho correctamente
		
		if (mysqli_connect_errno()) 
		{
		  echo "Conexión con bd fallida: ". mysqli_connect_error();
		  exit();
		}

		//Armo el query para asegurarme que el mail no este siendo usado.
		$query = "SELECT email FROM usuarios WHERE email='$email';";

		//Ejecuto el query
		$resultQuery = mysqli_query($conn,$query);

		if(mysqli_num_rows($resultQuery) > 0)
		{
			$exist = 1;
		}

		//Cierro la conexion con la BD
		mysqli_close($conn);

		return $exist;
	}


	function validarExistUsr($usuario)
	{
		global $host; global $user; global $password; global $db;

		$exist = 0;

		//Abro la conexion con la BD

	 	$conn = mysqli_connect($host, $user, $password, $db);

		// Chequeo que la conexion se haya hecho correctamente
		
		if (mysqli_connect_errno()) 
		{
		  echo "Conexión con bd fallida: ". mysqli_connect_error();
		  exit();
		}

		//Armo el query para asegurarme que el usuario no este siendo usado.
		$query = "SELECT usr FROM usuarios WHERE usr='$usuario';";

		//Ejecuto el query
		$resultQuery = mysqli_query($conn,$query);

		if(mysqli_num_rows($resultQuery) > 0)
		{
			$exist = 1;
		}

		//Cierro la conexion con la BD
		mysqli_close($conn);

		return $exist;
	}

	// La funcion test_input se utiliza para limpiar un poco lo ingresado por la persona

	function test_input($data)
	{	
		//Trim() remueve espacios en blanco.
		$data = trim($data);

		//stripslashes() remueve las contrabarras (\)
		$data = stripslashes($data);

		//htmlspecialchars() convierte ciertos caracteres predefinidos en entidades HTML
		$data = htmlspecialchars($data);

		return $data;
	}

?>