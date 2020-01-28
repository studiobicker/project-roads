<div class="widget">
  <div id="datepicker" data-date="<?php echo $session->datum; ?>"></div>
  <input type="hidden" id="picked-date">
</div>
<?php $vehicles = Vehicle::find_all_enabled(); ?>
<?php $kenteken = $session->vervoer; ?>
<div class="widget">

  <ul class="list-group">
    <a href="<?php echo url_for('/rides/'); ?>?vervoer=ALL" class="list-group-item">
      <span class="icon <?php if ($kenteken == 'ALL') { echo 'active'; } ?>"></span> Alle voertuigen</a>
    <?php foreach($vehicles as $vehicle) { ?>
    <a href="<?php echo url_for('/rides/'); ?>?vervoer=<?php echo h($vehicle->rp_vervoer_kenteken); ?>"
      class="list-group-item" style="background:<?php echo h($vehicle->rp_vervoer_kleur); ?>">
      <span class="icon <?php if ($kenteken == $vehicle->rp_vervoer_kenteken) { echo 'active'; } ?>"></span>
      <?php echo h($vehicle->rp_vervoer_naam); ?></a>
    <?php } ?>
  </ul>

</div>
<hr>
<?php $shifts = Shift::find_all(); ?>
<div class="widget">

  <ul class="list-group">
    <?php foreach($shifts as $shift) { ?>
    <li style="background:<?php echo h($shift->rp_vervoer_kleur); ?>" class="list-group-item">
      <div class="d-flex w-100 justify-content-between">
        <div><?php echo get_time(h($shift->rooster_start)) ?> - <?php echo get_time(h($shift->rooster_end)) ?>
          <?php echo h($shift->rooster_medewerker); ?></div>
        <?php if($session->check_login('5') ) {?>
        <div>
          <a href="edit.php?id=<?php echo $shift->rooster_id; ?>"><i class="fas fa-edit text-dark"></i></a>
          <a href="delete.php?id=<?php echo $shift->rooster_id; ?>"><i class="fas fa-trash-alt text-dark"></i></a>
        </div>
        <?php } ?>
      </div>
    </li>
    <?php } ?>
  </ul>

</div>