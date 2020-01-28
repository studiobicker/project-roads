<?php require_once('../private/initialize.php'); ?>
<?php require_login('15'); ?>
<?php require_rides_session_values(); ?>
<?php $page_title = 'Ritadministratie'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main container-fluid">
  <!-- end if -->
  <div class="py-3">
    <div class="row">
      <div class="col-md-12">
        <div class="page-actions">
          <div>
            <?php  if( $session->check_login('5') ) { ?>
            <a href="new.php" class="btn btn-primary" tabindex="-1" role="button">Rit toevoegen</a>
            <a href="new.php" class="btn btn-primary" tabindex="-1" role="button">Chaffeur inplannen</a>
            <?php }?>
          </div>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Zoeken" aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Zoeken</button>
          </form>
        </div>
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-md-9">
        <div class="page-actions">
          <div class="date-controls">
            <a href="<?php echo url_for('/rides'); ?>?datum=<?php echo get_day_before($session->datum) ?>"
              id="prev_date" class="btn btn-outline-primary btn-sm mr-1"><i class="fas fa-chevron-left"></i></a>
            <a href="<?php echo url_for('/rides'); ?>?datum=<?php echo get_day_after($session->datum) ?>" id="next_date"
              class="btn btn-outline-primary btn-sm"><i class="fas fa-chevron-right"></i></a>
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
    <div class="row mt-2">
      <div class="col-md-9">
        <div class="page-actions">
          <div class="input-group w-25">
            <select class="custom-select mr-2" id="bulk-action">
              <option selected>Acties...</option>
              <option value="move">Verplaatsen</option>
              <option value="copy">Kopieren</option>
              <option value="retour">Terugreis boeken</option>
            </select>

            <button class="btn btn-outline-primary" type="button">Uitvoeren</button>

          </div>
          <div class="rooster-display">
            Medewerker | <i class="fas fa-print"></i> print
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end if -->
  <div class=" row">
    <div class="col-md-9">


      <table class="table table-hover">
        <thead class="thead-dark">
          <tr>
            <th style="width: 5px; padding:0;"></th>
            <?php  if( $session->check_login('5') ) { ?>
            <th width=10 class="check-column"><input type="checkbox" id="checkAll" /></th>
            <?php }?>
            <th class="datum-column">Datum</th>
            <th width=125>Opdracht</th>
            <th width=45>Start</th>
            <th>Vertrek</th>
            <th width=45>Eind</th>
            <th>Bestemming</th>
            <th width=10>#</th>
            <th width=175>Bijzonderheden</th>
            <?php  if( $session->check_login('5') ) { ?>
            <th width=50></th>
            <?php }?>
          </tr>
        </thead>
        <tbody>
          <?php
      $rides = Ride::find_all();
?>
          <?php foreach($rides as $ride) {
            $creation_date = new DateTime($ride->opdracht_datum);
            ?>
          <tr class="entry-row" data-id="<?php echo $ride->opdracht_id; ?>"
            style="background:<?php echo get_rgba(h($ride->rp_vervoer_kleur)) ?>">
            <td style="background:<?php echo get_rgb(h($ride->rp_vervoer_kleur)) ?>"></td>
            <?php  if ( $session->check_login('5') ) { ?>
            <td scope="row"><input type="checkbox" name="opdracht[]" value="<?php echo $ride->opdracht_id; ?>" />
            </td>
            <?php }?>
            <td scope="row" nowrap="nowrap"><?php echo date_format($creation_date, 'd-m-Y'); ?></td>
            <td scope="row"><?php echo h($ride->opdracht_opdracht); ?></td>
            <td scope="row"><?php echo h($ride->starttijd()); ?></td>
            <td scope="row"><?php echo nl2br($ride->vertrek()); ?></td>
            <td scope="row"><?php echo h($ride->eindtijd()); ?></td>
            <td scope="row"><?php echo nl2br($ride->bestemming()); ?></td>
            <td scope="row"><?php echo h($ride->rit_aantalpassagiers); ?></td>
            <td scope="row"><?php echo nl2br($ride->rit_message); ?></td>
            <?php  if( $session->check_login('5') ) { ?>
            <td scope="row">
              <a href="edit.php?id=<?php echo $ride->opdracht_id; ?>"><i class="fas fa-edit"></i></a>
              <a href="delete.php?id=<?php echo $ride->opdracht_id; ?>"><i class="fas fa-trash-alt"></i></a>
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