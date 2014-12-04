<?php

/*

	THE HOLD UP
		written by cyle gage, 2011 or something

*/

$login_required = true;
require_once('logincheck.php');
require_once('requirements.php');

$limit_to_not_done = ' AND done=0';

if (isset($_GET['all'])) {
	$limit_to_not_done = '';
}

$get_projects = $mysqli->query('SELECT * FROM projects WHERE uid='.$current_user['userid'].$limit_to_not_done.' ORDER BY displayorder ASC, tsu DESC');

?>
<!doctype html>
<html>
<head>
<title>What's the hold up?</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,700,300,400" rel="stylesheet" type="text/css" />
<style type="text/css">
* {
	padding: 0;
	margin: 0;
}
body, input {
	font-family: "Open Sans", Helvetica, Arial, sans-serif;
	font-size: 14px;
}
body {
	margin: 1em;
}
input {
	padding: 0.25em;
	border-radius: 4px;
}
body > div {
	margin-bottom: 1rem;
}
div#project-list {
	margin-top: 1em;
}
div.project {
	padding: 5px 7px;
	margin-bottom: 3px;
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
span.project-status {
	width: 50%;
}
span.project-done {
	width: 50px;
}
span.project-last-update {
	font-size: 0.75em;
	font-style: italic;
}
@media screen and (max-width: 600px) {
	span.project-cell, span.project-status, span.project-done {
		width: 100%;
	}
}
</style>
</head>
<body>

<div><h1>What's the hold up?</h1></div>

<div><p>Keep track of your <?php echo $get_projects->num_rows; ?> projects at a very high level. (Double-click on the current status to update it. Drag 'n drop to resort. Click <a href="?all">here</a> to see even the "done" ones.)</p></div>

<div id="project-list">
<?php

if ($get_projects->num_rows > 0) {
	while ($project = $get_projects->fetch_assoc()) {
		echo '<div class="project" data-id="'.$project['id'].'">';
		echo '<span class="project-name project-cell" data-id="'.$project['id'].'">'.$project['name'].'</span>';
		echo '<span class="project-status project-cell" data-id="'.$project['id'].'"><span class="project-current-status">'.$project['status'].'</span> <span class="project-last-update">('.date('m.d.y h:ia', $project['tsu']).')</span></span> ';
		echo '<span class="project-done project-cell"><label><input type="checkbox" data-id="'.$project['id'].'" class="project-done-checkbox" '.(($project['done'] == true) ? ' checked="checked"' : '').' /> done</span></label> ';
		//echo '<span class="project-nothing project-cell" style="width:100px;"><label><input type="checkbox" /> nothing?</span></label> ';
		echo '</div>'."\n";
	}
}

?>
</div>

<div id="add-project">
<form action="add.php" method="post">
Add a project: <input style="width:250px;" name="t" type="text" placeholder="project name" /> <input style="width:250px;" name="s" type="text" placeholder="current status" /> <input type="submit" value="add" />
</form>
</div>

<div>
<p>Make your projects/stuff public via <a target="_blank" href="public.php?u=<?php echo $current_user['username']; ?>">a public listing</a>? Check this off: <input type="checkbox" value="1" id="public-checkbox" <?php if ($current_user['public']) { echo 'checked="checked"'; } ?> /></p>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js"></script>
<script src="holdup.js"></script>
</body>
</html>