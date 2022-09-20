<?php
//var_dump($test);
//var_dump($statCartonJaune);
//session_start();

$idUser="";
if(isset($_SESSION["user"]))
		{
$idUser=$_SESSION["user"];
		}
defined('BASEPATH') OR exit('No direct script access allowed');
//var_dump($pageActuel);
//var_dump($ligne);
//echo $this->session->userdata('utiliateur');

$cssPrevious="";$cssNext="";$cssPageActuel="";

?><!DOCTYPE html>
<?php echo $statCartonJaune[1];?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Ketrika</title>
	<?php include("inc/style.php");?>
</head>
<body>

<?php include("inc/header.php");?>




<div class="container">
  <div class="row">
    <div class="col"></div>
    <div class="col-6">
      

	<div class="shadow-lg p-3 mb-5 bg-white rounded">
	
		<table class="table">
			<thead class="thead-light">
				<tr>

				<th scope="col">Madagascar</th>
				<th scope="col"></th>
				
				<th scope="col">Cote d'Ivoir</th>
				</tr>
			</thead>
			<tbody>
				
				<tr>
				
					<td><?php// echo data["first_name"];?>
					
						<div class="progress">
							<div class="progress-bar" role="progressbar" style="width: <?php echo $statCartonJaune[0];?>%" aria-valuenow="<?php echo $statCartonJaune[0];?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</td>
					<th scope="row">CartonJaune</th>
					<td><?php //echo $data["last_name"];?>
					<div class="progress">
							<div class="progress-bar" role="progressbar" style="width: <?php echo $statCartonJaune[1];?>%" aria-valuenow="<?php echo $statCartonJaune[1];?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</td>
					
				</tr>


				<!-- 
<tr>
				
					<td><?php// echo data["first_name"];?>
					
						<div class="progress">
							<div class="progress-bar" role="progressbar" style="width: <?php echo $statBut[0];?>%" aria-valuenow="<?php echo $statBut[0];?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</td>
					<th scope="row">But</th>
					<td><?php //echo $data["last_name"];?>
					<div class="progress">
							<div class="progress-bar" role="progressbar" style="width: <?php echo $statBut[1];?>%" aria-valuenow="<?php echo $statBut[1];?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</td>
					
				</tr>

				<tr>
			

				<tr>
				
				<td><?php// echo data["first_name"];?>
					
					<div class="progress">
						<div class="progress-bar" role="progressbar" style="width: <?php echo $statCartonRouge[0];?>%" aria-valuenow="<?php echo $statCartonRouge[0];?>" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</td>
				<th scope="row">C Rouge</th>
				<td><?php //echo $data["last_name"];?>
				<div class="progress">
						<div class="progress-bar" role="progressbar" style="width: <?php echo $statCartonRouge[1];?>%" aria-valuenow="<?php echo $statCartonRouge[1];?>" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</td>
					
				</tr>

				<tr>
				
					<td><?php// echo data["first_name"];?></td>
					<th scope="row">Possesion</th>
					<td><?php //echo $data["last_name"];?></td>
				
				</tr>
				<tr>
				
					<td><?php// echo data["first_name"];?></td>
					<th scope="row">Tir Cadrer</th>
					<td><?php //echo $data["last_name"];?></td>
				
				</tr>
				</tr>
				
				-->
				
			</tbody>
		</table>
		<div class="row">
			<div class="col-sm"></div>
			<div class="col-sm"></div>

	
		</div>			
	</div>


    </div>
    <div class="col"></div>
  </div>
</div>





<?php include("inc/footer.php");?>
</body>
</html>







