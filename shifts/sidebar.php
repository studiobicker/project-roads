<div class="widget">
  <div id="datepicker" data-date="<?php echo $session->datum; ?>"></div>
  <input type="hidden" id="picked-date">
</div>

<div class="widget">
  <ul class="list-group">
    <a href="<?php echo url_for('/shifts/'); ?>?vervoer=ALL" class="list-group-item">
      <span class="icon <?php if ($kenteken == 'ALL') { echo 'active'; } ?>"></span> Alle voertuigen</a>
  </ul>
</div>