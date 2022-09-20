<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$minute=90;
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>E-Foot</title>
	<?php include("inc/style.php");?>
</head>
<body>

<?php include("inc/header.php");?>
<div id="container">
	<div class="row" style="margin-top:2%">
		<div class="col-sm"></div>
		<div class="col-sm">
			<p class="text-center"><h2>Insert Carton Rouge</h2> </p>
		<div class="shadow-lg p-3 mb-5 bg-white rounded">
		
				<form action="<?php echo site_url('index.php/moncontroller/insertCartonRouge/') ?>" method="Post">
						<p class="text-center">
							<!--<i class="fas fa-user-circle fa-7x"></i>-->
						</p>
						<div class="form-group">
						<select name="idJoueur"  class="form-control">
							<!--<option selected>Choisir Joueur</option>-->
									<?php foreach($joueur as $j){?>
							<option value="<?php echo $j["idJoueur"]?> "> <?php echo $j["nomJoueur"]?> --- <?php echo $j["nomEquipe"]?></option>
									<?php }?>
						</select>	
						</div>
					<div class="form-group">
						<select name="minute" class="form-control">
							<option selected>Choisir Minute</option>
										<?php for($i=1;$i<=90; $i++){?>
							<option value="<?php echo $i; ?>"> <?php echo $i;?></option>
										<?php }?>
						</select>		</div>
				<input type="hidden" name="idMatch" value="1">
					<p class="text-right">
						<button type="submit" class="btn btn-success">ok</button>
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
