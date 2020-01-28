<?php

class Ride extends DatabaseObject {

  static protected $table_name = "jobs o";
  static protected $table_vervoer = "rp_vervoermiddelen v";
  static protected $db_columns = 
    [
    'opdracht_id', 
    'opdracht_opdrachtnummer', 
    'opdracht_datum', 
    'opdracht_opdrachtgeverid', 
    'opdracht_factuurbedrijf',
    'opdracht_factuurnaam', 
    'opdracht_factuuradres', 
    'opdracht_factuurpostcode', 
    'opdracht_factuurplaats',
    'opdracht_telefoon',
    'opdracht_opdracht',
    'opdracht_factuurcode',
    'opdracht_prijs',
    'opdracht_kostenplaats',
    'opdracht_status',
    'opdracht_modifiedby',
    'rit_kenteken',
    'rit_aantalpassagiers',
    'rit_start',
    'rit_vertrekid',
    'rit_vertrekbedrijf',
    'rit_vertreknaam',
    'rit_vertrekadres',
    'rit_vertrekpostcode',
    'rit_vertrekplaats',
    'rit_vertrektelefoon',
    'rit_eind',
    'rit_bestemmingsid',
    'rit_bestemmingsbedrijf',
    'rit_bestemmingsnaam',
    'rit_bestemmingsadres',
    'rit_bestemmingspostcode',
    'rit_bestemmingsplaats',
    'rit_bestemmingstelefoon',
    'rit_message'];

  static protected $db_columns_vervoer = 
    ['rp_vervoer_naam', 
    'rp_vervoer_kenteken', 
    'rp_vervoer_telefoon', 
    'rp_vervoer_kleur'];

  static protected $table_id = "opdracht_id";
  static protected $order = "ORDER BY o.rit_start ASC, o.rit_eind ASC";

  public $opdracht_id;
  public $opdracht_opdrachtnummer;
  public $opdracht_datum;
  public $opdracht_opdrachtgeverid;
  
  public $opdracht_factuurbedrijf;
  public $opdracht_factuurnaam;
  public $opdracht_factuuradres;
  public $opdracht_factuurpostcode;
  public $opdracht_factuurplaats;

  public $opdracht_telefoon;
  public $opdracht_opdracht;
  public $opdracht_factuurcode;
  public $opdracht_prijs;

  public $opdracht_kostenplaats;
  public $opdracht_status;
  public $opdracht_modifiedby;

  public $rit_id;
  public $rit_opdrachtnummer;
  public $rit_kenteken;
  public $rit_aantalpassagiers;

  public $rit_start;
  public $rit_vertrekid;
  public $rit_vertrekbedrijf;
  public $rit_vertreknaam;
  public $rit_vertrekadres;
  public $rit_vertrekpostcode;
  public $rit_vertrekplaats;
  public $rit_vertrektelefoon;

  public $rit_eind;
  public $rit_bestemmingsid;
  public $rit_bestemmingsbedrijf;
  public $rit_bestemmingsnaam;
  public $rit_bestemmingsadres;
  public $rit_bestemmingspostcode;
  public $rit_bestemmingsplaats;
  public $rit_bestemmingstelefoon;

  public $rit_message;

  public $rp_vervoer_naam;
  public $rp_vervoer_kenteken;
  public $rp_vervoer_telefoon;
  public $rp_vervoer_kleur;

  public const STATUS_OPTIONS = [
    'O' => 'Optie',
    'D' => 'Definitief',
    'F' => 'Gefactureerd'
  ];

  public const INVOICE_OPTIONS = [
    'bill' => 'Factureren',
    'mark' => 'Markeren als gefactureerd',
    'unmark' => 'Markeren als niet gefactureerd'
  ];

  public const VIEW_OPTIONS = [
    'open' => 'Nog te factureren',
    'all' => 'Alles tonen',
    'billed' => 'Gefactureerde opdrachten'
  ];

