<?php

	session_start();  // permet d'indiquer au système que l'on va débuter une session pour l'utilisateur

	require_once(__DIR__.'/config/db.php');


	// vérifier que le button submit a été cliqué
	if(isset($_POST['action'])) {
		// affecte une variable à chq valeur clé de $_POST
		$email = trim(htmlentities($_POST['email']));   // trim -> enlève les espaces non souhaités
		$password = trim(htmlentities($_POST['password']));


		// création d'un tableau de session dans le cas ou le user n'a pas réussi à se logger
		// permet de conserver les champs correctement saisis si d'autres n'ont pas été saisis correctement
		$_SESSION['lastLogin'] = [];

		$_SESSION['lastLogin']['email'] = $email;


		// initialisation d'un tableau d'erreurs
		$errors = [];


		// récupération de l'user dans la bdd grâce à son email
		$query = $pdo->prepare('SELECT * FROM users WHERE email = :email');
		$query->bindValue(':email', $email, PDO::PARAM_STR);
		$query->execute();

		$resultUser = $query->fetch();		

		// si l'user a été trouvé, on compare le pwd en clair à celui crypté dans la bdd : fonction password_verify(password en clair, password crypté en bdd)
		if($resultUser) {
			$isValidPassword = password_verify($password, $resultUser['password']); 

			// on check maintenant que pwd est correct :
			if ($isValidPassword) {
				// on stock le user en session et on retire le pwd avant
				unset($resultUser['password']);
				$_SESSION['user'] = $resultUser;

				// on redirige l'user vers la page protégée catalogue.php
				header("Location: catalogue.php");
				die();
			}
			else { 
				$errors['password'] = "Mot de passe incorrect.";
			}
		}
		else {
			$errors['user'] = "$email n'existe pas dans la base de donnée.";
		}

		$_SESSION['loginErrors'] = $errors;
		header("Location: login.php");
		die();

	}
?>