<?php

	function checkLoggedIn() {
		if(empty($_SESSION['user'])) {
			header("Location: index.php");
			die();
		}
	}


	function geocode($address) {

		// URL API de googlemaps 
		// http://maps.google.com/maps/api/geocode/json?address=

		// encodage de l'adresse pour la soumettre par url (remplacer les espaces présents dans l'adresse par des %20)
		$address = urlencode($address);

		// url de l'API pour géocoder 
		$urlApi = "http://maps.google.com/maps/api/geocode/json?address=$address";

		// appel à l'api gmap decode (en GET - réponse en JSON)
		$responseJson = file_get_contents($urlApi);

		// décodage du json pour le transformer en array php associatif (-> 2ème paramètre : true)
		$responseArray = json_decode($responseJson, true);

/*		echo '<pre>';
		print_r($responseArray);
		echo '</pre>';*/

		// on prépare un tableau associatif de retour pcq on 2 infos (lat et lng à retourner alors 
		// qu'une fonction ne peut avoir qu'un seul retour)
		$response = [];

		// je teste le status de réponse de l'api -> OK  (sinon, cela signifie qu'il n'y a pas de correspondance -> 'zero résult')
		if($responseArray['status'] == 'OK') {
			$lat = $responseArray['results']['0']['geometry']['location']['lat'];
			$lng = $responseArray['results']['0']['geometry']['location']['lng'];

/*			echo $lat.'</br>';
			echo $lng.'</br>';*/

			// test facultatif - on vérifie seulement que lat et lng sont bien présentes 
			if($lat && $lng) {
				$response['lat'] = $lat;
				$response['lng'] = $lng;
			}
		}
		return $response;
	}

/*	echo "<pre>";
	print_r (geocode('136 avenue pablo picasso nanterre'));
	echo "</pre>";*/

?>