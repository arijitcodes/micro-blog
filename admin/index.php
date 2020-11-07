<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
	<title>ADMIN PORTAL |  Member's Area | Arijit Banerjee</title>

<?php

/* 

CHECKING IF VISITOR IS ADMIN AND LOGGED IN (CHECKING IF A SESSION NAMED 'AdminLoggedIn' HAS BEEN GENERATED BEFORE OR NOT)

*/

if (!$_SESSION['AdminLoggedIn']) {
	header("location: ../index.php?problem=NotLoggedIn");
	//header("location: admin.php?problem=NotLoggedIn");
	exit();
}

?>

</head>
<body>

<?php
include('../config.php');

// PRINTING DB OUTPUT 


// Writing Query
$sql = "SELECT * FROM $db_users_table";
// $sql = "SELECT * FROM admin where admin_user = '$_SESSION[‘admin_username’]'";

// Output Variable
$result = mysqli_query($conn, $sql);


//echo "<br><br>Hi " . $_SESSION['admin_username'] . ", LogIn Successful!<br><br>";


?>


<font face="verdana,arial">

<style type='text/css'>
	.a_left {
	  float: left;
	  #width:33.33333%;
	  text-align:left;
	}
	/*.a_center {
	  float: center;
	  width:33.33333%;
	  text-align:center;
	}*/
	.a_right {
	 float: right;
	 width:66.66666%;
	 text-align:right;
	}​
</style>

<div id='menu'>
	<p class='a_left'>Hi <?php echo $_SESSION['admin_username']; ?>, Welcome<p align='right'></p>
	<p class='a_right'>Menu : <a href="action/create_post.php">Create New Post</a> | <a href="action/view_post.php">View Posts</a> | <a href="action/add_user.php">Add New User</a> | <a href='logout.php'>Log Out</a></p>
</div>
<br><br><br><br>

<style>
table#t1 {
   border-collapse: collapse;
}
th, td {
    padding: 11px;
}
</style>


<br><br>
<center><font size="5" face="arial"><b>USERS DATA</b></font></center>

<!-- USERS DATA OUTPUT -->

<br><br>
<table border="1" align="center" id="t1">
	
<tr>
	<th>
		ID
	</th>
	<th>
		NAME
	</th>
	<th>
		EMAIL
	</th>
	<th>
		IP
	</th>
	<th>
		EMAIL CONFIRMED
	</th>
	<th>
		ACTION
	</th>
</tr>

<?php 
/*
// PRINTING DATABASE OUTPUT IN TABLE

if (mysqli_num_rows($result) > 0) {
//if (!$result || mysqli_num_rows($result) == 0) {
	
	while ($data=mysqli_fetch_assoc($result)) {
	
		echo "<tr>";

		echo "<td>" . $data['id'] . "</td>";
		echo "<td>" . $data['admin_user'] . "</td>";
		echo "<td>" . $data['admin_pass'] . "</td>";

		echo "<tr>";
	
	}
}

else{
	echo "0 Results!";
}
*/


if (mysqli_num_rows($result) > 0) {
//if (!$result || mysqli_num_rows($result) == 0) {
	
	while ($data=mysqli_fetch_assoc($result)) {
	
	echo "<tr>";
	echo "<td><center>" . $data['id'] . "</center></td>";
	echo "<td><center>" . $data['name'] . "</center></td>";
	echo "<td><center>" . $data['email'] . "</center></td>";
	echo "<td><center>" . $data['ip'] . "</center></td>";

	$confirmed = $data['confirmed'];
	if ($confirmed==1) {
		echo "<td><center><font color=green><b>YES</b></font></center></td>";
	} 
	elseif ($confirmed==0) {
		echo "<td><center><font color=red><b>NO</b></font></center></td>";
	}
	else {
		echo "<td><center><font color=red>ERROR IN DATABASE!</font></center></td>";
	}

	
		echo "<td>";?>
		<center>
			<?php $id2 = $data['id']; ?>

		<form method="post" action="action/index.php">
			<input type="hidden" name="id" value="<?php echo $id2; ?>">
			<input type="hidden" name="delete" value="0">
			<input type="submit" name="delete_btn" value="Delete">
		</form>
		</center>
		<?php echo "</td>";


	echo "<tr>";
	
	}
}

else{
	echo "0 Results!";
}

?>

</table>




<?php


/*
// ADMIN DATA INSERTION SETUP 


echo "<center><br><br><b><font color='red' face='arial' size='5'> CHANGE &nbsp; PAYMENT &nbsp; STATUS &nbsp; OF &nbsp; USERS </font></b></center>";

*/
?>
<!--
<center><font face="arial">
<br><br>Enter ID of USER whose PAYMENT STATUS you want to CHANGE : <br><br>
<form method="post" action="payment/payment_insert.php">
	<input type="text" name="user_id" class="textInput" required> 
	<input type="submit" name="user_id_submit_paid" value="PAID">
	<input type="submit" name="user_id_submit_not_paid" value="NOT PAID">
</form> 
</font>

-->

<?php

mysqli_close($conn);

?>


</body>
</html>