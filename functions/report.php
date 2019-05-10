<?php 

	session_start();
	include 'conexion.php';


	$type = $_POST['type'];
	$id = $_POST['id'];
	$user = $_SESSION['idUser'];
	$cont = $_POST['content'];

	$array = array();

	if ($cont != "") {

		$cons = $con -> query("INSERT INTO reportes(tipo,reported,id_usuario,contenido,respuesta,estado) VALUES('$type','$id','$user','$cont','',1)");
		$array['exito'] = "Tu reporte ha sido enviado con éxito, si es necesario nos pondremos en contacto contigo.";

	} else {
		$array['error'] = "No has llenado el campo de justificación";
	}

	echo json_encode($array);
?>