<?php
session_start();
include('config.php');
?>


<!-- PHP CODE STARTS HERE -->

<?php

/* 
CHECKING IF VISITOR IS ADMIN AND LOGGED IN (CHECKING IF A SESSION NAMED 'AdminLoggedIn' HAS BEEN GENERATED BEFORE OR NOT)
*/

if (!$_SESSION['LoggedIn']) {
	header("location: ../index.php?problem=NotLoggedIn");
	//header("location: admin.php?problem=NotLoggedIn");
	exit();

}

if (isset($_POST['post_submit_btn'])) {
	
	include('userdata.php');

	$subject = mysqli_real_escape_string($conn, $_POST['subject']);
	$raw_content = mysqli_real_escape_string($conn, $_POST['content']);
	//$cntnt = $_POST['content'];

	date_default_timezone_set('Asia/Kolkata');
	$date = date('jS F, Y - h:i A, l');

	$content = str_replace('\r\n\r\n', '<br><br>', $raw_content);

	$user = $name;
	

	/*
	$file = 'notice.txt';
	
	$fp = fopen($file, 'w');
	fwrite($fp, $str);
	fclose($fp);
	
	$fp = fopen($file, 'a');
	fwrite($fp, $cntnt);
	fclose($fp);
	*/
	//echo $str;
	//die("<b>Subject : </b>" . $subject . "<br><br><b>Content : </b>" . $str . "<br><br><b>Date and Time : </b>" . $date);
	//die($str);

	$sql = "INSERT INTO $db_posts_table(date_time, subject, post, posted_by) VALUES('$date', '$subject', '$content', '$user')";
	$query = mysqli_query($conn, $sql);

	if ($query) {
		
		 echo '
        	<script type="text/javascript">
            alert("New Notice has been Posted Successfully!"); 
            window.location.href = "posts.php";
            </script>';
	} 

	else {
		echo "<font color='red'>Error : MySqli Query Error on Line 61!</font>";	
	}

}


?>


<!-- PHP CODE ENDS HERE -->


<!-- HTML CODE STARTS HERE -->

<!DOCTYPE html>
<html>
<head>
	<title>Create New Post |  Member's Area | Arijit Banerjee</title>

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
	<p class='a_right'>Menu : <a href="home.php">Home</a> | <a href="posts.php">View Posts</a> | <a href="profile.php">My Profile</a> | <a href='logout.php'>Log Out</a></p>
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

<center><font size="5" face="arial"><b>CREATE NEW POST</b></font>
<br><br><font color='red'><b>[ PLEASE USE DOUBLE QUOTES ( " ) ONLY! DO NOT USE SINGLE QUOTES ( ' )! ]</b></font></center>
<br>
<form method="POST" action="create_new_post.php">
	<table border="1" align="center" id="t1">
		<tr>
			<td>Post Number : 
			<?php

			$sql2 = "SELECT * FROM $db_posts_table";
			$query2 = mysqli_query($conn, $sql2);

			if (mysqli_num_rows($query2) > 0) {
				
				while ($data2 = mysqli_fetch_assoc($query2)) {
					$new_id = $data2['id'] + 1;
					//echo $new_id;
				}
				echo $new_id;
			} 

			elseif (mysqli_num_rows($query2) == 0) {
				echo "1";
			}

			else {
				echo "<font color='red'>Error : Error in MySqli_Num_Rown on Line 129!</font>";
			}
				

			?>
			<br><br>
			Subject : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="text" name="subject" class="textInput" style="width:500px;font-size:10pt;" pattern=".{3,}" required  title="3 characters minimum">
			<br><br>
			Post Content : <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<textarea name="content" rows="20" cols="69" minlength="5"></textarea>
			<!--<input type="text" name="content" class="textInput" style="height:300px;width:500px;font-size:12pt;" required>-->
			<br><br>
			<p align="right"><input type="submit" name="post_submit_btn" value=" Post "></p></td>
		</tr>
	</table>


</form>
</font>
</body>
</html>

<!-- HTML CODE ENDS HERE -->