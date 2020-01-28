<?php require_once('../private/initialize.php'); 
 require_login('5');

if(is_post_request()) {

  $start_date = $_POST['rooster_datum'] ?? NULL;
  $start_time = $_POST['rooster_start'] ?? NULL;
  $end_time = $_POST['rooster_end'] ?? NULL;

  //convert start & end time to datetime
  $start_time_fmt = ($start_date && $start_time) ? set_datetime($start_date, $start_time) : NULL;
  $end_time_fmt = ($start_date && $end_time) ? set_datetime($start_date, $end_time) : NULL;

  // Create record using post parameters
  $args = [];
  $args['rooster_kenteken'] = $_POST['rooster_kenteken'] ?? NULL;
  $args['rooster_medewerker'] = $_POST['rooster_medewerker'] ?? NULL;
  $args['rooster_start'] = $start_time_fmt ?? NULL;
  $args['rooster_end'] = $end_time_fmt ?? NULL;
  $args['rooster_description'] = $_POST['rooster_description'] ?? NULL;
  $args['rooster_modifiedby'] = $session->username;

$shift = new Shift($args);
$result = $shift->save();

if($result === true) {
  $new_id = $shift->rl_id;
  $_SESSION['message'] = 'Rooster voor ' . $shift->rooster_medewerker .' succesvol toegevoegd.';
  redirect_to(url_for('/shifts/details.php?id=' . $new_id));
} else {
// show errors
}

} else {
// display the form
$shift = new Shift();
}

?>

<?php $page_title = 'Nieuw rooster'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main">

  <div class="container-fluid py-3">
    <div class="row">
      <div class="col-md-9 ">
        <?php echo display_errors($shift->errors); ?>
        <div class="container-fluid bg-light py-2">
          <h4 class="py-3">Nieuw rooster</h4>
          <form action="<?php echo url_for('/shifts/new.php'); ?>" method="post" class="needs-validation" novalidate>

            <?php include('form_fields.php'); ?>

            <div class="form-group row">
              <div class="col-sm-10">
                <input type="submit" value="Opslaan" class="btn btn-primary" name="opslaan" /> of <a
                  href="<?php echo url_for('/shifts'); ?>">Annuleren</a>
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