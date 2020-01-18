<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($code)) {
  redirect_to(url_for('/admin/codes'));
}
?>

<div class="form-group row">
  <label for="fct_code" class="col-sm-3 col-form-label">Factuurcode</label>
  <div class="col-sm-9">
    <input class="form-control" type="text" name="fct_code" id="fct_code" value="<?php echo h($code->fct_code); ?>"
      required>
    <div class="invalid-feedback">
      Vul hier de factuurcode in.
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="fct_omschrijving" class="col-sm-3 col-form-label">Omschrijving</label>
  <div class="col-sm-9">
    <input class="form-control" type="text" name="fct_omschrijving" id="fct_omschrijving"
      value="<?php echo h($code->fct_omschrijving); ?>" required>
    <div class="invalid-feedback">
      Vul hier de omschrijving van de factuurcode in.
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="fct_status" class="col-sm-3 col-form-label">Status</label>
  <div class="col-sm-9">
    <select class="custom-select" name="fct_status" required>
      <option value=""></option>
      <?php foreach(Code::STATUS_OPTIONS as $status_id => $status_name) { ?>
      <option value="<?php echo $status_id; ?>" <?php if($code->fct_status == $status_id) { echo 'selected'; } ?>>
        <?php echo $status_name; ?>
      </option>
      <?php } ?>
    </select>
    <div class="invalid-feedback">Selecteer de status van de factuurcode.</div>
  </div>
</div>
<hr>