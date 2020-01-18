<?php require_once('../../private/initialize.php'); ?>
<?php  require_login('1'); ?>
<?php

  // Get requested ID
  $id = $_GET['id'] ?? false;

  $user = User::find_by_id($id);
  if($user == false) {
    redirect_to(url_for('/admin/users'));
  }

  $role = Role::find_by_level($user->user_level);

?>

<?php $page_title = 'User'; ?>
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
                <h4 class="mt-0"><?php echo h($user->name); ?></h4>
              </div>
              <?php if ($user->user_id != 1) { ?>
              <a href="edit.php?id=<?php echo $user->user_id ?>" class="btn btn-outline-primary" tabindex="-1"
                role="button">Bewerken</a>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Gebruikersnaam</div>
          <div class="col-md-8">
            <?php echo h($user->username); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">E-mailadres</div>
          <div class="col-md-8">
            <?php echo h($user->email); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">Rol</div>
          <div class="col-md-8">
            <?php echo h($role->level_name); ?>
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