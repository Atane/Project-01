<!DOCTYPE html>
<html>
<head>
	<title>Gameloc</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div id="divMid" class="col-md-12">
				<img src="img/icone.ico" class="img-circle" width="150" height="150">
				<h1 id="title">Gameloc</h1>
				<p>Catalogue</p>

			</div>
		</div>

		<div id="" class="row">

			<div  class="col-md-3">
				<div id="divRecherche">
					<div class="form-group">
						<label for="inputRecherche">Rechercher :</label>
						<input type="text" class="form-control" id="inputRecherche" placeholder="Search">
					</div>

					<div class="form-group">
						<label for="inputRecherche">Plateforme :</label>
						<select class="form-control">
							<option>Tous</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
						<div class="checkbox">
							<label>
								<input type="checkbox" id="blankCheckbox" value="option1">
								<p>Disponible immédiatement</p>
							</label>
						</div>

						<button type="button" class="btn btn-primary">Rechercher</button>
					</div>

				</div>

			</div>

			<div id="" class="col-md-9">
				<div class="row">
					
					<div class="col-sm-3">
						<div class="divJeu">
							<img src="http://image.jeuxvideo.com/medias-sm/142247/1422469608-7141-jaquette-avant.jpg" class="divimg">
							<h3>Titres du jeu</h3>
							<p>Plateforme PC</p>
							<button type="button" class="btn btn-success">Louer</button>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="divJeu">
							<img src="http://image.jeuxvideo.com/medias-sm/142247/1422469608-7141-jaquette-avant.jpg" class="divimg">
							<h3>Titres du jeu</h3>
							<p>Plateforme PC</p>
							<button type="button" class="btn btn-success">Louer</button>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="divJeu">
							<img src="http://image.jeuxvideo.com/medias-sm/142247/1422469608-7141-jaquette-avant.jpg" class="divimg">
							<h3>Titres du jeu</h3>
							<p>Plateforme PC</p>
							<button type="button" class="btn btn-success">Louer</button>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="divJeu">
							<img src="http://image.jeuxvideo.com/medias-sm/142247/1422469608-7141-jaquette-avant.jpg" class="divimg">
							<h3>Titres du jeu</h3>
							<p>Plateforme PC</p>
							<button type="button" class="btn btn-success">Louer</button>
						</div>
					</div>
					
					<nav>
						<ul class="pagination">
							<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
							<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
						</ul>
					</nav>
				</div>
			</div>

			
		</div>
		
	</div>
</body>
</html>