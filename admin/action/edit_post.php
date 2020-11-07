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

	if (isset($_GET['id'])) {
		
		$get_id = mysqli_real_escape_string($conn, $_GET['id']);

		$sql = "SELECT * FROM $db_posts_table WHERE id='$get_id'";
		$query = mysqli_query($conn, $sql);

		if (mysqli_num_rows($query) > 0) {
			
			while ($data = mysqli_fetch_assoc($query)) {
			
			$id = $data['id'];
			$date = $data['date_time'];
			$subject = $data['subject'];
			$content = $data['post'];
			$posted_by = $data['posted_by'];

			//die($subject);

			}
		}

		else 
		{
			//echo "<font color='red'>Error : Error occured in MySqli_Num_Rows at Line 28!</font>";
			echo '
		        	<script type="text/javascript">
		            alert("Post Not Found! Please try again!"); 
		            window.location.href = "view_post.php";
		            </script>';
		}
	}

	elseif (isset($_POST['post_edit_submit_btn'])) {
		
		$id = mysqli_real_escape_string($conn, $_POST['id']);
		$subject = $_POST['subject'];
		$content = $_POST['content'];
		//$subject = mysqli_real_escape_string($conn, $_POST['subject']);
		//$content = mysqli_real_escape_string($conn, $_POST['content']);
		//die("ID = " . $id . "<br><br>Subject : <br> " . $subject . "<br><br>Content : <br>" . $content);
		//echo "JUST A TEST ECHO<br><br>ID = " . $id . "<br><br>Subject : <br> " . $subject . "<br><br>Content : <br>" . $content;

		$sql2 = "SELECT * FROM $db_posts_table WHERE id='$id'";
		$query2 = mysqli_query($conn, $sql2);

		if (mysqli_num_rows($query2) > 0) {
			
			$sql3 = "UPDATE $db_name.$db_posts_table SET `subject` = '$subject', `post` = '$content' WHERE $db_posts_table.`id` = '$id'";
			$query3 = mysqli_query($conn, $sql3);

			if ($query3) {
				echo '
		        	<script type="text/javascript">
		            alert("Post has been Updated Successfully!"); 
		            window.location.href = "view_post.php";
		            </script>';
			} 

			else {
				
				echo "<br><br><font color='red'><b>Error : Error occured in UPDATE Query at Line 59!</b></font>";
				die();
			}
			
		}

		else 
		{
			echo "<font color='red'>Error : Error occured in MySqli_Num_Rows at Line 59!</font>";
		}
	}

	elseif (isset($_GET['approve_id'])) {

		$get_id = mysqli_real_escape_string($conn, $_GET['approve_id']);

		$sql = "SELECT * FROM $db_posts_table WHERE id='$get_id'";
		$query = mysqli_query($conn, $sql);

		if (mysqli_num_rows($query) > 0) {
			
			while ($data = mysqli_fetch_assoc($query)) {
			
				$id = $data['id'];

				$sql2 = "UPDATE $db_name.$db_posts_table SET `approved` = 1 WHERE $db_posts_table.`id` = '$id'";
				$query2 = mysqli_query($conn, $sql2);

				if ($query2) {
					echo '
			        	<script type="text/javascript">
			            alert("Post Approved Successfully!"); 
			            window.location.href = "view_post.php";
			            </script>';
				}

				else {
					echo '
			        	<script type="text/javascript">
			            alert("Post Approval Failed! Please try again!"); 
			            window.location.href = "view_post.php";
			            </script>';
				}

			}
		}

		else 
		{
			//echo "<font color='red'>Error : Error occured in MySqli_Num_Rows at Line 28!</font>";
			echo '
		        	<script type="text/javascript">
		            alert("Post Not Found! Please try again!"); 
		            window.location.href = "view_post.php";
		            </script>';
		}
	}

	else
	{
		header("location: view_post.php");
	}
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
	<p class='a_right'>Menu : <a href="../index.php">Admin Home</a> | <a href="view_post.php">View Posts</a> | <a href="create_post.php">Create New Post</a> | <a href='../logout.php'>Log Out</a></p>
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

<center><font size="5" face="arial"><b>EDIT POST</b></font></center>
<br><font color='red'><b>[ PLEASE USE DOUBLE QUOTES ( " ) ONLY! DO NOT USE SINGLE QUOTES ( ' )! ]</b></font><br><br>
<form method="POST" action="edit_post.php">
	<table border="1" align="center" id="t1">
		<tr>
			<td>
			EDIT : <br><br>
			POST Number : <?php echo $id; ?>
			<br><br>
			First Posted On : <?php echo $date; ?>
			<br><br>
			Posted By : <?php echo $posted_by; ?>
			<br><br>
			Subject : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			<input type="text" name="subject" class="textInput" style="width:500px;font-size:10pt;" value="<?php echo $subject; ?>" required>
			<br><br>
			Post Content : <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<textarea name="content" rows="20" cols="69" required><?php echo $content; ?></textarea>
			<!--<input type="text" name="content" class="textInput" style="height:300px;width:500px;font-size:12pt;" required>-->
			<br><br>
			<input type="hidden" name="id" value=<?php echo $id; ?>>
			<p align="right"><input type="submit" name="post_edit_submit_btn" value=" UPDATE "></p></td>
		</tr>
	</table>
</form>
</font>
</body>
</html>

<!-- HTML CODE ENDS HERE -->