<?php
require_once('../private/initialize.php');

require_login('5');

$id = $_POST['id'];

// Find contact using ID
$data = Contact::find_by_id($id);

echo json_encode($data) ;

?>