<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($post)) {
  redirect_to(url_for('/dashboard'));
}
?>

<div class="form-group row">
  <label for="bericht_titel" class="col-sm-3 col-form-label">Titel</label>
  <div class="col-sm-9">
    <input class="form-control" type="text" name="bericht_titel" id="bericht_titel"
      value="<?php echo h($post->bericht_titel); ?>" required>
    <div class="invalid-feedback">
      Vul hier de titel van het bericht in.
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="bericht_message" class="col-sm-3 col-form-label">Bericht</label>
  <div class="col-sm-9">
    <textarea class="form-control" id="bericht_message" name="bericht_message"
      rows="3"><?php echo h($post->bericht_message); ?></textarea>
  </div>
</div>
<div class="form-group row">
  <label for="bericht_status" class="col-sm-3 col-form-label">Status</label>
  <div class="col-sm-9">
    <select class="custom-select" name="bericht_status" required>
      <option value=""></option>
      <?php foreach(Post::STATUS_OPTIONS as $status_id => $status_name) { ?>
      <option value="<?php echo $status_id; ?>" <?php if($post->bericht_status == $status_id) { echo 'selected'; } ?>>
        <?php echo $status_name; ?>
      </option>
      <?php } ?>
    </select>
    <div class="invalid-feedback">Selecteer de status van het bericht.</div>
  </div>
</div>
<hr>