<?php require_once('../../private/initialize.php'); ?>
<?php  require_login('1'); ?>

<?php

  // Get requested ID
  $id = $_GET['id'] ?? false;

  $vehicle = Vehicle::find_by_id($id);
  if($vehicle == false) {
    redirect_to(url_for('/admin/vehicles'));
  }

?>

<?php $page_title = 'Voertuig'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main">

  <div class="container py-3">
    <div class="row">
      <div class="col-md-9">
        <div class="row py-3">
          <div class="col-md-12">
            <div class="entry-header">
              <div>
                <h4 class="mt-0"><?php echo h($vehicle->rp_vervoer_naam); ?></h4>
              </div>
              <!-- end if -->
              <a href="edit.php?id=<?php echo $vehicle->rp_vervoer_id ?>" class="btn btn-outline-primary" tabindex="-1"
                role="button">Bewerken</a>
              <!-- end if -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Aantal zitplaatsen</div>
          <div class="col-md-8">
            <?php echo h($vehicle->rp_vervoer_aantalzit); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Kenteken</div>
          <div class="col-md-8">
            <?php echo h($vehicle->rp_vervoer_kenteken); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Telefoon</div>
          <div class="col-md-8">
            <?php echo h($vehicle->rp_vervoer_telefoon); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Kleurcode</div>
          <div class="col-md-8">
            <div id="cp1" class="input-group" title="Using input value">
              <input type="text" class="form-control input-lg" value="<?php echo h($vehicle->rp_vervoer_kleur); ?>"
                name="rp_vervoer_kleur" id="rp_vervoer_kleur" hidden disabled />
              <span class="input-group-append">
                <span class="colorpicker-input-addon"><i></i></span>
              </span>
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Status</div>
          <div class="col-md-8">
            <?php echo h($vehicle->status()); ?>
          </div>
        </div>
      </div>
      <aside class="col-md-3">
        <?php include(SITE_PATH . '/admin/sidebar.php') ?>
      </aside>
    </div>
</main>

<!--Content area end-->
<?php include(SITE_PATH . '/footer.php'); ?>