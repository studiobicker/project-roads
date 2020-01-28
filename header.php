<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>Roads Rittenplanner<?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css"
    integrity="sha256-FAOaXTpl90/K8cXmSdsskbQN3nKYulhCpPbcFzGTWKI=" crossorigin="anonymous" />

  <!--load fontawesome styles -->
  <link href="<?php echo url_for('/assets/css/all.css'); ?>" rel="stylesheet">
  <!--load bootstrap + custom styles -->
  <link href="<?php echo url_for('/assets/css/app.css'); ?>" rel="stylesheet" type="text/css" />



</head>
<div class="wrapper">
  <!--Header area start-->
  <header class="header">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg py-3">
        <a class="navbar-brand" href="<?php echo url_for('/index.php'); ?>">
          <img src="<?php echo url_for('/assets/img/logo.png'); ?>" alt="Roads Rittenplanner" />
        </a>
        <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
          class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>


        <div id="navbarSupportedContent" class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto">
            <?php if($session->is_logged_in()) { ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Welkom, <?php echo $session->username; ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="profile.php">Wachtwoord
                  wijzigen</span></a>
                <a class="dropdown-item" href="<?php echo url_for('/logout.php'); ?>">Uitloggen</a>
              </div>
            </li>
            <?php } ?>
          </ul>
        </div>
      </nav>

      <ul class="nav nav-tabs">
        <?php if($session->is_logged_in()) { ?>
        <li class="nav-item">
          <a class="nav-link <?php echo isActiveDir('/dashboard') ?>"
            href="<?php echo url_for('/index.php'); ?>"><span>Dashboard</span></a>
        </li>
        <li class=" nav-item">
          <a class="nav-link <?php echo isActiveDir('/rides') ?>"
            href="<?php echo url_for('/rides/'); ?>"><span>Ritadministratie</span></a>
        </li>
        <li class=" nav-item">
          <a class="nav-link <?php echo isActiveDir('/shifts') ?>"
            href="<?php echo url_for('/shifts/'); ?>"><span>Rooster</span></a>
        </li>
        <li class=" nav-item">
          <a class="nav-link <?php echo isActiveDir('/contacts') ?>"
            href="<?php echo url_for('/contacts/'); ?>"><span>Adresboek</span> </a>
        </li>
        <!-- if level <= 1  -->
        <?php if( $session->check_login('1') )  { ?>
        <li class=" nav-item">
          <a class="nav-link <?php echo isActiveDir('/invoices') ?>"
            href="<?php echo url_for('/invoices/'); ?>"><span>Facturen</span> </a>
        </li>
        <!-- if level <= 1  -->
        <li class="nav-item">
          <a class="nav-link" <?php echo isActiveDir('/admin') ?>
            href="<?php echo url_for('/admin/'); ?>"><span>Beheer</span></a>
        </li>
        <?php } ?>
        <?php } ?>
      </ul>
    </div>
  </header>
  <!--Header area end-->

  <body>