<?php 

	session_start();

	if (empty($_POST)) {
		header('location:../');
	};

	include 'conexion.php';

	$titulo = $_POST['titulo'];
	$bajada = $_POST['bajada'];
	$banner = "";
	$contenido = $_POST['boxContent'];
	$fuentes = $_POST['fuentes'];
	$cat = $_POST['categoria'];
	$id_usuario = $_SESSION['idUser'];

	if (!empty($_FILES['banner']['name'])) 
	{
		$foto = $_FILES['banner']['name'];
		$info = new SplFileInfo($foto);
		$extension = $info->getExtension();
		$banner = "imgs/pics/".uniqid().".".$extension;
		$dir = "../".$banner;
		move_uploaded_file($_FILES['banner']['tmp_name'], $dir);
	}
	else 
	{ 
		$banner = $_POST['video'];

		$pos = strpos($banner, 'https://www.dropbox.com/');

		if ($pos !== false) {
			$banner = str_replace('https://www.dropbox.com/', 'https://dl.dropboxusercontent.com/', $banner);
		}
	}

	$cons = $con -> query("INSERT INTO publicacion(titulo,bajada,contenido,banner,fuentes,categoria,id_usuario,estado) VALUES('$titulo','$bajada','$contenido','$banner','$fuentes','$cat','$id_usuario','0')");

	header('location:../admin/allNotes.php');


?>