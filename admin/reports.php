<?php 

	session_start();
	include '../functions/conexion.php';
	include '../functions/roles.php';

	if (!empty($_SESSION['key']))
	{
		//No hacer nada
	}
	else 
	{
		header('location:../functions/adminKey.php');
	};

	if ($roleActive != '5') {
		if ($roleActive != '4') {
			header('location:../index.php');
		}
	}

?>

<html>
<head>
	<title>Periodico Forever</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/admin-main.css">
</head>
<body bgcolor="#ECF1F5">

	<nav class="container-fluid" style="background: #2B3245;color:white;">
		<?php 
			$A_C1 = ""; $A_C2=""; $A_C3=""; $A_C4=""; $A_C5="disabled";
			include 'nav.php'; 
		?>
	</nav>

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
	
	<!-- BODY -->
	<div class="container-fluid" style="margin-top: 40px;">
		<div class="row">
			<div class="col-12">
				<h3 style="margin-bottom: 30px;">REPORTES - EN DESARROLLO</h3>
			</div>
		</div>
		<div class="row">
<?php 
	$sql = $con -> query("SELECT * FROM reportes WHERE estado=1");

	while ($row = $sql -> fetch_array()) {
?>

	<div class="col-md-3">
		<div class="row">
			<div class="col-12">
				<div  style="background: white;padding: 20px;">
					<p><b>ID reporte: </b><?php echo $row['id_reporte']; ?></p>
					<p><b>Tipo: </b><?php echo $row['tipo']; ?></p>
					<p><b>Reportado: </b><?php echo $row['reported']; ?></p>
					<p><b>Contenido: </b><?php echo $row['contenido']; ?></p>
					<p><b>Fecha: </b><?php echo $row['fecha']; ?></p>
					<div class="row">
						<div class="col-12 center-text" style="margin-top: 10px;">
								<div style="width: 33%;float: left;"><a href=""><button class="btn btn-outline-dark" style="margin-right: 5%;" name="btnNoteAction" data-toggle="tooltip" data-placement="bottom" title="Activar/Desactivar">
									<i class="material-icons">question_answer</i>
								</button></a></div>
								<div style="width: 33%;float: left;"><a href=""><button class="btn btn-outline-dark" style="margin-right: 5%;" name="btnNoteAction" data-toggle="tooltip" data-placement="bottom" title="Editar">
									<i class="material-icons">mode_edit</i>
								</button></a></div>
								<div class="dropdown" style="width: 33%;float: left;">
								  <button class="btn btn-outline-dark" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <i class="material-icons">more_horiz</i>
								  </button>
								  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
								    <button class="dropdown-item" type="button" id="delNote" data-id="">Eliminar</button>
								  </div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php 
	}; 
?>
		</div>
	</div>


<!-- <script src="../js/jquery.js"></script> -->
<script src="admin-main.js"></script>
</body>
</html>