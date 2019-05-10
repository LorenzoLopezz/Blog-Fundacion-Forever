<?php 
	session_start();

	include 'functions/conexion.php';

	$message;
	if (empty($_SESSION)) {
		$message = "Impulsado por Fundación Forever";
	} else {
		$idUser = $_SESSION['idUser'];

		$query = $con -> query("SELECT * FROM usuario WHERE id_usuario='$idUser'");
		$row = $query -> fetch_array();

		$change = $_SESSION['changeRole'];
		$role_ = $_SESSION['role'];

		$c = $con -> query("SELECT * FROM roles WHERE id_role='$role_'");
		$arr = $c -> fetch_array();

		switch ($change) {
			case '1':
				$message = "Se te ha degradado de nivel, tu cuenta ha vencido.";
				break;
			case '2':
				$message = "Bienvenido/a: ".ucwords($row['nombre'])." ".ucwords($row['apellido']);
				break;
			case '3':
				$message =  "Bienvenido/a: ".ucwords($row['nombre'])." ".ucwords($row['apellido']);
				break;
		}
	}

?>
<html>
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

	<?php include 'template/nav.php'; ?>

	<!--MODAL-->
	<div class="modal fade" id="share-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalCenterTitle">COMPARTIR</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body center-text">
	        <a id="btn-FB" href="" target="_blank"><button class="btn btn-outline-primary" style="margin:5px;">
	        	<img src="imgs/icons/fb.png" width="25px"> Facebook
	        </button></a>
	        <a id="btn-TW" href="" target="_blank"><button class="btn btn-outline-primary" style="margin:5px;">
	        	<img src="imgs/icons/twitter.png" width="25px"> Twitter
	        </button></a>
	        <a id="btn-G" href="" target="_blank"><button class="btn btn-outline-primary" style="margin:5px;">
	        	<img src="imgs/icons/google.png" width="25px"> Google+
	        </button></a>
	        <a id="btn-Wh" href="" target="_blank"><button class="btn btn-outline-primary" style="margin:5px;">
	        	<img src="imgs/icons/whatsapp.png" width="25px"> WhatsApp
	        </button></a>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	<div id="slide" class="container-fluid">
		<div class="row">
			<div class="col-md-12 pad-0 slide-box">
				<div class="slide-item">
					<div class="desc-slide-item">
						<h2 style="margin-top: 50px;"><?php echo ucwords($message); ?></h2>
					</div>
					<img src="imgs/pics/img1.jpg" alt="Imagen 1" width="100%">
				</div>
		</div>
	</div>

	<div id="section-all" class="container-fluid" style="margin-top: 20px;">
		<div class="row">
			<div class="col-md-8">
<?php 

	// SELECCIÓN DE LA NOTA MÁS VISITADA PARA UBICAR COMO NOTA MÁS LEÍDA

	$selNotes = $con -> query("SELECT * FROM publicacion WHERE estado='1'");

	$resultados = array();

	while ( $arrayNotes = $selNotes -> fetch_array() ) 
	{

		$id =  $arrayNotes['id_publicacion'];
		$selectVisitas = $con -> query("SELECT * FROM visitas WHERE id_publicacion='$id'");
		$arr = $selectVisitas -> num_rows;
		$resultados[$id] = $arr;
	}

	$masV = array_search(max($resultados),$resultados);

	$notaPrincipal = $con -> query("SELECT * FROM publicacion WHERE id_publicacion='$masV' AND estado='1'");
	$array1 = $notaPrincipal -> fetch_array();

?>
				<div class="main-note">
					<div class="img-cut">
						<?php 
							$illustration = $array1['banner'];

							$pos = strpos($illustration, 'https://www.youtube.com');

							$pos2 = strpos($illustration, 'dropboxusercontent');

							if ($pos !== false) {
								echo '<iframe width="100%" height="100%" src="'.$illustration.'" frameborder="0" autoplay="none" allowfullscreen></iframe>';
							} else if( $pos2 !== false ){
								echo '<video src="'.$illustration.'" width="100%" height="100%" frameborder="0" controls allowfullscreen preload autostart="false"></video>';
							} else {
								echo '<img src="'.$illustration.'" alt="Banner" width="100%">';	
							}
						?>
					</div>

					<div class="desc-main-note">
						<a href="note.php?idP=<?php echo $array1['id_publicacion']; ?>" class="no-resalt"><h2><?php echo $array1['titulo']; ?></h2></a>
						<span><?php echo $array1['fecha']; ?></span>
						<p><?php 

							$string = $array1['bajada'];

							$countWords = str_word_count($string);

							$words = explode(" ",$string);
							
							$n = count($words);

							if ($n > 30) {
								for ($i=0; $i <= 29 ; $i++) { 
									echo $words[$i]." ";
								};
							} else {
								echo $string;
							}

						?></p>
						<div class="row align-items-center">
							<div class="col-md-6">
								<h5 class="mar-0" style="color:#659622;"><?php echo ucwords($array1['categoria']); ?>s</h5>
							</div>
							<div class="col-md-6 right-text">
								<button id="share-btn" data-id="<?php echo $array1['id_publicacion']; ?>" class="btn" style="background: #659622;color: white;">COMPARTIR</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
