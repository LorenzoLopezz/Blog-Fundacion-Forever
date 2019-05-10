<?php 
	
	session_start();
	include 'functions/conexion.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
	<title>Periodico Forever</title>
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

	if (!$_SESSION) {
?>
	<div class="container-fluid">
		<div class="section_notice" style="margin-top: 50px;">
			<div class="row">
				<div class="col-12 center-text">
					Para poder reportar algún contenido debes haber iniciado sesión. <a href="login.php">Iniciar Sesión.</a>
				</div>
			</div>
		</div>
	</div>
<?php
	} else {
?>
	<div class="container-fluid">
		<div class="section_notice" style="margin-top: 50px;">
			<div class="row">
				<div class="col-12 center-text">
					<h3>REPORTAR</h3>
					<?php 
						$type = $_GET['type'];
						switch ($type) {
							case 'comment':
								$idc = $_GET['idc'];
								$sql = $con -> query("SELECT * FROM comments WHERE id_comentario='$idc'");
								$ar_sql = $sql -> fetch_array();

								$idu_ = $ar_sql['id_usuario'];
								$u = $con -> query("SELECT * FROM usuario WHERE id_usuario='$idu_'");
								$u_a = $u -> fetch_array();

								$idp_ = $ar_sql['id_publicacion'];
								$p = $con -> query("SELECT * FROM publicacion WHERE id_publicacion='$idp_'");
								$p_a = $p -> fetch_array();
					?>
					<div class="row justify-content-center">
						<div class="col-8 left-text" style="margin-top: 20px;" id="box-report">
							<div style="padding: 10px;background:white;border:1px solid #0ba2ba;">
								<h5><?php echo $u_a['nombre']." ".$u_a['apellido']; ?> - <?php echo substr($p_a['titulo'], 0,25); ?></h5>
								<span style="color:#777a7a;"><?php echo $ar_sql['fecha']; ?></span>
								<p class="mar-0"><?php echo $ar_sql['contenido']; ?></p>
							</div>
						</div>
						<div class="col-8" style="margin-top: 20px;">
							<p>¿Qué es lo que te molesta de éste contenido?</p>
							<input type="text" class="form-control" id="content-report">
							<button class="btn btn-primary" style="margin-top: 20px;" data-type="1" data-id="<?php echo $idc; ?>" id="report">Enviar</button>
						</div>
					</div>
					<?php
								break;
							case 'note':
								$idp_ = $_GET['idn'];
								$p = $con -> query("SELECT * FROM publicacion WHERE id_publicacion='$idp_'");
								$p_a = $p -> fetch_array();

								$u_p= $p_a['id_usuario'];
								$u = $con -> query("SELECT * FROM usuario WHERE id_usuario='$u_p'");
								$u_a = $u -> fetch_array();
					?>
					<div class="row justify-content-center">
						<div class="col-8 left-text" style="margin-top: 20px;" id="box-report">
							<div style="padding: 10px;background:white;border:1px solid #0ba2ba;">
								<div class="row">
									<div class="col-12 col-md-4">
										<?php 
											$illustration = $p_a['banner'];

											$pos = strpos($illustration, 'https://www.youtube.com');

											$pos2 = strpos($illustration, 'dropboxusercontent');

											if ($pos !== false) {
												echo '<iframe width="100%" height="400" src="'.$illustration.'" frameborder="0" autoplay="none" allowfullscreen></iframe>';
											} else if( $pos2 !== false ){
												echo '<video src="'.$illustration.'" width="100%" height="200" frameborder="0" controls allowfullscreen preload autostart="false"></video>';
											} else {
												echo '<img src="'.$illustration.'" alt="Banner" width="100%">';	
											}
										?>
									</div>
									<div class="col-12 col-md-8">
										<a href="note.php?idP=<?php echo $idp_; ?>"><h5><?php echo $u_a['nombre']." ".$u_a['apellido']; ?> - <?php echo substr($p_a['titulo'], 0,25); ?></h5></a>
										<span style="color:#777a7a;"><?php echo $p_a['actualizacion']; ?></span>
										<p class="mar-0"><?php echo $p_a['bajada']; ?></p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-8" style="margin-top: 20px;">
							<p>¿Qué es lo que te molesta de éste contenido?</p>
							<input type="text" class="form-control" id="content-report">
							<button class="btn btn-primary" style="margin-top: 20px;" data-type="2" data-id="<?php echo $idp_; ?>" id="report">Enviar</button>
						</div>
					</div>
					<?php
								break;
							
							default:
								echo '<h2>El tipo que ha sido recibido no es valido</h2>';
								break;
						}
					?>
				</div>
			</div>
		</div>
	</div>
<?php
	};

?>

<script src="js/jquery.js"></script>
<script src="js/functions.js"></script>
</body>
</html>