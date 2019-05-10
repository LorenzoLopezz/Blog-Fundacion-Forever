<?php 

	date_default_timezone_set('America/El_Salvador');
	
	session_start();
	include '../../functions/conexion.php';

	$a = array();
	$idU = $_POST['iduser'];
	$a['idU'] = $idU;
	$idR = $_POST['idrole'];
	$a['idR'] = $idR;
	$funcion = $_POST['funcion'];

	switch ($funcion) {
		case 'getRoles':
			$sql = $con -> query("SELECT * FROM roles WHERE id_role='$idR'");
			$res = $sql -> fetch_array();
?>
		
			<h5>Role activo</h5>
			<div class="space-active text-center" id="panel-roleActive" data-idr="<?php echo $res['id_role']; ?>" data-idu="<?php echo $idU; ?>"><?php echo ucwords($res['nombre']); ?></div><br><br><br>
			<h5>Roles disponibles</h5>

<?php
			$cons = $con -> query("SELECT * FROM roles WHERE id_role!='$idR'");
			

			while ($row = $cons -> fetch_array()) {
?>

		    <div class="space-inactive text-center" id="panel-roles" onclick="upgradeUser('<?php echo $idU; ?>','<?php echo $row['id_role']; ?>')"><?php echo ucwords($row['nombre']); ?></div>

<?php
			};
		break;

		case 'upgrade':
			$sql = $con -> query("UPDATE usuario SET role='$idR' WHERE id_usuario='$idU'");
			$cons = $con -> query("SELECT * FROM roles WHERE id_role='$idR'");
			$row = $cons -> fetch_array();

			echo '<b>Role: </b>'.$row['nombre'];
		break;

		case 'lock':
			$razon = $_POST['razon'];
			$cons = $con -> query("INSERT INTO bloqueos(id_usuario,description,modificado,estado) VALUES('$idU','$razon','','1')");
			$sql = $con -> query("UPDATE usuario SET estado='0' WHERE id_usuario='$idU'");
			$arr['a']="user-active";
			$arr['b']="user-inactive";
			$arr['c']="Se ha bloqueado el usuario";
			$arr['d']="inactive";

			echo json_encode($arr);
		break;

		case 'unlock':
			$cons = $con -> query("SELECT * FROM bloqueos WHERE id_usuario='$idU'");
			$res = $cons -> num_rows;
			if ($res > 0) {
				$mod = date('Y-m-d H:m:i');
				$c = $con -> query ("UPDATE bloqueos SET estado='0' AND modificado='$mod' WHERE id_usuario='$idU'");
			}
			$sql = $con -> query("UPDATE usuario SET estado='1' WHERE id_usuario='$idU'");
			$arr['a']="user-inactive";
			$arr['b']="user-active";
			$arr['c']="Se ha desbloqueado el usuario";
			$arr['d']="active";

			echo json_encode($arr);
		break;

		case 'delete':
			$cons = $con -> query("DELETE FROM usuario WHERE id_usuario='$idU'");
			$arr['a'] = "El usuario ha sido eliminado.";

			echo json_encode($arr);
		break;
	};
?>