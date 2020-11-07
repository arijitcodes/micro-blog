<?php
session_start();
include('config.php');
?>


<!-- PHP CODE STARTS HERE -->

<?php

// CHECKING IF A SESSION W'LOGGEDIN HAS BEEN GENERATED
if (!$_SESSION['LoggedIn']) {
	echo"<script type='text/javascript'>
        alert('YOU ARE NOT LOGGED IN YET!');
        window.location.href='index.php';
        </script>";
}
include('userdata.php');
?>

<!-- HTML CODE STARTS HERE -->


<!DOCTYPE html>
<html>
<head>
	<title>Member's Area | Arijit Banerjee</title>
</head>
<body>
<font face="verdana,arial">

<style type='text/css'>
	.a_left {
	  float: left;
	  #width:33.33333%;
	  text-align:left;
	}
	.a_center {
	  float: center;
	  #width:33.33333%;
	  text-align:center;
	}
	.a_right {
	 float: right;
	 #width:33.33333%;
	 text-align:right;
	}​
</style>

<div id='menu'>
	<!--<p class='a_left'>Hi <?php echo $name; ?>, Welcome<p align='right'></p>-->
	<p class='a_right'>Menu : <a href='home.php'>Home</a> | <a href='profile.php'>My Profile</a> | <a href="logout.php?changepass=1">Change Password</a> | <a href='logout.php'>Log Out</a></p>
</div>
<br><br><br><br>

<style>
table#t1 {
   border-collapse: collapse;
}
th, td {
    padding: 15px;
}
</style>
<center>
<br><br><h2>MY PROFILE</h2><br><br>
</center>
<table border="1" align="center" id="t1">

<tr>
	<th>
		NAME
	</th>
	<th>
		EMAIL
	</th>
	<th>
		PASSWORD
	</th>
	<th>
		IP Address
	</th>
</tr>

<?php

// PRINTING DATA OUTPUT IN TABLE


	echo "<tr>";

	echo "<td><center> $name </center></td>";
	echo "<td><center> $email </center></td>";
	echo "<td><center> $pass </center></td>";
	echo "<td><center> $ip </center></td>";

	echo "<tr>";

?>

</table>

<?php
mysqli_close($conn);
?>

<!-- PHP CODE ENDS HERE -->


</body>
</html>

<!-- HTML CODE ENDS HERE -->
