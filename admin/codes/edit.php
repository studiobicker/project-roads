<?php require_once('../../private/initialize.php'); 

require_login('1');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/admin/codes'));
}
$id = $_GET['id'];
$code = Code::find_by_id($id);
if($code == false) {
  redirect_to(url_for('/admin/codes'));
}

if(is_post_request()) {

  // Create record using post parameters
  $args = [];
  $args['fct_code'] = $_POST['fct_code'] ?? NULL;
  $args['fct_omschrijving'] = $_POST['fct_omschrijving'] ?? NULL;
  $args['fct_status'] = $_POST['fct_status'] ?? NULL;
  $args['fct_modifiedby'] = $session->username;

  $code->merge_attributes($args);
  $result = $code->save();

  if($result === true) {
    $_SESSION['message'] = 'Code succesvol bijgewerkt';
    redirect_to(url_for('/admin/codes/details.php?id=' . $id));
  } else {
    // show errors
  }

}

?>

<?php $page_title = 'Factuurcode wijzigen'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main code="main" class="site-main">

  <div class="container py-3">
    <div class="row">
      <div class="col-md-9 ">
        <div class="container bg-light py-2">
          <?php echo display_errors($code->errors); ?>
          <h4 class="py-3"><?php echo $page_title ?></h4>
          <form class="needs-validation" novalidate
            action="<?php echo url_for('/admin/codes/edit.php?id=' . h(u($id))); ?>" method="post">

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
      <aside class="col-md-3">
        <?php include(SITE_PATH . '/admin/sidebar.php') ?>
      </aside>
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