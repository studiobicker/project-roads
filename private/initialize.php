<?php

  ob_start(); // turn on output buffering
  
  define("PRIVATE_PATH", dirname(__FILE__));
  define("SITE_PATH", dirname(PRIVATE_PATH));
  define("WWW_ROOT", '/roads2020');

  require_once('functions.php');
  require_once('status_error_functions.php');
  require_once('db_credentials.php');
  require_once('database_functions.php');
  require_once('validation_functions.php');

  // Load class definitions manually
  // -> Individually
  //require_once('classes/contact.class.php');

  // -> All classes in directory
  foreach(glob('classes/*.class.php') as $file) {
    require_once($file);
  }

  // Autoload class definitions
  function my_autoload($class) {
    if(preg_match('/\A\w+\Z/', $class)) {
      include('classes/' . $class . '.class.php');
    }
  }
  spl_autoload_register('my_autoload');

  $database = db_connect();
  DatabaseObject::set_database($database);

  $session = new Session;