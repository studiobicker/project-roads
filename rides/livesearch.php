<?php
require_once('../private/initialize.php');

require_login('5');

$q = $_POST['keyword'];

$contacts = Contact::find_by_keyword($q); ?>
<?php foreach($contacts as $contact) { 
$title = h($contact->rl_bedrijf ) ? h($contact->rl_bedrijf ) . ' &middot ' : "" ; 
$title .= h($contact->rl_naam ) ? h($contact->rl_naam ) . ' &middot ' : "" ; 
$title .= h($contact->rl_adres ) ? h($contact->rl_adres ) . ' &middot' : "" ; 
$title .= h($contact->rl_postcode ) ? h($contact->rl_postcode ) . ' ' : "" ;
$title .= h($contact->rl_woonplaats ) ? h($contact->rl_woonplaats ) . ' &middot ' : "" ;
$title .= h($contact->rl_kostenplaats ) ? h($contact->rl_kostenplaats )  : "" ;
?>
<a href="#" class="list-group-item list-group-item-action client-row" data-id="<?php echo h($contact->rl_id ) ?>">
  <?php echo $title; ?>
</a>
<?php } ?>