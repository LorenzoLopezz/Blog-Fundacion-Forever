<nav class="container-fluid shadow" style="background: #ffffff;">
	<div class="row align-items-center">
	  	<div class="col-md-4">
	  		<img src="imgs/logo.png" alt="Fundación Forever" width="30%">
	  	</div>

<?php 
	if (!empty($_SESSION['role'])) {
		$role = $_SESSION['role'];
	} else { $role = '1'; }

	$linkPrincipal = 'functions/adminKey.php';
	$btn_key = 'Enter Key';

	switch ($role) {
		case '1':
			$type = "0";
			$linkPrincipal = 'our.php';
			break;
		case '2':
			$type = "0";
			$linkPrincipal = 'our.php';
			break;
		case '3':
			$type = "1";
			if (!empty($_SESSION['key'])) {
				$linkPrincipal = 'admin/newNote.php';
				$btn_key = 'Nueva Nota';
			};
			break;
		case '4':
			$type = "1";
			if (!empty($_SESSION['key'])) {
				$linkPrincipal = 'admin/reactionsControl.php';
				$btn_key = 'Panel de control';
			};
			break;
		case '5':
			$type = "1";
			if (!empty($_SESSION['key'])) {
				$linkPrincipal = 'admin/';
				$btn_key = 'Administrar';
			};
			break;
	}

	if ($type === "0"){

?>

	  	<div class="col-md-8">
	  		<div class="row justify-content-end">
	  			<div class="col-md-2">
	  				<a href="index.php">
	  					<button class="btn btn-outline-primary btn-size-100">Inicio</button>
	  				</a>
	  			</div>
	  			<div class="col-md-2">
	  				 <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				      Categorías
				    </button>
	  				<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
				      <a class="dropdown-item" href="noticias.php">Noticias</a>
				      <a class="dropdown-item" href="historias.php">Historias</a>
				    </div>
	  			</div>
	  			<div class="col-md-2">
	  				<a href="our.php">
	  					<button class="btn btn-outline-primary btn-size-100">Nosotros</button>
	  				</a>
	  			</div>
	  			<?php 
	  				if (empty($_SESSION)) {
	  			?>
	  			<div class="col-md-2">
	  				<a href="login.php">
	  					<button class="btn btn-outline-primary btn-size-100">Login</button>
	  				</a>
	  			</div>
	  			<?php 
	  				} else {
	  			?>
	  			<div class="col-md-2">
	  				<a href="profile.php?idP=<?php echo $_SESSION['idUser'] ?>">
	  					<button class="btn btn-outline-primary btn-size-100">Perfil</button>
	  				</a>
	  			</div>
	  			<div class="col-md-2">
	  				<a href="functions/out.php">
	  					<button class="btn btn-danger btn-size-100">Salir</button>
	  				</a>
	  			</div>
	  			<?php 
	  				};
	  			?>
	  		</div>
	  	</div>

<?php  

	}
	else if( $type === "1" )
	{  

?>

	  	<div class="col-md-8">
	  		<div class="row justify-content-center">
	  			<div class="col-md-2">
	  				<a href="index.php">
	  					<button class="btn btn-outline-primary btn-size-100">Inicio</button>
	  				</a>
	  			</div>
	  			<div class="col-md-2">
	  				 <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				      Categorías
				    </button>
	  				<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
				      <a class="dropdown-item" href="noticias.php">Noticias</a>
				      <a class="dropdown-item" href="historias.php">Historias</a>
				    </div>
	  			</div>
	  			<div class="col-md-2">
	  				<a href="our.php">
	  					<button class="btn btn-outline-primary btn-size-100">Nosotros</button>
	  				</a>
	  			</div>
	  			<div class="col-md-4">
	  				<a href="<?php echo $linkPrincipal; ?>">
	  					<button class="btn btn-danger btn-size-100"><?php echo $btn_key; ?></button>
	  				</a>
	  			</div>
	  			<?php 
	  				if (empty($_SESSION)) {
	  			?>
	  			<div class="col-md-2">
	  				<a href="login.php">
	  					<button class="btn btn-outline-primary btn-size-100">Login</button>
	  				</a>
	  			</div>
	  			<?php 
	  				} else {
	  			?>
	  			<div class="col-md-2">
	  				 <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				      Opciones
				    </button>
	  				<div class="dropdown-menu upd" aria-labelledby="btnGroupDrop1">
				      <a class="dropdown-item" href="profile.php?idP=<?php echo $_SESSION['idUser'] ?>"><i class="material-icons" style="font-size: 12px;">account_box</i> Perfil</a>
				      <a class="dropdown-item" href="functions/out.php"><i class="material-icons" style="font-size: 12px;">power_settings_new</i> Salir</a>
				    </div>
	  			</div>
	  			<?php 
	  				};
	  			?>
	  		</div>
	  	</div>

<?php  

	}

?>


	</div>
</nav>