<?php
//var_dump($utilisateur);
//var_dump($pourcentage);
defined('BASEPATH') OR exit('No direct script access allowed');
//var_dump($candidat);
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Election Mada</title>
	<?php include("inc/style.php");?>
</head>
<body>

<?php include("inc/header.php");?>
<div id="container">
	<div class="row" style="margin-top:2%">
		<div class="col-sm"></div>
		<div class="col-sm">
		<div class="shadow-lg p-3 mb-5 bg-white rounded">
				
				<form action="<?php echo site_url('index.php/logincontroller/') ?>" method="Post">
						<p class="text-center">
							<i class="fas fa-user-circle fa-7x"></i>
						</p>

					<?php if(isset($erreur)){?>
								
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							Votre <strong>Nom d'utilisateur</strong> ou <strong>Mot de Passe</strong> est Incorrecte.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php }?>
					<div class="form-group">
						<label for="exampleInputEmail1"></label>
						 <input type="text" class="form-control" name="user" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nom d'utilisateur">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1"></label>
						<input type="text" class="form-control" name="mdp" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Mot de Passe">
					</div>
					<p class="text-right">
						<button type="submit" class="btn btn-success">Connexion</button>
					</p>
				</form>

		</div>

    </div>
    <div class="col-sm"></div>
  </div>


</div>
<?php include("inc/footer.php");?>
</body>
</html>
