<?php

	session_start();  // permet d'indiquer au système que l'on va débuter une session pour l'utilisateur

	require_once(__DIR__.'/config/db.php');

	include(__DIR__.'/include/functions.php');


	// vérifier que le button submit a été cliqué
	if(isset($_POST['action'])) {
		// affecte une variable à chq valeur clé de $_POST
		$email = trim(htmlentities($_POST['email']));  // trim -> enlève les espaces non souhaités
		$password = trim(htmlentities($_POST['password']));
		$passwordConfirm = trim(htmlentities($_POST['passwordConfirm']));
		$lastname = trim(htmlentities($_POST['lastname']));
		$firstname = trim(htmlentities($_POST['firstname']));
		$address = trim(htmlentities($_POST['address']));
		$zipcode = trim(htmlentities($_POST['zipcode']));
		$town = trim(htmlentities($_POST['town']));
		$phone = trim(htmlentities($_POST['phone']));

		echo $email . "</br>";
		echo $password . "</br>";
		echo $passwordConfirm . "</br>";
		echo $lastname . "</br>";
		echo $firstname . "</br>";
		echo $address . "</br>";
		echo $zipcode . "</br>";
		echo $town . "</br>";
		echo $phone . "</br>";


		// création d'un tableau de session dans le cas ou le user n'a pas réussi à se logger
		// permet de conserver les champs correctement saisis si d'autres n'ont pas été saisis correctement
		$_SESSION['lastRegister'] = [];

		$_SESSION['lastRegister']['email'] = $email;
		$_SESSION['lastRegister']['lastname'] = $lastname;
		$_SESSION['lastRegister']['firstname'] = $firstname;
		$_SESSION['lastRegister']['address'] = $address;
		$_SESSION['lastRegister']['zipcode'] = $zipcode;		
		$_SESSION['lastRegister']['town'] = $town;
		$_SESSION['lastRegister']['phone'] = $phone;


		// initialisation d'un tableau d'erreurs
		$errors = [];


		// check du champ email
		if (empty($email) || (filter_var($email, FILTER_VALIDATE_EMAIL)) === false) {
			$errors['email'] = "Votre email n'est pas correct.";
		}

		elseif (strlen($email) > 60){
			$errors['email'] = "Votre email est trop long.";
		}
		else {
			// je vérifie que l'email n'existe pas déjà dans la bdd
			$query = $pdo->prepare('SELECT email FROM users WHERE email = :email');
			$query->bindValue(':email', $email, PDO::PARAM_STR);
			$query->execute();

			// je récupère le résultat sql
			$resultEmail = $query->fetch();

			// si la requête sql renvoie un résultat, c'est que l'email est déjà présent dans la bdd
			if ($resultEmail['email']) {
				$errors['email'] = "Cet email est déjà utilisé.";
			}
		}


		// check du champ password
		if ($password != $passwordConfirm) {
			$errors['password'] = "Les mots de passe sont différents.";
		}
		else if (strlen($password) <= 6) {
			$errors['password'] = "Le mot de passe doit contenir au moins 6 caractères.";
		}
		else {
			// le password contient au moins une lettre
			$containsLetter = preg_match('/[a-zA-Z]/', $password);

			// le password contient au moins un chiffre
			$containsDigit = preg_match('/\d/', $password);

			// le password contient au moins un autre caractère 
			$containsSpecial = preg_match('/[^a-zA-Z\d]/', $password);   // [^a-zA-Z\d] -> contient autre chose que des lettres et des chiffres

			// si une des conditions n'est pas remplie, erreur :
			if (!$containsLetter || !$containsDigit ||!$containsSpecial) {
				$errors['password'] = 'Le mot de passe doit contenir min. 6 caractères, dont au moins 1 lettre, 1 chiffre et 1 caractère spécial.';
			}
		}


		// check du champ lastname
		if(empty($lastname)) {
			$errors['lastname'] = "Vous n'avez pas saisi votre nom.<br />";
		}
		elseif  (!preg_match ('/^[a-zA-Z-_]{2,30}$/', $lastname)) {
			$errors['lastname'] = "Votre nom doit contenir entre 2 et 30 caractères.";
		}

		// check du champ firstname
		if(empty($firstname)) {
			$errors['firstname'] =  "Vous n'avez pas saisi votre prénom.<br />";
		}
		elseif  (!preg_match ('/^[a-zA-Z-_]{2,30}$/' , $firstname)) {
			$errors['firstname'] = "Votre prénom doit contenir entre 2 et 30 caractères.";
		}

		// check du champ address
		if(empty($address)) {
			$errors['address'] =  "Vous n'avez pas saisi votre adresse.<br />";
		}
		elseif  (!preg_match ('/^[a-zA-Z0-9- ]{5,50}$/' , $address)) {
			$errors['address'] = "Votre addresse doit contenir entre 5 et 50 caractères.";
		}

		// check du champ town
		if(empty($town)) { 
			$errors['town'] = "Vous n'avez pas saisi votre ville.";
		}
		elseif  (!preg_match ('/^[a-zA-Z-_]{2,50}$/' , $town)) {
			$errors['town'] = "Votre ville doit contenir entre 2 et 50 caractères.";
		}

		// check du champ zipcode (max. 5 chiffres)
		if(empty($zipcode)) { 
			$errors['zipcode'] = "Vous n'avez pas saisi votre code postal.";
		}
		elseif ((strlen($zipcode) != 5) && !(ctype_digit($zipcode))) { 
			$errors['zipcode'] = "Votre code postal doit contenir 5 chiffres.";
		}


		// check du champ phone (max. 10 chiffres)
		if(empty($phone)) { 
			$errors['phone'] = "Vous n'avez pas saisi votre numéro de téléphone.";
		}
		elseif (!(preg_match('/^0[1-79][0-9]{8}$/', $phone))) { 
			$errors['phone'] = "Votre numéro de téléphone doit contenir 10 chiffres.";
		}

		echo "<pre>";
		print_r($errors);
		echo "</pre>";

		// s'il n'y a pas d'erreur, je récupère ses coordonnées gps et j'enregistre l'utilisateur dans la bdd
		if(empty($errors)) {

			$completeAddress = $address." ".$zipcode." ".$town;

/*			echo "<pre>";
			print_r (geocode($completeAddress));
			echo "</pre>";*/

			// on stock le résultat de la fonction dans une variable (on obtient un array)
			$resultGeocode = geocode($completeAddress);

			// puis on récupère chaque valeur du array (pour éviter d'éxécuter 2 fois la fonction)
			$lat = $resultGeocode['lat'];
			$lng = $resultGeocode['lng'];

			$query = $pdo->prepare('INSERT INTO users(email, password, lastname, firstname, address, zipcode, town, latitude, longitude, phone, created_on, updated_on) VALUES(:email, :password, :lastname, :firstname, :address, :zipcode, :town, :latitude, :longitude, :phone, NOW(), NOW())');

			$query->bindValue(':email', $email, PDO::PARAM_STR);

			// hash (cryptage) du password 
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
			/*echo $hashedPassword;*/
			$query->bindValue(':password', $hashedPassword, PDO::PARAM_STR);

			$query->bindValue(':lastname', $lastname, PDO::PARAM_STR);
			$query->bindValue(':firstname', $firstname, PDO::PARAM_STR);
			$query->bindValue(':address', $address, PDO::PARAM_STR);
			$query->bindValue(':zipcode', $zipcode, PDO::PARAM_STR);
			$query->bindValue(':town', $town, PDO::PARAM_STR);
			$query->bindValue(':phone', $phone, PDO::PARAM_STR);

			// on bind la latitude et la longitude seulement si l'API de google maps a réussi à générer les coordonnées en fonction de l'adresse
			if($lat && $lng) {
				$query->bindValue(':latitude', $lat, PDO::PARAM_STR);
				$query->bindValue(':longitude', $lng, PDO::PARAM_STR);
			} 
			else {
				$query->bindValue(':latitude', NULL, PDO::PARAM_STR);
				$query->bindValue(':longitude', NULL, PDO::PARAM_STR);				
			}


			$query->execute();

			// l'user a t il bien été inséré en bdd ?
			if($query->rowCount() > 0) {
				// récupération de l'user depuis la bdd pour l'affecter à une variable de session
				$query = $pdo->prepare('SELECT * FROM users WHERE id = :id');
				$query->bindValue(':id', $pdo->lastInsertId(), PDO::PARAM_INT);
				$query->execute();
				$resultUser = $query->fetch();

				// on stock le user en session et on supprime le password avant 
				unset($resultUser['password']);  // suppression de la clé password (pour plus de sécurité)
				$_SESSION['user'] = $resultUser;

				unset($_SESSION['lastRegister']);  // suppression du tableau de session créé pour récupérer les champs correctement saisis

				header("Location: catalogue.php");
				die();
			}
		}
		else {
			$_SESSION['registerErrors'] = $errors;

			print_r($errors);			

			header("Location: register.php");
			die();
		}
	}
?>