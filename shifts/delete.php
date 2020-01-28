<?php
require_once('../private/initialize.php');

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

  // Delete contact
  $result = $shift->delete();
  $_SESSION['message'] = 'Het rooster voor ' . $shift->rooster_medewerker .'  is succesvol verwijderd';
  redirect_to(url_for('/shifts'));

} else {
  // Display form
}

?>

<?php $page_title = 'Rooster verwijderen'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<div id="content">


  <!--Content area start-->
  <main role="main" class="site-main">
    <div class="container-fluid py-3">
      <div class="row">
        <div class="col-md-9 ">
          <div class="container-fluid bg-light py-2">
            <?php //echo display_errors($contact->errors); ?>
            <h4 class="py-3"><?php echo $page_title ?></h4>
            <p>Weet je zeker dat je dit rooster wilt verwijderen?</p>

            <p class="py-3">
              <strong><?php echo h($shift->rooster_medewerker); ?></strong><br>
              <?php echo h($shift->rp_vervoer_naam); ?></p>
            <form action="<?php echo url_for('/shifts/delete.php?id=' . h(u($id))); ?>" method="post">
              <div class="form-group row">
                <div class="col-sm-10">
                  <input type="submit" value="Verwijder rooster" class="btn btn-primary" name="commit" /> of <a
                    href="<?php echo url_for('/shifts'); ?>">Annuleren</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include(SITE_PATH . '/footer.php'); ?>