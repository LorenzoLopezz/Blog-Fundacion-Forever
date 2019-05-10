<?php

	date_default_timezone_set('America/El_Salvador');

	$date2 = '2018-06-24';

	echo $date2."</br>";

	$date1 = date('Y-m-d');
	
	echo $date1."</br>";

	if ($date1 === $date2) {
		echo 'Las fechas son iguales';
	} else {
		echo 'Las fechas son diferentes';
	}

	echo "</br></br></br>";

	if ($date1 > $date2) {
		echo "La fecha 1 es mayor a la fecha 2 </br></br>";
	} else {
		echo "La fecha 1 es menor a la fecha 2 </br></br>";
	}

?>