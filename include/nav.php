<div class="navbar-fixed-top">

	<div class="container">

		<div class="row">

			<div id="divNav" class="col-md-12">

				<ul class="nav navbar-nav">
					<li class="<?php if($page == 'home') echo 'active'; ?>"><a href="index.php">Home</a></li>
					<li class="<?php if($page == 'friends') echo 'active'; ?>"><a href="catalogue.php">Catalogue</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">  <!-- <?php if($page == 'profile') echo 'active'; ?>  -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
							aria-haspopup="true" aria-expanded="false">Profile <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="settings.php">Settings</a></li>
							<li><a href="addGame.php">Add games</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>	
			</div>
		</div>
	</div>
</div>