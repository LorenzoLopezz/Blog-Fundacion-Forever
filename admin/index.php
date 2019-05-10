<?php 
	
	session_start();
	include '../functions/conexion.php';
	include '../functions/roles.php';

	if (!empty($_SESSION['key']))
	{
		//No hacer nada
	}
	else 
	{
		header('location:../functions/adminKey.php');
	};

	if ($roleActive != '5') {
		header('location:../index.php');
	}

?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Periodico Forever</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/admin-main.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
</head>
<body bgcolor="#ECF1F5">

	<nav class="container-fluid" style="background: #2B3245;color:white;">
		<?php 
			$A_C1 = "disabled"; $A_C2=""; $A_C3=""; $A_C4=""; $A_C5="";
			include 'nav.php'; 
		?>
	</nav>
	

	<div class="jumbotron jumbotron-fluid" style="margin-top: 20px;">
	  <div class="container">
	    <h1 class="display-5">Bienvenido al Panel de administración.</h1>
	    <p class="lead">Aquí podrás manipular todo lo que necesites del periódico y bases de datos, todo dependerá de tus permisos.</p>
	  </div>
	</div>

	<div class="container" style="margin-top: 20px;">
		<div class="row justify-content-center">
			<div class="col-md-3">
				<div class=" shadow center-text action-box" style="margin-bottom: 10px;">
					<a href="../"><h3>Periódico</h3></a>
				</div>
			</div>
			<div class="col-md-3">
				<div class=" shadow center-text action-box" style="margin-bottom: 10px;">
					<a href="newNote.php"><h3>Agregar nota</h3></a>
				</div>
			</div>
			<div class="col-md-3">
				<div class=" shadow center-text action-box" style="margin-bottom: 10px;">
					<a href="users.php"><h3>Usuarios</h3></a>
				</div>
			</div>
			<div class="col-md-3">
				<div class=" shadow center-text action-box" style="margin-bottom: 10px;">
					<a href="allNotes.php"><h3>Ver notas</h3></a>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-3">
				<div class=" shadow center-text action-box" style="margin-bottom: 10px;">
					<a href="reports.php"><h3>Reportes</h3></a>
				</div>
			</div>
		</div>
	</div>

	<?php 

		$comments = $con -> query("SELECT * FROM comments");
		$t_c = $comments -> num_rows;

		$pubs = $con -> query("SELECT * FROM publicacion WHERE estado=1");
		$t_p = $pubs -> num_rows;

	?>

	<hr>

	<div class="container" style="margin-top: 30px;">
		<div class="row">
			<div class="col-12">
				<h3 style="color:#d37613;">Estadísticas</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-3 center-text">
				<div style="background: white;padding: 10px;">
					<h4 style="color: #0ccc78;">Comentarios</h4>
					<p style="margin:0;"><?php echo $t_c; ?> en total</p>
				</div>
			</div>

			<div class="col-3 center-text">
				<div style="background: white;padding: 10px;">
					<h4 style="color: #0ccc78;">Publicaciones</h4>
					<p style="margin:0;"><?php echo $t_p; ?> publicadas</p>
				</div>
			</div>
		</div>
	</div>

<!-- 	<div class="container" style="margin-top: 30px;">
		<div class="row">
			<div class="col-12" style="border-bottom: 2px solid black;margin-bottom: 10px;">
				<h2>Resumen estadístico</h2>
			</div>
			<div class="col-md-4">
				<canvas id="myChart" width="400" height="400"></canvas>
				<script>
					var ctx = document.getElementById("myChart");
					var ctx = document.getElementById("myChart").getContext("2d");
					var ctx = $("#myChart");
					var ctx = "myChart";

					var ctx = document.getElementById("myChart");
					var myChart = new Chart(ctx, {
					    type: 'bar',
					    data: {
					        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
					        datasets: [{
					            label: '# of Votes',
					            data: [12, 19, 3, 5, 2, 3],
					            backgroundColor: [
					                'rgba(255, 99, 132, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(255, 206, 86, 0.2)',
					                'rgba(75, 192, 192, 0.2)',
					                'rgba(153, 102, 255, 0.2)',
					                'rgba(255, 159, 64, 0.2)'
					            ],
					            borderColor: [
					                'rgba(255,99,132,1)',
					                'rgba(54, 162, 235, 1)',
					                'rgba(255, 206, 86, 1)',
					                'rgba(75, 192, 192, 1)',
					                'rgba(153, 102, 255, 1)',
					                'rgba(255, 159, 64, 1)'
					            ],
					            borderWidth: 1
					        }]
					    },
					    options: {
					    	events: ["mousemove"],
					    	legend: { labels: { fontColor:'red' } },
					    	tooltips: { mode:'index' },
					        scales: { yAxes: [{ ticks: { beginAtZero:true } }] }
					    }
					});
				</script>
			</div>
		</div>
	</div> -->

<script src="admin-main.js"></script>
</body>
</html>