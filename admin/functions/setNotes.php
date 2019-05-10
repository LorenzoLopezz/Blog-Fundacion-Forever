<?php 

	date_default_timezone_set('America/El_Salvador');
	session_start();
	include '../../functions/conexion.php';

	$function = $_POST['function'];


	switch ($function) {
		case 'privacity':
			$id = $_POST['id'];
			$array = array();
			$array['ide'] = $id;


			if( !empty($_POST) )
			{
				$query = $con -> query("SELECT * FROM publicacion WHERE id_publicacion='$id'");
				$row = $query -> fetch_array();

				$set = $row['estado'];

				if ($set === "1") {	$change = '0'; $icon = 'lock';} else { $change = '1'; $icon='lock_open';};
				
				$sql = $con -> query("UPDATE publicacion SET estado='$change' WHERE id_publicacion='$id'");

				$array['ok'] = "Se ha cambiado el estado de la publicación";
				$array['estado'] = $change;
				$array['icon'] = $icon;
			}
			else
			{
				header('location:../PeriodicoForever/');
			}

			echo json_encode($array);
		break;

		case 'update':

			$idNote = $_POST['idNote'];
			$titulo = $_POST['titulo'];
			$bajada = $_POST['bajada'];
			$contenido = $_POST['boxContent'];
			$fuentes = $_POST['fuentes'];
			$cat = $_POST['categoria'];
			$id_usuario = $_SESSION['idUser'];
			$lastBanner = $_POST['lastBanner'];
			$update = date('Y-m-d H:m:i');

			if (!empty($_FILES['banner']['name'])) 
			{
				unlink("../../".$lastBanner);
				$foto = $_FILES['banner']['name'];
				$info = new SplFileInfo($foto);
				$extension = $info->getExtension();
				$banner = "imgs/pics/".uniqid().".".$extension;
				$dir = "../../".$banner;
				move_uploaded_file($_FILES['banner']['tmp_name'], $dir);
			}
			else if ( !empty($_POST['video']) )
			{ 
				$banner = $_POST['video'];

				$pos = strpos($banner, 'https://www.dropbox.com/');

				if ($pos !== false) {
					$banner = str_replace('https://www.dropbox.com/', 'https://dl.dropboxusercontent.com/', $banner);
				}
			} else {
				$banner = $lastBanner;
			};

			$cons = $con -> query("UPDATE publicacion SET titulo='$titulo',bajada='$bajada',contenido='$contenido',banner='$banner',fuentes='$fuentes',categoria='$cat',actualizacion='$update',id_usuario='$id_usuario',estado='0' WHERE id_publicacion='$idNote'");

			header('location:../../admin/allNotes.php');

		break;

		case 'delete':

			$id = $_POST['id'];
			$array = array();

			$query = $con -> query("SELECT * FROM publicacion WHERE id_publicacion='$id'");
			$row = $query -> fetch_array();

			$b = $row['banner'];

			$pos = strpos($b, 'https://www.youtube.com');
			$pos2 = strpos($b, 'dropboxusercontent');

			if ($pos !== true && $pos2 !== true) {
				unlink("../../".$b);
			}

			$cons = $con -> query("DELETE FROM publicacion WHERE id_publicacion='$id'");

			$array['ide'] = $id;

			echo json_encode($array);

		break;
	}


?>