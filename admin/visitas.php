<?php 

	include '../functions/conexion.php';

	session_start();

	$sql = $con -> query("SELECT * FROM visitas");

	echo '<h2>VISITAS</h2>';

	while ($row = $sql -> fetch_array()) {
?>

	<p><?php echo $row['id_visita'] ?> - <?php echo $row['ip'] ?> - <?php echo $row['id_publicacion'] ?> - <?php echo $row['id_usuario'] ?> - <?php echo $row['fecha'] ?></p>

<?php
	};
?>