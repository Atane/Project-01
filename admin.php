<?php

	session_start();

	require(__DIR__.'/config/db.php');
	require(__DIR__.'/include/functions.php');

	// vérifier que l'user soit connecté
	checkLoggedIn();

	// vérifier le rôle de l'user -> doit être admin pour pouvoir accéder à cette page
	if($_SESSION['user']['role'] != "admin") {
		header("HTTP/1.0 403 Forbidden");  // rediriger l'user vers une page d'erreur s'il n'est pas admin
		die();
	}

	// compter le nb de user en bdd
	$query = $pdo->query('SELECT count(id) as total FROM users');
	$resultCount = $query->fetch();
	$totalUsers = $resultCount["total"];  // afficher ce résultat dans la page admin  

?>


<!DOCTYPE html>
<html>
<head>
	<title>Gameloc</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/main.css">

	<style type="text/css">
		#map {
			width: 600px;
			height: 400px;
		}
	</style>

</head>

<body>

	<?php include(__DIR__.'/include/nav.php'); ?>

	<div class="container">

		<div class="row">
			<div id="divMid" class="col-md-12">
				<img src="img/icone.ico" class="img-circle" width="150" height="150">
				<h1 id="title">Gameloc</h1>
				<p>Admin</p>
			</div>
		</div>

		<div class="row">

			<div  class="col-md-12">

				<h1>Statistiques</h1>
				<p>Nombre d'utilisateurs inscrits : <?php echo $totalUsers ?>.</p>

				<h1>Localisation des utilisateurs</h1>
				<div id="map"></div>
				
					<script type="text/javascript">

						// cibler un point sur la carte
						var map;

						// insérer un marker de position sur la carte
						/*$i = 0;
						<?php foreach($users as $keyUsers => $user): ?>
							i++;*/
							var myLatLng = {lat: 48.8909964, lng: 2.2345892};  // position du user
					/*	<?php endforeach;?>*/

						function initMap() {
							map = new google.maps.Map(document.getElementById('map'), {
								center: {lat: 48.8909964, lng: 2.2345892},
								zoom: 10
							});

							var marker = new google.maps.Marker({
								position: myLatLng,
								map: map,
								title: 'hello'  // nom du user
							});
						}

					</script>

					<script async defer
						src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApFHyhOE1lniNGNo0yrkthO-wEUp4OOzM&callback=initMap">
					</script>

				<h1>Derniers jeux ajoutés les nouveaux inscrits</h1>
			</div>
		</div>
	</div>
	
	<?php include(__DIR__.'/include/footer.php'); ?>
	
</body>
</html>

