<?php require_once('../private/initialize.php'); ?>
<?php  require_login('15'); ?>
<?php

  // Get requested ID
  $id = $_GET['id'] ?? false;

  if(!$id) {
    redirect_to(url_for('/dashboard'));
  }

  // Find contact using ID
  $post = Post::find_by_id($id);
  $creation_date = new DateTime($post->bericht_created);

?>

<?php $page_title = 'Bericht'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main">

  <div class="container-fluid py-3">
    <div class="row">
      <div class="col-md-9">
        <div class="row py-3">
          <div class="col-md-12">
            <div class="entry-header">
              <div>
                <h4 class="mt-0"><?php echo nl2br($post->bericht_titel);?></h4>
                <small>Van: <?php echo $post->bericht_createdby; ?><br>
                  Datum: <?php echo date_format($creation_date, 'd-m-Y'); ?></small>
              </div>
              <?php if($session->check_login('5') ) {?>
              <div>
                <a href="edit.php?id=<?php echo $post->bericht_id ?>" class="btn btn-outline-primary" tabindex="-1"
                  role="button">Bewerken</a>
                <a href="delete.php?id=<?php echo $post->bericht_id ?>" class="btn btn-outline-danger"><i
                    class="fas fa-trash-alt"></i></a>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <p><?php echo nl2br($post->bericht_message); ?></p>
          </div>
        </div>
      </div>
</main>

<!--Content area end-->
<?php include(SITE_PATH . '/footer.php'); ?>