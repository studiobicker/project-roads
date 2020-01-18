<?php
require_once('../private/initialize.php');

require_login('5');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/contacts'));
}

$id = $_GET['id'];
$contact = Contact::find_by_id($id);
if($contact == false) {
  redirect_to(url_for('/contacts'));
}

if(is_post_request()) {

  // Delete contact
  $result = $contact->delete();
  $_SESSION['message'] = 'Het contact is succesvol verwijderd';
  redirect_to(url_for('/contacts'));

} else {
  // Display form
}

?>

<?php $page_title = 'Contact verwijderen'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<div id="content">


  <!--Content area start-->
  <main role="main" class="site-main">
    <div class="container py-3">
      <div class="row">
        <div class="col-md-9 ">
          <div class="container bg-light py-2">
            <?php //echo display_errors($contact->errors); ?>
            <h4 class="py-3"><?php echo $page_title ?></h4>
            <p>Weet je zeker dat je dit contact wilt verwijderen?</p>

            <p class="py-3">
              <strong><?php echo nl2br($contact->name()); ?></strong> </p>
            <form action="<?php echo url_for('/contacts/delete.php?id=' . h(u($id))); ?>" method="post">
              <div class="form-group row">
                <div class="col-sm-10">
                  <input type="submit" value="Verwijder contact" class="btn btn-primary" name="commit" /> of <a
                    href="<?php echo url_for('/contacts'); ?>">Annuleren</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include(SITE_PATH . '/footer.php'); ?>