  public function __construct($args=[]) {
    //$this->opdracht_opdrachtnummer = isset($args['opdracht_opdrachtnummer']) ? $args['opdracht_opdrachtnummer'] : '';
    $this->opdracht_opdrachtnummer = $args['opdracht_opdrachtnummer'] ?? '';
    $this->opdracht_datum = $args['opdracht_datum'] ?? '';
    $this->opdracht_opdrachtgeverid = $args['opdracht_opdrachtgeverid'] ?? '';
   
    $this->opdracht_factuurbedrijf = $args['opdracht_factuurbedrijf'] ?? '';
    $this->opdracht_factuurnaam = $args['opdracht_factuurnaam'] ?? '';
    $this->opdracht_factuuradres = $args['opdracht_factuuradres'] ?? '';
    $this->opdracht_factuurpostcode = $args['opdracht_factuurpostcode'] ?? '';
    $this->opdracht_factuurplaats = $args['opdracht_factuurplaats'] ?? '';

    $this->opdracht_telefoon = $args['opdracht_telefoon'] ?? '';
    $this->opdracht_opdracht = $args['opdracht_opdracht'] ?? '';
    $this->opdracht_factuurcode = $args['opdracht_factuurcode'] ?? '';
    $this->opdracht_prijs = $args['opdracht_prijs'] ?? 0;
    $this->opdracht_kostenplaats = $args['opdracht_kostenplaats'] ?? '';
    $this->opdracht_status = $args['opdracht_status'] ?? '';
    $this->opdracht_modifiedby = $args['opdracht_modifiedby'] ?? '';
    $this->opdracht_modified = $args['opdracht_modified'] ?? '';

    $this->rit_opdrachtnummer = $args['rit_opdrachtnummer'] ?? '';
    $this->rit_kenteken = $args['rit_kenteken'] ?? '';
    $this->rit_aantalpassagiers = $args['rit_aantalpassagiers'] ?? '';

    $this->rit_start = $args['rit_start'] ?? '';
    $this->rit_vertrekid = $args['rit_vertrekid'] ?? '';
    $this->rit_vertrekbedrijf = $args['rit_vertrekbedrijf'] ?? '';
    $this->rit_vertreknaam = $args['rit_vertreknaam'] ?? '';
    $this->rit_vertrekadres = $args['rit_vertrekadres'] ?? '';
    $this->rit_vertrekpostcode = $args['rit_vertrekpostcode'] ?? '';
    $this->rit_vertrekplaats = $args['rit_vertrekplaats'] ?? '';
    $this->rit_vertrektelefoon = $args['rit_vertrektelefoon'] ?? '';

    $this->rit_eind = $args['rit_eind'] ?? '';
    $this->rit_bestemmingsid = $args['rit_bestemmingsid'] ?? '';
    $this->rit_bestemmingsbedrijf = $args['rit_bestemmingsbedrijf'] ?? '';
    $this->rit_bestemmingsnaam = $args['rit_bestemmingsnaam'] ?? '';
    $this->rit_bestemmingsadres = $args['rit_bestemmingsadres'] ?? '';
    $this->rit_bestemmingspostcode = $args['rit_bestemmingspostcode'] ?? '';
    $this->rit_bestemmingsplaats = $args['rit_bestemmingsplaats'] ?? '';
    $this->rit_modifiedby = $args['rit_modifiedby'] ?? '';

    $this->rit_message = $args['rit_message'] ?? '';
    $this->rit_bestemmingstelefoon = $args['rit_bestemmingstelefoon'] ?? '';

    $this->rp_vervoer_naam = $args['rp_vervoer_naam'] ?? '';
    $this->rp_vervoer_kenteken = $args['rp_vervoer_kenteken'] ?? '';
    $this->rp_vervoer_telefoon = $args['rp_vervoer_telefoon'] ?? '';
    $this->rp_vervoer_kleur = $args['rp_vervoer_kleur'] ?? '#FFFFFF';
  }

  public function get_id() {
    return $this->opdracht_id;
  }
  public function set_id($insert_id) {
    $this->opdracht_id = $insert_id;
  }

  public function starttijd() {
    $output = (new DateTime($this->rit_start))->format('H:i');
    return $output;
  }

  public function eindtijd() {
    $output = (new DateTime($this->rit_eind))->format('H:i');
    return $output;
  }

  public function vertrek() {
    $output =  ($this->rit_vertrekbedrijf) ? "{$this->rit_vertrekbedrijf}\r\n" : "";
    $output .= ($this->rit_vertreknaam) ? "{$this->rit_vertreknaam}\r\n" : "";
    $output .= ($this->rit_vertrekadres) ? "{$this->rit_vertrekadres}\r\n" : "";
    $output .= ($this->rit_bestemmingspostcode) ? "{$this->rit_bestemmingspostcode}  " : "";
    $output .= ($this->rit_vertrekplaats) ? "{$this->rit_vertrekplaats}\r\n" : "";
    $output .= ($this->rit_vertrektelefoon) ? "{$this->rit_vertrektelefoon}" : "";
    return $output;
  }

  public function bestemming() {
    $output =  ($this->rit_bestemmingsbedrijf) ? "{$this->rit_bestemmingsbedrijf}\r\n" : "";
    $output .= ($this->rit_bestemmingsnaam) ? "{$this->rit_bestemmingsnaam}\r\n" : "";
    $output .= ($this->rit_bestemmingsadres) ? "{$this->rit_bestemmingsadres}\r\n" : "";
    $output .= ($this->rit_bestemmingspostcode) ? "{$this->rit_bestemmingspostcode}  " : "";
    $output .= ($this->rit_bestemmingsplaats) ? "{$this->rit_bestemmingsplaats}\r\n" : "";
    $output .= ($this->rit_bestemmingstelefoon) ? "{$this->rit_bestemmingstelefoon}" : "";
    return $output;
  }

  public function factuur() {
    $output =  ($this->opdracht_factuurbedrijf) ? "{$this->opdracht_factuurbedrijf}\r\n" : "";
    $output .= ($this->opdracht_factuurnaam) ? "{$this->opdracht_factuurnaam}\r\n" : "";
    $output .= ($this->opdracht_factuuradres) ? "{$this->opdracht_factuuradres}\r\n" : "";
    $output .= ($this->opdracht_factuurpostcode) ? "{$this->opdracht_factuurpostcode}  " : "";
    $output .= ($this->opdracht_factuurplaats) ? "{$this->opdracht_factuurplaats}\r\n" : "";
    $output .= ($this->opdracht_kostenplaats) ? "{$this->opdracht_kostenplaats}\r\n" : "";
    return $output;
  }

  static public function find_all() {
    global $session;
    $sql = "SELECT o.*, v.* FROM " . static::$table_name . ", " . static::$table_vervoer . " ";
    $sql .= "WHERE o.rit_kenteken=v.rp_vervoer_kenteken ";
    $sql .= "AND o.opdracht_datum='" . self::$database->escape_string($session->datum) . "' ";
    if($session->vervoer != 'ALL') {
      $sql .= "AND o.rit_kenteken='" . self::$database->escape_string($session->vervoer) . "' ";
    } 
    $sql .= static::$order;
    
    return static::find_by_sql($sql);
  }

  static public function find_by_id($id) {
    global $session;
    $sql = "SELECT o.*, v.* FROM " . static::$table_name . ", " . static::$table_vervoer . " ";
    $sql .= "WHERE o.rit_kenteken=v.rp_vervoer_kenteken ";
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