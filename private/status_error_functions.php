<?php

function require_login($level) {
  global $session;
  if(!$session->is_logged_in()) {
    redirect_to(url_for('/login.php'));
  } else {
    // check user access level
    if(!$session->check_login($level)) {
      
      redirect_to(url_for('/not_authorized.php'));
    }
  }
}

function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"alert alert-danger\" role=\"alert\">";
    $output .= "Verbeter alsjeblieft de volgende fouten:";
    $output .= "<ul>";
    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}

function display_session_message() {
  global $session;
  $msg = $session->message();
  if(isset($msg) && $msg != '') {
    $session->clear_message();
    return '<div id="message">' . h($msg) . '</div>';
  }
}

 function require_rides_session_values() {
  global $session;
  // check if query string parameters are passed for date en vehicle
  // if not, check if date and vehicle are stored in sessin
  // if not, datum = now and vervoer = ALL
  // store date and vehicle in session

  if ( isset($_GET['datum']) && !empty($_GET['datum']) ) {
    $sel_date = $_GET['datum'];
  } elseif ($session->is_session_var('datum') ){
    $sel_date = $session->datum;

  } else {
    $sel_date = (new DateTime('now'))->format('Y-m-d');
  }

  if ( isset($_GET['vervoer']) && !empty($_GET['vervoer']) ) {
    $sel_vehicle = $_GET['vervoer'];
  } elseif ($session->is_session_var('vervoer') ){
    $sel_vehicle = $session->vervoer;
  } else {
    $sel_vehicle = 'ALL';
  }

  $session-> set_session_var('datum', $sel_date);
  $session-> set_session_var('vervoer',$sel_vehicle);

}

?>