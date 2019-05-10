<?php 

	include '../../functions/conexion.php';
	include '../../functions/roles.php';
	session_start();

	$id = $_SESSION['idUser'];

	if ($_SESSION['estilo']==2) {
		$_SESSION['estilo'] = "1";
		$sql = $con -> query("UPDATE usuario SET tipo_estilo=1 WHERE id_usuario='$id'");
	} else {
		$_SESSION['estilo'] = "2";
		$sql = $con -> query("UPDATE usuario SET tipo_estilo=2 WHERE id_usuario='$id'");
	}

	

	header('location:../users.php');

?>