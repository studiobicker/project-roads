<?php require_once('../private/initialize.php'); 

require_login('5');

if(is_post_request()) {

  // Create record using post parameters
  $order_date = $_POST['opdracht_datum'] ?? NULL;
  $start_time = $_POST['rit_start'] ?? NULL;
  $end_time = $_POST['rit_eind'] ?? NULL;

  //convert start & end time to datetime
  $order_date_fmt = $order_date ? set_date($order_date) : NULL;
  $start_time_fmt = ($order_date && $start_time) ? set_datetime($order_date, $start_time) : NULL;
  $end_time_fmt = ($order_date && $end_time) ? set_datetime($order_date, $end_time) : NULL;

  //if opslaan als optie is not checked opdracht_status is definitief
  $order_state = $_POST['opdracht_status'] ?? NULL;
  $order_option = $_POST['opdracht_optie'] ?? NULL;
  $order_state = (!empty($order_option)) ? 'O' : $order_state;

  // Create record using post parameters
  $args = [];
  $args['opdracht_opdrachtnummer'] = $_POST['opdracht_opdrachtnummer'] ?? NULL;
  $args['opdracht_datum'] = $order_date_fmt ?? NULL;
  $args['opdracht_opdrachtgeverid'] = $_POST['opdracht_opdrachtgeverid'] ?? NULL;
  $args['opdracht_factuurbedrijf'] = $_POST['opdracht_factuurbedrijf'] ?? NULL;
  $args['opdracht_factuurnaam'] = $_POST['opdracht_factuurnaam'] ?? NULL;
  $args['opdracht_factuuradres'] = $_POST['opdracht_factuuradres'] ?? NULL;
  $args['opdracht_factuurpostcode'] = $_POST['opdracht_factuurpostcode'] ?? NULL;
  $args['opdracht_factuurplaats'] = $_POST['opdracht_factuurplaats'] ?? NULL;
  $args['opdracht_telefoon'] = $_POST['opdracht_telefoon'] ?? NULL;
  $args['opdracht_opdracht'] = $_POST['opdracht_opdracht'] ?? NULL;
  $args['opdracht_factuurcode'] = $_POST['opdracht_factuurcode'] ?? NULL;
  $args['opdracht_prijs'] = $_POST['opdracht_prijs'] ?? NULL;
  $args['opdracht_kostenplaats'] = $_POST['opdracht_kostenplaats'] ?? NULL;
  $args['opdracht_status'] = $order_state ?? NULL;
  $args['opdracht_modifiedby'] = $session->username;

  $args['rit_kenteken'] = $_POST['rit_kenteken'] ?? NULL;
  $args['rit_aantalpassagiers'] = $_POST['rit_aantalpassagiers'] ?? NULL;
  $args['rit_start'] = $start_time_fmt ?? NULL;
  $args['rit_vertrekid'] = $_POST['rit_vertrekid'] ?? NULL;
  $args['rit_vertrekbedrijf'] = $_POST['rit_vertrekbedrijf'] ?? NULL;
  $args['rit_vertreknaam'] = $_POST['rit_vertreknaam'] ?? NULL;
  $args['rit_vertrekadres'] = $_POST['rit_vertrekadres'] ?? NULL;
  $args['rit_vertrekpostcode'] = $_POST['rit_vertrekpostcode'] ?? NULL;
  $args['rit_vertrekplaats'] = $_POST['rit_vertrekplaats'] ?? NULL;
  $args['rit_vertrektelefoon'] = $_POST['rit_vertrektelefoon'] ?? NULL;
  $args['rit_eind'] = $end_time_fmt ?? NULL;
  $args['rit_bestemmingsid'] = $_POST['rit_bestemmingsid'] ?? NULL;
  $args['rit_bestemmingsbedrijf'] = $_POST['rit_bestemmingsbedrijf'] ?? NULL;
  $args['rit_bestemmingsnaam'] = $_POST['rit_bestemmingsnaam'] ?? NULL;
  $args['rit_bestemmingsadres'] = $_POST['rit_bestemmingsadres'] ?? NULL;
  $args['rit_bestemmingspostcode'] = $_POST['rit_bestemmingspostcode'] ?? NULL;
  $args['rit_bestemmingsplaats'] = $_POST['rit_bestemmingsplaats'] ?? NULL;
  $args['rit_bestemmingstelefoon'] = $_POST['rit_bestemmingstelefoon'] ?? NULL;
  $args['rit_message'] = $_POST['rit_message'] ?? NULL;

  $ride = new Ride($args);
  $result = $ride->save();

  if($result === true) {
    $new_id = $ride->opdracht_id;
    $_SESSION['message'] = 'Aanvraag succesvol geboekt.';
    redirect_to(url_for('/rides/details.php?id=' . $new_id));
  } else {
    // show errors
  }

} else {
  // display the form
  $ride = new Ride();
}

?>

<?php $page_title = 'Nieuwe ritaanvraag'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main">

  <div class="container-fluid py-3">
    <div class="row">
      <div class="col-md-9 ">
        <?php echo display_errors($ride->errors); ?>
        <div class="container-fluid bg-light py-2">
          <h4 class="py-3">Ritaanvraag</h4>
          <form action="<?php echo url_for('/rides/new.php'); ?>" method="post" class="needs-validation" novalidate>

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