<?php
require_once('../../private/initialize.php');

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

  // Delete user
  $result = $user->delete();
  $_SESSION['message'] = 'Het account is succesvol verwijderd';
  redirect_to(url_for('/admin/users'));

} else {
  // Display form
}

?>

<?php $page_title = 'Account verwijderen'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<div id="content">


  <!--Content area start-->
  <main role="main" class="site-main">
    <div class="container py-3">
      <div class="row">
        <div class="col-md-9 ">
          <div class="container bg-light py-2">
            <h4 class="py-3"><?php echo $page_title ?></h4>
            <p>Weet je zeker dat je dit account wilt verwijderen?</p>

            <p class="py-3">
              <strong><?php echo h($user->username) ?> </strong>
            </p>
            <form action="<?php echo url_for('/admin/users/delete.php?id=' . h(u($id))); ?>" method="post">
              <div class="form-group row">
                <div class="col-sm-10">
                  <input type="submit" value="Verwijder account" class="btn btn-primary" name="commit" /> of <a
                    href="<?php echo url_for('/admin/users'); ?>">Annuleren</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include(SITE_PATH . '/footer.php'); ?>