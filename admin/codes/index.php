<?php require_once('../../private/initialize.php'); ?>
<?php require_login('1'); ?>

<?php $page_title = 'Factuurcodes'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main container-fluid">
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
            <th>Factuurcode</th>
            <th>Omschrijving</th>
            <th>Status</th>
            <th width=60>Acties</th>
          </tr>
        </thead>
        <tbody>
          <?php
      $codes = Code::find_all();
?>
          <?php foreach($codes as $code) { ?>
          <tr class="entry-row" data-id="<?php echo $code->fct_id; ?>">

            <td scope="row"><?php echo h($code->fct_code); ?></td>
            <td scope="row"><?php echo h($code->fct_omschrijving); ?></td>
            <td scope="row"><?php echo h($code->status()); ?></td>
            </td>
            <td scope="row">
              <a href="edit.php?id=<?php echo $code->fct_id; ?>"><i class="fas fa-edit"></i></a>
              <a href="delete.php?id=<?php echo $code->fct_id; ?>"><i class="fas fa-trash-alt"></i></a>
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