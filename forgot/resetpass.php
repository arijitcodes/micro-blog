<?php
session_start();
include('../config.php');
?>

<!-- PHP CODE STARTS HERE -->

<?php

if (isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['email2']) && isset($_GET['code'])) {

	$pass1 = mysqli_real_escape_string($conn, $_POST['pass1']);
	$pass2 = mysqli_real_escape_string($conn, $_POST['pass2']);
	$email = mysqli_real_escape_string($conn, $_POST['email2']);
	$code = mysqli_real_escape_string($conn, $_GET['code']);

	//echo "PASS 1 = " . $pass1 . "<br>PASS 2 = " . $pass2 . "<br>Email = " . $email . "<br>Code = " . $code;

	if ($pass1 == $pass2) {

		
        //md5 enc password
        $encryptedPassword = md5($pass1);

		$sql = "UPDATE $db_name.$db_users_table SET `password` = '$encryptedPassword', `passreset` = '0' WHERE $db_users_table.`email` = '$email'";
		$query = mysqli_query($conn, $sql);

		if ($query) {
			echo "PASSWORD UPDATED SUCCESSFULLY! <a href='../index.php'>Click Here to Log In</a>";
		}

		else {
			echo "ERROR OCCURED! PLEASE TRY AGAIN! <a href='forgotpassword.php'>Click Here to Retry</a>";
		}
	}

	else {

		echo "PASSWORDS DO NOT MATCH! PLEASE TRY AGAIN! <a href='forgotpassword.php'>Click Here to Retry</a>";
	}

}



?>

<!-- PHP CODE ENDS HERE -->
