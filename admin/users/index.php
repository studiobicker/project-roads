<?php require_once('../../private/initialize.php'); ?>
<?php  require_login('1'); ?>

<?php $page_title = 'Gebruikers'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main container">
  <!-- end if -->
  <div class="page-actions py-3">
    <a href="new.php" class="btn btn-primary" tabindex="-1" role="button">Toevoegen</a>
  </div>
  <!-- end if -->
  <div class="row">
    <div class="col-md-9">


      <table class="table table-hover">
        <thead class="thead-dark">
          <tr>
            <th>Gebruikersnaam</th>
            <th>Naam</th>
            <th>E-mail</th>
            <th>Rol</th>
            <th width=60>Acties</th>
          </tr>
        </thead>
        <tbody>
          <?php
      $users = User::find_all();
?>
          <?php foreach($users as $user) { 
            $role = Role::find_by_level($user->user_level);?>
          <tr class="entry-row" data-id="<?php echo $user->user_id; ?>">

            <td scope="row"><?php echo h($user->username); ?></td>
            <td scope="row"><?php echo h($user->name); ?></td>
            <td scope="row"><?php echo h($user->email); ?></td>
            <td scope="row"><?php echo h($role->level_name); ?></td>
            <td scope="row">
              <?php if ($user->user_id != 1) { ?>
              <a href="edit.php?id=<?php echo $user->user_id; ?>"><i class="fas fa-edit"></i></a>
              <a href="delete.php?id=<?php echo $user->user_id; ?>"><i class="fas fa-trash-alt"></i></a>
              <?php } ?>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <aside class="col-md-3">
      <?php include(SITE_PATH . '/admin/sidebar.php') ?>
    </aside>
  </div>
</main>
<!--Content area end-->
<?php include(SITE_PATH . '/footer.php'); ?>