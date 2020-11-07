
<?php

/* DATABASE CONFIGURATION FILE */


$db_host = "";				// DATABASE HOST
$db_name = "";			// DATABASE NAME
$db_user = "";	// DATABASE USERNAME
$db_pass = "";		    // DATABASE USER'S PASSWORD

$db_users_table = "users";						// DATABASE USERS TABLE NAME
$db_admin_table = "admin";						// DATABASE ADMIN TABLE NAME
$db_posts_table = "posts";					// DATABASE NOTICE TABLE NAME



// Create Connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check Connection
if (!$conn) {
	die("<br><br>MySqli Connect Error : " . mysqli_connect_error());
}

/*
else {
	echo "<br><br> DATABASE CONNECTION SUCCESSFULL!";
}
*/


/* ERROR REPORTING SECTION STARTS HERE */

// Turn off all error reporting
//error_reporting(0);

// Report simple running errors
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ...)
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

// Report all errors except E_NOTICE
//error_reporting(E_ALL & ~E_NOTICE);

// Report all PHP errors (see changelog)
//error_reporting(E_ALL);

// Report all PHP errors
//error_reporting(-1);

// Same as error_reporting(E_ALL);
//ini_set('error_reporting', E_ALL);


/* ERROR REPORTING SECTION ENDS HERE */

?>