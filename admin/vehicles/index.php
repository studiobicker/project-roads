<?php require_once('../../private/initialize.php'); ?>
<?php  require_login('1'); ?>
<?php $page_title = 'Voertuigen'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main container">
  <!-- end if -->
  <div class="page-actions py-3">
    <a href="new.php" class="btn btn-primary" tabindex="-1" role="button">Toevoegen</a>
  </div>
  <!-- end if -->
  <div class="row">
    <div class="col-md-9">


      <table class="table table-hover">
        <thead class="thead-dark">
          <tr>
            <th>Voertuig</th>
            <th>Zitplaatsen</th>
            <th nowrap="nowrap">Kenteken</th>
            <th nowrap="nowrap">Telefoon</th>
            <th>Status</th>
            <th width=60>Acties</th>
          </tr>
        </thead>
        <tbody>
          <?php
      $vehicles = Vehicle::find_all();
?>
          <?php foreach($vehicles as $vehicle) { ?>
          <tr class="entry-row" data-id="<?php echo $vehicle->rp_vervoer_id; ?>">

            <td scope="row"><?php echo h($vehicle->rp_vervoer_naam); ?></td>
            <td scope="row"><?php echo h($vehicle->rp_vervoer_aantalzit); ?></td>
            <td scope="row" nowrap="nowrap"><?php echo h($vehicle->rp_vervoer_kenteken); ?></td>
            <td scope="row" nowrap="nowrap"><?php echo h($vehicle->rp_vervoer_telefoon); ?></td>
            <td scope="row" nowrap="nowrap">
              <?php if(h($vehicle->rp_vervoer_disabled) == 0){ echo 'actief';} else {echo 'buiten dienst';} ?></td>
            <td scope="row">
              <a href="edit.php?id=<?php echo $vehicle->rp_vervoer_id; ?>"><i class="fas fa-edit"></i></a>
              <a href="delete.php?id=<?php echo $vehicle->rp_vervoer_id; ?>"><i class="fas fa-trash-alt"></i></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <aside class="col-md-3">
      <?php include(SITE_PATH . '/admin/sidebar.php') ?>
    </aside>
  </div>
</main>
<!--Content area end-->
<?php include(SITE_PATH . '/footer.php'); ?>