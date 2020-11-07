<?php
//PHP CODE
session_start();
include('../config.php');


// Taking DATA from the FORM into Different Variables
if (isset($_POST['login_btn'])) {
	$user = mysqli_real_escape_string($conn, $_POST['user']);            // Taking DATA from the FORM into Different Variables
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);            // Taking DATA from the FORM into Different Variables


	// Our SQL Query
	$sel_user = "SELECT * FROM $db_admin_table WHERE admin_user ='$user' AND admin_pass ='$pass'";

	// INSERTING DATA INTO DATABASE
	$run_user = mysqli_query($conn, $sel_user);

	// CHECKING DATA WITH DATABASE
	$check_user = mysqli_num_rows($run_user);

	if($check_user>0){

		$_SESSION['admin_username'] = $user;
		$_SESSION['AdminLoggedIn'] = "YES";
		//header("location: index.php");
		echo '
		        	<script type="text/javascript">
		            window.location.href = "index.php";
		            </script>';
	}

	else {
		echo '<script language="javascript">';
		echo 'alert("LogIn Failed!! Wrong Username / Password!")';
		echo '</script>';
	}
}



?>





<!-- HTML CODE -->

<!DOCTYPE html>
<html>
<head>
	<title>Admin LogIn | Members Area | Arijit Banerjee</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>

<center>
<div class="head">
	<h1>
	<font face="verdana">
	Member's Area | ADMIN PORTAL<br><font face="arial" size="4"></font>
	</font><br><br>
	</h1>
</div>

<!-- IF VISITOR TRIES TO GET OVER TO ANY FILE DIRECTLY -->
<?php

if (isset($_GET["problem"])) {
	$problem = $_GET["problem"];
	if ($problem == "NotLoggedIn") {
		echo "<br><br><center><font size='4' color='red' face='arial'><b>ERROR : You are not Logged In yet !!</b></font></center><br>";
	}
}

?>


<form method="post" action="admin.php"><b>
	<table><br>
		<tr>
			<td>Admin Username : </td>
			<td><input type="text" name="user" class="textInput" placeholder="Enter your Admin Username" required></td>
		</tr>
		<tr>
			<td>Admin Password : </td>
			<td><input type="password" name="pass" class="textInput" placeholder="Enter your Admin Password" required></td>
		</tr>
		<tr>
			<td></td>
			<td><br><input type="submit" name="login_btn" value="Log In"></td>
		</tr>
	</table>
<br><br>
<font color='red'><b>THIS IS ADMINISTRATORS PORTAL!<br>ANY UN-AUTHORISED LOGIN TRIALS MAY CAUSE<br>POLICE F.I.R. IF NEEDED!</b></center></font></a></td>
	</b>
</form><br>
<br>
<div class="head">
	<font face="verdana" size="2"><center><b>
	Copyrights 2019 &copy; Arijit Banerjee
	</b></center></font>
</div>

</body>
</html>
