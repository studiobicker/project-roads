<?php require_once('../private/initialize.php'); ?>
<?php  require_login('15'); ?>

<?php

  // Get requested ID
  $id = $_GET['id'] ?? false;

  if(!$id) {
    redirect_to(url_for('/rides'));
  }

  // Find code using ID
  $ride = Ride::find_by_id($id);
?>

<?php $page_title = 'Rit'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main code="main" class="site-main">

  <div class="container-fluid py-3">
    <div class="row">
      <div class="col-md-9">
        <div class="row py-3">
          <div class="col-md-12">
            <div class="entry-header">
              <div>
                <h4 class="mt-0"><?php echo h($ride->opdracht_opdracht); ?></h4>
                <p><?php echo h($ride->rp_vervoer_naam); ?></p>
              </div>
              <!-- end if -->
              <div>
                <a href="edit.php?id=<?php echo $ride->opdracht_id ?>" class="btn btn-outline-primary" tabindex="-1"
                  code="button">Bewerken</a>
                <a href="delete.php?id=<?php echo $ride->opdracht_id ?>" class="btn btn-outline-danger"><i
                    class="fas fa-trash-alt"></i></a>
              </div>
              <!-- end if -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"><label>Datum</label></div>
          <div class="col-md-9">
            <?php echo get_date(h($ride->opdracht_datum)) ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"><label>Vertrek</label></div>
          <div class="col-md-9">
            <?php echo h($ride->starttijd()); ?> uur
          </div>
        </div>
        <div class="row">
          <div class="col-md-3"><label>Aankomst</label></div>
          <div class="col-md-9">
            <?php echo h($ride->eindtijd()); ?> uur
          </div>
        </div>

        <div class="row py-3">
          <div class="col-md-12">
            <div class="card-deck">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title text-secondary">Vertrek</h5>
                  <p class="card-text"><?php echo nl2br($ride->vertrek()); ?></p>

                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title text-secondary">Bestemming</h5>
                  <p class="card-text"><?php echo nl2br($ride->bestemming()); ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row py-3">
          <div class="col-md-12">
            <h6>Mededeling</h6>
            <p><?php echo nl2br($ride->rit_message); ?></p>
          </div>
        </div>
      </div>
      <aside class="col-md-3">
        <?php include(SITE_PATH . '/rides/sidebar-single.php') ?>
      </aside>
    </div>
</main>

<!--Content area end-->
<?php include(SITE_PATH . '/footer.php'); ?>