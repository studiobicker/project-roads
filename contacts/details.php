<?php require_once('../private/initialize.php'); ?>
<?php  require_login('15'); ?>
<?php

  // Get requested ID
  $id = $_GET['id'] ?? false;

  if(!$id) {
    redirect_to(url_for('/contacts'));
  }

  // Find contact using ID
  $contact = Contact::find_by_id($id);

?>

<?php $page_title = 'Contactgegevens'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main">

  <div class="container py-3">
    <div class="row">
      <div class="col-md-9">
        <div class="row py-3">
          <div class="col-md-12">
            <div class="entry-header">
              <div>
                <h4 class="mt-0"><?php echo nl2br($contact->name());?></h4>
              </div>
              <?php if($session->check_login('5') ) {?>
              <a href="edit.php?id=<?php echo $contact->rl_id ?>" class="btn btn-outline-primary" tabindex="-1"
                role="button">Bewerken</a>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Contactgegevens</div>
          <div class="col-md-8">
            <?php echo nl2br($contact->phones()); ?><br>
            <?php echo h($contact->rl_email); ?>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-4">Adresgegevens</div>
          <div class="col-md-8">
            <?php echo nl2br($contact->address()); ?>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-4">Kostenplaats</div>
          <div class="col-md-8">
            <?php echo h($contact->rl_kostenplaats); ?>
          </div>
        </div>
      </div>
    </div>
</main>

<!--Content area end-->
<?php include(SITE_PATH . '/footer.php'); ?>