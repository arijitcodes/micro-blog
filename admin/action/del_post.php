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

		$sql = "DELETE FROM $db_posts_table WHERE $db_posts_table.id = '$get_id'";
		$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

		if ($query) {
			
			echo '
		        	<script type="text/javascript">
		            alert("Notice Deleted Successfully!"); 
		            window.location.href = "view_post.php";
		            </script>';
			
		}
		
		else 
		{
			//echo "<font color='red'>Error : Error occured in MySqli_Num_Rows at Line 28!</font>";
			echo '
		        	<script type="text/javascript">
		            alert("Notice Not Found! Please try again!"); 
		            window.location.href = "view_post.php";
		            </script>';
		}
	}
?>

<!-- PHP CODE ENDS HERE -->