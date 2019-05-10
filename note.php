<?php 

	session_start();

	date_default_timezone_set('America/El_Salvador');

	include 'functions/conexion.php';

	include 'functions/roles.php';

	include 'functions/visita.php';


	$idPost = $_GET['idP'];
	
	$cos = $con -> query("SELECT * FROM publicacion WHERE id_publicacion='$idPost' AND estado='1'");

	$num = $cos -> num_rows;

	if ($num === 0) {
		header('location:index.php');
	}

	$row = $cos -> Fetch_Array();

	$creator = $row['id_usuario'];

?>

<html itemscope itemtype="<a href='http://schema.org/Article'>http://schema.org/Article</a>">
<head>
	<meta name="description" content="Descripcion de pagina. No sueperar los 155 caracteres." />

	<!-- Schema.org markup for Google+ -->
	<meta itemprop="name" content="<?php echo $row['titulo']; ?>">
	<meta itemprop="description" content="<?php echo $row['bajada']; ?>">
	<meta itemprop="image" content="https://periodicoforever.000webhostapp.com/imgs/logo.png">

	<!-- Twitter Card data -->
	<meta name="twitter:card" content="https://periodicoforever.000webhostapp.com/<?php echo $row['banner']; ?>">
	<meta name="twitter:site" content="https://periodicoforever.000webhostapp.com/">
	<meta name="twitter:title" content="<?php echo $row['titulo']; ?>">
	<meta name="twitter:description" content="<?php echo $row['bajada']; ?>">
	<meta name="twitter:creator" content="Fundación Forever">
	<!-- Twitter summary card with large image. Al menos estas medidas 280x150px -->
	<meta name="twitter:image:src" content="https://periodicoforever.000webhostapp.com/imgs/logo.png">

	<!-- Open Graph data -->
	<meta property="og:title" content="<?php echo $row['titulo']; ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" />
	<meta property="og:image" content="https://periodicoforever.000webhostapp.com/imgs/logo.png" />
	<meta property="og:description" content="<?php echo $row['bajada'] ?>" />
	<meta property="og:site_name" content="Inforever" />
	<meta property="article:published_time" content="<?php echo $row['fecha'] ?>" />
	<meta property="article:modified_time" content="<?php echo $row['actualización'] ?>" />
	<meta property="article:section" content="<?php echo ucwords($row['categoria']).'s'; ?>" />
	<meta property="article:tag" content="fundación forever,integración,el salvador,cambio,becas" />


	<meta charset="UTF-8">
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

	<div id="section-notes" class="container-fluid" style="margin-bottom: 50px;">
		<div class="row">
			<div class="col-md-8">
				<div class="row">	
					<div class="col-md-12">
						<nav aria-label="breadcrumb">
						  <ol class="breadcrumb">
						    <li class="breadcrumb-item"><a href="../PeriodicoForever/">Inicio</a></li>
						    <li class="breadcrumb-item" aria-current="page"><a href="../PeriodicoForever/historias.php"><?php echo ucwords($row['categoria']) ?>s</a></li>
						    <li class="breadcrumb-item" aria-current="page"><?php echo ucwords($row['titulo']) ?></li>
						  </ol>
						</nav>
					</div>
				</div>
				<div id="note">
					<h1><?php echo $row['titulo']; ?></h1>
					<h5 style="color: #808080">Publicado: <?php echo substr($row['fecha'], 0,10); ?>. Última actualización: <?php echo substr($row['actualizacion'], 0,10); ?></h5>
					<div id="notes-bajada" style="margin: 20px 0px;">
						<?php echo $row['bajada']; ?>
					</div>

					<div id="banner_video">
						<?php 

							$illustration = $row['banner'];

							// if ($illustration != "") {
								

							$pos = strpos($illustration, 'https://www.youtube.com');

							$pos2 = strpos($illustration, 'dropboxusercontent');

							if ($pos !== false) {
								echo '<iframe width="100%" height="400" src="'.$illustration.'" frameborder="0" autoplay="none" allowfullscreen></iframe>';
							} else if( $pos2 !== false ){
								echo '<video src="'.$illustration.'" width="100%" height="400" frameborder="0" controls allowfullscreen preload autostart="false"></video>';
							} else {
								echo '<img src="'.$illustration.'" alt="Banner" width="100%">';	
							}


						?>
					</div>

					<div id="notes-contenido" style="margin-top: 20px;">
						<?php echo $row['contenido']; ?>
					</div>
				</div>
