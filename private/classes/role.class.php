<?php

class Role extends DatabaseObject {

  static protected $table_name = "login_levels";
  static protected $db_columns = ['level_id', 'level_name', 'level_level'];
  static protected $table_id = "level_id";
  static protected $order = "ORDER BY level_level";

  public $level_id;
  public $level_name;
  public $level_level;

  public function __construct($args=[]) {
    //$this->rl_zoeknaam = isset($args['rl_zoeknaam']) ? $args['rl_zoeknaam'] : '';
    $this->level_name = $args['level_name'] ?? '';
    $this->level_level = $args['level_level'] ?? '';
  }

  public function get_id() {
    return $this->level_id;
  }
  public function set_id($insert_id) {
    $this->level_id = $insert_id;
  }
  protected function validate() {
    $this->errors = [];
    // Add custom validations
    
    if(is_blank($this->level_name)) {
      $this->errors[] = "Vul de naam van de rol in.";
    }
    if(is_blank($this->level_level)) {
      $this->errors[] = "Vul het toegangsniveau de rol in.";
    } elseif (!has_unique_level($this->level_level, $this->level_id ?? 0)) {
      $this->errors[] = "Toegangsniveau niet uniek. Probeer een andere.";
    }

    return $this->errors;
  }

  static public function find_by_level($level_level) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE level_level='" . self::$database->escape_string($level_level) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  
}

?>