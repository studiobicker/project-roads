<?php
require_once('./private/initialize.php');

$errors = [];
$username = '';
$password = '';

if(is_post_request()) {

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validations
  if(is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  // if there were no errors, try to login
  if(empty($errors)) {
    $user = User::find_by_username($username);
    // test if admin found and password is correct
    if($user != false && $user->verify_password($password)) {
      // Mark admin as logged in
      $session->login($user);
      redirect_to(url_for('/index.php'));
    } else {
      // username not found or password does not match
      $errors[] = "Gebruikersnaam en/of wachtwoord is onjuist.";
    }

  }

}

?>

<?php $page_title = 'Inloggen'; ?>
<?php include(SITE_PATH . '/login_header.php'); ?>

<form class="form-signin needs-validation" novalidate method="post" action="login.php">
  <div class="text-center mb-4">
    <img src="<?php echo url_for('/assets/img/logo.png'); ?>" alt="Roads Rittenplanner" />
    <?php echo display_errors($errors); ?>
  </div>

  <div class="form-label-group">
    <input type="text" id="username" name="username" class="form-control" value="<?php echo h($username); ?>"
      placeholder="Gebruikersnaam" required autofocus="">
    <div class="invalid-feedback">
      Vul hier je gebruikersnaam in.
    </div>
    <label for="username">Gebruikersnaam</label>
  </div>

  <div class="form-label-group">
    <input type="password" id="password" name="password" class="form-control" placeholder="Wachtwoord" required>
    <div class="invalid-feedback">
      Vul hier je wachtwoord in.
    </div>
    <label for="password">Wachtwoord</label>
  </div>

  <input type="submit" value="Login" class="btn btn-lg btn-primary btn-block" name="login" />
</form>

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

<?php include(SITE_PATH . '/login_footer.php'); ?>