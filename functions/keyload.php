<?php
	
	session_start();
	include 'conexion.php';
	include 'roles.php';

	$pass = $_POST['password'];
	$id_user = $_SESSION['idUser'];
	$redir = $_POST['redir'];
	$idP = $_POST['idp'];

	$sql = $con -> query("SELECT * FROM adminkeys WHERE llave='$pass' AND propietario='$id_user'");

	$row = $sql -> fetch_array();

	if( !$row['id_key'] )
	{
		header('location:adminKey.php?error=NoExist');
	}
	else 
	{
		$_SESSION['key'] = "true";

		if ($redir == '1') {
			header('location:../admin/functions/editNote.php?id='.$idP);
		} else {
			header('location:../'.$linkAdmin);
		};
		
	}

?>