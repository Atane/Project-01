<?php 

include(__DIR__.'/config/db.php');

$query= $pdo->prepare('SELECT * FROM games');
$query->execute();
$allGames = $query->fetchAll();

if(isset($_POST['action'])) {
	$gameName = $_POST['gameName'];
	// $plateforme = ;
	// $dispo = ;
	$query = $pdo->prepare('SELECT * FROM games WHERE titre LIKE :gameName');
	$query->bindValue(':gameName', '%'.$gameName.'%', PDO::PARAM_STR);
	$query->execute();

	$allTitre = $query->fetchAll();
}
?>




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

			<div  class="col-md-2">
				<div id="divRecherche">
					<form id="search-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<div class="form-group">
							<label for="gameName">Rechercher</label>
							<input type="text" class="form-control" name="gameName" placeholder="search">
						</div>
					</form>

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

						<button type="button" class="btn btn-primary" name="action">Rechercher</button>
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

					

						<?php foreach ($allGames as $keyGames => $games): ?>
					<div class="col-sm-3">
						<div class="divJeu">
						<div class="tailleImg">
							<img src="<?php echo $games['image_de_couverture']; ?>" class="divimg">
							</div>
							<h3><?php echo $games['titre'];?>
							<p><?php echo $games['synopsis'];?></p>
							<button type="button" class="btn btn-success">Louer</button>
						</div>
					</div>
						<?php endforeach; ?>
					
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