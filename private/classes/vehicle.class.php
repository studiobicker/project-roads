<?php

class Vehicle extends DatabaseObject {

  static protected $table_name = "rp_vervoermiddelen";
  static protected $db_columns = ['rp_vervoer_id', 'rp_vervoer_naam', 'rp_vervoer_aantalzit', 'rp_vervoer_kenteken', 'rp_vervoer_telefoon', 'rp_vervoer_kleur','rp_vervoer_disabled', 'rp_vervoer_timestamp'];
  static protected $table_id = "rp_vervoer_id";
  static protected $order = "ORDER BY rp_vervoer_naam";

  public $rp_vervoer_id;
  public $rp_vervoer_naam;
  public $rp_vervoer_aantalzit;
  public $rp_vervoer_kenteken;
  public $rp_vervoer_telefoon;
  public $rp_vervoer_kleur;
  public $rp_vervoer_disabled;

  public const STATUS_OPTIONS = [
    0 => 'Actief',
    1 => 'Buiten dienst',
  ];

  public function __construct($args=[]) {
    //$this->rl_zoeknaam = isset($args['rl_zoeknaam']) ? $args['rl_zoeknaam'] : '';
    $this->rp_vervoer_naam = $args['rp_vervoer_naam'] ?? '';
    $this->rp_vervoer_aantalzit = $args['rp_vervoer_aantalzit'] ?? 0;
    $this->rp_vervoer_kenteken = $args['rp_vervoer_kenteken'] ?? '';
    $this->rp_vervoer_telefoon = $args['rp_vervoer_telefoon'] ?? '';
    $this->rp_vervoer_kleur = $args['rp_vervoer_kleur'] ?? '#FFFFFF';
    $this->rp_vervoer_disabled = $args['rp_vervoer_disabled'] ?? 0;
  }

  public function get_id() {
    return $this->rp_vervoer_id;
  }
  public function set_id($insert_id) {
    $this->rp_vervoer_id = $insert_id;
  }
 
  public function status() {
    if($this->rp_vervoer_disabled == 0 || $this->rp_vervoer_disabled == 1  ) {
      return self::STATUS_OPTIONS[$this->rp_vervoer_disabled];
    } else {
      return "Onbekend";
    }
  }
  
  protected function validate() {
    $this->errors = [];
    // Add custom validations
    
    if(is_blank($this->rp_vervoer_naam)) {
      $this->errors[] = "Vul de naam van het voertuig in.";
    }
    if(is_blank($this->rp_vervoer_kenteken)) {
      $this->errors[] = "Vul het kenteken in.";
    }
    if(is_notnumeric($this->rp_vervoer_aantalzit)) {
      $this->errors[] = "Vul bij aantal zitplaatsen een getal in.";
    }
    
    return $this->errors;
  }

  static public function find_all_enabled() {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE rp_vervoer_disabled='0'". " ";
    $sql .= static::$order;
    return static::find_by_sql($sql);
  }

}

?>