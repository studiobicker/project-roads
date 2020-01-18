<?php require_once('../../private/initialize.php'); 

require_login('1');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/admin/users'));
}
$id = $_GET['id'];
$user = User::find_by_id($id);
if($user == false) {
  redirect_to(url_for('/admin/users'));
}

if(is_post_request()) {

  // Create record using post parameters
  $args = [];
  $args['name'] = $_POST['name'] ?? NULL;
  $args['username'] = $_POST['username'] ?? NULL;
  $args['email'] = $_POST['email'] ?? NULL;
  $args['password'] = $_POST['password'] ?? NULL;
  $args['confirm_password'] = $_POST['confirm_password'] ?? NULL;
  $args['user_level'] = $_POST['user_level'] ?? NULL;

  $user->merge_attributes($args);
  $result = $user->save();

  if($result === true) {
    $_SESSION['message'] = 'Gebruiker succesvol bijgewerkt';
    redirect_to(url_for('/admin/users/details.php?id=' . $id));
  } else {
    // show errors
  }

}

?>

<?php $page_title = 'Account wijzigen'; ?>
<?php $password_hint = "(leeg = niet wijzigen)"; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main">

  <div class="container py-3">
    <div class="row">
      <div class="col-md-9 ">
        <div class="container bg-light py-2">
          <?php echo display_errors($user->errors); ?>
          <h4 class="py-3"><?php echo $page_title ?></h4>
          <form class="needs-validation" novalidate
            action="<?php echo url_for('/admin/users/edit.php?id=' . h(u($id))); ?>" method="post">

            <?php include('form_fields.php'); ?>

            <div class="form-group row">
              <div class="col-sm-10">
                <input type="submit" value="Opslaan" class="btn btn-primary" name="opslaan" /> of <a
                  href="<?php echo url_for('/admin/users'); ?>">Annuleren</a>
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