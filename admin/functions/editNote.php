<?php 

	session_start();
	include '../../functions/conexion.php';
	include '../../functions/roles.php';

	$idP = $_GET['id'];

	if (!empty($_SESSION['key']))
	{
		//No hacer nada
	}
	else 
	{
		if (!empty($_GET['dir'])) {
			header('location:../../functions/adminKey.php?redir=1&idp='.$idP);
		} else {
			header('location:../functions/adminKey.php');
		};
	};

	if ($roleActive === '4') {
		header('location:../');
	}



	if (empty($_GET)) 
	{
		header('location:../../');
	} 
	else 
	{

		$sql = $con -> query("SELECT * FROM publicacion WHERE id_publicacion='$idP'");

		$row = $sql -> Fetch_Array();

	}

?>

<html>
<head>
	<title>Periodico Forever</title>
	<script src="../../js/ckeditor/ckeditor.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="../../css/main.css">
	<link rel="stylesheet" href="../../css/admin-main.css">
</head>
<body bgcolor="#ECF1F5">

	<nav class="container-fluid" style="background: #2B3245;color:white;">
		<div class="row align-items-center">
			<div class="col-12 col-md-6">
				<a href="../admin/"><h2 style="padding: 20px 0px;">Administración</h2></a>
			</div>
			<div class="col-12 col-md-6">
				<div class="row justify-content-end">
					<div class="col-6 col-md-3 center-text" style="margin-bottom: 10px;">
						<a href="../allNotes.php">
							<button class="btn btn-outline-danger btn-size-100">Cancelar</button>
						</a>
					</div>
				</div>
			</div>
		</div>
	</nav>
	

	<div class="container" style="margin-top: 20px;">
		<div class="row">
			<h1 style="padding-bottom: 10px;border-bottom: 2px solid black; width: 100%;margin-bottom: 20px;">Editar nota</h1>
		</div>
	</div>

	<div class="container">
		<form action="setNotes.php" method="POST" enctype="multipart/form-data" onsubmit="reviewNote();">
			<div class="row">
				<div class="col-12 newNote-input">
					<h3>Titulo</h3>
					<input type="hidden" name="idNote" id="idNote" value="<?php echo $row['id_publicacion']; ?>">
					<input class="form-control shadow-sm" name="titulo" id="titulo" value="<?php echo $row['titulo']; ?>"></input>
				</div>
			</div>

			<div class="row" style="margin-top: 20px;">
				<div class="col-12">
					<h3>Banner / Video (Solo 1 de los dos) - Se reemplazará el existente</h3>
					<div class="row align-items-center">
						<div class="col-12 col-md-6">
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
									echo '<img src="../../'.$illustration.'" alt="Banner" width="100%">';	
								}


							?>
						</div>
						<div class="col-12 col-md-6">
							<input type="hidden" id="lastBanner" name="lastBanner" value="<?php echo $illustration; ?>">
							<input type="file" accept=".jpg, .jpeg, .png" name="banner" id="banner"><br><br>
							<input type="text" class="form-control" name="video" id="video">					
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12 newNote-input">
					<h3>Bajada</h3>
					<textarea cols="" rows="2" class="form-control" maxlength="150" wrap="hard" placeholder="150 caracteres permitidos" name="bajada" id="bajada"><?php echo $row['bajada']; ?></textarea>
				</div>
			</div>

			<div class="row" style="margin-top: 30px;">
				<div class="col-12">
					<h2>Contenido</h2>
					<textarea name="boxContent" id="boxContent"><?php echo $row['contenido']; ?></textarea>
					<script>
						CKEDITOR.replace('boxContent');
					</script>
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-md-6 newNote-input">
					<h3>Fuentes</h3>
					<textarea cols="" rows="3" class="form-control" maxlength="2000" wrap="hard" placeholder="No puede ir vacío" name="fuentes" id="fuentes"><?php echo $row['fuentes']; ?></textarea>
				</div>
				<div class="col-12 col-md-6 newNote-input">
					<h3>Categoría</h3>
					<select name="categoria" id="categoria" class="form-control">
						<option value="<?php echo $row['categoria']; ?>"><?php echo ucwords($row['categoria']); ?></option>
						<option>----------------------------------</option>
						<option value="noticia">Noticia</option>
						<option value="historia">Historia</option>
					</select>
					<input type="hidden" value="update" name="function" id="function">
				</div>
			</div>

			<div class="row justify-content-center" style="margin: 30px 0px;">
				<div class="col-4 center-text">
					<button class="btn btn-success btn-size-75">Enviar</button>
				</div>
			</div>
		</form>
	</div>


<script src="../../js/functions.js"></script>
</body>
</html>