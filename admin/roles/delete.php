<?php
require_once('../../private/initialize.php');

require_login('1');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/admin/roles'));
}

$id = $_GET['id'];
$role = Role::find_by_id($id);
if($role == false) {
  redirect_to(url_for('/admin/roles'));
}

if(is_post_request()) {

  // Delete contact
  $result = $role->delete();
  $_SESSION['message'] = 'De rol is succesvol verwijderd';
  redirect_to(url_for('/admin/roles'));

} else {
  // Display form
}

?>

<?php $page_title = 'Rol verwijderen'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<div id="content">


  <!--Content area start-->
  <main role="main" class="site-main">
    <div class="container py-3">
      <div class="row">
        <div class="col-md-9 ">
          <div class="container bg-light py-2">
            <h4 class="py-3"><?php echo $page_title ?></h4>
            <p>Weet je zeker dat je deze rol wilt verwijderen?</p>

            <p class="py-3">
              <strong><?php echo h($role->level_name) ?> <?php echo h($role->level_level) ?></strong> </p>
            <form action="<?php echo url_for('/admin/roles/delete.php?id=' . h(u($id))); ?>" method="post">
              <div class="form-group row">
                <div class="col-sm-10">
                  <input type="submit" value="Verwijder rol" class="btn btn-primary" name="commit" /> of <a
                    href="<?php echo url_for('/admin/roles'); ?>">Annuleren</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include(SITE_PATH . '/footer.php'); ?>