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

	<?php include(__DIR__.'/include/nav.php'); ?>

	<div class="container">

		<div class="row">

			<div id="divMid" class="col-md-12">

				<!-- insertion d'un message si l'user a bien été déconnecté -->
				<?php if(isset($_SESSION['message'])) :?>
					<div class="alert alert-info">
						<p><?php  echo $_SESSION['message']; ?></p>
						<?php  unset($_SESSION['message']); ?>
					</div>
				<?php endif; ?>	

				<img src="img/icone.ico" class="img-circle" width="150" height="150">
				<h1 id="title">Gameloc</h1>
				<p>Bienvenue dans la plus grande communauté de gamers sur Paris</p>
				<p>Nous mettons les gamers en relation pour qu'ils puissent s'échanger les jeux vidéos de n'importe quelle</p>
				<p>plateforme</p>
				<p>PC, Xbox, PS4</p>

				<button type="submit" name="actionRegister" value="register" onclick="self.location.href='register.php'" class="btn btn-success">Inscription</button>

				<button type="submit" name="actionLogin" value="login" onclick="self.location.href='login.php'" class="btn btn-primary">Connexion</button>
				
			</div>
		</div>
	</div>

	<?php include(__DIR__.'/include/footer.php'); ?>

</body>
</html>