<?php 

	if (empty($_SESSION)) {} else {
		header('location:index.php');	
	} 

	include 'functions/conexion.php';
	include 'functions/roles.php';

	if (!empty($_GET['error'])) {
		$error = $_GET['error'];

		switch ($error) {
			case 'UserNotExist':
				$typeError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">El usuario no existe, te equivocaste en algo.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				break;
			
			case 'password-No-Match':
				$typeError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Las contraseñas no coincidieron, deberías revisar.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				break;

			case 'mailRegistered':
				$typeError = '<div class="alert alert-danger alert-dismissible fade show" role="alert">¡Ups! Parece que ésta cuenta ya fue registrada. <a href="recover.php">Recuperar cuenta</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				break;
		}
	} else { $typeError = ''; }

?>

<html>
<head>
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

	$type = "";

	if ( empty($_GET['type']) ) {
		//No hacer nada
	} else {
		$type = $_GET['type'];
	}
?>

	<div class="container fluid" style="margin-top: 10px;">
		<div class="row justify-content-center">
			<div class="col-6 center-text"><?php echo $typeError; ?></div>
		</div>
	</div>

<?php

	if ($type != "register") 
	{
?>
	<div id="section-login" class="container-fluid">
		<div class="row justify-content-around">
			<div class="col-md-4 center-text login-box rounded">
				<h3>INICIA SESIÓN</h3>
				<form action="functions/log.php" method="POST" style="margin-top: 30px;">
					<div class="row justify-content-around">
						<div class="col-md-10">
							<div class="input-group">
							    <div class="input-group-prepend">
							 
							    </div>
							    <input type="text" class="form-control" name="email" placeholder="Introduce tu correo"  pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
							</div>
						</div>
					</div>
					<div class="row justify-content-around" style="margin-top: 15px;">
						<div class="col-md-10">
							<div class="input-group">
							    <div class="input-group-prepend">
							     
							    </div>
							    <input type="password" class="form-control" name="password" placeholder="Introduce tu contraseña"  maxlength="25" minlength="8" required>
							</div>
						</div>
					</div>
					<div class="row justify-content-around" style="margin-top: 30px;">
						<button class="col-md-4 btn btn-primary rounded">Entrar</button>
					</div>
					<div class="row justify-content-around" style="margin-top: 30px;">
						<a class="col-md-4" href="?type=register">Registrarse</a>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php

	} 
	else if ($type = "register")
	{
?>

	<div id="section-register" class="container-fluid">
		<div class="row justify-content-around">
			<div class="col-md-4 center-text login-box rounded">
				<h3>REGISTRARSE</h3>
				<form action="functions/register.php" method="POST" style="margin-top: 30px;">
					<div class="row justify-content-around">
						<div class="col-md-10">
							<div class="input-group">
							    <div class="input-group-prepend">
							     
							    </div>
							    <input type="text" class="form-control" name="nombre"  placeholder="Introduce tu nombre" title="Introduce tu nombre correctamente"   required/>
							</div>
						</div>
					</div>
					<div class="row justify-content-around" style="margin-top: 15px;">
						<div class="col-md-10">
							<div class="input-group">
							    <div class="input-group-prepend">
							   
							    </div>
							    <input type="text" class="form-control" name="apellido" placeholder="Introduce tu apellido" title="Introduce tu apellido correctamente"   required/>
							</div>
						</div>
					</div>
					<div class="row justify-content-around" style="margin-top: 15px;">
						<div class="col-md-10">
							<div class="input-group">
							    <div class="input-group-prepend">
							    </div>
							    <input type="text" class="form-control" name="email" placeholder="Introduce tu correo"  pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
							</div>
						</div>
					</div>
					<div class="row justify-content-around" style="margin-top: 15px;">
						<div class="col-md-10">
							<div class="input-group">
							    <div class="input-group-prepend">
							      
							    </div>
							    <input type="password" class="form-control" name="password" placeholder="Introduce tu contraseña" maxlength="25" minlength="8" required>
							</div>
						</div>
					</div>
					<div class="row justify-content-around" style="margin-top: 15px;">
						<div class="col-md-10">
							<div class="input-group">
							    <div class="input-group-prepend">
							     
							    </div>
							    <input type="password" class="form-control" name="passwordRepeat" placeholder="Introduce tu contraseña nuevamente" maxlength="25" minlength="8" required>
							</div><br>
								  <p>¿Eres becado?</p>
     					   <label>
     					       <input type="radio" name="becado" value="Si"> Si
     					   </label>
     					   <label>
     					       <input type="radio" name="becado" value="No" checked> No
      					  </label>					



						</div>
					</div>
					<div class="row justify-content-around" style="margin-top: 30px;">
						<button class="col-md-4 btn btn-primary rounded">Registrarse</button>
					</div>
					<div class="row justify-content-around" style="margin-top: 30px;">
						<a class="col-md-6" href="login.php">¿Ya tienes cuenta?</a>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php
	};
?>

</body>
</html>