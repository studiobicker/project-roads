<?php

class Shift extends DatabaseObject {

  static protected $table_name = "rooster";
  static protected $table_vervoer = "rp_vervoermiddelen";
  static protected $db_columns = ['rooster_id', 'rooster_kenteken', 'rooster_medewerker', 'rooster_start', 'rooster_end', 'rooster_description', 'rooster_modifiedby'];
  static protected $table_id = "rooster_id";
  static protected $order = "ORDER BY r.rooster_start ASC";

  public $rooster_id;
  public $rooster_kenteken;
  public $rooster_medewerker;
  public $rooster_start;
  public $rooster_end;
  public $rooster_description;
  public $rooster_modifiedby;

  public $rp_vervoer_naam;
  public $rp_vervoer_kenteken;
  public $rp_vervoer_telefoon;
  public $rp_vervoer_kleur;


  public function __construct($args=[]) {
    //$this->rl_zoeknaam = isset($args['rooster_kenteken']) ? $args['rooster_kenteken'] : '';
    $this->rooster_kenteken = $args['rooster_kenteken'] ?? '';
    $this->rooster_medewerker = $args['rooster_medewerker'] ?? '';
    $this->rooster_start = $args['rooster_start'] ?? '';
    $this->rooster_end = $args['rooster_end'] ?? '';
    $this->rooster_description = $args['rooster_description'] ?? '';
    $this->rooster_modifiedby = $args['rooster_modifiedby'] ?? '';
  }

  public function get_id() {
    return $this->rooster_id;
  }
  public function set_id($insert_id) {
    $this->rooster_id = $insert_id;
  }

  public function starttijd() {
    $output = (new DateTime($this->rooster_start))->format('H:i');
    return $output;
  }

  public function eindtijd() {
    $output = (new DateTime($this->rooster_end))->format('H:i');
    return $output;
  }

  protected function validate() {
    $this->errors = [];


    return $this->errors;
  }

  static public function find_all() {
    global $session;
    $sql = "SELECT r.*, v.* FROM " . static::$table_name . " r, " . static::$table_vervoer . " v ";
    $sql .= "WHERE r.rooster_kenteken=v.rp_vervoer_kenteken ";
    $sql .= "AND DATE_FORMAT(r.rooster_start, '%Y-%m-%d')='" . self::$database->escape_string($session->datum) . "' ";
    if($session->vervoer != 'ALL') {
      $sql .= "AND r.rooster_kenteken='" . self::$database->escape_string($session->vervoer) . "' ";
    } 
    $sql .= static::$order;
     return static::find_by_sql($sql);
  }

  static public function find_by_id($id) {
    global $session;
    $sql = "SELECT r.*, v.* FROM " . static::$table_name . " r, " . static::$table_vervoer . " v ";
    $sql .= "WHERE r.rooster_kenteken=v.rp_vervoer_kenteken ";
    $sql .= "AND " . static::$table_id . "='" . self::$database->escape_string($id) . "'";

    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

}

?>