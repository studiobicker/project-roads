<?php require_once('../private/initialize.php'); ?>
<?php  require_login('15'); ?>

<?php

  // Get requested ID
  $id = $_GET['id'] ?? false;

  $shift = Shift::find_by_id($id);
  if($shift == false) {
    redirect_to(url_for('/shifts'));
  }

?>

<?php $page_title = 'Chauffeur'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main container-fluid">

  <div class="py-3">
    <div class="row">
      <div class="col-md-9">
        <div class="row py-3">
          <div class="col-md-12">
            <div class="entry-header">
              <div>
                <h4 class="mt-0"><?php echo h($shift->rooster_medewerker); ?></h4>
              </div>
              <!-- end if -->

              <div>
                <?php  if( $session->check_login('5') ) { ?>
                <a href="edit.php?id=<?php echo $shift->rooster_id ?>" class="btn btn-outline-primary" tabindex="-1"
                  code="button">Bewerken</a>
                <a href="delete.php?id=<?php echo $shift->rooster_id ?>" class="btn btn-outline-danger"><i
                    class="fas fa-trash-alt"></i></a>
                <?php }?>
              </div>
              <!-- end if -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"><label>Datum</label></div>
          <div class="col-md-8">
            <?php echo get_date(h($shift->rooster_start)) ?>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4"><label>Begin</label></div>
          <div class="col-md-8">
            <?php echo h($shift->starttijd()); ?> uur
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"><label>Eind</label></div>
          <div class="col-md-8">
            <?php echo h($shift->eindtijd()); ?> uur
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-4">Medewerker</div>
          <div class="col-md-8">
            <?php echo h($shift->rooster_medewerker); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Voertuig</div>
          <div class="col-md-8">
            <?php echo h($shift->rp_vervoer_naam); ?>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <h6>Mededeling</h6>
            <p><?php echo nl2br($shift->rooster_description); ?></p>
          </div>
        </div>
      </div>


      <aside class="col-md-3">

      </aside>
    </div>
</main>

<!--Content area end-->
<?php include(SITE_PATH . '/footer.php'); ?>