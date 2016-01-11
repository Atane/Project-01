<?php

	session_start();  // permet d'indiquer au système que l'on va débuter une session pour l'utilisateur

	require_once(__DIR__.'/config/db.php');

	// vérifier que le button submit ait été cliqué
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


		// initialisation d'un tableau d'erreurs
		$errors = [];


		// check du champ email
		if (empty($email) || (filter_var($email, FILTER_VALIDATE_EMAIL)) === false) {
			$errors['email'] = "Wrong email.";
		}

		elseif (strlen($email) > 60){
			$errors['email'] = "Email too long.";
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
				$errors['email'] = "Email already exists.";
			}
		}


		// check du champ password
		if ($password != $passwordConfirm) {
			$errors['password'] = "Not the same passwords.";
		}
		else if (strlen($password) <= 6) {
			$errors['password'] = "Password should contain min. 6 characters.";
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
				$errors['password'] = 'Password should contain min. 6 characters, including one digit, one alphabet, and one special character.';
			}
		}

		print_r($errors);

		// s'il n'y a pas d'erreur, j'enregistre l'utilisateur dans la bdd
		if(empty($errors)) {
			$query = $pdo->prepare('INSERT INTO users(email, password, lastname, firstname, address, zipcode, town, phone, created_on, updated_on) VALUES(:email, :password, :lastname, :firstname, :address, :zipcode, :town, :phone, NOW(), NOW())');
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

				header("Location: catalogue.php");
				die();
			}
		}
		else {
			$_SESSION['registerErrors'] = $errors;

			header("Location: index.php");
			die();
		}
	}
?>