<?php require_once('../private/initialize.php'); ?>
<?php require_login('15'); ?>

<?php $page_title = 'Dashboard'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="container-fluid py-3">
  <div class="row">
    <div class="col-md-9">

      <!-- if ($level <= 10)  -->
      <div class="page-actions">
        <a href="new.php" class="btn btn-primary" tabindex="-1" role="button">Toevoegen</a>
      </div>
      <!-- end if -->

      <?php $posts = Post::find_all(); ?>
      <?php 
        foreach($posts as $post) { 
          $creation_date = new DateTime($post->bericht_created);
      ?>

      <article class="media message entry-row <?php  if ($post->bericht_status == '1') { echo "closed"; } ?>"
        data-id="<?php echo $post->bericht_id; ?>">
        <div class="avatar"><i class="far fa-file-alt"></i></div>
        <div class="media-body">
          <div class="small">
            <strong><?php echo $post->bericht_createdby; ?></strong> plaatste dit bericht op
            <?php echo date_format($creation_date, 'd-m-Y'); ?>
          </div>
          <h5 class="mt-0"><?php echo $post->bericht_titel; ?></h5>
          <p><?php echo nl2br($post->bericht_message); ?></p>
        </div>
      </article>
      <?php } ?>



      <!-- paginering invoegen -->

    </div>
  </div>
  <aside col-md-3></aside>
</main>
<!--Content area end-->

<?php include(SITE_PATH . '/footer.php'); ?>