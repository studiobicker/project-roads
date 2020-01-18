<?php
  require_once('./private/initialize.php');
?>

<?php $page_title = 'Geen toegang'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<main role="main" class="container py-3">

  <div class="starter-template">
    <h3 class="py-3"><?php echo $page_title ?></h3>
    <p class="lead">Je bent niet geautoriseerd deze pagina te bekijken.<br>
      Neem contact op met de beheerder als je denkt dat dit niet juist is.</p>
  </div>

</main>

<?php include(SITE_PATH . '/footer.php'); ?>