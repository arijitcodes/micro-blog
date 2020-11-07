<?php
session_start();
if (!$_SESSION['AdminLoggedIn']) {
	header("location: ../../login.php?problem=NotLoggedIn");
	//header("location: admin.php?problem=NotLoggedIn");
	exit();
}
// CHECKING IF VISITOR IS ADMIN AND LOGGED IN (CHECKING IF A SESSION NAMED 'AdminLoggedIn' HAS BEEN GENERATED BEFORE OR NOT) 

?>

</head>
<body>

<?php
include('../../config.php');


// ALLOW BUTTON PRESSED
if (isset($_POST['allow_btn'])) {

	$user_id = mysqli_real_escape_string($conn, $_POST['id']);            // Taking DATA from the FORM into Different Variables


	// Writing Query
	$sql = "SELECT * FROM $db_users_table WHERE id ='$user_id'";


	// Output Variable
	$result = mysqli_query($conn, $sql);


	// CHECKING DATA WITH DATABASE
	$check_user_id = mysqli_num_rows($result);



	if ($check_user_id>0) {


		// SQL QUERY TO INSERT DATA INTO PAYMENT__STATUS COLUMN

		//$sql_insert = "UPDATE '$db_name'.'$db_table' SET `payment_status` = \'1\' WHERE `$db_table`.`id` = '$user_id'";
		$sql_insert = "UPDATE $db_name.$db_users_table SET `approve` = '1' WHERE $db_users_table.`id` = $user_id";

		// Output Variable
		$result_insert = mysqli_query($conn, $sql_insert);

		if ($result_insert) {
			die("<br><br><font color='green'>USER <font color='red'><b>ALLOWED</b></font> SUCCESSFULLY</font>. <a href='../index.php'>Click Here</a> to get back to the <a href='../index.php'>ADMIN PAGE</a>");
		}

		else{
			die("<br><br><font color='red' face='arial'><b>FAILED TO ALLOW USER !!</b></font> <a href='../index.php'>Click Here</a> to get back to the <a href='../index.php'>ADMIN PAGE</a>");

		}

	}

	else{
		/*
		echo '<script language="javascript">';
		echo 'alert("ERROR! Registration Aborted! Please try again!")';
		echo '</script>';
		$_SESSION['reg_failed'] = "YES";
		header("location: failed.php");
		*/
		die("<br><br><font color='red' face='arial'><b>USER ID DID NOT MATCH WITH DATABASE !!</b></font> <a href='../index.php'>Click Here</a> to get back to the <a href='../index.php'>ADMIN PAGE</a>");
	}
}


// DELETE BUTTON PRESSED
if (isset($_POST['delete_btn'])) {

	$user_id = mysqli_real_escape_string($conn, $_POST['id']);            // Taking DATA from the FORM into Different Variables


	// Writing Query
	$sql = "SELECT * FROM $db_users_table WHERE id ='$user_id'";


	// Output Variable
	$result = mysqli_query($conn, $sql);


	// CHECKING DATA WITH DATABASE
	$check_user_id = mysqli_num_rows($result);



	if ($check_user_id>0) {


		// SQL QUERY TO INSERT DATA INTO PAYMENT__STATUS COLUMN

		//$sql_insert = "UPDATE $db_name.$db_users_table SET `approve` = '1' WHERE $db_users_table.`id` = $user_id";
		$sql_insert = "DELETE FROM $db_name.$db_users_table WHERE $db_users_table.`id` = $user_id";

		// Output Variable
		$result_insert = mysqli_query($conn, $sql_insert);

		if ($result_insert) {
			die("<br><br><font color='green'>USER <font color='red'><b>DELETED</b></font> SUCCESSFULLY</font>. <a href='../index.php'>Click Here</a> to get back to the <a href='../index.php'>ADMIN PAGE</a>");
		}

		else{
			die("<br><br><font color='red' face='arial'><b>FAILED TO DELETE USER !!</b></font> <a href='../index.php'>Click Here</a> to get back to the <a href='../index.php'>ADMIN PAGE</a>");

		}

	}

	else{
		/*
		echo '<script language="javascript">';
		echo 'alert("ERROR! Registration Aborted! Please try again!")';
		echo '</script>';
		$_SESSION['reg_failed'] = "YES";
		header("location: failed.php");
		*/
		die("<br><br><font color='red' face='arial'><b>USER ID DID NOT MATCH WITH DATABASE !!</b></font> <a href='../index.php'>Click Here</a> to get back to the <a href='../index.php'>ADMIN PAGE</a>");
	}
}

?>