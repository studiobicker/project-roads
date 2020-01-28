<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($shift)) {
  redirect_to(url_for('/shifts'));
}
$rooster_datum = !empty($shift->rooster_start) ? h($shift->rooster_start) : get_date($session->datum);

$vehicles = Vehicle::find_all_enabled()
?>

<div class="form-group required row">
  <label for="rooster_datum" class="col-sm-3 col-form-label">Datum</label>
  <div class="col-md-3 col-sm-5 input-group date">
    <input class="form-control" type="text" name="rooster_datum" id="rooster_datum"
      value="<?php echo get_date($rooster_datum)  ?>" required>
    <div class="input-group-append">
      <span class="input-group-text" id="basic-addon2"><i class="fas fa-calendar-alt"></i></span>
    </div>
    <div class="invalid-feedback">
      Vul hier de roosterdatum in.
    </div>
  </div>
</div>
<div class="form-group required row">
  <label for="rooster_start" class="col-sm-3 col-form-label">Begin</label>
  <div class="col-md-4 col-sm-7 input-group ">
    <input class="form-control time-control" type="text" name="rooster_start" id="rooster_start"
      value="<?php echo get_time(h($shift->rooster_start)) ?>" required>

    <div class="input-group-append">
      <span class="input-group-text" id="basic-addon2">hh:mm</span>
    </div>
    <div class="invalid-feedback">
      Vul hier de begintijd in.
    </div>
  </div>
</div>

<div class="form-group required row">
  <label for="rooster_end" class="col-sm-3 col-form-label">Eind</label>
  <div class="col-md-3 col-sm-5 input-group ">
    <input class="form-control  time-control" type="text" name="rooster_end" id="rooster_end"
      value="<?php echo get_time(h($shift->rooster_end)) ?>" required>
    <div class="input-group-append">
      <span class="input-group-text" id="basic-addon2">hh:mm</span>
    </div>
    <div class="invalid-feedback">
      Vul hier de eindtijd in.
    </div>
  </div>
</div>
<hr>
<div class="form-group row">
  <label for="rooster_medewerker" class="col-sm-3 col-form-label">Medewerker</label>
  <div class="col-md-7 col-sm-9">
    <input class="form-control" type="text" name="rooster_medewerker" id="rooster_medewerker"
      value="<?php echo h($shift->rooster_medewerker); ?>">
  </div>
</div>
<div class="form-group required row">
  <label for="rit_kenteken" class="col-sm-3 col-form-label">Voertuig</label>
  <div class="col-md-7 col-sm-9">
    <select class="custom-select" name="rooster_kenteken" required>
      <option value="">Maak je keuze</option>
      <?php foreach($vehicles as $vehicle) { ?>
      <option value="<?php echo h($vehicle->rp_vervoer_kenteken) ?>"
        <?php if($shift->rooster_kenteken == $vehicle->rp_vervoer_kenteken) { echo 'selected'; } ?>>
        <?php echo h($vehicle->rp_vervoer_naam) ?>
      </option>
      <?php } ?>
    </select>
    <div class="invalid-feedback">Selecteer een voertuig.</div>
  </div>
</div>

<div class="form-group row">
  <label for="rooster_description" class="col-sm-3 col-form-label">Mededeling</label>
  <div class="col-md-7 col-sm-9">
    <textarea class="form-control" id="rit_message" name="rooster_description"
      rows="3"><?php echo h($shift->rooster_description); ?></textarea>
  </div>
</div>