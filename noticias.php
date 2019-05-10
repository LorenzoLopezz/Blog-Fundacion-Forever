<?php 

	session_start();
	
	include 'functions/conexion.php';

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
	        <a id="btn-FB" href="" target="_blanck"><button class="btn btn-outline-primary">
	        	<img src="imgs/icons/fb.png" width="25px"> Facebook
	        </button></a>
	        <a id="btn-TW" href="" target="_blanck"><button class="btn btn-outline-primary">
	        	<img src="imgs/icons/twitter.png" width="25px"> Twitter
	        </button></a>
	        <a id="btn-G" href="" target="_blanck"><button class="btn btn-outline-primary">
	        	<img src="imgs/icons/google.png" width="25px"> Google+
	        </button></a>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div id="section-notice" class="container-fluid">
		<div class="row">	
			<div class="col-md-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="../">Inicio</a></li>
				    <!-- <li class="breadcrumb-item"><a href="#">Categorías</a></li> -->
				    <li class="breadcrumb-item" aria-current="page">Noticias</li>
				  </ol>
				</nav>
				<h1>Noticias</h1>
			</div>
		</div>
		<div class="row">

<?php 

	$SANotes = $con -> query("SELECT * FROM publicacion WHERE categoria='noticia' AND estado='1'");

	while ( $row = $SANotes -> fetch_array() ) {

?>
			<div class="col-md-4" style="margin-top:10px;">
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
							<h5 class="mar-0" style="color:#B2B2B2;"><?php echo $row['categoria']; ?></h5>
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

<script src="js/functions.js"></script>
</body>
</html>