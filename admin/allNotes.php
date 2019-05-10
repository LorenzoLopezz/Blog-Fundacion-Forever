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
			$A_C1 = ""; $A_C2=""; $A_C3="disabled"; $A_C4=""; $A_C5=""; 
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
	
	<div class="container" style="margin-top: 20px;">
		<div class="row">
			<div class="col-8 col-md-10">
				<input type="text" class="form-control" placeholder="Buscar...">
			</div>
			<div class="col-4 col-md-2">
				<button class="btn btn-success btn-size-100">Buscar</button>
			</div>
		</div>
	</div>

	<div class="container-fluid" style="margin-top: 20px;">
		<div class="row justify-content-center">
<?php 

	$sql = $con -> query("SELECT * FROM publicacion");

	while ( $row = $sql -> fetch_array() ) {

		$selNotes = $con -> query("SELECT * FROM publicacion");

		$id =  $row['id_publicacion'];

		$selectVisitas = $con -> query("SELECT * FROM visitas WHERE id_publicacion='$id'");
		$vis = $selectVisitas -> num_rows;
		
?>
			<div class="col-md-3" style="margin-bottom: 10px;">
				<div class="shadow" style="padding: 15px;background: white;">
					<div class="row align-items-center" id="content_Target<?php echo $row['id_publicacion']; ?>">
						<div class="col-12" style="text-align: left;">
							<span># <?php echo $id; ?></span>
						</div>
						<div class="col-12" style="height: 50px;">
							<a href="../note.php?idP=<?php echo $id ?>"><h5 class="mar-0"><?php echo $row['titulo']; ?></h5></a>
						</div>
						<div class="col-12" style="margin-top: 10px;border-bottom: 2px solid #f2f2f2;height: 150px;overflow: hidden;">
							<?php 

								$illustration = $row['banner'];

								// if ($illustration != "") {
									

								$pos = strpos($illustration, 'https://www.youtube.com');

								$pos2 = strpos($illustration, 'dropboxusercontent');

								if ($pos !== false) {
									echo '<iframe width="100%" src="'.$illustration.'" frameborder="0" autoplay="none" allowfullscreen></iframe>';
								} else if( $pos2 !== false ){
									echo '<video src="'.$illustration.'" width="100%" frameborder="0" controls allowfullscreen preload autostart="false"></video>';
								} else {
									echo '<img src="../'.$illustration.'" alt="Banner" width="100%">';	
								}


							?>
							<p><?php echo substr($row['bajada'], 0, 200); ?></p>
						</div>
						<div class="col-12">
							<br>
							<h4><?php 
								$u = $row['id_usuario'];
								$cons = $con -> query("SELECT * FROM usuario WHERE id_usuario='$u'");
								$a = $cons -> fetch_array();
								echo $a['nombre']." ".$a['apellido'];
							?></h4>
							<p style="margin-bottom:0;"><b>Publicado: </b><?php echo substr($row['fecha'], 0,11); ?></p>
							<p style="margin-bottom:0;"><b>Última actualización: </b><?php echo substr($row['actualizacion'], 0,11); ?></p>
							<p style="margin-bottom:0;"><b>Categoría: </b><?php echo ucwords($row['categoria']); ?>s</p>
							<p style="margin-bottom:0;"><b>Visitas: </b><?php echo $vis; ?></p>
						</div>
						<div class="col-12 center-text" style="margin-top: 10px;">
								<div style="width: 33%;float: left;"><button class="btn btn-outline-dark" style="margin-right: 5%;" name="btnNoteAction" data-toggle="tooltip" data-placement="bottom" title="Activar/Desactivar" id="setNote" data-id="<?php echo $row['id_publicacion']; ?>">
									<?php 

										$id = $row['id_publicacion'];

										$estado = $row['estado'];

										if ($estado === "0") 
										{
											echo '<i class="material-icons" id="lockType'.$id.'">lock</i>';
										}
										else
										{
											echo '<i class="material-icons" id="lockType'.$id.'">lock_open</i>';
										}

									?>

								</button></div>
								<div style="width: 33%;float: left;"><a href="functions/editNote.php?id=<?php echo $row['id_publicacion']; ?>"><button class="btn btn-outline-dark" style="margin-right: 5%;" name="btnNoteAction" data-toggle="tooltip" data-placement="bottom" title="Editar">
									<i class="material-icons">mode_edit</i>
								</button></a></div>
								<div class="dropdown" style="width: 33%;float: left;">
								  <button class="btn btn-outline-dark" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <i class="material-icons">more_horiz</i>
								  </button>
								  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
								    <button class="dropdown-item" type="button" id="delNote" data-id="<?php echo $row['id_publicacion']; ?>">Eliminar</button>
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