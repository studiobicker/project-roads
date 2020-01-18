<?php $code = Code::find_by_code($ride->opdracht_factuurcode); ?>

<div class="widget">
  <h5>Status</h5>
  <?php echo h($ride->opdracht_status) ?>
</div>

<div class="widget">
  <h5>Opdracht (<?php echo h($ride->opdracht_opdrachtnummer) ?>)</h5>
  <div><?php echo h($ride->opdracht_opdracht) ?></div>
  <div><?php echo h($ride->opdracht_telefoon) ?></div>
  <div><?php echo h($ride->opdracht_factuurcode) ?> <?php echo h($code->fct_omschrijving) ?></div>
  <div><?php echo h($ride->opdracht_kostenplaats) ?></div>
  <div>prijs</div>
</div>

<div class="widget">
  <p><?php echo nl2br($ride->factuur()); ?></p>
</div>

<div class="widget py-3">
  <small>Laatst gewijzigd op <?php echo get_date(h($ride->opdracht_modified)) ?> om
    <?php echo get_time(h($ride->opdracht_modified)) ?> door <?php echo h($ride->opdracht_modifiedby) ?></small>
</div>