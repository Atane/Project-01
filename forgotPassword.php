<?php
	session_start();

	require(__DIR__.'/config/db.php');
	require(__DIR__.'/include/functions.php');

	// vérifier que le form a été envoyé
	if(isset($_POST['action'])) {
		// récupération de l'email
		$email = trim(htmlentities($_POST['email']));

		// initialisation du tableau d'erreur
		$errors = [];

		// check du champ email
		if(empty($email) || (filter_var($email, FILTER_VALIDATE_EMAIL)) === false) {
			$errors['email'] = "Email incorrect.";
		}

		if (empty($errors)) {
			// récupération de l'user en bdd
			$query = $pdo->prepare('SELECT * FROM users WHERE email = :email');
			$query->bindValue(':email', $email, PDO::PARAM_STR);
			$query->execute();

			$resultUser = $query->fetch();

			// si j'ai bien un user en bdd
			if($resultUser) {
				
				// génération du token
				$token = md5(uniqid(mt_rand(), true));

				// date d'expiration du token
				$expireToken = date('Y-m-d H:i:s', strtotime("+ 1 day"));

				// récupération de l'adresse IP du demandeur
				$ip = $_SERVER['REMOTE_ADDR'];

				// sauvegarder les 3 variables créées : 
				$query = $pdo->prepare('UPDATE users 
							    SET token = :token, exp_token = :exp_token, ip = :ip 
							    WHERE id = :id');

				$query->bindValue(':token', $token, PDO::PARAM_STR);
				$query->bindValue(':exp_token', $expireToken, PDO::PARAM_STR);
				$query->bindValue(':ip', $ip, PDO::PARAM_STR);
				$query->bindValue(':id', $resultUser['id'], PDO::PARAM_INT);
				$query->execute();


				// si mise à jour OK
				if($query->rowCount() > 0) {
					// génération du lien permettant de reset le pwd
					$resetLink = 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']).'/resetPassword.php?token='.$token.'&email='.$email;
				
					/*echo $resetLink; 
					die();*/

					// envoyer un email à l'user
					$mail = new PHPMailer;

					$mail->isSMTP();                                      // Set mailer to use SMTP
					$mail->Host = 'smtp.mailgun.org';  // Specify main and backup SMTP servers
					$mail->SMTPAuth = true;                               // Enable SMTP authentication
					$mail->Username = 'postmaster@sandbox504c3f44050c4ee3aa785151b4924429.mailgun.org';                 // SMTP username
					$mail->Password = '5af02be0e52d7990ab876526bae4ba3e';                           // SMTP password
					$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
					$mail->Port = 587;                                    // TCP port to connect to

					$mail->setFrom('no-reply@aego.fr', 'Test WebForce 3');
					$mail->addAddress($email);               // Name is optional

					$mail->isHTML(true);   // Set email format to HTML

					$mail->Subject = 'Mot de passe oublié';
					$mail->Body    = '<a href="'.$resetLink.'">Cliquez sur le lien suivant pour réinitialiser le password</a>';

					if(!$mail->send()) {
					    echo 'Message could not be sent.';
					    echo 'Mailer Error: ' . $mail->ErrorInfo;
					} else {
					    echo 'Message has been sent';
					}

					// faire le resetPassword.php avec le modèle dans wfr3_session
				}
			}
			else {
				$errors['email'] = "Email introuvable dans la base de données.";
			}
		}
	}
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
				<img src="img/icone.ico" class="img-circle" width="150" height="150">
				<h1 id="title">Gameloc</h1>
				<P>Reset Password</P>
			</div>

		</div>

		<div class="row">

			<div class="col-md-3">

			</div>

			<div id="loginID" class="col-md-6">
				<form id="formLogin" method="POST" action="#" class="form-horizontale">

					<div class="form-group <?php if(isset($_SESSION['loginErrors']['user'])) echo 'has-error'; ?>">
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?php if(isset($_SESSION['lastLogin']['email'])) echo $_SESSION['lastLogin']['email']; ?>">
						<?php if(isset($_SESSION['loginErrors']['user'])): ?>
							 <span class="help-block">
							 	<?php echo ($_SESSION['loginErrors']['user']); ?>
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

	<?php include(__DIR__.'/include/footer.php'); ?>

</body>
</html>