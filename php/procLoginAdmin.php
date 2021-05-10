<?php  

	include('dbcon.php');
	include('functions.php');

	//Posibles errores
	//1 -> Usr o pass incorrectos
	//2 -> Problema de conexion
	//3 -> Cuenta no admin
	//4 -> Campos vacios
	//5 -> Cuenta no activada

	$result = "";

	if(isset($_POST['submit']))
	{
		if(empty($_POST['usr']) || empty($_POST['pass']))
		{
			header("Location: ../admin.php?result=4");
		}
		else
		{
			$username = test_input($_POST['usr']);
			$pass = test_input($_POST['pass']);

			$conn = mysqli_connect($host, $user, $password, $db);

			//Verifico conexion exitosa
			if (mysqli_connect_errno()) 
			{
			    header("Location: ../admin.php?result=2");
			}

			$query = "SELECT id_usr, activado, admin FROM usuarios WHERE usr = '$username' AND pass = '$pass' LIMIT 1";
			$resultQuery = mysqli_query($conn, $query);

			//Si tengo algun tipo de problema con la query
			if (!$resultQuery) 
			{
				header("Location: ../admin.php?result=2");
			}

			if(mysqli_num_rows($resultQuery) > 0)
			{
				$row = mysqli_fetch_assoc($resultQuery);

				if($row['activado'] == 1 && $row['admin'] == 1)
				{
					//Comienzo sesion
					session_start(); //inicializa sesion
					$_SESSION['idusuario'] = $row['id_usr'];  //guarda el idusuario como variable de sesion
					header("Location: ../admin/adminPanel.php"); //redirecciona a visitas.php (listado de comentarios)
				}
				else
				{
					if($row['activado'] == 0)
					{
						header("Location: ../admin.php?result=5");
					}
					else
					{
						if($row['admin'] == 0)
						{
							header("Location: ../admin.php?result=3");
						}
					}
					
				}
			}
			else
			{
				header("Location: ../admin.php?result=1");
			}

			//Cierro la conexion con la BD
			mysqli_close($conn);
		}
	}
?>