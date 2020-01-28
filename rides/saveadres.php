<?php
require_once('../private/initialize.php');

require_login('5');

$args = [];
$args['rl_bedrijf'] = $_POST['rl_bedrijf'] ?? NULL;
$args['rl_naam'] = $_POST['rl_naam'] ?? NULL;
$args['rl_adres'] = $_POST['rl_adres'] ?? NULL;
$args['rl_postcode'] = $_POST['rl_postcode'] ?? NULL;
$args['rl_woonplaats'] = $_POST['rl_woonplaats'] ?? NULL;
$args['rl_land'] = $_POST['rl_land'] ?? NULL;
$args['rl_telefoon'] = $_POST['rl_telefoon'] ?? NULL;
$args['rl_mobiel'] = $_POST['rl_mobiel'] ?? NULL;
$args['rl_email'] = $_POST['rl_email'] ?? NULL;
$args['rl_kostenplaats'] = $_POST['rl_kostenplaats'] ?? NULL;
$args['rl_zoeknaam'] = trim($args['rl_bedrijf'] . ' ' . $args['rl_naam']);

$id = $_POST['rl_id'] ?? NULL;

if ($id) {
	$contact = Contact::find_by_id($id);
	$contact->merge_attributes($args);
	$msg = "gewijzigd.";
} else {
	$contact = new Contact($args);
	$msg = "toegevoegd.";
}

 $result = $contact->save();

// if($result === true) {
// 	$new_id = $contact->rl_id;
// 	//$_SESSION['message'] = 'Contact' . $contact->zoeknaam .' succesvol ' . $msg;
// 	$message = 'Contact' . $contact->zoeknaam .' succesvol ' . $msg;
// } else {
// // show errors
// 	$message = 'Er is iets misgegaan.';
// }

$message= $msg;
$data = json_encode(array('message' => $message));
echo $data;

?>