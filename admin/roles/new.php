<?php require_once('../../private/initialize.php'); 

require_login('1');

if(is_post_request()) {

  // Create record using post parameters
  $args = [];
  $args['level_name'] = $_POST['level_name'] ?? NULL;
  $args['level_level'] = $_POST['level_level'] ?? NULL;

  $role = new Role($args);
  $result = $role->save();

  if($result === true) {
    $new_id = $role->level_id;
    $_SESSION['message'] = 'Rol' . $role->level_name .' succesvol toegevoegd.';
    redirect_to(url_for('/admin/roles/details.php?id=' . $new_id));
  } else {
    // show errors
  }

} else {
  // display the form
  $role = new Role();
}

?>

<?php $page_title = 'Nieuwe rol'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main">

  <div class="container py-3">
    <div class="row">
      <div class="col-md-9 ">
        <?php echo display_errors($role->errors); ?>
        <div class="container bg-light py-2">
          <h4 class="py-3">Nieuwe rol</h4>
          <form action="<?php echo url_for('/admin/roles/new.php'); ?>" method="post" class="needs-validation"
            novalidate>

            <?php include('form_fields.php'); ?>

            <div class="form-group row">
              <div class="col-sm-10">
                <input type="submit" value="Opslaan" class="btn btn-primary" name="opslaan" /> of <a
                  href="<?php echo url_for('/admin/roles'); ?>">Annuleren</a>
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