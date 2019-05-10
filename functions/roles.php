<?php 

	$roleActive; $reactionRule; $linkAdmin;

	if ( !empty( $_SESSION['role']) ) 
	{
		$roleActive = $_SESSION['role'];
		$reactionRule = '1';
	}
	else
	{
		$roleActive = '1';
		$reactionRule = '0';
;	};

	$cons = $con -> query("SELECT * FROM roles WHERE id_role='$roleActive'");
	$permisos = $cons -> Fetch_Array();

	switch ($roleActive) {
		case '1':

			// 

			break;

		case '2':

			// 

			break;

		case '3':

			$linkAdmin = 'admin/newNote.php';

			break;

		case '4':

			//

			break;

		case '5':

			$linkAdmin = 'admin/';

			break;
	}

?>