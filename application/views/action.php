<div class="container">

    <div class="row">

      <div class="col-lg-3">

        <!-- <h1 class="my-4">Shop Name</h1>
        <div class="list-group">
          <a href="#" class="list-group-item">Category 1</a>
          <a href="#" class="list-group-item">Category 2</a>
          <a href="#" class="list-group-item">Category 3</a>
        </div> -->

      </div>
      <!-- /.col-lg-3 -->
      <div>
        <table>
          <tr>
          <td>Candidat</td>
            <td>Nombre grands electeur</td>
          </tr>
          <?php foreach ($resultData as $data) { ?>
          <tr>
            <td><?php echo $data['nomCandidat']?></td>
            <td><?php echo $data['nbge'];?></td>
            <td></td>
          </tr>
          <?php } ?>
        </table>
      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
