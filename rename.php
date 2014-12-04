<?php

//echo '<pre>'.print_r($_POST, true).'</pre>';

$login_required = true;
require_once('logincheck.php');
require_once('requirements.php');

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
	die('error: ID not given');
}

if (!isset($_POST['n']) || trim($_POST['n']) == '') {
	die('error: name not given');
}

$id = (int) $_POST['id'] * 1;
$name = "'".$mysqli->escape_string(trim($_POST['n']))."'";

$update = $mysqli->query("UPDATE projects SET name=$name, tsu=UNIX_TIMESTAMP() WHERE uid=".$current_user['userid']." AND id=$id");

if (!$update) {
	die('error: update failed');
} else {
	header('Location: /holdup/');
}

?>