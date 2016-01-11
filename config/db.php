<?php

define('HOST', 'localhost'); // Domaine ou IP du serveur ou est située la base de données
define('USER', 'root'); // Nom d'utilisateur autorisé à se connecter à la base
define('PASSWORD', '');  // Mot de passe de connexion à la base
define('DB', 'project-01'); // Base de données sur laquelle on va faire les requêtes

$db_options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", // On force l'encodage en utf8
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // On récupère tous les résultats en tableau associatif
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING // On affiche des warnings pour les erreurs, à commenter en prod (valeur par défaut PDO::ERRMODE_SILENT)
);

try {
	$pdo = new PDO('mysql:host='.HOST.';dbname='.DB, USER, PASSWORD, $db_options);
} catch (Exception $e) {
	$msgError = $e->getMessage();	
	die('Une erreur de connexion à la bdd : '.$msgError);
}

?>