<?php

	// même pour effacer une variable en session, on doit utiliser session_start();
	session_start();

	// je supprime la variable user dans la session
	unset($_SESSION['user']);

	// création d'un msg de déconnexion en session
	$_SESSION['message'] = "Vous avez bien été déconnecté.";

	header("Location: index.php");
	die();

?>