<?php require_once('../private/initialize.php'); ?>
<?php require_login('1'); ?>
<?php $page_title = 'Facturen'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main container-fluid">
  <!-- end if -->
  <div class="py-3">
    <div class="row mt-2">
      <div class="col-md-12">
        <div class="page-actions">
          <div class="input-group mr-2 w-75">
            <select class="custom-select mr-2" id="bulk-action">
              <option selected>Acties...</option>
              <?php foreach(Ride::INVOICE_OPTIONS as $option_value => $option_description) { ?>
              <option value="<?php echo $option_value; ?>"
                <?php //if($vehicle->rp_vervoer_disabled == $status_id) { echo 'selected'; } ?>>
                <?php echo $option_description; ?>
              </option>
              <?php } ?>
            </select>
            <button class="btn btn-outline-primary" id="action_invoices" type="submit">Uitvoeren</button>
          </div>
          <?php $codes = Code::find_all_enabled(); ?>
          <div class="input-group">
            <select class="custom-select mr-2" id="code-action">
              <option selected>Alle factuurcodes</option>
              <?php foreach($codes as $code) { ?>
              <option value="<?php echo h($code->fct_code) ?>"
                <?php if($ride->opdracht_factuurcode === $code->fct_code) { echo 'selected'; } ?>>
                <?php echo h($code->fct_code) ?> - <?php echo h($code->fct_omschrijving) ?>
              </option>
              <?php } ?>
            </select>
            <select class="custom-select mr-2" id="view-action">
              <?php foreach(Ride::VIEW_OPTIONS as $option_value => $option_description) { ?>
              <option value="<?php echo $option_value; ?>"
                <?php //if($vehicle->rp_vervoer_disabled == $status_id) { echo 'selected'; } ?>>
                <?php echo $option_description; ?>
              </option>
              <?php } ?>
            </select>

          </div>
          <div class="input-group date mr-2 w-50">
            <input class="form-control" type="text" name="startdate" id="startdate"
              value="<?php echo get_date(h($ride->opdracht_datum)) ?>" required>
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon2"><i class="fas fa-calendar-alt"></i></span>
            </div>
          </div>
          <div class="input-group date mr-2 w-50">
            <input class="form-control" type="text" name="enddate" id="enddate"
              value="<?php echo get_date(h($ride->opdracht_datum)) ?>" required>
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon2"><i class="fas fa-calendar-alt"></i></span>
            </div>
          </div>
          <button class="btn btn-outline-primary" id="filter_invoices" type="submit">Uitvoeren</button>

        </div>
      </div>
    </div>
  </div>
  <!-- end if -->
  <div class=" row">
    <div class="col-md-12">


      <table class="table table-hover">
        <thead class="thead-dark">
          <tr>
            <th style="width: 5px; padding:0;"></th>
            <th width=10 class="check-column"><input type="checkbox" id="checkAll" /></th>
            <th class="code-column">Code</th>
            <th>Factuur</th>
            <th>Opdracht</th>
            <th class="datum-column">Datum</th>
            <th>Vergoeding</th>
            <th>Vertrek</th>
            <th>Bestemming</th>
            <th width=50></th>
          </tr>
        </thead>
        <tbody>
          <?php
      $rides = Ride::find_all(); ?>
          <?php foreach($rides as $ride) {
            $creation_date = new DateTime($ride->opdracht_datum);
            ?>
          <tr class="entry-row" data-id="<?php echo $ride->opdracht_id; ?>">
            <td></td>
            <td scope="row"><input type="checkbox" name="opdracht[]" value="<?php echo $ride->opdracht_id; ?>" />
            </td>
            <td scope="row"><?php echo h($ride->opdracht_factuurcode); ?></td>
            <td scope="row"><?php echo nl2br($ride->factuur()); ?></td>
            <td scope="row"><?php echo h($ride->opdracht_opdracht); ?></td>
            <td scope="row" nowrap="nowrap">
              <?php echo date_format($creation_date, 'd-m-Y'); ?><br><em><?php echo h($ride->starttijd()); ?></em></td>
            <td scope="row">0,00</td>
            <td scope="row"><?php echo nl2br($ride->vertrek()); ?></td>
            <td scope="row"><?php echo nl2br($ride->bestemming()); ?></td>
            <td scope="row">
              <a href="<?php echo url_for('/rides'); ?>/edit.php?id=<?php echo $ride->opdracht_id; ?>"><i
                  class="fas fa-edit"></i></a>
              <a href="<?php echo url_for('/rides'); ?>/delete.php?id=<?php echo $ride->opdracht_id; ?>"><i
                  class="fas fa-trash-alt"></i></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>
<!--Content area end-->
<?php include(SITE_PATH . '/footer.php'); ?>