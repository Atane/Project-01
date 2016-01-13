<?php 

include(__DIR__.'/config/db.php');

	// recherche

print_r($_POST);
if(isset($_POST['action'])) {
	$gameName = $_POST['gameName'];
	$plateformId = $_POST['platform_id'];
	$checkDispo = $_POST['checkDispo'];

	if ($platformId > 0 && $checkDispo) {
		
	$query = $pdo->prepare('SELECT games.*, platforms.name as platform_name FROM games 
							INNER JOIN platforms ON platform_id = platforms.id 
							WHERE game_name LIKE :game_name AND games.platform_id = :platformId');
	$query->bindValue(':game_name', '%'.$gameName.'%', PDO::PARAM_STR);
	$query->bindValue(':platformId', $platformId, PDO::PARAM_STR);
	$query->execute();

	$allGames = $query->fetchAll();
	}
	elseif ($platformId > 0 && !$checkDispo) {
		
	$query = $pdo->prepare('SELECT games.*, platforms.name as platform_name FROM games 
							INNER JOIN platforms ON platform_id = platforms.id 
							WHERE game_name LIKE :game_name AND games.platform_id = :platformId');
	$query->bindValue(':game_name', '%'.$gameName.'%', PDO::PARAM_STR);
	$query->bindValue(':platformId', $platformId, PDO::PARAM_STR);
	$query->execute();

	$allGames = $query->fetchAll();
	}
} 
else {


	$query= $pdo->prepare('SELECT games.*, platforms.name as platform_name FROM games INNER JOIN platforms ON platform_id = platforms.id');
	$query->execute();
	$allGames = $query->fetchAll();
}
	// préparer la requête en récupérant également le type de plateform (inner join de la table 'games' avec la table 'platforms')

/*	echo '<pre>';
	print_r($allGames);
	echo '</pre>';
	die();*/

// Pagination

// 1. Grâce à une query et a SQL COUNT récupérer le nombre total de users dans ma bdd
	$query = $pdo->query('SELECT COUNT(*) AS total FROM games');
	$countGames = $query->fetch();
	$totalGames = $countGames['total'];

	$limitGames = 4;
	$pageGames = ceil($totalGames / $limitGames);

// 6. récupérer la variable page envoyé en GET
	if (isset($_GET['page']) 
		&& $_GET['page'] > 0 
		&& $_GET['page'] <= $pageGames) {
		$page = $_GET['page'];

}
else {
	$page = 1;
}
$offset = ($page - 1) * $limitGames;

$query = $pdo ->prepare('SELECT games.*, platforms.name as platform_name FROM games INNER JOIN platforms ON platform_id = platforms.id LIMIT :limit OFFSET :offset');
$query->bindValue(':limit', $limitGames, PDO::PARAM_INT);
$query->bindValue(':offset', $offset, PDO::PARAM_INT);
$query->execute();

$games = $query->fetchAll();

	// préparer la requête pour récupérer les types de plateforms à afficher dans la box de recherche
	$query= $pdo->prepare('SELECT * FROM platforms');
	$query->execute();
	$allPlatforms = $query->fetchAll();

/*	echo '<pre>';
	print_r($allPlatforms);
	echo '</pre>';
	die();*/


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
		<?php // include (__DIR__.'/include/nav.php'); ?>
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

							<div class="form-group">
								<label for="inputRecherche">Plateforme :</label>
								<select name="platform_id" class="form-control">
									<option>Tous</option>
									<?php foreach ($allPlatforms as $keyPlatforms => $plateform): ?>
										<option><?php echo $plateform['name'];?></option>
									<?php endforeach; ?>
								</select>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="checkDispo" id="blankCheckbox" value="option1">
										<p>Disponible immédiatement</p>
									</label>
								</div>

								<button type="submit" class="btn btn-primary" name="action">Rechercher</button>
							</div>
						</form>
					</div>
				</div>

				<div class="col-md-9">
					<div class="row">
						<div>
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


								<ul class="pagination">
									<!-- 8. Mettre la pagination suivant > et précédente < -->
									<?php if($page > 1): ?>
										<li><a href="catalogue.php?page=<?php echo $page - 1; ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
									<?php endif; ?>

									<!-- 3. Construire la pagination pour n nombre de page $pageUser -->
									<?php for ($i=1; $i <= $pageGames ; $i++):?> 
										<li class="<?php if($page == $i) echo 'active'; ?>"><a href="catalogue.php?page=<?php echo $i; ?>"><?php echo $i ?></a></li>
									<?php endfor; ?>

									<?php if($page < $pageGames): ?>
										<li><a href="catalogue.php?page=<?php echo $page + 1; ?>" aria-label="next"><span aria-hidden="true">&raquo;</span></a></li>
									<?php endif; ?>
								</ul>
							</div>

						</div>		
					</div>	
				</div>
			</body>
			</html>