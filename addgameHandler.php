<?php

	session_start();

	require(__DIR__.'/config/db.php');
	require(__DIR__.'/include/functions.php');

	// vérifier que l'user soit connecté
	checkLoggedIn();


	// ******** Ajout d'un jeu dans la bdd  ************

	// vérifier que le formulaire est complété et qu'il s'agit bien du btn 'action' réservé à l'envoie du form pour ajouter un jeu dans la base
	if(isset($_POST['action']) && ($_POST['action'] == 'add')) {     
 
		// htmlentities -> sécuriser les données reçues via le form
		$gameName = htmlentities($_POST['gameName']);
		$imgUrl = htmlentities($_POST['imgUrl']);
		$issuedOn = htmlentities($_POST['issuedOn']);
		$description = htmlentities($_POST['description']);
		$gameTime = htmlentities($_POST['gameTime']);	
		$platform_id = htmlentities($_POST['platform_id']);

		/*
		echo $gameName . '<br/>';
		echo $imgUrl . '<br/>';
		echo $issuedOn .'<br/>';
		echo $description . '<br/>';
		echo $gameTime . '<br/>';
		echo $platform_id . '<br/>';
		*/


		// création d'un tableau de session dans le cas ou le user n'a pas réussi à se logger
		// permet de conserver les champs correctement saisis si d'autres n'ont pas été saisis correctement
		$_SESSION['lastGameAdded'] = [];

		$_SESSION['lastGameAdded']['gameName'] = $gameName;
		$_SESSION['lastGameAdded']['imgUrl'] = $imgUrl;
		$_SESSION['lastGameAdded']['issuedOn'] = $issuedOn;
		$_SESSION['lastGameAdded']['description'] = $description;
		$_SESSION['lastGameAdded']['gameTime'] = $gameTime;		
		$_SESSION['lastGameAdded']['platform_id'] = $platform_id;


		// initialisation d'un tableau d'erreurs
		$errors = [];


		// check du champ gameName
		if(empty($gameName)) {
			$errors['gameName'] = "Le nom du jeu est obligatoire.";
		}

		// check du champ imgUrl
		if(empty($imgUrl)) {
			$errors['imgUrl'] = "Veuillez indiquer l'URL de l'image.";
		}

		// check du champ issuedOn
		if(empty($issuedOn)) {
			$errors['issuedOn'] = "Veuillez indiquer la date de sortie du jeu.";
		}

		// check du champ description
		if(empty($description)) {
			$errors['description'] = "Veuillez compléter la description du jeu.";
		}

		// check du champ platform_id
		if(empty($platform_id)) {
			$errors['platform_id'] = "Veuillez indiquer la plateforme sur laquelle le jeu est disponible.";
		}


		// s'il n'y a pas d'erreur, j'enregistre le jeu dans la bdd
		if(empty($errors)) {

			print_r($_POST);

			$query = $pdo->prepare('INSERT INTO games (game_name, url_img, published_at, description, game_time, platform_id) VALUES (:gameName, :imgUrl, :issuedOn, :description, :gameTime, :platform_id)');
			$query->bindValue(':gameName', $gameName, PDO::PARAM_STR);
			$query->bindValue(':imgUrl', $imgUrl, PDO::PARAM_STR);
			$query->bindValue(':issuedOn', $issuedOn, PDO::PARAM_STR);
			$query->bindValue(':description', $description, PDO::PARAM_INT);		
			$query->bindValue(':gameTime', $gameTime, PDO::PARAM_STR);
			$query->bindValue(':platform_id', $platform_id, PDO::PARAM_INT);

			if(!$query->execute()) {     // éxécute la requête SQL
				echo "Une erreur est survenue à l'enregistrement";
			}

			// le jeu a t il bien été inséré en bdd ?
			if($query->rowCount() > 0) {
				// récupération du jeu depuis la bdd pour l'affecter à une variable de session
				$query = $pdo->prepare('SELECT * FROM games WHERE id = :id');
				$query->bindValue(':id', $pdo->lastInsertId(), PDO::PARAM_INT);
				$query->execute();
				$resultAdd = $query->fetch();

				// suppression du tableau de session créé pour récupérer les champs correctement saisis
				unset($_SESSION['lastGameAdded']);  

				$_SESSION['message'] = "Votre jeu a bien été rajouté.";

				header("Location: addgame.php");
				die();
			}
		}
		else {
			$_SESSION['addGameErrors'] = $errors;

			print_r($errors);

			header("Location: addgame.php");
			die();
		}
	}			


?>

