<?php require_once('../../private/initialize.php'); ?>
<?php  require_login('1'); ?>

<?php

  // Get requested ID
  $id = $_GET['id'] ?? false;

  if(!$id) {
    redirect_to(url_for('/admin/codes'));
  }

  // Find code using ID
  $code = Code::find_by_id($id);

?>

<?php $page_title = 'Factuurcode'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main code="main" class="site-main">

  <div class="container-fluid py-3">
    <div class="row">
      <div class="col-md-9">
        <div class="row py-3">
          <div class="col-md-12">
            <div class="entry-header">
              <div>
                <h4 class="mt-0"><?php echo h($code->fct_code); ?></h4>
              </div>
              <!-- end if -->
              <div>
                <a href="edit.php?id=<?php echo $code->fct_id ?>" class="btn btn-outline-primary" tabindex="-1"
                  code="button">Bewerken</a>
                <a href="delete.php?id=<?php echo $code->fct_id ?>" class="btn btn-outline-danger"><i
                    class="fas fa-trash-alt"></i></a>
              </div>
              <!-- end if -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Factuurcode</div>
          <div class="col-md-8">
            <?php echo h($code->fct_code); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Omschrijving</div>
          <div class="col-md-8">
            <?php echo h($code->fct_omschrijving); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Status</div>
          <div class="col-md-8">
            <?php echo h($code->status()); ?>
          </div>
        </div>
      </div>
      <aside class="col-md-3">
        <?php include(SITE_PATH . '/admin/sidebar.php') ?>
      </aside>
    </div>
</main>

<!--Content area end-->
<?php include(SITE_PATH . '/footer.php'); ?>