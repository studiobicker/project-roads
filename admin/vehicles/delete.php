<?php
require_once('../../private/initialize.php');

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

  // Delete contact
  $result = $vehicle->delete();
  $_SESSION['message'] = 'Het voertuig is succesvol verwijderd';
  redirect_to(url_for('/admin/vehicles'));

} else {
  // Display form
}

?>

<?php $page_title = 'Voertuig verwijderen'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<div id="content">


  <!--Content area start-->
  <main role="main" class="site-main">
    <div class="container py-3">
      <div class="row">
        <div class="col-md-9 ">
          <div class="container bg-light py-2">
            <h4 class="py-3"><?php echo $page_title ?></h4>
            <p>Weet je zeker dat je dit voertuig wilt verwijderen?</p>

            <p class="py-3">
              <strong><?php echo h($vehicle->rp_vervoer_naam) ?> met kenteken
                <?php echo h($vehicle->rp_vervoer_kenteken) ?></strong>
            </p>
            <form action="<?php echo url_for('/admin/vehicles/delete.php?id=' . h(u($id))); ?>" method="post">
              <div class="form-group row">
                <div class="col-sm-10">
                  <input type="submit" value="Verwijder voertuig" class="btn btn-primary" name="commit" /> of <a
                    href="<?php echo url_for('/admin/vehicles'); ?>">Annuleren</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include(SITE_PATH . '/footer.php'); ?>