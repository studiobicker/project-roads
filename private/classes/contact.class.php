<?php

class Contact extends DatabaseObject {

  static protected $table_name = "relaties";
  static protected $db_columns = ['rl_id', 'rl_zoeknaam', 'rl_bedrijf', 'rl_naam', 'rl_adres', 'rl_postcode', 'rl_woonplaats', 'rl_land', 'rl_telefoon', 'rl_mobiel', 'rl_email', 'rl_kostenplaats'];
  static protected $table_id = "rl_id";
  static protected $order = "ORDER BY rl_zoeknaam ASC";

  public $rl_id;
  public $rl_zoeknaam;
  public $rl_bedrijf;
  public $rl_naam;
  public $rl_adres;
  public $rl_postcode;
  public $rl_woonplaats;
  public $rl_land;
  public $rl_telefoon;
  public $rl_mobiel;
  public $rl_email;
  public $rl_kostenplaats;


  public function __construct($args=[]) {
    //$this->rl_zoeknaam = isset($args['rl_zoeknaam']) ? $args['rl_zoeknaam'] : '';
    $this->rl_zoeknaam = $args['rl_zoeknaam'] ?? '';
    $this->rl_bedrijf = $args['rl_bedrijf'] ?? '';
    $this->rl_naam = $args['rl_naam'] ?? '';
    $this->rl_adres = $args['rl_adres'] ?? '';
    $this->rl_postcode = $args['rl_postcode'] ?? '';
    $this->rl_woonplaats = $args['rl_woonplaats'] ?? '';
    $this->rl_land = $args['rl_land'] ?? '';
    $this->rl_telefoon = $args['rl_telefoon'] ?? '';
    $this->rl_mobiel = $args['rl_mobiel'] ?? '';
    $this->rl_email = $args['rl_email'] ?? '';
    $this->rl_kostenplaats = $args['rl_kostenplaats'] ?? '';

  }

  public function get_id() {
    return $this->rl_id;
  }
  public function set_id($insert_id) {
    $this->rl_id = $insert_id;
  }

  public function name() {
    $output =  ($this->rl_bedrijf) ? "{$this->rl_bedrijf}\r\n" : "";
    $output .= "{$this->rl_naam}";
    return $output;
  }
  public function address() {
    return "{$this->rl_adres}\r\n{$this->rl_postcode} {$this->rl_woonplaats}";
  }
  public function phones() {
    $output = ($this->rl_telefoon) ? "{$this->rl_telefoon}\r\n" : "";
    $output .= "{$this->rl_mobiel}";
    return $output;
  }
  public function avatar() {
    if (!empty($this->rl_naam)) {
      return "far fa-2x fa-user";
    } else {
      return "far fa-2x fa-building";
    }
  }
  protected function validate() {
    $this->errors = [];

    if(is_blank($this->rl_naam) && is_blank($this->rl_bedrijf )) {
      $this->errors[] = "Vul een bedrijf of naam in";
    }
    if(is_blank($this->rl_adres)) {
      $this->errors[] = "Vul een adres in";
    }
    if(is_blank($this->rl_postcode)) {
      $this->errors[] = "Vul een postcode in";
    }
    if(is_blank($this->rl_woonplaats)) {
      $this->errors[] = "Vul een plaats in";
    }
    return $this->errors;
  }

  static public function find_by_keyword($key) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE rl_naam LIKE '%" . self::$database->escape_string($key) . "%' ";
    $sql .= "OR rl_bedrijf LIKE '%" . self::$database->escape_string($key) . "%' ";
    $sql .= "OR rl_adres LIKE '%" . self::$database->escape_string($key) . "%' ";
    $sql .= "OR rl_kostenplaats LIKE '%" . self::$database->escape_string($key) . "%' ";
    $sql .= static::$order;
    return static::find_by_sql($sql);
  }

}

?>