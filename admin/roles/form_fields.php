<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($role)) {
  redirect_to(url_for('/admin/roles'));
}
?>

<div class="form-group row">
  <label for="level_name" class="col-sm-3 col-form-label">Rol</label>
  <div class="col-sm-9">
    <input class="form-control" type="text" name="level_name" id="level_name"
      value="<?php echo h($role->level_name); ?>" placeholder="Naam van de rol" required>
    <div class="invalid-feedback">
      Vul hier de rol in.
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="level_level" class="col-sm-3 col-form-label">Niveau</label>
  <div class="col-sm-9">
    <input class="form-control" type="text" name="level_level" id="level_level"
      value="<?php echo h($role->level_level); ?>" placeholder="Toegangsniveau van de rol" required>
    <div class="invalid-feedback">
      Vul hier het toegangsniveau in.
    </div>
  </div>
</div>