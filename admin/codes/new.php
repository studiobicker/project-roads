<?php require_once('../../private/initialize.php'); 

require_login('1');

if(is_post_request()) {

  // Create record using post parameters
  $args = [];
  $args['fct_code'] = $_POST['fct_code'] ?? NULL;
  $args['fct_omschrijving'] = $_POST['fct_omschrijving'] ?? NULL;
  $args['fct_status'] = $_POST['fct_status'] ?? NULL;
  $args['fct_modifiedby'] = $session->username;

  $code = new Code($args);
  $result = $code->save();

  if($result === true) {
    $new_id = $code->level_id;
    $_SESSION['message'] = 'Factuurcode' . $code->fct_code .' succesvol toegevoegd.';
    redirect_to(url_for('/admin/codes/details.php?id=' . $new_id));
  } else {
    // show errors
  }

} else {
  // display the form
  $code = new Code();
}

?>

<?php $page_title = 'Nieuwe code'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main">

  <div class="container-fluid py-3">
    <div class="row">
      <div class="col-md-9 ">
        <?php echo display_errors($code->errors); ?>
        <div class="container bg-light py-2">
          <h4 class="py-3">Nieuwe rol</h4>
          <form action="<?php echo url_for('/admin/codes/new.php'); ?>" method="post" class="needs-validation"
            novalidate>

            <?php include('form_fields.php'); ?>

            <div class="form-group row">
              <div class="col-sm-10">
                <input type="submit" value="Opslaan" class="btn btn-primary" name="opslaan" /> of <a
                  href="<?php echo url_for('/admin/codes'); ?>">Annuleren</a>
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