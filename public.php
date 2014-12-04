<!doctype html>
<html>
<?php

// get items for user if they are set to PUBLIC

if (!isset($_GET['u']) || trim($_GET['u']) == '') {
	die('no username given, dunno what to show you');
}

require_once('dbconn_mysql.php');

$username = strtolower(trim($_GET['u']));
$username_db = $mysqli->escape_string($username);

// make sure this user exists and is public
$get_user_query = $mysqli->query("SELECT * FROM users WHERE username='$username_db' AND public=1");
if ($get_user_query->num_rows != 1) {
	die('no user record with that name, sorry, or they are not public about their projects');
}

$user_row = $get_user_query->fetch_assoc();
$user_id = $user_row['id'];

?>
<head>
<title><?php echo $username; ?>'s stuff</title>
<style type="text/css">
* {
	padding: 0;
	margin: 0;
}
body, input {
	font-family: Helvetica, Arial, sans-serif;
	font-size: 14px;
}
body {
	margin: 5%;
}
input {
	padding: 3px;
	border-radius: 4px;
}
body > div {
	margin-bottom: 1em;
}
div#project-list {
	margin-top: 1em;
}
div.project {
	padding: 5px 7px;
	margin: 3px;
	background: url('img/linen.png') #ddd;
	border-radius: 4px;
}
.project-cell {
	display: inline-block;
	vertical-align: top;
	width: 300px;
}
span.project-name {
	font-weight: bold;
}
span.project-last-update {
	font-size: 0.75em;
	font-style: italic;
}
</style>
</head>
<body>

<div><h1><?php echo $username; ?>'s stuff</h1></div>

<div><p>This shows the user's <b>not done</b> projects/stuff/whatever. It does not show the current status.</p></div>

<div id="project-list">
<?php

$get_projects = $mysqli->query('SELECT * FROM projects WHERE uid='.$user_id.' AND done=0 ORDER BY displayorder ASC, tsu DESC');
if ($get_projects->num_rows > 0) {
	while ($project = $get_projects->fetch_assoc()) {
		echo '<div class="project">';
		echo '<span class="project-name project-cell">'.$project['name'].'</span>';
		//echo '<span class="project-status project-cell" style="width:50%;"><span class="project-current-status">'.$project['status'].'</span> <span class="project-last-update">('.date('m.d.y h:ia', $project['tsu']).')</span></span> ';
		echo '<span class="project-status project-cell" style="width:50%;"><span class="project-last-update">Last status update '.date('m.d.y h:ia', $project['tsu']).'</span></span> ';
		echo '</div>'."\n";
	}
} else {
	echo '<p>No projects.</p>';
}

?>
</div>

<p>Want to use this yourself? <a href="./">Try it out.</a></p>

</body>
</html>