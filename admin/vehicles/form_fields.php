<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($vehicle)) {
  redirect_to(url_for('/admin/vehicles'));
}
?>

<div class="form-group row">
  <label for="rp_vervoer_naam" class="col-sm-3 col-form-label">Naam</label>
  <div class="col-sm-9">
    <input class="form-control" type="text" name="rp_vervoer_naam" id="rp_vervoer_naam"
      value="<?php echo h($vehicle->rp_vervoer_naam); ?>" required>
    <div class="invalid-feedback">
      Vul hier de naam van het voertuig in.
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="rp_vervoer_aantalzit" class="col-sm-3 col-form-label">Aantal zitplaatsen</label>
  <div class="col-sm-9">
    <input class="form-control" type="text" name="rp_vervoer_aantalzit" id="rp_vervoer_aantalzit"
      value="<?php echo h($vehicle->rp_vervoer_aantalzit); ?>" required>
    <div class="invalid-feedback">
      Vul hier het aantal zitplaatsen in.
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="level_level" class="col-sm-3 col-form-label">Kenteken</label>
  <div class="col-sm-9">
    <input class="form-control" type="text" name="rp_vervoer_kenteken" id="rp_vervoer_kenteken"
      value="<?php echo h($vehicle->rp_vervoer_kenteken); ?>" required>
    <div class="invalid-feedback">
      Vul hier het kenteken in.
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="rp_vervoer_telefoon" class="col-sm-3 col-form-label">Telefoon</label>
  <div class="col-sm-9">
    <input class=" form-control" type="text" name="rp_vervoer_telefoon" id="rp_vervoer_telefoon"
      value="<?php echo h($vehicle->rp_vervoer_telefoon); ?>">
  </div>
</div>
<div class="form-group row">
  <label for="rp_vervoer_kleur" class="col-sm-3 col-form-label">Kleurcode</label>
  <div class="col-sm-4">
    <div id="cp1" class="input-group" title="Using input value">
      <input type="text" class="form-control input-lg" value="<?php echo h($vehicle->rp_vervoer_kleur); ?>"
        name="rp_vervoer_kleur" id="rp_vervoer_kleur" />
      <span class="input-group-append">
        <span class="input-group-text colorpicker-input-addon"><i></i></span>
      </span>
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="rp_vervoer_disabled" class="col-sm-3 col-form-label">Status</label>
  <div class="col-sm-9">
    <select class="custom-select" name="rp_vervoer_disabled" required>
      <option value=""></option>
      <?php foreach(Vehicle::STATUS_OPTIONS as $status_id => $status_name) { ?>
      <option value="<?php echo $status_id; ?>"
        <?php if($vehicle->rp_vervoer_disabled == $status_id) { echo 'selected'; } ?>><?php echo $status_name; ?>
      </option>
      <?php } ?>
    </select>
    <div class="invalid-feedback">Selecteer de status van het voertuig.</div>
  </div>
</div>
<hr>