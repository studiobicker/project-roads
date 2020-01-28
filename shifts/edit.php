<?php require_once('../private/initialize.php'); 
 require_login('5');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/shifts'));
}
$id = $_GET['id'];
$shift = Shift::find_by_id($id);
if($shift == false) {
  redirect_to(url_for('/shifts'));
}

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
 

  $shift->merge_attributes($args);
  $result = $shift->save();

  if($result === true) {
    $_SESSION['message'] = 'Rooster succesvol bijgewerkt';
    redirect_to(url_for('/shifts/details.php?id=' . $id));
  } else {
    // show errors
  }

}
?>

<?php $page_title = 'Bewerk rooster'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main container-fluid">

  <div class="py-3">
    <div class="row">
      <div class="col-md-9 ">
        <div class="container-fluid bg-light py-2">
          <?php echo display_errors($shift->errors); ?>
          <h4 class="py-3"><?php echo $page_title ?></h4>
          <form class="needs-validation" novalidate action="<?php echo url_for('/shifts/edit.php?id=' . h(u($id))); ?>"
            method="post">

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