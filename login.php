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
			<div class="col-md-3">

			</div>
			<div id="loginID" class="col-md-6">
				<form id="formLogin" method="POST" action="loginHandler.php" class="form-horizontale">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Email">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Password">
					</div>

					<div class="form-group">
						<p class="help-block"><a href="forgotPassword.php">Forgot Your password ?</a></p>
					</div>
					<button type="submit" name="action" class="btn btn-danger">Submit</button>
				</form>
			</div>
			<div class="col-md-3">

			</div>
			

			
		</div>
	</div>
</div>
</body>
</html>


