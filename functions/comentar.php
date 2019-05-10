<?php 

	session_start();
	include 'conexion.php';
	
	$idP = $_POST['id'];
	$content = $_POST['content'];

	if (!$_SESSION) {
		$idU = 1;
		if ($content != "") {
			$sql = $con -> query("INSERT INTO comments(id_usuario,id_publicacion,contenido) VALUES('$idU','$idP','$content')");
		}
	} else {
		$idU = $_SESSION['idUser'];
		$sql = $con -> query("INSERT INTO comments(id_usuario,id_publicacion,contenido) VALUES('$idU','$idP','$content')");
	}

	$sql2 = $con -> query("SELECT * FROM comments WHERE id_publicacion='$idP' ORDER BY fecha DESC");


while( $array = $sql2 -> fetch_array() ) 
{
	$user = $array['id_usuario'];
	$sql3 = $con -> query("SELECT * FROM usuario WHERE id_usuario='$user'");
	$resp  = $sql3 -> fetch_array();
?>

	<div id="commentBox" style="padding: 0px 15px;">
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
			if ($_SESSION['idUser'] == $array['id_usuario']) {
				$del = '<button class="btn btn-outline-dark" id="del_coment">
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
					</div>
				</div>
				<div class="col-4 align-self-center text-right">
					<a href="report.php?type=comment"><button class="btn btn-outline-dark">
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

};

?>