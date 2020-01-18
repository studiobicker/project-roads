<?php require_once('../private/initialize.php'); 

require_login('5');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/rides'));
}
$id = $_GET['id'];
$ride = Ride::find_by_id($id);
if($ride == false) {
  redirect_to(url_for('/rides'));
}

if(is_post_request()) {

  // Create record using post parameters
  $args = [];
  $args['opdracht_opdrachtnummer'] = $_POST['opdracht_opdrachtnummer'] ?? NULL;
  $args['opdracht_datum'] = $_POST['opdracht_datum'] ?? NULL;
  $args['opdracht_opdracht'] = $_POST['opdracht_opdracht'] ?? NULL;
  $args['opdracht_factuurcode'] = $_POST['opdracht_factuurcode'] ?? NULL;
  $args['opdracht_modifiedby'] = $session->username;

  $ride->merge_attributes($args);
  $result = $ride->save();

  if($result === true) {
    $_SESSION['message'] = 'Rit succesvol bijgewerkt';
    redirect_to(url_for('/rides/details.php?id=' . $id));
  } else {
    // show errors
  }

}

?>

<?php $page_title = 'Rit wijzigen'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main code="main" class="site-main">

  <div class="container-fluid py-3">
    <div class="row">
      <div class="col-md-9 ">
        <div class="container bg-light py-2">
          <?php echo display_errors($ride->errors); ?>
          <h4 class="py-3"><?php echo $page_title ?></h4>
          <form class="needs-validation" novalidate action="<?php echo url_for('/rides/edit.php?id=' . h(u($id))); ?>"
            method="post">

            <?php include('form_fields.php'); ?>

            <div class="form-group row">
              <div class="col-sm-10">
                <input type="submit" value="Opslaan" class="btn btn-primary" name="opslaan" /> of <a
                  href="<?php echo url_for('/rides'); ?>">Annuleren</a>
              </div>
            </div>
          </form>
        </div>
      </div>
      <aside class="col-md-3">
        <?php include(SITE_PATH . '/rides/sidebar-single.php') ?>
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