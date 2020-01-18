<?php require_once('../private/initialize.php'); ?>
<?php require_login('15'); ?>
<?php require_rides_session_values(); ?>
<?php $page_title = 'Ritadministratie'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main container-fluid">
  <!-- end if -->
  <div class="page-actions py-3">
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
  <!-- end if -->
  <div class="row">
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