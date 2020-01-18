<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($contact)) {
  redirect_to(url_for('/contacts'));
}
?>

<div class="form-group row">
  <label for="rl_bedrijf" class="col-sm-3 col-form-label">Bedrijf</label>
  <div class="col-sm-9">
    <input class="form-control" type="text" name="rl_bedrijf" id="rl_bedrijf"
      value="<?php echo h($contact->rl_bedrijf); ?>" placeholder="Naam van het bedrijf, organisatie of instelling">
  </div>
</div>
<div class="form-group row">
  <label for="rl_naam" class="col-sm-3 col-form-label">Naam</label>
  <div class="col-sm-9">
    <input class="form-control" type="text" name="rl_naam" id="rl_naam" value="<?php echo h($contact->rl_naam); ?>"
      placeholder="Volledige naam">
  </div>
</div>
<div class="form-group row">
  <label for="rl_kostenplaats" class="col-sm-3 col-form-label">Kostenplaats</label>
  <div class="col-sm-9">
    <input class="form-control" type="text" name="rl_kostenplaats" id="rl_kostenplaats"
      value="<?php echo h($contact->rl_kostenplaats); ?>">
  </div>
</div>
<hr>
<div class="form-group row">
  <label for="rl_adres" class="col-sm-3 col-form-label">Adres</label>
  <div class="col-sm-9">
    <input class="form-control" type="text" name="rl_adres" id="rl_adres" value="<?php echo h($contact->rl_adres); ?>"
      required>
    <div class="invalid-feedback">
      Vul hier het adres in
    </div>
  </div>
</div>

<div class="form-group row">
  <label for="rl_postcode" class="col-sm-3 col-form-label">Postcode + Plaats</label>
  <div class="col-sm-3">
    <input type="text" class="form-control" name="rl_postcode" id="rl_postcode"
      value="<?php echo h($contact->rl_postcode); ?>" placeholder="Postcode" pattern="[1-9][0-9]{3}\s?[a-zA-Z]{2}"
      required>
    <div class="invalid-feedback">
      Vul hier de postcode in
    </div>
  </div>
  <div class="col-sm-6">
    <input type="text" class="form-control" name="rl_woonplaats" id="rl_woonplaats"
      value="<?php echo h($contact->rl_woonplaats); ?>" placeholder="Plaats" required>
    <div class="invalid-feedback">
      Vul hier de woonplaats in
    </div>
  </div>
</div>

<div class="form-group row">
  <label for="rl_email" class="col-sm-3 col-form-label">E-mailadres</label>
  <div class="col-sm-9">
    <input class="form-control" type="email" name="rl_email" id="rl_email" value="<?php echo h($contact->rl_email); ?>">
    <div class="invalid-feedback">
      Vul een geldig e-mailadres in
    </div>
  </div>
</div>

<div class="form-group row">
  <label for="rl_telefoon" class="col-sm-3 col-form-label">Telefoon</label>
  <div class="col">
    <input type="text" class="form-control" name="rl_mobiel" id="rl_mobiel"
      value="<?php echo h($contact->rl_mobiel); ?>" placeholder="Mobiel">
  </div>
  <div class="col">
    <input type="tel" class="form-control" name="rl_telefoon" id="rl_telefoon"
      value="<?php echo h($contact->rl_telefoon); ?>" placeholder="Vast">
  </div>
</div>