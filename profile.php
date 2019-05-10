<?php 

	session_start();
	include 'functions/conexion.php';
	include 'functions/roles.php';

	if (!empty($_GET['idP'])) 
	{
		$idU = $_GET['idP'];
		$sql = $con -> query("SELECT * FROM usuario WHERE id_usuario='$idU'");
		$row = $sql -> fetch_array();

		if (!$row['id_usuario']) {
			$estado = 'notExist';
			$nombre = "No existe él usuario que solicito";
		} else {
			if ($row['estado'] === "1") {

				$nombre = $row['nombre']." ".$row['apellido'];

				if ($row['foto'] === "") {
					$photo = "imgs/icons/default.png";
				} else { $photo = $row['foto']; }

				$idRole = $row['role'];
				$cons = $con -> query("SELECT nombre FROM roles WHERE id_role='$idRole'");
				$res = $cons -> fetch_array();
				$roleUser = ucwords($res['nombre']);

				if (!empty($_SESSION)) {
					$idUserActive = $_SESSION['idUser'];
					$roleUserActive = $_SESSION['role'];						
				} else {
					$idUserActive = 0;
					$roleUserActive = 0;
				}

				if ($idUserActive === $row['id_usuario']) {
					$options = true;
					$functions = true;
				} else if ($roleUserActive === 3 || $roleUserActive === 5) {
					$options = true;
					$functions = true;
				} else {
					$options = false;
					$functions = false;
				}

			} else {

				$nombre = "El usuario no se encuentra disponible";

			}
				$estado = $row['estado'];
		}

	} 
	else 
	{
		header('location:index.php');
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
	<title><?php echo $nombre; ?> - Periódico Forever</title>
	<link rel="icon" type="image/png" href="imgs/logo.png">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css">
</head>
<body>

<?php
	include 'template/nav.php';
?>

	<!--MODAL-->
	<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="modalTitle">CONFIRMACIÓN</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body center-text" id="body">
	      </div>
	      <div class="modal-footer" id="modalBtns">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
	      </div>
	    </div>
	  </div>
	</div>

<?php

	switch ($estado) {
		case 'notExist':
?>

			<div class="container-fluid" style="margin: 100px 0px;">
				<div class="row justify-content-center">
					<div class="col-6 text-center">
						<h2>El usuario que solicitó no existe.</h2><br>
						<div><i class="material-icons text-secondary" style="font-size: 150px;">warning</i></div>
					</div>
				</div>
			</div>

<?php
			break;
		
		case '0':
?>

			<div class="container-fluid" style="margin: 100px 0px;">
				<div class="row justify-content-center">
					<div class="col-6 text-center">
						<h2>El usuario no se encuentra disponible.</h2><br>
						<div><i class="material-icons text-secondary" style="font-size: 150px;">warning</i></div>
					</div>
				</div>
			</div>

<?php
			break;

		case '1':
			include 'template/bodyProfile.php';
			break;
	}
?>

<script src="js/functions.js"></script>
</body>
</html>