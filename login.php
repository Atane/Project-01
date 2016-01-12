<?php
	session_start();
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
	<div class="container">
		
		<div class="row">
			
			<div id="divMid" class="col-md-12">
				<img src="img/icone.ico" class="img-circle" width="150" height="150">
				<h1 id="title">Gameloc</h1>
				<P>Connexion</P>
			</div>

		</div>

		<div class="row">

			<div class="col-md-3">

			</div>

			<div id="loginID" class="col-md-6">
				<form id="formLogin" method="POST" action="loginHandler.php" class="form-horizontale">

					<div class="form-group <?php if(isset($_SESSION['loginErrors']['user'])) echo 'has-error'; ?>">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?php if(isset($_SESSION['lastLogin']['email'])) echo $_SESSION['lastLogin']['email']; ?>">
						<?php if(isset($_SESSION['loginErrors']['user'])): ?>
							 <span class="help-block">
							 	<?php echo ($_SESSION['loginErrors']['user']); ?>
							 </span>
						<?php endif; ?>
					</div>

					<div class="form-group <?php if(isset($_SESSION['loginErrors']['password'])) echo 'has-error'; ?>">
						<label for="password">Mot de passe</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="password">
						<?php if(isset($_SESSION['loginErrors']['password'])): ?>
							 <span class="help-block">
							 	<?php echo ($_SESSION['loginErrors']['password']); ?>
							 </span>
						<?php endif; ?>
					</div>

					<button type="submit" name="action" class="btn btn-primary">Valider</button>

					<!-- on supprime les erreurs après les avoir affichées une fois  -->
					<?php if(isset($_SESSION['loginErrors'])) { 
						unset($_SESSION['loginErrors']);
					} ?>

					<!-- on supprime les variables de sessions récupérées après les avoir affichées une fois  -->
					<?php if(isset($_SESSION['lastLogin'])) { 
						unset($_SESSION['lastLogin']);
					} ?>

				</form>
			</div>

			<div class="col-md-3">

			</div>
			
		</div>

	</div>

</body>
</html>