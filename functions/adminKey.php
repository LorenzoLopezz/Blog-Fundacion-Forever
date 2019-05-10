<?php 
	
	session_start();

	$error;

	if (!empty($_GET)) 
	{
		$error = 'border:1px solid red';
	}

	if (empty($_SESSION)) 
	{
		header('location:../');
	}

	if (!empty($_SESSION['key']))
	{
		header('location:../admin/');
	};

	if (!empty($_GET['redir'])) {
		$redir = $_GET['redir'];
		$idP = $_GET['idp'];
	} else {
		$redir = 0;
		$idP = 0;
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
</head>
<body>

	<nav class="nav justify-content-center" style="background: #364252;">
		<div style="padding: 20px;">
			<h2 class="mar-0 text-white">Periodico Forever</h2>
		<div>
	</nav>

	<form action="keyload.php" method="POST">
		<div class="container-fluid" style="margin-top: 40px;">
			<div class="row justify-content-center">
				<div class="col-md-4 text-center">
					<h4>Ingresa tu clave de administrador</h4>
				</div>
			</div>
			<div class="row justify-content-center" style="margin-top: 20px;">
				<div class="col-md-4">
					<input name="password" id="password" type="password" class="form-control" placeholder="Clave de administrador" style='<?php echo $error; ?>' autofocus>
					<input type="text" id="redir" name="redir" class="hide" value="<?php echo $redir; ?>">
					<input type="text" id="idp" name="idp" class="hide" value="<?php echo $idP; ?>">
				</div>			
			</div>
			<div class="row justify-content-center" style="margin-top: 20px;">
				<div class="col-md-4 text-center">
					<button type="submit" class="btn btn-success">Entrar</button>
				</div>
			</div>
		</div>
	</form>
	
</body>
</html>