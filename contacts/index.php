<?php require_once('../private/initialize.php'); ?>
<?php require_login('15'); ?>
<?php $page_title = 'Adresboek'; ?>
<?php include(SITE_PATH . '/header.php'); ?>

<!--Content area start-->
<main role="main" class="site-main">

  <div class="container py-3">
    <!-- end if -->
    <div class="page-actions">
      <a href="new.php" class="btn btn-primary" tabindex="-1" role="button">Toevoegen</a>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Zoeken" aria-label="Search">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Zoeken</button>
      </form>
    </div>
    <!-- end if -->
  </div>

  <div class="container">
    <table class="table table-hover">
      <thead class="thead-dark">
        <tr>
          <th>&nbsp;</th>
          <th>Naam</th>
          <th>Adres</th>
          <th nowrap="nowrap">Telefoon</th>
          <th>E-mailadres</th>
          <th width=50>Kostenplaats</th>
          <?php if($session->check_login('5') ) {?>
          <th width=60>Acties</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php
      $contacts = Contact::find_all();
?>
        <?php foreach($contacts as $contact) { ?>
        <tr class="entry-row" data-id="<?php echo $contact->rl_id; ?>">
          <td scope="row"><i class="<?php echo $contact->avatar(); ?>"></i></td>
          <td scope="row"><?php echo nl2br($contact->name()); ?></td>
          <td scope="row"><?php echo nl2br($contact->address()); ?></td>
          <td scope="row" nowrap="nowrap"><?php echo nl2br($contact->phones()); ?></td>
          <td scope="row"><?php echo h($contact->rl_email); ?></td>
          <td scope="row"><?php echo h($contact->rl_kostenplaats); ?></td>
          <?php if($session->check_login('5') ) {?>
          <td scope="row">
            <a href="edit.php?id=<?php echo $contact->rl_id; ?>"><i class="fas fa-edit"></i></a>
            <a href="delete.php?id=<?php echo $contact->rl_id; ?>"><i class="fas fa-trash-alt"></i></a>
          </td>
          <?php } ?>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <!-- paginering invoegen -->

</main>
<!--Content area end-->
<?php include(SITE_PATH . '/footer.php'); ?>