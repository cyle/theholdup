<?php

$login_required = true;
require_once('logincheck.php');
require_once('requirements.php');

if (!isset($_POST['t']) || trim($_POST['t']) == '') {
	die('no project name given!');
}

if (!isset($_POST['s']) || trim($_POST['s']) == '') {
	die('no project status given!');
}

$project_title = "'".$mysqli->escape_string(trim($_POST['t']))."'";
$project_status = "'".$mysqli->escape_string(trim($_POST['s']))."'";
$project_uid = (int) $current_user['userid'];

$query = "INSERT INTO projects (uid, name, status, done, displayorder, tsc, tsu) VALUES ($project_uid, $project_title, $project_status, 0, 999, UNIX_TIMESTAMP(), UNIX_TIMESTAMP())";
$add_project = $mysqli->query($query);
if (!$add_project) {
	die('adding the project to the database failed, oh dear');
} else {
	header('Location: /holdup/');
}

?>