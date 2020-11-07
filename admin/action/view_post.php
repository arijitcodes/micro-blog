<?php
session_start();
include('../../config.php');
?>


<!-- PHP CODE STARTS HERE -->

<?php

	/* 
	CHECKING IF VISITOR IS ADMIN AND LOGGED IN (CHECKING IF A SESSION NAMED 'AdminLoggedIn' HAS BEEN GENERATED BEFORE OR NOT)
	*/

	if (!$_SESSION['AdminLoggedIn']) {
		header("location: ../index.php?problem=NotLoggedIn");
		//header("location: admin.php?problem=NotLoggedIn");
		exit();
	}

	$sql = "SELECT * FROM $db_posts_table";
	$query = mysqli_query($conn, $sql);

?>

<!-- PHP CODE ENDS HERE -->


<!-- HTML CODE STARTS HERE -->


<!DOCTYPE html>
<html>
<head>
	<title>ADMIN PORTAL |  Member's Area | Arijit Banerjee</title>
</head>
<body>
<center>
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
	<!--<p class='a_left'>Hi <?php echo $_SESSION['admin_username']; ?>, Welcome<p align='right'></p>-->
	<p class='a_right'>Menu : <a href="../index.php">Admin Home</a> | <a href="create_post.php">Create Post</a> | <a href="add_user.php">Add New User</a> | <a href='../logout.php'>Log Out</a></p>
</div>
<br><br><br><br>

<style>
table#t1 {
   border-collapse: collapse;
}
th, td {
    padding: 8px;
}
</style>
<br>
<h2>POSTS</h2>
<br><br>
<table border="1" align="center" id="t1">
<tr>
	<th>
		Post Number
	</th>
	<th>
		Date and Time
	</th>
	<th>
		Subject
	</th>
	<th>
		Post
	</th>
	<th>
		Posted By
	</th>
	<th>
		Actions
	</th>
</tr>

<?php 

	if (mysqli_num_rows($query) > 0) {
		
		while ($data = mysqli_fetch_assoc($query)) {
			echo "<tr>";
			echo "<td><center>". $data['id'] ."</center></td>";
			echo "<td><center>". $data['date_time'] ."</center></td>";
			echo "<td><center>". $data['subject'] ."</center></td>";
			echo "<td>". $data['post'] ."</td>";
			echo "<td><center>". $data['posted_by'] ."</center></td>";
			$approved = $data['approved'];
			if ($approved==0) {
				echo "<td><center><a href='edit_post.php?approve_id=" . $data['id'] ."'>APPROVE</a><br><br><a href='del_post.php?id=" . $data['id'] ."'>DELETE</a></center></td>";
			}
			else {
				echo "<td><center><a href='edit_post.php?id=" . $data['id'] ."'>EDIT</a><br><br><a href='del_post.php?id=" . $data['id'] ."'>DELETE</a></center></td>";
			}
			echo "</tr>";
		}
	} 

	else {
		echo "<font color='red'>NO DATA FOUND TO SHOW!<br><br></font>";
	}

?>

</table>
<br><br>
</font>
</center>
</body>
</html>

<!-- HTMLS CODE ENDS HERE -->