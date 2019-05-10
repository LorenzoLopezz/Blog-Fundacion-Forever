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

	if ($roleActive === '4') {
		header('location:../');
	}

?>

<html>
<head>
	<title>Periodico Forever</title>
	<script src="../js/ckeditor/ckeditor.js"></script>
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
			$A_C1 = ""; $A_C2=""; $A_C3=""; $A_C4="disabled"; $A_C5="";
			include 'nav.php'; 
		?>
	</nav>
	

	<div class="container" style="margin-top: 20px;">
		<div class="row">
			<h1 style="padding-bottom: 10px;border-bottom: 2px solid black; width: 100%;margin-bottom: 20px;">Nueva nota</h1>
		</div>
	</div>

	<div class="container">
		<form action="../functions/addNote.php" method="POST" enctype="multipart/form-data" onsubmit="reviewNote();">
			<div class="row">
				<div class="col-12 newNote-input">
					<h3>Titulo</h3>
					<input class="form-control shadow-sm" name="titulo" id="titulo"></input>
				</div>
			</div>

			<div class="row" style="margin-top: 20px;">
				<div class="col-12">
					<h3>Banner / Video (Solo 1 de los dos)</h3>
					<div class="row">
						<div class="col-12 col-md-6">
							<input type="file" accept=".jpg, .jpeg, .png" name="banner" id="banner">
						</div>
						<div class="col-12 col-md-6">
							<input type="text" class="form-control" name="video" id="video">					
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-12 newNote-input">
					<h3>Bajada</h3>
					<textarea cols="" rows="2" class="form-control" maxlength="150" wrap="hard" placeholder="150 caracteres permitidos" name="bajada" id="bajada"></textarea>
				</div>
			</div>

			<div class="row" style="margin-top: 30px;">
				<div class="col-12">
					<h2>Contenido</h2>
					<textarea name="boxContent" id="boxContent">This is some sample content.</textarea>
					<script>
						CKEDITOR.replace('boxContent');
					</script>
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-md-6 newNote-input">
					<h3>Fuentes</h3>
					<textarea cols="" rows="3" class="form-control" maxlength="2000" wrap="hard" placeholder="No puede ir vacío" name="fuentes" id="fuentes"></textarea>
				</div>
				<div class="col-12 col-md-6 newNote-input">
					<h3>Categoría</h3>
					<select name="categoria" id="categoria" class="form-control">
						<option value="noticia">Noticia</option>
						<option value="historia">Historia</option>
					</select>
				</div>
			</div>

			<div class="row justify-content-center" style="margin: 30px 0px;">
				<div class="col-4 center-text">
					<button class="btn btn-success btn-size-75">Enviar</button>
				</div>
			</div>
		</form>
	</div>


<script src="../js/functions.js"></script>
<script src="style.js"></script>
</body>
</html>