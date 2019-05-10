<?php 

	session_start();
	include 'conexion.php';

	$type = $_POST['typeAction'];

	switch ($type) {
		case 'delComment':
				$idComment = $_POST['idComment'];
				echo $idComment;
				$sql = $con -> query("DELETE FROM comments WHERE id_comentario='$idComment'");
				echo 'Se ha eliminado el comentario';
			break;
		
		default:
			echo 'La función que se ha solicitado no existe.';
			break;
	}



?>