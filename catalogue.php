<?php 

	include(__DIR__.'/config/db.php');

	// préparer la requête en récupérant également le type de plateform (inner join de la table 'games' avec la table 'platforms')
	$query= $pdo->prepare('SELECT games.*, platforms.name as platform_name FROM games INNER JOIN platforms ON platform_id = platforms.id');
	$query->execute();
	$allGames = $query->fetchAll();

/*	echo '<pre>';
	print_r($allGames);
	echo '</pre>';
	die();*/


	// préparer la requête pour récupérer les types de plateforms à afficher dans la box de recherche
	$query= $pdo->prepare('SELECT * FROM platforms');
	$query->execute();
	$allPlatforms = $query->fetchAll();

/*	echo '<pre>';
	print_r($allPlatforms);
	echo '</pre>';
	die();*/


	if(isset($_POST['action'])) {
		$gameName = $_POST['gameName'];
		// $plateforme = ;
		// $dispo = ;
		$query = $pdo->prepare('SELECT * FROM games WHERE game_name LIKE :game_name');
		$query->bindValue(':game_name', '%'.$gameName.'%', PDO::PARAM_STR);
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

		<div class="row">

			<div  class="col-md-3">

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
							<?php foreach ($allPlatforms as $keyPlatforms => $plateform): ?>
								<option><?php echo $plateform['name'];?></option>
							<?php endforeach; ?>
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

			<div class="col-md-9">
				<div class="row">

					<?php foreach ($allGames as $keyGames => $game): ?>
						<div class="col-sm-3">
							<div class="divJeu">
								<div class="tailleImg">
									<img src="<?php echo $game['url_img']; ?>" class="divimg">
								</div>
								<h3><?php echo $game['game_name'];?>
								<p>Platerforme: <?php echo $game['platform_name']; ?></p>
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