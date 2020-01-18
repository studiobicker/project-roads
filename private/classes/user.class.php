<?php

class User extends DatabaseObject {

  static protected $table_name = "users";
  static protected $db_columns = ['user_id', 'user_level', 'username', 'name', 'email', 'hashed_password'];
  static protected $table_id = "user_id";
  static protected $order = "ORDER BY user_level, username ASC";

  public $user_id;
  public $user_level;
  public $username;
  public $name;
  public $email;
  protected $hashed_password;
  public $password;
  public $confirm_password;
  protected $password_required = true;

  public function __construct($args=[]) {
    $this->user_level = $args['user_level'] ?? '';
    $this->username = $args['username'] ?? '';
    $this->name = $args['name'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->confirm_password = $args['confirm_password'] ?? '';
  }

  protected function set_hashed_password() {
    $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  public function verify_password($password) {
    return password_verify($password, $this->hashed_password);
  }

  protected function create() {
    $this->set_hashed_password();
    return parent::create();
  }

  protected function update() {
    if($this->password != '') {
      $this->set_hashed_password();
      // validate password
    } else {
      // password not being updated, skip hashing and validation
      $this->password_required = false;
    }
    return parent::update();
  }

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->name)) {
      $this->errors[] = "Vul de naam van de gebruiker in.";
    }


    if(is_blank($this->email)) {
      $this->errors[] = "Vul het e-mailadres van de gebruiker in.";
    } elseif (!has_valid_email_format($this->email)) {
      $this->errors[] = "Vul een geldig e-mailadres in.";
    }

    if(is_blank($this->username)) {
      $this->errors[] = "Vul een gebruikersnaam in";
    } elseif (!has_unique_username($this->username, $this->user_id ?? 0)) {
      $this->errors[] = "Deze gebruikersnaam is niet toegestaan. Probeer een andere.";
    }

    if($this->password_required) {
      if(is_blank($this->password)) {
        $this->errors[] = "Vul een wachtwoord in";
      }

      if(is_blank($this->confirm_password)) {
        $this->errors[] = "Herhaal het wachtwoord bij bevestig wachtwoord";
      } elseif ($this->password !== $this->confirm_password) {
        $this->errors[] = "Wachtwoord en bevestig wachtwoord komen niet overeen.";
      }
    }

    return $this->errors;
  }

  static public function find_by_username($username) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public function get_id() {
    return $this->user_id;
  }
  public function set_id($insert_id) {
    $this->user_id = $insert_id;
  }

}

?>