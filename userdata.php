<?php
//session_start();
include('config.php');

// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);


$sessionemail = $_SESSION['useremail'];

// COLLECTING DATA FROM DB
$sql = "SELECT * FROM $db_users_table WHERE email = '$sessionemail'";
$insert = mysqli_query($conn, $sql);

if (!$insert) {
	echo " Mysqli Query Error : Message from Line 23";
}

if (mysqli_num_rows($insert) > 0) {

	while ($data=mysqli_fetch_assoc($insert)) {
		$name = $data['name'];
		$email = $data['email'];
		$pass = $data['password'];
		$ip = $data['ip'];
		//echo $name . "-" . $email . "-" . $pass . "-" . $ip;
	}
}

else {
	echo "NO DATA FOUND!";
}


?>