<?php 

	//SELECCIONANDO LAS OTRAS NOTAS

	$SANotes = $con -> query("SELECT * FROM publicacion WHERE id_publicacion!='$masV' AND estado='1' ORDER BY actualizacion DESC");

	while ( $row = $SANotes -> fetch_array() ) {

?>
					<div class="col-md-6" style="margin-top:10px;">
						<div class="secondary-note">
							<div class="img-cut-small">
								<?php 
									$illustration = $row['banner'];
									$pos = strpos($illustration, 'https://www.youtube.com');

									$pos2 = strpos($illustration, 'dropboxusercontent');

									if ($pos !== false) {
										echo '<iframe width="100%" height="100%" src="'.$illustration.'" frameborder="0" autoplay="none" allowfullscreen></iframe>';
									} else if( $pos2 !== false ){
										echo '<video src="'.$illustration.'" width="100%" height="100%" frameborder="0" controls allowfullscreen preload autostart="false"></video>';
									} else {
										echo '<img src="'.$illustration.'" alt="Banner" width="100%">';	
									}
								?>
							</div>
							<span><?php echo $row['actualizacion'] ?></span>
							<div style="height: 100px;max-height: 100px;">
								<a href="note.php?idP=<?php echo $row['id_publicacion'] ?>" class="no-resalt"><h3 style="color: #1277BD;"><?php echo $row['titulo']; ?></h3></a>
							</div>
							<div class="row align-items-center">
								<div class="col-md-6">
									<h5 class="mar-0" style="color:#B2B2B2;"><?php echo ucwords($row['categoria']); ?>s</h5>
								</div>
								<div class="col-md-6 right-text">
									<button id="share-btn" data-id="<?php echo $row['id_publicacion']; ?>" class="btn" style="background: #D2D2D2;color:#1277BD;">COMPARTIR</button>
								</div>
							</div>
						</div>
					</div>
<?php 

	};

?>
				</div>
			</div>

			<div id="section-sidebar" class="col-md-4">
				<div class="reactions-box">
					<h2 class="center-text">ÚLTIMAS REACCIONES</h2>
<?php 

	$sql = $con -> query("SELECT * FROM comments ORDER BY fecha DESC LIMIT 6");

	$cont = $sql -> num_rows;

	if ($cont > 0) {

		while ( $com = $sql -> fetch_array() ) {

			$idP = $com['id_publicacion'];
			$idU = $com['id_usuario'];
			$cons = $con -> query("SELECT * FROM publicacion WHERE id_publicacion='$idP'");
			$conss = $cons -> fetch_array();
			$consU = $con -> query("SELECT * FROM usuario WHERE id_usuario='$idU'");
			$rowU = $consU -> fetch_array();
			$name = $rowU['nombre']." ".$rowU['apellido'];

?>
					<div class="reaction-body">
						<h4 style="border-bottom: 2px solid #1277BD;color:#1277BD;"><?php echo $name; ?></h4>
						<a href="note.php?idP=<?php echo $com['id_publicacion'] ?>" style="color:black;"><b><h5><?php echo $conss['titulo']; ?></h5></b></a>
						<span><?php echo $com['fecha'] ?></span>
						<p><?php 

							$txt = $com['contenido'];
							$len = strlen($txt);
							$txt = substr($txt, 0,150);
							if ($len > 150) {
								echo $txt."...";
							} else {
								echo $txt;
							};

						?></p>
						<!-- <div class="row">
							<div class="col-md-6 center-text"><button class="btn btn-size-75 btn-primary">
								bt1
							</button></div>
							<div class="col-md-6 center-text"><button class="btn btn-size-75 btn-primary">
								btn2
							</button></div>
						</div> -->
					</div>
<?php 

		};
	} else {

?>
					<div class="reaction-body">
						<h4 style="border-bottom: 2px solid #1277BD;color:#1277BD;">--</h4>
						<b><h5>Aun no hay comentarios...</h5></b>
						</div>
					</div>
<?php 
	
	};

?>
				</div>
			</div>
		</div>
	</div>

<script src="js/functions.js"></script>
</body>
</html>