<?php

class Code extends DatabaseObject {

  static protected $table_name = "factuur_codes";
  static protected $db_columns = ['fct_id', 'fct_code', 'fct_omschrijving', 'fct_status', 'fct_modifiedby'];
  static protected $table_id = "fct_id";
  static protected $order = "ORDER BY fct_code";

  public $fct_id;
  public $fct_code;
  public $fct_omschrijving;
  public $fct_status;
  public $fct_modifiedby;

  public const STATUS_OPTIONS = [
    0 => 'Actief',
    1 => 'Vervallen',
  ];

  public function __construct($args=[]) {
    //$this->rl_zoeknaam = isset($args['rl_zoeknaam']) ? $args['rl_zoeknaam'] : '';
    $this->fct_code = $args['fct_code'] ?? '';
    $this->fct_omschrijving = $args['fct_omschrijving'] ?? '';
    $this->fct_status = $args['fct_status'] ?? 0;
    $this->fct_modifiedby = $args['fct_modifiedby'] ?? '';
  }

  public function get_id() {
    return $this->fct_id;
  }
  public function set_id($insert_id) {
    $this->fct_id = $insert_id;
  }

  public function status() {
    if($this->fct_status == 0 || $this->fct_status == 1  ) {     
      return self::STATUS_OPTIONS[$this->fct_status];
    } else {
      return "Onbekend";
    }
  }
  

  protected function validate() {
    $this->errors = [];
    // Add custom validations
    
    if(is_blank($this->fct_code)) {
      $this->errors[] = "Vul een factuurcode in.";
    } elseif (!has_unique_code($this->fct_code, $this->fct_id ?? 0)) {
      $this->errors[] = "Factuurcode niet uniek. Probeer een andere.";
    }
    if(is_blank($this->fct_omschrijving)) {
      $this->errors[] = "Vul een omschrijving van de code in.";
    }
    if(is_blank($this->fct_status)) {
      $this->errors[] = "Vul een status van de code in.";
    }

    return $this->errors;
  }

  static public function find_by_code($fct_code) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE fct_code='" . self::$database->escape_string($fct_code) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_all_enabled() {
    $sql = "SELECT * FROM " . static::$table_name . " " ;
    $sql .= "WHERE fct_status='0' ";
    $sql .= static::$order;
  
    return static::find_by_sql($sql);
  }
  
}

?>