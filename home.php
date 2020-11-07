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

<!-- PHP CODE ENDS HERE -->


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

	.a_right {
	 float: right;
	 width:66.66666%;
	 text-align:right;
	}​
</style>

<div id='menu'>
	<p class='a_left'>Hi <?php echo $name; ?>, Welcome<p align='right'></p>
	<p class='a_right'>Menu : <a href='profile.php'>My Profile</a> | <a href="posts.php">View Posts</a> | <a href="create_new_post.php">Create New Post</a> | <a href='logout.php'>Log Out</a></p>
</div>

<br><br><br><br><br><br>

<style>
table#t1 {
   border-collapse: collapse;
}
th, td {
    padding: 15px;
}
</style>

<!--<center>-->
<table border="2" align="center" id="t1">
<th>
<h1>MENU</h1>
</th>
<tr>
<td>
<font size="5">
<ul>
	<li><a href="posts.php">View Posts</a> </li>
	<li><a href="create_new_post.php">Create New Post</a> &nbsp;&nbsp;</li>
	<li><a href="profile.php">My Profile</a> </li>
</ul>
<!--</center>-->
</font>
</td>
</tr>

<?php
mysqli_close($conn);
?>

</body>
</html>

<!-- HTML CODE ENDS HERE -->
