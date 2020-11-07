<?php


session_start();

if (!$_SESSION['not_confirmed']) {
	header("location: registration.php");
	//session_destroy();
	exit();
}

else {


	include('config.php');

	$email = $_GET['email'];
	$code = $_GET['code'];


	// Our SQL Query for EMAIL Verification
	$query = "SELECT * FROM $db_users_table WHERE email ='$email'";
	$result = mysqli_query($conn, $query);


	// TAKING DATA INTO VARIABLES FROM DATABASE FOR FUTHER USE

	if (mysqli_num_rows($result) > 0) {

		
		while ($row=mysqli_fetch_assoc($result)) {
		$db_code=$row['confirm_code'];
		}


		if($code == $db_code) {
			
			$sql = "UPDATE $db_name.$db_users_table SET `confirmed` = '1', `confirm_code` = '0' WHERE $db_users_table.`email` = '$email'";


			$input = mysqli_query($conn, $sql);
			
			if ($input) {

				if (isset($_SESSION['not_confirmed'])) {
					unset($_SESSION['not_confirmed']);
				}

				die('E-Mail Confirmed. Now you can Log-In.<br>To <a href="login.php"><u><font color=blue>Log In</font></u></a> click <a href="index.php"><u><font color=blue>this link</font></u></a>');
			}

			else {
				die('<br><br><b>Problem Occurred! Contact Administrator immediately!</b>');
			}
		}

		else{
			echo "<font color=red>E-Mail and Code doesn't match!</font>";
		}
	}

	else{
		echo "0 Results!";
	}
}

?>