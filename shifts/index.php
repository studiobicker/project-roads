<?php require_once('../private/initialize.php'); ?>
<?php require_login('15'); ?>
<?php require_rides_session_values(); ?>
<?php $page_title = 'Rooster'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main container-fluid">
  <div class="py-3">
    <div class="row">
      <div class="col-md-12">
        <div class="page-actions">
          <div>
            <?php  if( $session->check_login('5') ) { ?>
            <a href="new.php" class="btn btn-primary" tabindex="-1" role="button">Chaffeur inplannen</a>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-md-9">
        <div class="page-actions">
          <div class="date-controls">
            <a href="<?php echo url_for('/shifts'); ?>?datum=<?php echo get_day_before($session->datum) ?>"
              id="prev_date" class="btn btn-outline-primary btn-sm mr-1"><i class="fas fa-chevron-left"></i></a>
            <a href="<?php echo url_for('/shifts'); ?>?datum=<?php echo get_day_after($session->datum) ?>"
              id="next_date" class="btn btn-outline-primary btn-sm"><i class="fas fa-chevron-right"></i></a>
            <h5 class="ml-3 mb-0"><?php echo get_day_date($session->datum) ?></h5>
          </div>
          <div class="vehicle-display">
            <?php
            if($session->vervoer) {
              $vehicle = Vehicle::find_by_kenteken($session->vervoer);
              if ($vehicle) { ?>
            <h5><?php echo $vehicle->rp_vervoer_naam ?> &middot <?php echo $vehicle->rp_vervoer_telefoon ?></h5>
            <?php } 
            } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class=" row">
    <div class="col-md-9">

      <table class="table table-hover">
        <thead class="thead-dark">
          <tr>
            <th style="width: 5px; padding:0;"></th>
            <th width=125>Datum</th>
            <th width=45>Start</th>
            <th width=45>Eind</th>
            <th>Naam</th>
            <th>Voertuig</th>
            <th>Mededeling</th>
            <?php if($session->check_login('5') ) {?>
            <th width=60>Acties</th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
          <?php $shifts = Shift::find_all(); ?>
          <?php foreach($shifts as $shift) { ?>
          <tr class="entry-row" data-id="<?php echo $shift->rooster_id; ?>"
            style="background:<?php echo get_rgba(h($shift->rp_vervoer_kleur)) ?>">
            <td style="background:<?php echo get_rgb(h($shift->rp_vervoer_kleur)) ?>">
            </td>
            <td scope="row" nowrap="nowrap"><?php echo get_date(h($shift->rooster_start)) ?></td>
            <td scope="row"><?php echo h($shift->starttijd()); ?></td>
            <td scope="row"><?php echo h($shift->eindtijd()); ?></td>
            <td scope="row"><?php echo h($shift->rooster_medewerker); ?></td>
            <td scope="row"><?php echo h($shift->rp_vervoer_naam); ?></td>
            <td scope="row"><?php echo nl2br($shift->rooster_description); ?></td>
            <?php if($session->check_login('5') ) {?>
            <td scope="row">
              <a href="edit.php?id=<?php echo $shift->rooster_id; ?>"><i class="fas fa-edit"></i></a>
              <a href="delete.php?id=<?php echo $shift->rooster_id; ?>"><i class="fas fa-trash-alt"></i></a>
            </td>
            <?php } ?>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <aside class="col-md-3">
      <?php include('sidebar.php') ?>
    </aside>
  </div>

</main>
<!--Content area end-->
<?php include(SITE_PATH . '/footer.php'); ?>