<?php if (!empty($_SESSION)) {
	$tU = "";
} else {
	$tU = "- Como invitado"; 
}; ?>
			<div id="commentInput" style="background: white;padding: 20px;margin-top: 30px;">
				<h3>Comentarios <?php echo $tU; ?></h3>
				<input id="commentContent" name="commentContent" type="text" class="form-control" placeholder="Escribe tu comentario">
				<button id="comentar" type="button" class="btn btn-success" style="margin-top: 15px;" data-id="<?php echo $row['id_publicacion']; ?>">Comentar</button>
			</div>
			<div id="comments-body" class="comments">

<?php

	$sql2 = $con -> query("SELECT * FROM comments WHERE id_publicacion='$idPost' ORDER BY fecha DESC");
	
	$i = 1;
	while( $array = $sql2 -> fetch_array() ) 
	{
		$user = $array['id_usuario'];
		$sql3 = $con -> query("SELECT * FROM usuario WHERE id_usuario='$user'");
		$resp  = $sql3 -> fetch_array();
?>
					<div id="commentBox-<?php echo $i; ?>" style="padding: 0px 15px;">
						<div class="row" style="background: white;padding: 10px; margin-top: 5px;">
							<div class="col-md-2">
								<img src="<?php  
									$img = $resp['foto'];

									if( $img === "" )
									{
										echo 'imgs/icons/default.png';
									}
									else
									{
										echo $img;
									};

								?>" alt="User Photo" width="100%">
							</div>
							<div class="col-md-10">
								<a href="profile.php?idP=<?php echo $resp['id_usuario']; ?>"><h4><?php echo $resp['nombre']." ".$resp['apellido']; ?></h4></a>
								<span style="color: #B5B5B5;"><?php echo $array['fecha']; ?></span><br>
								<p><?php echo $array['contenido']; ?></p>
								<div class="row align-items-center">			
<?php 

		if (!empty($_SESSION)) {
			
			$idC = $array['id_comentario'];
			$Likes = $con -> query("SELECT * FROM reaction_coments WHERE id_comentario='$idC' AND tipo='1'");
			$cant1 = $Likes -> num_rows;

			$DisLikes = $con -> query("SELECT * FROM reaction_coments WHERE id_comentario='$idC' AND tipo='0'");
			$cant0 = $DisLikes -> num_rows;

			$del;
			if ( $_SESSION['idUser'] == $array['id_usuario'] || !empty($_SESSION['key']) ) {
				$del = '<button class="btn btn-outline-dark" id="delete_c" data-id="'.$array["id_comentario"].'" data-idbox="'.$i.'">
									<i class="material-icons">delete</i>
								</button>';
			} else {
				$del = '<a href="report.php?type=comment&idc='.$array['id_comentario'].'"><button class="btn btn-outline-dark">
									<i class="material-icons">report</i>
								</button></a>';
			};
?>
								<div class="col-4 align-self-center"><button class="btn btn-outline-dark" id="btn-reaction" data-id="<?php echo $array['id_comentario']; ?>" data-type='1'>
									<div class="row">
										<div class="col-3">
											<i class="material-icons">thumb_up</i>
										</div>
										<div class="col-9">
											<span id="like<?php echo $array['id_comentario']; ?>"><?php echo $cant1; ?></span> Likes
										</div>
									</div>
								</button></div>	
								<div class="col-4 align-self-center"><button class="btn btn-outline-dark" id="btn-reaction" data-id="<?php echo $array['id_comentario']; ?>" data-type='0'>
									<div class="row">
										<div class="col-3">
											<i class="material-icons">thumb_down</i>
										</div>
										<div class="col-9">
											<span id="dislike<?php echo $array['id_comentario']; ?>"><?php echo $cant0; ?></span> DisLikes
										</div>
									</div>
								</button></div>
								<div class="col-4 align-self-center text-right">
										<?php echo $del; ?>
									</div>
<?php 

		}
		else
		{

?>
								<div class="col-8 align-self-center">
									<div class="alert alert-danger" role="alert">
										Debes iniciar sesión para reaccionar. <a href="login.php">Iniciar Sesión.</a>
									</div></div>
									<div class="col-4 align-self-center text-right">
										<a href="report.php?type=comment&idc=<?php echo $array['id_comentario']; ?>"><button class="btn btn-outline-dark">
											<i class="material-icons">report</i>
										</button></a>
									</div>
<?php 

		};

?>
								</div>
							</div>
						</div>
					</div>
<?php 
		$i = $i+1;
	};

	$sql4 = $con -> query("SELECT * FROM usuario WHERE id_usuario='$creator'");
	$resp = $sql4 -> fetch_array();

