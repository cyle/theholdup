<?php

$login_required = true;
require_once('logincheck.php');
require_once('requirements.php');

if (isset($_GET['v']) && trim($_GET['v']) == '1') {
	$val = 1;
} else {
	$val = 0;
}

$update = $mysqli->query("UPDATE users SET public=$val WHERE id=".$current_user['userid']);
if (!$update) { echo $mysqli->error; }

echo 'ok';

?>