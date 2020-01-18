<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($ride)) {
  redirect_to(url_for('/rides'));
}
$codes = Code::find_all_enabled();
?>

<div class="form-group row">
  <label for="opdracht_datum" class="col-sm-3 col-form-label">Datum</label>
  <div class="col-md-7 col-sm-9 input-group date">
    <input class="form-control" type="text" name="opdracht_datum" id="opdracht_datum"
      value="<?php echo get_date(h($ride->opdracht_datum)) ?>" required>
    <div class="input-group-append">
      <span class="input-group-text" id="basic-addon2"><i class="fas fa-calendar-alt"></i></span>
    </div>
    <div class="invalid-feedback">
      Vul hier de opdrachtdatum in.
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="opdracht_factuurcode" class="col-sm-3 col-form-label">Code</label>
  <div class="col-md-4 col-sm-5">
    <select class="custom-select" name="opdracht_factuurcode" required>
      <option value=""></option>
      <?php foreach($codes as $code) { ?>
      <option value="<?php echo h($code->fct_code) ?>"
        <?php if($ride->opdracht_factuurcode == $code->fct_code) { echo 'selected'; } ?>>
        <?php echo h($code->fct_code) ?> - <?php echo h($code->fct_omschrijving) ?>
      </option>
      <?php } ?>
    </select>
    <div class="invalid-feedback">Selecteer een (factuur-)code.</div>
  </div>
  <div class="col-md-3 col-sm-4">
    <input type="tel" class="form-control" name="rl_telefoon" id="rl_telefoon" value="" placeholder="0,00">
  </div>
</div>
<div class="form-group row">
  <label for="opdracht_opdracht" class="col-sm-3 col-form-label">Opdracht</label>
  <div class="col-md-7 col-sm-9">
    <input class="form-control" type="text" name="opdracht_opdracht" id="opdracht_opdracht"
      value="<?php echo h($ride->opdracht_opdracht); ?>" required>
    <div class="invalid-feedback">
      Vul hier de opdracht in.
    </div>
  </div>
</div>

<hr>