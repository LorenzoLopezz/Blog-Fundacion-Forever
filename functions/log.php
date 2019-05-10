<?php 

	date_default_timezone_set('America/El_Salvador');

	if (empty($_POST)) {
		header('location:../index.php');
	} else {

		include 'conexion.php';

		$email = $_POST['email'];
		$passw = $_POST['password'];

		$consulta = "SELECT * FROM usuario WHERE email='$email' AND password='$passw'";
		$result = $con->query($consulta);

		$row = $result -> fetch_array();

		if ( !$row['id_usuario'] ) 
		{

		 	header('location:../login.php?error=UserNotExist');

		 } 
		 else 
		 {
		 	
		 	session_start();
		 	$_SESSION['idUser'] = $row['id_usuario'];
		 	$_SESSION['foto'] = $row['foto'];
		 	$_SESSION['becado'] = $row['becado'];
		 	$_SESSION['estilo'] = $row['tipo_estilo'];

		 	$idUser = $row['id_usuario'];
		 	$role = $row['role'];

		 	if ( $role != "1" ) 
		 		{

				 	$ident = $con -> query("SELECT * FROM adminkeys WHERE propietario='$idUser'");
				 	$rowIdent = $ident -> fetch_array(); 

			 	if ( !$rowIdent['id_key'] ) 
			 		{
				 		$change = $con -> query("UPDATE usuario SET role='1' WHERE id_usuario='$idUser'");
				 		$_SESSION['role'] ='1';
				 		$_SESSION['changeRole'] = '1';
			 	} 
			 	else if( $rowIdent['id_key'] )
			 	{
			 		$_SESSION['changeRole'] = '2';
			 		$_SESSION['role'] = $row['role'];
			 	}

			} 
			else 
			{
				$_SESSION['changeRole'] = '3';
			 	$_SESSION['role'] = $row['role'];
			};

		 	header('location:../');

		 };

	 $con -> close();
	
	};

?>