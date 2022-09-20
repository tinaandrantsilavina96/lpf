<?php
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
	<h2>Election Madagascar</h2>
	
	<div class="row">
    <div class="col-sm"></div>
    <div class="col-sm">
	<div class="shadow-lg p-3 mb-5 bg-white rounded">
			<form action="<?php echo site_url('index.php/welcome/insertVoix/') ?>" method="Post">
		
		<div class="form-group">
				<select name="province" class="form-control">
				<option selected>Choisir Province</option>
					<?php foreach($province as $pro)
					
					{?>
					
						
						<option value="<?php echo $pro["idProvince"]?>"><?php echo $pro["nomProvince"];echo $pro["idProvince"]?></option>
					<?php }?>
			</select>
		</div>
		<div class="form-group">
				<select name="candidat" class="form-control">
				<option selected>Choisir Candidat</option>
				<?php foreach($candidat as $pro)
					{?>
						<option value="<?php echo $pro["idCandidat"]?>"><?php echo $pro["nomCandidat"];echo $pro["idCandidat"]?></option>
					<?php }?>
			</select>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1"></label>
			<input type="number" class="form-control" name="voix" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Voix">
		</div>
		
		<button type="submit" class="btn btn-primary">Ok</button>
		</form>

		</div>


	<!-- ---------------------------------------->
	<table class="table">
  <thead>
    <tr>
      <th scope="col">Province</th>
	  <?php foreach($candidat as $pro){
		  ?>
				<th scope="col"><?php echo $pro["nomCandidat"] ; ?></th>
	  <?php } ?>
      

    </tr>
  </thead>
  <tbody>
		<?php foreach($province as $pro)
		{?>						
    <tr>
      <th scope="row"><?php echo $pro["nomProvince"]?></th>
				
	  <td>Mark</td>
      
    </tr>
		<?php } ?>



  </tbody>
</table>

    </div>
    <div class="col-sm"></div>
  </div>


</div>
<?php include("inc/footer.php");?>
</body>
</html>
