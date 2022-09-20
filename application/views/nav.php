<div class="container">



      <div class="col-lg-3">

      </div>
      <!-- /.col-lg-3 -->
      <div>
        <form action="<?php echo site_url('/welcome/insertResultat/') ?>" method="post">
          <p>Sasie resultat</p>
          <select type="select" name="etat">
             <?php foreach ($etatData as $data) { ?>
             <option value="<?php echo $data['idEtat'];?>"><?php echo $data['nomEtat'];?></option>
             <?php } ?>
          </select>
          <p>Donald Trump : <input type="number" name="vc1" /></p>
          <p>Joe Biden : <input type="number" name="vc2" /></p>
          <p><input type="submit" value="OK"></p>
        </form>
      </div>
      <div>
            <table>
              <tr>
                <td>Etat</td>
                <td>Donald Trump</td>
                <td>Joe Biden</td>
          </tr>
          <?php foreach ($infoData as $data) { ?>
          <tr>
            <td><?php echo $data['nomEtat']?></td>
            <td><?php echo $data['candidatA'];?></td>
            <td><?php echo $data['candidatB'];?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
      <a href="<?php echo site_url('/welcome/fiche');?>" class="list-group-item"><p>Voir resultat</p></a>
			<a href="<?php echo site_url('/welcome/carte');?>" class="list-group-item"><p>Voir Carte</p></a>

    </	div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
