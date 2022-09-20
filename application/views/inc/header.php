<nav class="position-sticky  navbar navbar-expand-lg navbar-light bg-light" style="background-color: #c20b6d;">
  <a class="navbar-brand" href="#"><i class="fas fa-globe "style="margin-right:3%"></i>Stat-Foot</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
		<li class="nav-item">
        <a class="nav-link" href="<?php echo site_url("index.php/moncontroller/")?>">statistique <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url("index.php/moncontroller/but/")?>">But</a>
      </li>

			<li class="nav-item">
        <a class="nav-link" href="<?php echo site_url("index.php/moncontroller/faute/")?>">Faute</a>
      </li>

			<li class="nav-item">
        <a class="nav-link" href="<?php echo site_url("index.php/moncontroller/cartonJaune/")?>">Carton Jaune</a>
      </li>

			<li class="nav-item">
        <a class="nav-link" href="<?php echo site_url("index.php/moncontroller/cartonRouge/")?>">Carton Rouge</a>
      </li>

		<!--

			<?php 
					if(!isset($_SESSION["user"]))
					{?>


								<li class="nav-item">
									<a class="nav-link" href="<?php echo site_url("index.php/logincontroller/connexion")?>">Connexion</a>
								</li>
				
				
				<?php	}
					else
					{?>
					
								<li class="nav-item">
									<a class="nav-link" href="<?php echo site_url("index.php/logincontroller/deconnexion")?>">Deconnection <?php //echo $_SESSION["user"]?></a>
								</li>
					
					
					<?php }
			?>
-->


<!--
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown link
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
			-->
    </ul>
  </div>
</nav>

