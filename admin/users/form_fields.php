<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($user)) {
  redirect_to(url_for('/admin/users'));
}
$roles = Role::find_all();
?>

<div class="form-group row">
  <label for="name" class="col-sm-3 col-form-label">Naam</label>
  <div class="col-sm-9">
    <input class="form-control" type="text" name="name" id="name" value="<?php echo h($user->name); ?>" required>
    <div class="invalid-feedback">
      Vul hier de naam de gebruiker in.
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="username" class="col-sm-3 col-form-label">Gebruikersnaam</label>
  <div class="col-sm-9">
    <input class="form-control" type="text" name="username" id="username" value="<?php echo h($user->username); ?>"
      required>
    <div class="invalid-feedback">
      Vul hier de gebruikersnaam in.
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="email" class="col-sm-3 col-form-label">E-mailadres</label>
  <div class="col-sm-9">
    <input class="form-control" type="email" name="email" id="email" value="<?php echo h($user->email); ?>" required>
    <div class="invalid-feedback">
      Vul een geldig e-mailadres in
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="password" class="col-sm-3 col-form-label">Wachtwoord</label>
  <div class="col-sm-9">
    <input class="form-control" type="password" name="password" id="password" value=""
      <?php echo $password_required ?? ''; ?>>
    <small id="passwordHelp" class="form-text text-muted"><?php echo $password_hint ?? ''; ?></small>
    <div class="invalid-feedback">
      Vul hier een wachtwoord in.
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="confirm_password" class="col-sm-3 col-form-label">Bevestig wachtwoord</label>
  <div class="col-sm-9">
    <input class="form-control" type="password" name="confirm_password" id="confirm_password" value=""
      <?php echo $password_required ?? ''; ?>>
    <div class="invalid-feedback">
      Vul hier een wachtwoord in.
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="user_level" class="col-sm-3 col-form-label">Rol</label>
  <div class="col-sm-9">
    <select class="custom-select" name="user_level" required>
      <option value=""></option>
      <?php foreach($roles as $role) { ?>
      <option value="<?php echo h($role->level_level) ?>"
        <?php if($user->user_level == $role->level_level) { echo 'selected'; } ?>>
        <?php echo h($role->level_name) ?>
      </option>
      <?php } ?>
    </select>
    <div class="invalid-feedback">Selecteer de rol van de gebruiker.</div>
  </div>
</div>
<hr>