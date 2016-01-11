<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	
	<title>Register</title>

</head>

<body>
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

					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="email">
					</div>

					<div class="form-group">
						<label for="password">Mot de passe</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="password">
					</div>

					<div class="form-group">
						<label for="passwordConfirm">Confirmer mot de passe</label>
						<input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" placeholder="confirm password">
					</div>

					<div class="form-group">
						<label for="lastname">Nom</label>
						<input type="text" class="form-control" id="lastname" name="lastname" placeholder="lastname">
					</div>

					<div class="form-group">
						<label for="firstname">Nom</label>
						<input type="text" class="form-control" id="firstname" name="firstname" placeholder="firstname">
					</div>

					<div class="form-group">
						<label for="address">Adresse</label>
						<input type="text" class="form-control" id="address" name="address" placeholder="address">
					</div>

					<div class="form-group">
						<label for="zipcode">Code postal</label>
						<input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="zipcode">
					</div>

					<div class="form-group">
						<label for="town">Ville</label>
						<input type="text" class="form-control" id="town" name="town" placeholder="town">
					</div>

					<div class="form-group">
						<label for="phone">Téléphone</label>
						<input type="tel" class="form-control" id="phone" name="phone" placeholder="phone">
					</div>

					<button type="submit" name="action" class="btn btn-primary">Valider</button>

				</form>			
			</div>
		</div>
	</div>

</body>
</html>