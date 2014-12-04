<?php

/*

	LOGIN CHECKING
		cyle gage, emerson college, 2012

*/

require_once('dbconn_mysql.php');

// set defaults for your user cookie
$current_user = array(
	'loggedin' => false,
	'username' => 'nobody',
	'userid' => 0,
	'is_admin' => false
);

if (isset($login_required) && $login_required == true) {
	
	/*
	
	this is where you'd do some kind of login authentication
	
	I use SAML where this is implemented, which I cannot include here
	
	but you should set:
	
	$current_user['username'] = "username here";
	$current_user['loggedin'] = true;
	$current_user['public'] = false;
	
	then the rest here uses the hold up's own internal user database
	
	*/
	
	$get_user = $mysqli->query("SELECT * FROM users WHERE username='".$mysqli->escape_string($current_user['username'])."'");
	if ($get_user->num_rows > 0) {
		// retrieve user info... if anything... and update their last login time
		$user_info = $get_user->fetch_assoc();
		$current_user['userid'] = (int) $user_info['id'] * 1;
		if ($user_info['userlevel'] == 1) {
			$current_user['is_admin'] = true;
		}
		if ($user_info['public'] == 1) {
			$current_user['public'] = true;
		}
		$update_user = $mysqli->query('UPDATE users SET lastactivity=UNIX_TIMESTAMP() WHERE id='.$current_user['userid']);
	} else {
		// add new user!
		$rightnow = time();
		$add_user = $mysqli->query("INSERT INTO users (username, userlevel, tsc, tsu, lastactivity) VALUES ('".$mysqli->escape_string($current_user['username'])."', 10, $rightnow, $rightnow, $rightnow)");
		if ($add_user == false) {
			die('oh snap, could not add you as a user...');
		} else {
			$current_user['userid'] = (int) $mysqli->insert_id * 1;
		}
	}
	
}
	
?>