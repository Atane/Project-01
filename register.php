<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	
	<title>Register</title>

</head>

<body>

	<?php include(__DIR__.'/include/nav.php'); ?>

	<div class="container">

		<div class="row">

			<div id="divMid" class="col-md-12">
				<img src="img/icone.ico" class="img-circle" width="150" height="150">
				<h1 id="title">Gameloc</h1>
				<p>Inscription</p>				
			</div>
		</div>

		<div class="row">

			<div id="loginID" class="col-md-6 col-md-offset-3">
				<form method="POST" action="registerHandler.php">

				<!-- 	<?php echo '<pre>' ?>
					<?php print_r($_SESSION['registerErrors']) ?>
					<?php echo '</pre>' ?> -->

					<div class="form-group <?php if(isset($_SESSION['registerErrors']['email'])) echo 'has-error'; ?>">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?php if(isset($_SESSION['lastRegister']['email'])) echo $_SESSION['lastRegister']['email']; ?>">
						<?php if(isset($_SESSION['registerErrors']['email'])): ?>
							 <span class="help-block">
							 	<?php echo ($_SESSION['registerErrors']['email']); ?>
							 </span>
						<?php endif; ?>
					</div>

					<div class="form-group <?php if(isset($_SESSION['registerErrors']['password'])) echo 'has-error'; ?>">
						<label for="password">Mot de passe</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="password">
						<?php if(isset($_SESSION['registerErrors']['password'])): ?>
							 <span class="help-block">
							 	<?php echo ($_SESSION['registerErrors']['password']); ?>
							 </span>
						<?php endif; ?>
					</div>

					<div class="form-group">
						<label for="passwordConfirm">Confirmer mot de passe</label>
						<input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" placeholder="confirm password">
					</div>

					<div class="form-group <?php if(isset($_SESSION['registerErrors']['lastname'])) echo 'has-error'; ?>">
						<label for="lastname">Nom</label>
						<input type="text" class="form-control" id="lastname" name="lastname" placeholder="lastname" value="<?php if(isset($_SESSION['lastRegister']['lastname'])) echo $_SESSION['lastRegister']['lastname']; ?>">
						<?php if(isset($_SESSION['registerErrors']['lastname'])): ?>
							 <span class="help-block">
							 	<?php echo ($_SESSION['registerErrors']['lastname']); ?>
							 </span>
						<?php endif; ?>
					</div>

					<div class="form-group <?php if(isset($_SESSION['registerErrors']['firstname'])) echo 'has-error'; ?>">
						<label for="firstname">Prénom</label>
						<input type="text" class="form-control" id="firstname" name="firstname" placeholder="firstname" value="<?php if(isset($_SESSION['lastRegister']['firstname'])) echo $_SESSION['lastRegister']['firstname']; ?>">
						<?php if(isset($_SESSION['registerErrors']['firstname'])): ?>
							 <span class="help-block">
							 	<?php echo ($_SESSION['registerErrors']['firstname']); ?>
							 </span>
						<?php endif; ?>
					</div>

					<div class="form-group <?php if(isset($_SESSION['registerErrors']['address'])) echo 'has-error'; ?>">
						<label for="address">Adresse</label>
						<input type="text" class="form-control" id="address" name="address" placeholder="address" value="<?php if(isset($_SESSION['lastRegister']['address'])) echo $_SESSION['lastRegister']['address']; ?>">
						<?php if(isset($_SESSION['registerErrors']['address'])): ?>
							 <span class="help-block">
							 	<?php echo ($_SESSION['registerErrors']['address']); ?>
							 </span>
						<?php endif; ?>
					</div>

					<div class="form-group <?php if(isset($_SESSION['registerErrors']['zipcode'])) echo 'has-error'; ?>">
						<label for="zipcode">Code postal</label>
						<input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="zipcode" value="<?php if(isset($_SESSION['lastRegister']['zipcode'])) echo $_SESSION['lastRegister']['zipcode']; ?>">
						<?php if(isset($_SESSION['registerErrors']['zipcode'])): ?>
							 <span class="help-block">
							 	<?php echo ($_SESSION['registerErrors']['zipcode']); ?>
							 </span>
						<?php endif; ?>
					</div>

					<div class="form-group <?php if(isset($_SESSION['registerErrors']['town'])) echo 'has-error'; ?>">
						<label for="town">Ville</label>
						<input type="text" class="form-control" id="town" name="town" placeholder="town" value="<?php if(isset($_SESSION['lastRegister']['town'])) echo $_SESSION['lastRegister']['town']; ?>">
						<?php if(isset($_SESSION['registerErrors']['town'])): ?>
							 <span class="help-block">
							 	<?php echo ($_SESSION['registerErrors']['town']); ?>
							 </span>
						<?php endif; ?>
					</div>

					<div class="form-group <?php if(isset($_SESSION['registerErrors']['phone'])) echo 'has-error'; ?>">
						<label for="phone">Téléphone</label>
						<input type="tel" class="form-control" id="phone" name="phone" placeholder="phone" value="<?php if(isset($_SESSION['lastRegister']['phone'])) echo $_SESSION['lastRegister']['phone']; ?>">
						<?php if(isset($_SESSION['registerErrors']['phone'])): ?>
							 <span class="help-block">
							 	<?php echo ($_SESSION['registerErrors']['phone']); ?>
							 </span>
						<?php endif; ?>
					</div>

					<button type="submit" name="action" class="btn btn-primary">Valider</button>

					<!-- on supprime les erreurs après les avoir affichées une fois  -->
					<?php if(isset($_SESSION['registerErrors'])) { 
						unset($_SESSION['registerErrors']);
					} ?>

					<!-- on supprime les variables de sessions récupérées après les avoir affichées une fois  -->
					<?php if(isset($_SESSION['lastRegister'])) { 
						unset($_SESSION['lastRegister']);
					} ?>					

				</form>			
			</div>
		</div>
	</div>

	<?php include(__DIR__.'/include/footer.php'); ?>

</body>
</html>