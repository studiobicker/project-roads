<?php require_once('../private/initialize.php'); 
 require_login('5');

if(is_post_request()) {

// Create record using post parameters
$args = [];
$args['rl_bedrijf'] = $_POST['rl_bedrijf'] ?? NULL;
$args['rl_naam'] = $_POST['rl_naam'] ?? NULL;
$args['rl_adres'] = $_POST['rl_adres'] ?? NULL;
$args['rl_postcode'] = $_POST['rl_postcode'] ?? NULL;
$args['rl_woonplaats'] = $_POST['rl_woonplaats'] ?? NULL;
$args['rl_land'] = $_POST['rl_land'] ?? NULL;
$args['rl_telefoon'] = $_POST['rl_telefoon'] ?? NULL;
$args['rl_mobiel'] = $_POST['rl_mobiel'] ?? NULL;
$args['rl_email'] = $_POST['rl_email'] ?? NULL;
$args['rl_kostenplaats'] = $_POST['rl_kostenplaats'] ?? NULL;
$args['rl_zoeknaam'] = trim($args['rl_bedrijf'] . ' ' . $args['rl_naam']);

$contact = new Contact($args);
$result = $contact->save();

if($result === true) {
$new_id = $contact->rl_id;
$_SESSION['message'] = 'Contact' . $contact->zoeknaam .' succesvol toegevoegd.';
redirect_to(url_for('/contacts/details.php?id=' . $new_id));
} else {
// show errors
}

} else {
// display the form
$contact = new Contact();
}

?>

<?php $page_title = 'Nieuw contact'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main">

  <div class="container py-3">
    <div class="row">
      <div class="col-md-9 ">
        <?php echo display_errors($contact->errors); ?>
        <div class="container bg-light py-2">
          <h4 class="py-3">Nieuw contact</h4>
          <form action="<?php echo url_for('/contacts/new.php'); ?>" method="post" class="needs-validation" novalidate>

            <?php include('form_fields.php'); ?>

            <div class="form-group row">
              <div class="col-sm-10">
                <input type="submit" value="Opslaan" class="btn btn-primary" name="opslaan" /> of <a
                  href="<?php echo url_for('/contacts'); ?>">Annuleren</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

<?php include(SITE_PATH . '/footer.php'); ?>