<?php 

session_start();
include 'conexion.php';

$idU = $_SESSION['idUser'];
$idP = $_POST['id'];
$content = $_POST['content'];

if ($content != "") {
	$sql = $con -> query("INSERT INTO comments(id_usuario,id_publicacion,contenido) VALUES('$idU','$idP','$content')");
}

$sql2 = $con -> query("SELECT * FROM comments WHERE id_publicacion='$idP' ORDER BY fecha DESC");


while( $array = $sql2 -> fetch_array() ) 
{
	$user = $array['id_usuario'];
	$sql3 = $con -> query("SELECT * FROM usuario WHERE id_usuario='$user'");
	$row  = $sql3 -> fetch_array();
?>

	<div id="commentBox" style="padding: 0px 15px;">
		<div class="row" style="background: white;padding: 10px; margin-top: 5px;">
			<div class="col-md-2">
				<img src="<?php  
					$img = $row['foto'];

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
				<h4><?php echo $row['nombre']." ".$row['apellido']; ?></h4>
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
<?php 

};

?>

				<div class="col-4 align-self-center text-right">
					<a href="report.php?type=comment"><button class="btn btn-outline-dark">
						<i class="material-icons">report</i>
					</button></a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 

};

?>