?>
				</div>

			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12 sidebar-box center-text">
						<div>
							<img src="imgs/icons/default.png" width="50%" style="border-radius: 50%;">
						</div>
						<div>
							<a href="profile.php?idP=<?php echo $creator; ?>"><h3 style="font-size: 'Roboto:400',sans-serif;"><?php echo $resp['nombre']." ".$resp['apellido']; ?></h3></a>
						</div>
					</div>
					<div class="col-md-12 sidebar-box center-text">
				        <a id="btn-FB" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" target="_blank"><button class="btn btn-outline-primary">
				        	<img src="imgs/icons/fb.png" width="25px"> Facebook
				        </button></a>
				        <a id="btn-TW" href="https://twitter.com/?status= ¡Colabora! <?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" target="_blank"><button class="btn btn-outline-primary">
				        	<img src="imgs/icons/twitter.png" width="25px"> Twitter
				        </button></a>
				        <a id="btn-G" href="https://plus.google.com/share?url=<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" target="_blank"><button class="btn btn-outline-primary">
				        	<img src="imgs/icons/google.png" width="25px"> Google+
				        </button></a>
				        <a id="btn-Wh" href="https://wa.me/?text=<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" target="_blank"><button class="btn btn-outline-primary" style="margin:5px;">
				        	<img src="imgs/icons/whatsapp.png" width="25px"> WhatsApp
				        </button></a>
				        <hr>
				        <a href="report.php?type=note&idn=<?php echo $idPost; ?>" style="color:black;"><button class="btn btn-outline-dark">
							<i class="material-icons">report</i>
						</button> Reportar</a>
					</div>
					<!-- <div class="col-md-12 sidebar-box">
						<h3 style="margin: 0;color: #00B2CC;">Estadísticas<span style="float: right;" class="icon-trending_up"></span></h3>
						<div class="stadistics">
							<p><span class="material-icons icon-s">visibility</span> 100 views</p>
						</div>
						<div class="stadistics">
							<p><span class="material-icons">thumb_up</span> <span id="numLikes">12</span> likes</p>
						</div>
						<div class="stadistics">
							<p><span class="material-icons">reply</span> 15 shares</p>
						</div>
						<div class="stadistics">
							<p>Última actualización: <b><span>09/12/2017</span></b></p>
						</div>
					</div> -->
					<div class="col-md-12 sidebar-box">
						<h3 style="margin: 0;color: #00B2CC;">Fuentes <span style="float: right;" class="icon-import_contacts"></span></h3>
						<div><br>
							<p><?php echo $row['fuentes']; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src="js/jquery.js"></script>
<script src="js/functions.js"></script>
</body>
</html>