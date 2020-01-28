<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($ride)) {
  redirect_to(url_for('/rides'));
}
$codes = Code::find_all_enabled();
$vehicles = Vehicle::find_all_enabled()
?>

<div class="form-group required row">
  <label for="opdracht_datum" class="col-sm-3 col-form-label">Datum</label>
  <div class="col-md-3 col-sm-5 input-group date">
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
<div class="form-group required row">
  <label for="opdracht_factuurcode" class="col-sm-3 col-form-label">Code</label>
  <div class="col-md-4 col-sm-5">

    <select class="custom-select" name="opdracht_factuurcode" id="opdracht_factuurcode" required>
      <option value="">Maak je keuze</option>
      <?php foreach($codes as $code) { ?>
      <option value="<?php echo h($code->fct_code) ?>"
        <?php if($ride->opdracht_factuurcode === $code->fct_code) { echo 'selected'; } ?>>
        <?php echo h($code->fct_code) ?> - <?php echo h($code->fct_omschrijving) ?>
      </option>
      <?php } ?>
    </select>
    <div class="invalid-feedback">Selecteer een (factuur-)code.</div>
  </div>
  <div class="col-md-3 col-sm-4">
    <input type="tel" class="form-control" name="opdracht_prijs" id="opdracht_prijs" value=""
      placeholder="<?php echo h($ride->opdracht_prijs); ?>">
  </div>
</div>
<div class="form-group required row">
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
<div id="opdrachtgever">
  <h6 class="text-secondary">Opdrachtgever</h6>
  <input type="hidden" id="opdracht_opdrachtgeverid" name="opdracht_opdrachtgeverid"
    value="<?php echo h($ride->opdracht_opdrachtgeverid); ?>" />
  <div class="form-group row">
    <div class="col-sm-3"></div>
    <div class="col-md-7 col-sm-9">
      <input class="form-control contact_search" type="text" data-result="client_box" value="" autocomplete="off"
        placeholder="Zoek op naam, bedrijf of adres">
      <div class="list-group" id="client_box"></div>
    </div>
  </div>
  <div class="form-group row">
    <label for="opdracht_factuurbedrijf" class="col-sm-3 col-form-label">Bedrijf</label>
    <div class="col-md-7 col-sm-9">
      <input class="form-control" type="text" name="opdracht_factuurbedrijf" id="opdracht_factuurbedrijf"
        value="<?php echo h($ride->opdracht_factuurbedrijf); ?>">
    </div>
  </div>

  <div class="form-group required row">
    <label for="opdracht_factuurnaam" class="col-sm-3 col-form-label">Naam + Telefoon </label>
    <div class="col-md-4 col-sm-5">
      <input type="text" class="form-control" name="opdracht_factuurnaam" id="opdracht_factuurnaam"
        value="<?php echo h($ride->opdracht_factuurnaam); ?>" required placeholder="Naam">
      <div class="invalid-feedback">
        Vul hier de naam van de aanvrager in.
      </div>
    </div>
    <div class="col-md-3 col-sm-4">
      <input type="text" class="form-control" name="opdracht_telefoon" id="opdracht_telefoon"
        value="<?php echo h($ride->opdracht_telefoon); ?>" required placeholder="Telefoon">
      <div class="invalid-feedback">
        Vul hier het telefoonnummer van de aanvrager in.
      </div>
    </div>
  </div>

  <div class="form-group row">
    <label for="opdracht_factuuradres" class="col-sm-3 col-form-label">Adres</label>
    <div class="col-md-7 col-sm-9">
      <input class="form-control" type="text" name="opdracht_factuuradres" id="opdracht_factuuradres"
        value="<?php echo h($ride->opdracht_factuuradres); ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="opdracht_factuurpostcode" class="col-sm-3 col-form-label">Postcode + Plaats</label>
    <div class="col-md-2 col-sm-3">
      <input type="text" class="form-control" name="opdracht_factuurpostcode" id="opdracht_factuurpostcode"
        value="<?php echo h($ride->opdracht_factuurpostcode); ?>" placeholder="Postcode"
        pattern="[1-9][0-9]{3}\s?[a-zA-Z]{2}">
    </div>
    <div class="col-md-5 col-sm-6">
      <input type="text" class="form-control" name="opdracht_factuurplaats" id="opdracht_factuurplaats"
        value="<?php echo h($ride->opdracht_factuurplaats); ?>" placeholder="Plaats">
    </div>
  </div>

  <div class="form-group row">
    <label for="opdracht_kostenplaats" class="col-sm-3 col-form-label">Kostenplaats</label>
    <div class="col-md-6 col-sm-7">
      <input class="form-control" type="text" name="opdracht_kostenplaats" id="opdracht_kostenplaats"
        value="<?php echo h($ride->opdracht_kostenplaats); ?>">
    </div>
    <div class=".col-md-1 col-sm-2"> <a href="#" id="save_client" class="btn btn-secondary"><i
          class="fas fa-download"></i></a></div>
  </div>

  <hr>
