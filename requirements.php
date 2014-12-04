<?php

// i'll just define this here...
function bailout($message) {
	echo '<html><body>';
	echo '<p>'.$message.'</p>';
	echo '</body></html>';
	die();
}

// there used to be finer-grained controls for who can access this, now i don't care

?>