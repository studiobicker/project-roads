<?php

class Session {

  private $user_id;
  public $username;
  private $user_level;
  private $last_login;
  public $datum;
  public $vervoer;

  public const MAX_LOGIN_AGE = 60*60*24; // 1 day

  public function __construct() {
    session_start();
    $this->check_stored_login();
    $this->check_stored_vars();
  }

  public function login($user) {
    if($user) {
      // prevent session fixation attacks
      session_regenerate_id();
      $this->user_id = $_SESSION['user_id'] = $user->user_id;
      $this->username = $_SESSION['username'] = $user->username;
      $thie->user_level = $_SESSION['user_level'] = $user->user_level;
      $this->last_login = $_SESSION['last_login'] = time();
    }
    return true;
  }

  public function is_logged_in() {
    // return isset($this->user_id);
    return isset($this->user_id) && $this->last_login_is_recent();
  }

  public function check_login($level) {
    return isset($this->user_level) && $this->user_level <= $level ;
  }

  public function logout() {
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    unset($_SESSION['user_level']);
    unset($_SESSION['last_login']);
    unset($_SESSION['datum']);
    unset($_SESSION['vervoer']);
    unset($this->user_id);
    unset($this->username);
    unset($this->user_level);
    unset($this->last_login);
    unset($this->datum);
    unset($this->vervoer);
    return true;
  }

  public function set_session_var($var, $value) {
    if($value) {
      $this->$var = $_SESSION[$var] = $value;
    }
  }
  public function is_session_var($var) {
     return isset($this->$var) && !empty($this->$var);
  }

  private function check_stored_login() {
    if(isset($_SESSION['user_id'])) {
      $this->user_id = $_SESSION['user_id'];
      $this->username = $_SESSION['username'];
      $this->user_level = $_SESSION['user_level'];
      $this->last_login = $_SESSION['last_login'];
    }
  }
  
  private function check_stored_vars() {
    if(isset($_SESSION['datum'])) {
      $this->datum =  $_SESSION['datum'];
    }
    if(isset($_SESSION['vervoer'])) {
      $this->vervoer =  $_SESSION['vervoer'];
    }
  }

  private function last_login_is_recent() {
    if(!isset($this->last_login)) {
      return false;
    } elseif(($this->last_login + self::MAX_LOGIN_AGE) < time()) {
      return false;
    } else {
      return true;
    }
  }

  public function message($msg="") {
    if(!empty($msg)) {
      // Then this is a "set" message
      $_SESSION['message'] = $msg;
      return true;
    } else {
      // Then this is a "get" message
      return $_SESSION['message'] ?? '';
    }
  }

  public function clear_message() {
    unset($_SESSION['message']);
  }
}

?>