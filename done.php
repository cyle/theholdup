<?php

$login_required = true;
require_once('logincheck.php');
require_once('requirements.php');

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
	die('error: ID not given');
}

if (!isset($_POST['d']) || !is_numeric($_POST['d'])) {
	die('error: status not given');
}

$id = (int) $_POST['id'] * 1;
$done = (int) $_POST['d'] * 1;

$update = $mysqli->query('UPDATE projects SET displayorder=9999, done='.$done.', tsu=UNIX_TIMESTAMP() WHERE uid='.$current_user['userid'].' AND id='.$id);
if (!$update) {
	die('error saving state');
}

echo 'ok';

?>