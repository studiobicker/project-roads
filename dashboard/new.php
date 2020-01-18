<?php require_once('../private/initialize.php'); 
 require_login('10');

if(is_post_request()) {

// Create record using post parameters
$args = [];
$args['bericht_titel'] = $_POST['bericht_titel'] ?? NULL;
$args['bericht_message'] = $_POST['bericht_message'] ?? NULL;
$args['bericht_status'] = $_POST['bericht_status'] ?? NULL;
$args['bericht_createdby'] = $session->username;

$post = new Post($args);
$result = $post->save();

if($result === true) {
$new_id = $post->bericht_id;
$_SESSION['message'] = 'Bericht' . $post->bericht_titel .' succesvol toegevoegd.';
redirect_to(url_for('/dashboard/details.php?id=' . $new_id));
} else {
// show errors
}

} else {
// display the form
$post = new Post();
}

?>

<?php $page_title = 'Nieuw bericht'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main">

  <div class="container py-3">
    <div class="row">
      <div class="col-md-9 ">
        <?php echo display_errors($post->errors); ?>
        <div class="container bg-light py-2">
          <h4 class="py-3">Nieuw bericht</h4>
          <form action="<?php echo url_for('/dashboard/new.php'); ?>" method="post" class="needs-validation" novalidate>

            <?php include('form_fields.php'); ?>

            <div class="form-group row">
              <div class="col-sm-10">
                <input type="submit" value="Opslaan" class="btn btn-primary" name="opslaan" /> of <a
                  href="<?php echo url_for('/dashboard'); ?>">Annuleren</a>
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