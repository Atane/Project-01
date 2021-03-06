<div class="navbar-fixed-top">

	<div class="container">

		<div class="row">

			<div id="divNav" class="col-md-12">

				<?php if(isset($_SESSION['user'])): ?>
				<ul class="nav navbar-nav">
					<li class="<?php if($pageActive == 'catalogue') echo 'active'; ?>"><a href="catalogue.php">Catalogue</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown"> 
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
							aria-haspopup="true" aria-expanded="false">Profile <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="settings.php">Settings</a></li>
							<li><a href="addGame.php">Add games</a></li>
							<!-- vérifier le rôle de l'user -> doit être admin pour pouvoir accéder à cette page -->
							<?php if($_SESSION['user']['role'] == "admin"): ?>
								<li role="separator" class="divider"></li>
								<li><a href="admin.php">Admin</a></li>
							<?php endif; ?>
							<li role="separator" class="divider"></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>