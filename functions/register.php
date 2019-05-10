<?php 

	include 'conexion.php';

	if( empty($_POST) ) {
		header('location:../login.php?type=register');
	} else {

		$nombre 	= $_POST['nombre'];
		$apellido 	= $_POST['apellido'];
		$email 		= $_POST['email'];
		$password 	= $_POST['password'];
		$passwordR 	= $_POST['passwordRepeat'];
		$becado 	= $_POST['becado'];

		if (!empty($_FILES['foto']['name'])) 
		{
			$foto = $_FILES['foto']['name'];
			$img = "../pics/".uniqid().$foto;
			move_uploaded_file($_FILES['foto']['tmp_name'], $img);
		}
		else 
		{ 
			$img = "imgs/icons/default.png"; 
		}

		$c = "SELECT * FROM usuario WHERE email='$email'";
		$cc = $con -> query($c);

		$result = $cc -> fetch_array();

		if ( !$result['id_usuario'] ) 
		{

			if ($password === $passwordR) {
				$conss = "INSERT INTO usuario(nombre,apellido,foto,email,password,becado,role,llave,estado) VALUES('$nombre','$apellido','$img','$email','$password','$becado',1,0,1)";

				$query = $con -> query($conss);

			 	$consulta = "SELECT * FROM usuario WHERE email='$email' AND password='$password'";
				$cons = $con -> query($consulta);

				$row = $cons -> fetch_array();

			 	session_start();
			 	$_SESSION['idUser'] = $row['id_usuario'];
			 	$_SESSION['foto'] = $row['foto'];
			 	$_SESSION['becado'] = $row['becado'];
			 	$_SESSION['role'] = $row['role'];
			 	$_SESSION['changeRole'] = '2';


			 	header('location:../');
			} else {
			header('location:../login.php?type=register&error=password-No-Match');
			}

		} 
		else 
		{
			header('location:../login.php?type=register&error=mailRegistered');
		}

	};


?>