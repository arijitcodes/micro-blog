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

if (isset($_POST['submit_btn'])) {
	
	 // TAKING DATA FROM THE FORM INTO VARIABLES

    $name = mysqli_real_escape_string($conn, $_POST['user_name']);          // Taking Username
    $email = mysqli_real_escape_string($conn, $_POST['user_email']);            // Taking User Email
    $pass = mysqli_real_escape_string($conn, $_POST['user_pass']);              // Taking Password


    /* EMAIL VERIFICATION START */
    $sql_email = "SELECT * FROM $db_users_table WHERE email = '$email'";
    $run_sql_email = mysqli_query($conn, $sql_email);
    $select_email = mysqli_num_rows($run_sql_email);
    /* EMAIL VERIFICATION END*/

    if ($select_email == 0) {
        
        $confirm_code = 0;         // Generating CONFIRMATION CODE
        $confirmed = 1;
        $ip = $_SERVER['REMOTE_ADDR'];  // Getting Users IP


        /* INSERTION OF DATA INTO DATABASE START */

        $sql = "INSERT INTO $db_users_table(name, email, password, ip, confirm_code, confirmed) VALUES('$name', '$email', '$pass', '$ip', '$confirm_code', $confirmed)";
        $insert = mysqli_query($conn, $sql);

        if ($insert) {
            echo"<script type='text/javascript'>
       		 alert('New User Registration Complete.');
       		 window.location.href='../index.php';
       		 </script>";
            
            /*

            //VERIFICATION EMAIL
            
            $message = 
            "
            Confirm Your Email
            Click the link below to confirm your account :
            http://www.hva17.cf/alliance/emailconfirm.php?email=$email&code=$confirm_code
            ";

            mail($email,"Registration Email Confirm : Arijit Banerjee",$message,"From: DoNotReply@hva17.cf");
            
            echo "<br><br><b>Please check your Mail Inbox and Spam Folder for a Confirmation Email and CLICK THE LINK IN THE EMAIL to Confirm Your Account & E-Mail</b>.";
            
            */

            //echo " Registration Successfull! <a href='login.php'>Click Here</a> to go to the <a href='login.php'>Log In Page</a>";
        }

        else {
            die('ERROR IN LINE 38');
        }

        /* INSERTION OF DATA INTO DATABASE ENDS */
    }

    elseif ($select_email>0) {
        echo"<script type='text/javascript'>
        alert('This Email is already in use! Please try a new one!');
        window.location.href='add_user.php';
        </script>";
    }

    else {
        die(' Registration Failed due to any Unknown Error!<br><br>If you are seeing this then please copy the above error and send us via email from the contact section. We will be thankful to you and our monkies will start identifying the problem.');
    }

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
	<p class='a_right'>Menu : <a href="../index.php">Admin Home</a> | <a href="view_post.php">View Posts</a> | <a href="create_post.php">Create Post</a> | <a href='../logout.php'>Log Out</a></p>
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
<center><font size="5" face="arial"><b>ADD NEW USER</b></font>
<br><br>
<!-- <font color='red'><b>[ PLEASE USE DOUBLE QUOTES ( " ) ONLY! DO NOT USE SINGLE QUOTES ( ' )! ]</b></font> -->
</center>
<br>
<form method="POST" action="add_user.php">
	<table border="1" align="center" id="t1">
		<tr>
			<td>

				<br>Name : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="user_name" required>
				<br><br>Email Id : &nbsp;&nbsp; <input type="email" name="user_email" required>
				<br><br>Password : &nbsp;<input type="password" name="user_pass" required>
				<br>
			<p align="right"><input type="submit" name="submit_btn" value=" Submit "></p></td>
		</tr>
	</table>


</form>
</font>
</body>
</html>

<!-- HTML CODE ENDS HERE -->