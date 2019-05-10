<?php 

	date_default_timezone_set('America/El_Salvador');
	
	$idP = $_GET['idP'];

	function getRealIP()
    {
        if (isset($_SERVER["HTTP_CLIENT_IP"]))
        {
            return $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
        {
            return $_SERVER["HTTP_X_FORWARDED"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
        {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED"]))
        {
            return $_SERVER["HTTP_FORWARDED"];
        }
        else
        {
            return $_SERVER["REMOTE_ADDR"];
        }
    };

    $ip = getRealIP();

    $date = date('Y-m-d');
    $fecha = date('Y-m-d H:m:i');
  

    if ( !empty($_SESSION) ) {

		$idUser = $_SESSION['idUser'];


        $quer = $con -> query("SELECT * FROM visitas WHERE id_usuario='$idUser' AND id_publicacion='$idP'");
        $v = $quer -> Fetch_Array();

        $times = $v['fecha'];
		$day = substr($times, 0,10);

		if ($day != $date)
        {
              $sql = $con -> query("INSERT INTO visitas(id_publicacion,id_usuario,ip,fecha) VALUES('$idP','$idUser','$ip','$fecha')");
        } else {}

    } 
    else
    {	
		$idUser = '1';

		$quer = $con -> query("SELECT * FROM visitas WHERE id_usuario='$idUser' AND id_publicacion='$idP'");
        $v = $quer -> Fetch_Array();

        $dir = $v['ip'];
        $times = $v['fecha'];
		$day = substr($times, 0,10);

        if( $day != $date )
        {
	        if ($dir != $ip) {
	      		 $sql = $con -> query("INSERT INTO visitas(id_publicacion,id_usuario,ip,fecha) VALUES('$idP','$idUser','$ip','$fecha')");
	        };
    	}


    };
?>