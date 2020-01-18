<?php

class Post extends DatabaseObject {

  static protected $table_name = "berichten";
  static protected $db_columns = ['bericht_id', 'bericht_titel', 'bericht_message', 'bericht_status', 'bericht_createdby', 'bericht_modifiedby'];
  static protected $table_id = "bericht_id";
  static protected $order = "ORDER BY bericht_status ASC, bericht_created DESC";

  public $bericht_id;
  public $bericht_titel;
  public $bericht_message;
  public $bericht_status;
  public $bericht_created;
  public $bericht_createdby;
  public $bericht_modifiedby;

  public const STATUS_OPTIONS = [
    0 => 'In behandeling',
    1 => 'Afgehandeld',
  ];


  public function __construct($args=[]) {
    //$this->bericht_titel = isset($args['bericht_titel']) ? $args['bericht_titel'] : '';
    $this->bericht_titel = $args['bericht_titel'] ?? '';
    $this->bericht_message = $args['bericht_message'] ?? '';
    $this->bericht_status = $args['bericht_status'] ?? 0;
    $this->bericht_createdby = $args['bericht_createdby'] ?? '';
    $this->bericht_modifiedby = $args['bericht_modifiedby'] ?? '';

  }

  public function get_id() {
    return $this->bericht_id;
  }
  public function set_id($insert_id) {
    $this->bericht_id = $insert_id;
  }

  
  protected function validate() {
    $this->errors = [];
    if(is_blank($this->bericht_titel)) {
      $this->errors[] = "Vul de titel van het bericht in";
    }
    return $this->errors;
  }
}

?>