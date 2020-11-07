<?php

session_start();

if (!$_SESSION['AdminLoggedIn']) {
	header("location: admin.php?problem=NotLoggedIn");
	exit();
}

if (isset($_SESSION['AdminLoggedIn'])) {
	unset($_SESSION['AdminLoggedIn']);
}

echo "Logged Out ! Session Destroyed Successfully! <br><br><a href='../registration.php'>Registration</a> | <a href='../index.php'>LogIn</a> | <a href='../index.php'>Home</a> | <a href='admin.php'>Admin Login</a>";

?>