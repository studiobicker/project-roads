<?php require_once('../../private/initialize.php'); ?>
<?php  require_login('1'); ?>

<?php

  // Get requested ID
  $id = $_GET['id'] ?? false;

  if(!$id) {
    redirect_to(url_for('/admin/roles'));
  }

  // Find role using ID
  $role = Role::find_by_id($id);

?>

<?php $page_title = 'Rol'; ?>
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
                <h4 class="mt-0"><?php echo h($role->level_name); ?></h4>
              </div>
              <!-- end if -->
              <a href="edit.php?id=<?php echo $role->level_id ?>" class="btn btn-outline-primary" tabindex="-1"
                role="button">Bewerken</a>
              <!-- end if -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Rol</div>
          <div class="col-md-8">
            <?php echo h($role->level_name); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Niveau</div>
          <div class="col-md-8">
            <?php echo h($role->level_level); ?>
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