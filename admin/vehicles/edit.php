<?php require_once('../../private/initialize.php'); 

require_login('1');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/admin/vehicles'));
}
$id = $_GET['id'];
$vehicle = Vehicle::find_by_id($id);
if($vehicle == false) {
  redirect_to(url_for('/admin/vehicles'));
}

if(is_post_request()) {

  // Create record using post parameters
  $args = [];
  $args['rp_vervoer_naam'] = $_POST['rp_vervoer_naam'] ?? NULL;
  $args['rp_vervoer_aantalzit'] = $_POST['rp_vervoer_aantalzit'] ?? NULL;
  $args['rp_vervoer_kenteken'] = $_POST['rp_vervoer_kenteken'] ?? NULL;
  $args['rp_vervoer_telefoon'] = $_POST['rp_vervoer_telefoon'] ?? NULL;
  $args['rp_vervoer_kleur'] = $_POST['rp_vervoer_kleur'] ?? NULL;
  $args['rp_vervoer_disabled'] = $_POST['rp_vervoer_disabled'] ?? NULL;

  $vehicle->merge_attributes($args);
  $result = $vehicle->save();

  if($result === true) {
    $_SESSION['message'] = 'Voertuig succesvol bijgewerkt';
    redirect_to(url_for('/admin/vehicles/details.php?id=' . $id));
  } else {
    // show errors
  }

}

?>

<?php $page_title = 'Voertuig wijzigen'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main">

  <div class="container py-3">
    <div class="row">
      <div class="col-md-9 ">
        <div class="container bg-light py-2">
          <?php echo display_errors($vehicle->errors); ?>
          <h4 class="py-3"><?php echo $page_title ?></h4>
          <form class="needs-validation" novalidate
            action="<?php echo url_for('/admin/vehicles/edit.php?id=' . h(u($id))); ?>" method="post">

            <?php include('form_fields.php'); ?>

            <div class="form-group row">
              <div class="col-sm-10">
                <input type="submit" value="Opslaan" class="btn btn-primary" name="opslaan" /> of <a
                  href="<?php echo url_for('/admin/vehicles'); ?>">Annuleren</a>
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