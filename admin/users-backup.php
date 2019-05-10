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
		header('location:../index.php');
	}

?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
			$A_C1 = ""; $A_C2="disabled"; $A_C3=""; $A_C4="";
			include 'nav.php'; 
		?>
	</nav>
	
	<!--MODAL-->
	<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="modalTitle">Configuraciones de Usuario</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" id="body-panel">
	      </div>
	      <div class="modal-footer" id="modalBtns">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!--MODAL-LOCK-->
	<div class="modal fade" id="detailsModal-lock" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="modalTitle">Configuraciones de Usuario</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" id="body-panel">
	      	<h5>Especifique la razón del bloqueo (Obligatorio):</h5>
	      	<input type="text" class="form-control" id="razon" placeholder="Escribe aquí...">
	      </div>
	      <div class="modal-footer" id="modalBtns-lock">
	        <button type="button" id="comprobar" class="btn btn-primary" onclick="comprobar();">Comprobar</button>
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

	$sql = $con -> query("SELECT * FROM usuario");

	while ( $row = $sql -> fetch_array() ) {
		$estado = $row['estado'];
		if ($estado==='1') {$style="user-active";$state='active';}
		else{$style="user-inactive";$state='inactive';};
		
?>
			<div class="col-12 col-md-3 center-text" style="margin-bottom: 10px;">
				<div class="shadow <?php echo $style; ?>" id="box-user-<?php echo $row['id_usuario']; ?>">
					<div class="row ">
						<div class="col-12" style="text-align: left;">
							<span># <?php echo $row['id_usuario']; ?></span>
						</div>
						<div class="col-12">
							<img class="rounded-circle" src="<?php  
									$img = $row['foto'];

									if( $img === "" )
									{
										echo '../imgs/icons/default.png';
									}
									else
									{
										echo "../".$img;
									};

								?>" width="50%">
						</div>
						<div class="col-12" style="margin-top: 10px;height: 60px;">
							<h5><?php echo $row['nombre']." ".$row['apellido'] ?></h5>
						</div>
						<div class="col-12" style="margin-top: 10px;">
							<p><b>Fecha Registro: </b><?php echo substr($row['fecha'], 0,11); ?></p>
						</div>
						<div class="col-12">
							<p><b>Edad: </b>00</p>
						</div>
						<div class="col-12">
							<p><b>Becado: </b><?php echo $row['becado']; ?></p>
						</div>
						<div class="col-12">
							<p id="roleAsign<?php echo $row['id_usuario']; ?>"><b>Role: </b><?php 
								$r = $row['role'];
								$cons = $con -> query("SELECT nombre FROM roles WHERE id_role='$r'");
								$roleName = $cons -> fetch_array();
								echo ucwords($roleName['nombre']); 
							?></p>
						</div>
						<div class="col-12" style="margin-top: 20px;">
							<div style="width: 33%;float: left;">
								<button type="button" name="btnUserAction" class="btn btn-outline-dark" style="margin-right: 5%;" data-toggle="tooltip" data-placement="bottom" title="Subir de categoría" id="showPanelUpgrade" data-iduser="<?php echo $row['id_usuario']; ?>" data-idrole="<?php echo $row['role'] ?>">
									<i class="material-icons">arrow_upward</i>
								</button>
							</div>
							<div style="width: 33%;float: left;">
								<a href="../profile.php?idP=<?php echo $row['id_usuario']; ?>"><button class="btn btn-outline-dark" style="margin-right: 5%;" name="btnUserAction" data-toggle="tooltip" data-placement="bottom" title="Ver perfil" id="showProfile">
									<i class="material-icons">account_circle</i>
								</button></a>
							</div>
							<div class="dropdown" style="width: 33%;float: left;">
							  <button class="btn btn-outline-dark" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <i class="material-icons">more_horiz</i>
							  </button>
							  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
							    <button class="dropdown-item" type="button" id="lock-button" name="user-<?php echo $row['id_usuario']; ?>" data-iduser="<?php echo $row['id_usuario']; ?>" data-idrole="<?php echo $row['role'] ?>" data-state="<?php echo $state; ?>">Bloquear/Desbloquear</button>
							    <button class="dropdown-item" type="button" id="delete_user" data-iduser="<?php echo $row['id_usuario']; ?>">Eliminar</button>
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


<script src="admin-main.js"></script>
</body>
</html>