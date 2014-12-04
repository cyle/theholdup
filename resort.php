<?php

$login_required = true;
require_once('logincheck.php');
require_once('requirements.php');

if (!isset($_POST['order']) || !is_array($_POST['order'])) {
	die('error: order not given');
}

for ($i = 0; $i < count($_POST['order']); $i++) {
	
	$id = (int) $_POST['order'][$i] * 1;
	$mysqli->query('UPDATE projects SET displayorder='.$i.' WHERE uid='.$current_user['userid'].' AND id='.$id);
	
}

echo 'ok';

?>