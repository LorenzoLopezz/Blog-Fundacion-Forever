<?php 

	session_start();
	include 'conexion.php';

	$type = $_POST['type'];
	$id = $_POST['id'];
	$idUser = $_SESSION['idUser'];

	if ($id != "") {

		$comp = $con -> query("SELECT * FROM reaction_coments WHERE id_comentario='$id' AND id_usuario='$idUser'");

		$countt = $comp -> num_rows;
		$countt = $comp -> fetch_array();

		if ($countt > 0) {
			$sql = $con -> query("DELETE FROM reaction_coments WHERE id_comentario='$id' AND id_usuario='$idUser'");

			$tipo = $countt['tipo'];

			if ($type != $tipo) {
				$sql = $con -> query("INSERT INTO reaction_coments(id_comentario,id_usuario,tipo) VALUES('$id','$idUser','$type')");
			}
		}
		else
		{
			$sql = $con -> query("INSERT INTO reaction_coments(id_comentario,id_usuario,tipo) VALUES('$id','$idUser','$type')");
		};

	}

		$selectD = $con -> query("SELECT * FROM reaction_coments WHERE id_comentario='$id' AND tipo='0'");
		$selectL = $con -> query("SELECT * FROM reaction_coments WHERE id_comentario='$id' AND tipo='1'");

		$countD = $selectD -> num_rows;
		$countL = $selectL -> num_rows;

		$array = array();

		$array['disl'] = $countD;
		$array['like'] = $countL;

		echo json_encode($array);
?>