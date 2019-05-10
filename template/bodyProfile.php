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

	<div class="container" style="margin-top: 20px;">
		<div class="row">
			<div class="col-md-3">
				<div class="shadow" style="background: white;padding: 15px;">
					<img src="<?php echo $photo; ?>" alt="Perfil" width="100%"><br><br>
					<p class="mar-0 text-center"><b>ID de Usuario: </b><?php echo $row['id_usuario']; ?></p>
				</div>
			</div>
			<div class="col-md-9">
				<div style="padding: 15px;">
					<div>
						<h3><?php echo $nombre; ?></h3>
						<p class="mar-0"><?php echo $row['email']; ?></p>
					</div><br>
					<div>
						<p><b>Becado: </b><?php echo $row['becado']; ?></p>
					</div>
					<div>
						<p><b>Role: </b><?php echo $roleUser; ?></p>
					</div>
					<div>
						<?php 
							if ($functions === true) {
								echo '<button class="btn btn-primary">Editar perfil</button>';
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 style="margin-top: 20px;">Aportes realizados</h2>
				<div class="row">

<?php 
		$SANotes = $con -> query("SELECT * FROM publicacion WHERE id_usuario='$idU' AND estado='1'");

		$num = $SANotes -> num_rows;

	if ($num > 0) {

		while ( $row = $SANotes -> fetch_array() ) {

?>
					<div class="col-md-3" style="margin-top:10px;">
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
								<a href="note.php?idP=<?php echo $row['id_publicacion'] ?>" class="no-resalt"><h3 style="color: #1277BD;" title="<?php echo $row['titulo']; ?>"><?php 
									$st = strlen($row['titulo']); 
									if($st > 20 ){
										echo substr($row['titulo'], 0,20);echo "...";
									}else{
										echo $row['titulo'];
									};
								?></h3></a>
							</div>

						<?php 
							if ($options === true) {
						?>
							<div class="row">
								<div class="col-4 text-center">
									<button class="btn btn-outline-dark" style="margin-right: 5%;" name="btnNoteAction" data-toggle="tooltip" data-placement="bottom" title="Activar/Desactivar" id="setNote" data-id="<?php echo $row['id_publicacion']; ?>">
										<?php 

											$id = $row['id_publicacion'];

											$estado = $row['estado'];

											if ($estado === "0") 
											{
												echo '<i class="material-icons" id="lockType'.$id.'">lock</i>';
											}
											else
											{
												echo '<i class="material-icons" id="lockType'.$id.'">lock_open</i>';
											}

										?>
									</button>
								</div>
								<div class="col-4 text-center">
									<a href="admin/functions/editNote.php?id=<?php echo $row['id_publicacion']; ?>&dir=profile"><button class="btn btn-outline-dark" style="margin-right: 5%;" name="btnNoteAction" data-toggle="tooltip" data-placement="bottom" title="Editar">
										<i class="material-icons">mode_edit</i>
									</button></a>
								</div>
								<div class="col-4 text-center">
									<div class="dropdown">
									  <button class="btn btn-outline-dark" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    <i class="material-icons">more_horiz</i>
									  </button>
									  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
									    <button class="dropdown-item" type="button" id="delNote" data-id="<?php echo $row['id_publicacion']; ?>">Eliminar</button>
									  </div>
									</div>
								</div>
							</div>
						<?php 
							} else {
						?>
							<div class="row">
								<div class="col-md-6 right-text">
									<button id="share-btn" data-id="<?php echo $array1['id_publicacion']; ?>" class="btn" style="background: #659622;color: white;">COMPARTIR</button>
								</div>
							</div>
						<?php
							};
						?>
						</div>
					</div>
<?php 
		
		};
	} else {
		echo '<div class="col-md-12"><h5 class="text-secondary">No se ha encontrado ninguna nota relacionada</h5></div>';
	}

?>

				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 style="margin-top: 20px;">Comentarios</h2>
				<div class="row">

<?php 

		$SANotes = $con -> query("SELECT * FROM comments WHERE id_usuario='$idU'");

		$num = $SANotes -> num_rows;

	if ($num > 0) {

		$i = 1;
		while ( $row = $SANotes -> fetch_array() ) {

			$publicacion = $row['id_publicacion'];
			$sql = $con -> query("SELECT * FROM publicacion WHERE id_publicacion='$publicacion'");
			$res = $sql -> fetch_array();
			$publicacion = $res['titulo'];
			$state = $res['estado'];

			if ($state === '1') {
?>
					<div class="col-md-3" style="margin-top:10px;">
						<div class="secondary-note" id="box-<?php echo $i; ?>">
							<a href="note.php?idP=<?php echo $res['id_publicacion']; ?>"><h4 class="mar-0"><?php echo $publicacion; ?></h4></a>
							<p class="text-secondary"><?php echo $row['fecha']; ?></p>
							<p><?php echo $row['contenido']; ?></p>
							<div class="row justify-content-end">
								<?php 
									if ($functions === true) {
								?>
									<div class="col-4">
										<button class="btn btn-outline-dark" style="height: 38px;" id="del_comment" data-idc="<?php echo $row['id_comentario']; ?>" data-idbox="<?php echo $i; ?>">
											<i class="material-icons">delete</i>
										</button>
									</div>
								<?php
									}
								?>
							</div>
						</div>
					</div>
<?php 
			};
			$i = $i+1;
		};
	} else {
		echo '<div class="col-md-12"><h5 class="text-secondary">No has comentado nada aún.</h5></div>';
	}

?>

				</div>
			</div>
		</div>
	</div>