</div>
<h6 class="text-secondary">Ritgegevens</h6>
<div class="form-group required row">
  <label for="rit_kenteken" class="col-sm-3 col-form-label">Voertuig</label>
  <div class="col-md-7 col-sm-9">
    <select class="custom-select" name="rit_kenteken" required>
      <option value="">Maak je keuze</option>
      <?php foreach($vehicles as $vehicle) { ?>
      <option value="<?php echo h($vehicle->rp_vervoer_kenteken) ?>"
        <?php if($ride->rit_kenteken == $vehicle->rp_vervoer_kenteken) { echo 'selected'; } ?>>
        <?php echo h($vehicle->rp_vervoer_naam) ?>
      </option>
      <?php } ?>
    </select>
    <div class="invalid-feedback">Selecteer een voertuig.</div>
  </div>
</div>
<div class="form-group row">
  <label for="rit_aantalpassagiers" class="col-sm-3 col-form-label">Aantal passagiers</label>
  <div class="col-md-3 col-sm-5">
    <input class="form-control" type="text" name="rit_aantalpassagiers" id="rit_aantalpassagiers"
      value="<?php echo h($ride->rit_aantalpassagiers); ?>">
  </div>
</div>
<hr>
<h6 class="text-secondary">Vertrek</h6>

<input type="hidden" id="rit_vertrekid" name="rit_vertrekid" value="<?php echo h($ride->rit_vertrekid); ?>" />
<div class="form-group required row">
  <label for="rit_start" class="col-sm-3 col-form-label">Tijdstip</label>
  <div class="col-md-4 col-sm-7 input-group ">
    <input class="form-control time-control" type="text" name="rit_start" id="rit_start"
      value="<?php echo get_time(h($ride->rit_start)) ?>" required>

    <div class="input-group-append">
      <span class="input-group-text" id="basic-addon2">hh:mm</span>
    </div>
    <div class="invalid-feedback">
      Vul hier het tijdstip van vertrek in.
    </div>
  </div>
</div>
<div class="form-group row">
  <div class="col-sm-3"></div>
  <div class="col-md-7 col-sm-9">
    <input class="form-control contact_search" data-result="departure_box" type="text" value="" autocomplete="off"
      placeholder="Zoek op naam, bedrijf of adres">
    <div id="departure_box"></div>
  </div>
</div>
<div class="form-group row">
  <label for="rit_vertrekbedrijf" class="col-sm-3 col-form-label">Bedrijf</label>
  <div class="col-md-7 col-sm-9">
    <input class="form-control" type="text" name="rit_vertrekbedrijf" id="rit_vertrekbedrijf"
      value="<?php echo h($ride->rit_vertrekbedrijf); ?>">
  </div>
</div>

<div class="form-group row">
  <label for="rit_vertreknaam" class="col-sm-3 col-form-label">Naam + Telefoon </label>
  <div class="col-md-4 col-sm-5">
    <input type="text" class="form-control" name="rit_vertreknaam" id="rit_vertreknaam"
      value="<?php echo h($ride->rit_vertreknaam); ?>" placeholder="Naam">
  </div>
  <div class="col-md-3 col-sm-4">
    <input type="text" class="form-control" name="rit_vertrektelefoon" id="rit_vertrektelefoon"
      value="<?php echo h($ride->rit_vertrektelefoon); ?>" placeholder="Telefoon">
  </div>
</div>

<div class="form-group row">
  <label for="rit_vertrekadres" class="col-sm-3 col-form-label">Adres</label>
  <div class="col-md-7 col-sm-9">
    <input class="form-control" type="text" name="rit_vertrekadres" id="rit_vertrekadres"
      value="<?php echo h($ride->rit_vertrekadres); ?>">
  </div>
</div>

<div class="form-group row">
  <label for="rit_vertrekpostcode" class="col-sm-3 col-form-label">Postcode + Plaats</label>
  <div class="col-md-2 col-sm-3">
    <input type="text" class="form-control" name="rit_vertrekpostcode" id="rit_vertrekpostcode"
      value="<?php echo h($ride->rit_vertrekpostcode); ?>" placeholder="Postcode" pattern="[1-9][0-9]{3}\s?[a-zA-Z]{2}">
  </div>
  <div class="col-md-5 col-sm-6">
    <input type="text" class="form-control" name="rit_vertrekplaats" id="rit_vertrekplaats"
      value="<?php echo h($ride->rit_vertrekplaats); ?>" placeholder="Plaats">
  </div>
