<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Wyznacznik Macierzy</title>
		<?php 
		require_once('bootstrap.php');
		?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body style="background-color:#F3F3F3">
		
		<div class="container">
		  <h1>Skrypty na Algebrę Liniową</h1>
		  <p>Patryk Marszelewski</p>
		  <div class="row">
			<div class="col-sm-6" style="background-color:#FFFFCC; padding: 10px;">
				<div class="card" style="width: 20rem;">
				  <img class="card-img-top" width="200px" src="http://bazywiedzy.com/gfx/metoda-wyznacznikow-3.png" alt="obraz">
				  <div class="card-body">
					<h4 class="card-title">Wyznaczniki</h4>
					<p class="card-text">Skrypt liczący wyznaczniki.</p>
					<p><a href="wyznaczniki.txt" class="btn btn-info">Zobacz kod</a></p>
					<a href="wyznaczniki.php" class="btn btn-primary">Oblicz Wyznacznik</a>
				  </div>
				</div>
			</div>
			<div class="col-sm-6" style="background-color:#CCE5FF; padding: 10px;">
				<div class="card" style="width: 20rem;">
				  <img class="card-img-top" style="border: 1px black solid;" width="200px" src="http://www.matmana6.pl/zdjecia/studia/macierze_i_wyznaczniki/definicja_i_rodziaje_liniowych_ukladow_rownan_1.png" alt="obraz">
				  <div class="card-body">
					<h4 class="card-title">Układy równań</h4>
					<p class="card-text">Skrypt wyliczający wartości niewiadomych z</p>
					<p class="card-text">układu równań.</p>
					<p><a href="uklady.txt" class="btn btn-info">Zobacz kod</a></p>
					<a href="uklady.php" class="btn btn-primary">Oblicz Układ</a>
				  </div>
				</div>
			</div>
			<div class="col-sm-6" style="background-color:#dbd3be; padding: 10px;" hidden>
				<div class="card" style="width: 20rem;">
				  <img class="card-img-top" style="border: 1px black solid;" width="200px" src="./parametr.PNG" alt="obraz">
				  <div class="card-body">
					<h4 class="card-title">Układy równań z parametrem</h4>
					<p class="card-text">Skrypt wyliczający wartości niewiadomych z</p>
					<p class="card-text">układu równań z parametrem <b>NIE ZROBIONE</b>.</p>
					<p><a class="btn btn-info" disabled>Zobacz kod</a></p>
					<a class="btn btn-primary" disabled>Oblicz Układ</a>
				  </div>
				</div>
			</div>
		  </div>
		</div>
		
		
	</body>
</html>