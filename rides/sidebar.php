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