<div class="row align-items-center">
	<div class="col-12 col-md-6 center-text">
		<a href="../admin/"><h2 style="padding: 20px 0px;">Administración</h2></a>
	</div>
	<div class="col-12 col-md-6">
		<div class="row justify-content-center">
			<div class="col-6 col-md-3 center-text" style="margin-bottom: 10px;">
				<a href="../admin/">
					<button class="btn btn-outline-primary btn-size-100" <?php echo $A_C1; ?>>Inicio</button>
				</a>
			</div>
			<div class="col-6 col-md-3">
				<div class="col-md-3">
					<div class="dropdown" style="width: 33%;float: left;">
					 <button class="btn btn-outline-primary" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <span>Categorías <i class="material-icons" style="font-size: 12px;">expand_more</i></span>
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
						  <a href="users.php">
						  	<button class="dropdown-item" type="button" <?php echo $A_C2; ?>>Usuarios</button>
						  </a>
						  <a href="allNotes.php">
					    	<button class="dropdown-item" type="button" <?php echo $A_C3; ?>>Ver Notas</button>
						  </a>
						  <a href="reports.php">
					    	<button class="dropdown-item" type="button" <?php echo $A_C5; ?>>Reportes</button>
						  </a>
					  </div>
					</div>
				</div>
			</div>
			<div class="col-6 col-md-3" style="margin-bottom: 10px;">
				<a href="newNote.php">
					<button class="btn btn-outline-primary btn-size-100" <?php echo $A_C4; ?>>Nueva nota</button>
				</a>
			</div>
			<div class="col-6 col-md-3">
				<a href="../functions/out.php"><button class="btn btn-outline-danger btn-size-100">Salir</button></a>
			</div>
		</div>
	</div>
</div>