</div>
<hr>
<h6 class="text-secondary">Bestemming</h6>
<input type="hidden" id="rit_bestemmingsid" name="rit_bestemmingsid"
  value="<?php echo h($ride->rit_bestemmingsid); ?>" />
<div class="form-group required row">
  <label for="rit_eind" class="col-sm-3 col-form-label">Tijdstip</label>
  <div class="col-md-3 col-sm-5 input-group ">
    <input class="form-control  time-control" type="text" name="rit_eind" id="rit_eind"
      value="<?php echo get_time(h($ride->rit_eind)) ?>" required>
    <div class="input-group-append">
      <span class="input-group-text" id="basic-addon2">hh:mm</span>
    </div>
    <div class="invalid-feedback">
      Vul hier het tijdstip van aankomst in.
    </div>
  </div>
</div>
<div class="form-group row">
  <div class="col-sm-3"></div>
  <div class="col-md-7 col-sm-9">
    <input class="form-control contact_search" type="text" data-result="destination_box" value="" autocomplete="off"
      placeholder="Zoek op naam, bedrijf of adres">
    <div id="destination_box"></div>
  </div>
</div>
<div class="form-group row">
  <label for="rit_bestemmingsbedrijf" class="col-sm-3 col-form-label">Bedrijf</label>
  <div class="col-md-7 col-sm-9">
    <input class="form-control" type="text" name="rit_bestemmingsbedrijf" id="rit_bestemmingsbedrijf"
      value="<?php echo h($ride->rit_bestemmingsbedrijf); ?>">
  </div>
</div>

<div class="form-group row">
  <label for="rit_bestemmingsnaam" class="col-sm-3 col-form-label">Naam + Telefoon </label>
  <div class="col-md-4 col-sm-5">
    <input type="text" class="form-control" name="rit_bestemmingsnaam" id="rit_bestemmingsnaam"
      value="<?php echo h($ride->rit_bestemmingsnaam); ?>" placeholder="Naam">
  </div>
  <div class="col-md-3 col-sm-4">
    <input type="text" class="form-control" name="rit_bestemmingstelefoon" id="rit_bestemmingstelefoon"
      value="<?php echo h($ride->rit_bestemmingstelefoon); ?>" placeholder="Telefoon">
  </div>
</div>
<hr>

<div class="form-group row">
  <label for="rit_bestemmingsadres" class="col-sm-3 col-form-label">Adres</label>
  <div class="col-md-7 col-sm-9">
    <input class="form-control" type="text" name="rit_bestemmingsadres" id="rit_bestemmingsadres"
      value="<?php echo h($ride->rit_bestemmingsadres); ?>">
  </div>
</div>

<div class="form-group row">
  <label for="rit_bestemmingspostcode" class="col-sm-3 col-form-label">Postcode + Plaats</label>
  <div class="col-md-2 col-sm-3">
    <input type="text" class="form-control" name="rit_bestemmingspostcode" id="rit_bestemmingspostcode"
      value="<?php echo h($ride->rit_bestemmingspostcode); ?>" placeholder="Postcode"
      pattern="[1-9][0-9]{3}\s?[a-zA-Z]{2}">
  </div>
  <div class="col-md-5 col-sm-6">
    <input type="text" class="form-control" name="rit_bestemmingsplaats" id="rit_bestemmingsplaats"
      value="<?php echo h($ride->rit_bestemmingsplaats); ?>" placeholder="Plaats">
  </div>
</div>
<hr>
<div class="form-group row">
  <label for="rit_message" class="col-sm-3 col-form-label">Mededeling</label>
  <div class="col-md-7 col-sm-9">
    <textarea class="form-control" id="rit_message" name="rit_message"
      rows="3"><?php echo h($ride->rit_message); ?></textarea>
  </div>
</div>
<input type="hidden" class="form-control" name="opdracht_status" id="opdracht_status"
  value="<?php echo h($ride->opdracht_status); ?>">
<?php if($ride->opdracht_status != 'F') { ?>
<hr>
<div class="form-group row">
  <div class="col-md-8 col-sm-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="O" id="opdracht_optie" name="opdracht_optie"
        <?php if($ride->opdracht_status == 'O') { echo 'checked'; } ?>>
      <label class="form-check-label" for="opdracht_optie">
        Opslaan als optie
      </label>
    </div>
  </div>
</div>
<?php } ?>
<hr>