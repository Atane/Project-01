<?php

	session_start();

	require(__DIR__.'/config/db.php');
	require(__DIR__.'/include/functions.php');

	// vérifier que l'user soit connecté
	checkLoggedIn();

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	
	<title>Add Game</title>
</head>

<body>

	<?php include(__DIR__.'/include/nav.php'); ?>

	<div class="container">

		<div class="row">

			<div id="divMid" class="col-md-12">
				<img src="img/icone.ico" class="img-circle" width="150" height="150">
				<h1 id="title">Gameloc</h1>
				<p>Ajouter un Jeu</p>				
			</div>
		</div>

		<div class="row">

			<div id="loginID" class="col-md-3">

			</div>

			<div id="loginID" class="col-md-6">

				<form method="POST" action="addgameHandler.php">

					<div class="form-group <?php if(isset($_SESSION['addGameErrors']['gameName'])) echo 'has-error'; ?>">
						<label for="gameName">Titre</label>
						<input type="text" class="form-control" id="gameName" name="gameName" placeholder="title" value="<?php if(isset($_SESSION['lastGameAdded']['gameName'])) echo $_SESSION['lastGameAdded']['gameName']; ?>">
						<?php if(isset($_SESSION['addGameErrors']['gameName'])): ?>
							 <span class="help-block">
							 	<?php echo ($_SESSION['addGameErrors']['gameName']); ?>
							 </span>
						<?php endif; ?>
					</div>

					<div class="form-group <?php if(isset($_SESSION['addGameErrors']['imgUrl'])) echo 'has-error'; ?>">
						<label for="imgUrl">URL de l'image</label>
						<input type="text" class="form-control" id="imgUrl" name="imgUrl" placeholder="url" value="<?php if(isset($_SESSION['lastGameAdded']['imgUrl'])) echo $_SESSION['lastGameAdded']['imgUrl']; ?>">
						<?php if(isset($_SESSION['addGameErrors']['imgUrl'])): ?>
							 <span class="help-block">
							 	<?php echo ($_SESSION['addGameErrors']['imgUrl']); ?>
							 </span>
						<?php endif; ?>
					</div>

					<div class="form-group <?php if(isset($_SESSION['addGameErrors']['issuedOn'])) echo 'has-error'; ?>">
						<label for="issuedOn">Date de sortie</label>
						<input type="date" class="form-control" id="issuedOn" name="issuedOn" placeholder="issued on" value="<?php if(isset($_SESSION['lastGameAdded']['issuedOn'])) echo $_SESSION['lastGameAdded']['issuedOn']; ?>">
						<?php if(isset($_SESSION['addGameErrors']['issuedOn'])): ?>
							 <span class="help-block">
							 	<?php echo ($_SESSION['addGameErrors']['issuedOn']); ?>
							 </span>
						<?php endif; ?>
					</div>

					<div class="form-group <?php if(isset($_SESSION['addGameErrors']['description'])) echo 'has-error'; ?>">
						<label for="description">Description</label>
						<input type="text" class="form-control" id="description" name="description" placeholder="description" value="<?php if(isset($_SESSION['lastGameAdded']['description'])) echo $_SESSION['lastGameAdded']['description']; ?>">
						<?php if(isset($_SESSION['addGameErrors']['description'])): ?>
							 <span class="help-block">
							 	<?php echo ($_SESSION['addGameErrors']['description']); ?>
							 </span>
						<?php endif; ?>
					</div>

					<div class="form-group <?php if(isset($_SESSION['addGameErrors']['gameTime'])) echo 'has-error'; ?>">
						<label for="gameTime">Temps de jeu</label>
						<input type="text" class="form-control" id="gameTime" name="gameTime" placeholder="game time" value="<?php if(isset($_SESSION['lastGameAdded']['gameTime'])) echo $_SESSION['lastGameAdded']['gameTime']; ?>">
					</div>

					<button type="submit" name="action" value="add" class="btn btn-primary">Ajouter</button>

					<!-- on supprime les erreurs après les avoir affichées une fois  -->
					<?php if(isset($_SESSION['addGameErrors'])) { 
						unset($_SESSION['addGameErrors']);
					} ?>

					<!-- on supprime les variables de sessions récupérées après les avoir affichées une fois  -->
					<?php if(isset($_SESSION['lastGameAdded'])) { 
						unset($_SESSION['lastGameAdded']);
					} ?>					
				</form>
			</div>

			<div id="loginID" class="col-md-3">

			</div>

		</div>
	</div>

	<?php include(__DIR__.'/include/footer.php'); ?>

</body>

</html>