<?php
session_start();
include('config.php');
?>


<!-- PHP CODE STARTS HERE -->

<?php
/*
	// CHECKING IF A SESSION W'LOGGEDIN HAS BEEN GENERATED
	if (!$_SESSION['LoggedIn']) {
		echo"<script type='text/javascript'>
	        alert('YOU ARE NOT LOGGED IN YET!');
	        window.location.href='index.php';
	        </script>";
	}
*/
	$sql = "SELECT * FROM $db_posts_table";
	$query = mysqli_query($conn, $sql);

?>

<!-- PHP CODE ENDS HERE -->


<!-- HTML CODE STARTS HERE -->


<!DOCTYPE html>
<html>
<head>
	<title>View Posts |  Member's Area | Arijit Banerjee</title>
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
	<?php 
	if (isset($_SESSION['LoggedIn'])) { 
		echo "<p class='a_right'>Menu : <a href='home.php'>Home</a> | <a href='profile.php'>My Profile</a> | <a href='create_new_post.php'>Create New Post</a> | <a href='logout.php'>Log Out</a></p>";
	}
	else {
		echo "<p class='a_right'>Menu : <a href='index.php'>LogIn</a> | <a href='registration.php'>Registration</a></p>";
	}
	?>
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
</tr>

<?php 

	if (mysqli_num_rows($query) > 0) {
		
		while ($data = mysqli_fetch_assoc($query)) {

			if ($data['approved']==1) {

				echo "<tr>";
				echo "<td><center>". $data['id'] ."</center></td>";
				echo "<td><center>". $data['date_time'] ."</center></td>";
				echo "<td><center>". $data['subject'] ."</center></td>";
				echo "<td>". $data['post'] ."</td>";
				echo "<td><center>". $data['posted_by'] ."</center></td>";
				echo "</tr>";
				
			}
			
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