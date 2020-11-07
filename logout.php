<?php
session_start();
include('config.php');

if (!$_SESSION['LoggedIn']) {
	header("location: index.php?problem=NotLoggedIn");
	exit();
}

if (isset($_GET['changepass'])) {
	if (mysqli_real_escape_string($conn, $_GET['changepass']) == 1) {
		if (isset($_SESSION['LoggedIn'])) {
		unset($_SESSION['LoggedIn']);
		}

		if (isset($_SESSION['useremail'])) {
			unset($_SESSION['useremail']);
		}

		//header("location: forgot/forgotpassword.php");
		echo"<script type='text/javascript'>
        window.location.href='forgot/forgotpassword.php';
        </script>";
		die();
	}
}

if (isset($_SESSION['LoggedIn'])) {
	unset($_SESSION['LoggedIn']);
}

if (isset($_SESSION['useremail'])) {
	unset($_SESSION['useremail']);
}

echo "Logged Out Successfully! <br><br><a href='registration.php'>Registration</a> | <a href='index.php'>LogIn</a> | <a href='home.php'>Home</a>";

?>