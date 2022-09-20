
<?php 
	$i=0;
	$colorBiden="";
	$colorTrump="";
	$color="";
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Carte</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 	 <link href="assets/css/bootstrap.css" rel="stylesheet">	

  </head>
	<?php echo site_url()?>
  <body>
   <div class="container">
   <table class="table">
  <thead>
    <tr>
	  <th scope="col">Etat</th>
      <th scope="col">Trump</th>
	  <th scope="col">Joe</th>
    </tr>
  </thead>
  <tbody>
						<?php foreach($resultData as $donnee)

						{
							if((int)$donnee["candidatA"] > (int)$donnee["candidatB"]){
								$colorBiden="blue";
								$colorTrump="red";
								$color="red";
							}
							if((int)$donnee["candidatA"] < (int)$donnee["candidatB"]){
								$colorBiden="red";
								$colorTrump="blue";
								$color="blue";
							}
							?>
											
    <tr style="background-color:<?php echo $color ;?>" >
      <th scope="row"><?php echo $donnee["nomEtat"] ;?></th>
      <td><?php echo $donnee["candidatA"];?></td>
      <td><?php echo $donnee["candidatB"];?></td>
    </tr>

						<?php 
					$i++;}?>
  </tbody>
</table>
  </div>
  </body>
</html>
