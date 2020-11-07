<?php
session_start();
include('../config.php');
?>

<!-- PHP CODE STARTS HERE -->

<?php

if (isset($_POST['submit_btn'])) {

	$email = mysqli_real_escape_string($conn, $_POST['email']);			// Taking User's email id as input

	$sql = "SELECT * FROM $db_users_table WHERE email='$email'";
	$query = mysqli_query($conn, $sql);
	$numrow = mysqli_num_rows($query);

	if ($numrow>0) {

		while ($row = mysqli_fetch_assoc($query)) {
			$db_email = $row['email'];
		}

		if ($email == $db_email) {

			$code = rand(10000, 100000);

			mysqli_query($conn, "UPDATE $db_users_table SET passreset='$code' WHERE email='$db_email'");

    
			//die("<a href='forgotpassword.php?code=$code&email=$db_email'>Click Here</a> to <a href='forgotpassword.php?code=$code&email=$db_email'>Reset Password!</a>");
			//echo "<a href='forgotpassword.php?code=$code&email=$db_email'>Click Here</a> to <a href='forgotpassword.php?code=$code&email=$db_email'>Reset Password!</a>";


			
			// SEND RESET LINK VIA EMAIL

			$to = $db_email;
			$subject = "Password Recovery : Mr.Arijit.tk";
			$body = "

			This is an automated email. Please DO NOT REPLY to this email!

			Click the link below or paste it into your browser :
			http://www.mrarijit.tk/forgot/forgotpassword.php?code=$code&email=$db_email

			";

			mail($to, $subject, $body, "From: DoNotReply@mrarijit.tk");

			echo "Check your Email Inbox. And click on the link to reset your password!";

			
		}

		else {
			echo "The Email is incorrect!";
		}

	} else {
		echo "The Email Address is not found in the database!";
	}
}


if (isset($_GET['code']) && isset($_GET['email'])) {



	if ($_GET['code'] && $_GET['email']) {
		$get_email = mysqli_real_escape_string($conn, $_GET['email']);
		$get_code = mysqli_real_escape_string($conn, $_GET['code']);


		$sql2 = "SELECT * FROM $db_users_table WHERE email='$get_email'";
		$query2 = mysqli_query($conn, $sql2);

		while ($row2 = mysqli_fetch_assoc($query2)) {
			$db_code = $row2['passreset'];
			$db_email2 = $row2['email'];

		}

		if ($get_email == $db_email2 && $get_code == $db_code) {

			//echo "Code = " . $get_code . "and Email = " . $get_email;

			?>
			<!-- HTML CODE STARTS HERE -->


			<!DOCTYPE html>
			<html lang="en">
			  <head>

			    <title>Forgot Password | Member's Area | Arijit Banerjee</title>

					<script type="../text/javascript" src="style/loginjs.js"></script>
					<link href="../style/logincss.css" rel="stylesheet" type="text/css" />

			  	</head>

			 	<body>
				<br><br><br>
				<div class="login-page">
				  <div class="form">
			      <form class="form-signin" method="post" action="resetpass.php?code=<?php echo $db_code; ?>">
			        <h2 class="form-signin-heading">Reset Password</h2><br>
			        <input type="password" name="pass1" class="form-control" placeholder="Enter a New Password" required autofocus><br>
			        <input type="password" name="pass2" class="form-control" placeholder="Re-enter the Password" required autofocus><br>
			        <!--
			        <div class="checkbox">
			          <label>
			            <input type="checkbox" value="remember-me"> Remember me
			          </label>
			        </div>
			        -->
			        <input type="hidden" name="email2" name="email2" value="<?php echo $db_email2; ?>">
			        <button class="btn btn-lg btn-primary btn-block" name="submit_btn2" type="submit">Submit</button>

					<br><br><a href='../index.php'>Click Here</a> to <a href='../index.php'>Go Back</a>

			      </form>
			    </div>
				</div>

				<font size="2">
				<center>
					Copyrights &copy; 2019 - ARIJIT BANERJEE<br>All Rights Reserved
				</center>
				</font>

			    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
			    <script src="js/ie10-viewport-bug-workaround.js"></script>
			  </body>
			</html>


			<!-- HTML CODE ENDS HERE -->
			<?php
		}
	}
}

?>


<?php

//if (isset(!$_GET['code']) && isset(!$_GET['email'])) {

	if (!isset($_GET['email'])) {

?>
<!-- PHP CODE ENDS HERE -->



	<!-- HTML CODE STARTS HERE -->


	<!DOCTYPE html>
	<html lang="en">
	  <head>

	    <title>Forgot Password | Member's Area | Arijit Banerjee</title>

			<script type="../text/javascript" src="style/loginjs.js"></script>
			<link href="../style/logincss.css" rel="stylesheet" type="text/css" />

	  </head>

	  <body>
	<br><br><br>
	<div class="login-page">
	  <div class="form">

	      <form class="form-signin" method="post" action="forgotpassword.php">
	        <h2 class="form-signin-heading">Please enter your Email Address</h2><br>

	        <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus><br>

	        <!--
	        <div class="checkbox">
	          <label>
	            <input type="checkbox" value="remember-me"> Remember me
	          </label>
	        </div>
	        -->
	        <button class="btn btn-lg btn-primary btn-block" name="submit_btn" type="submit">Submit</button>

			<br><br><a href='../index.php'>Click Here</a> to <a href='../index.php'>Go Back</a>

	      </form>

	    </div>
		</div>

	<font size="2">
	<center>
	Copyrights &copy; 2019 - ARIJIT BANERJEE<br>All Rights Reserved
	</center>
	</font>

	    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	    <script src="js/ie10-viewport-bug-workaround.js"></script>
	  </body>
	</html>


	<!-- HTML CODE ENDS HERE -->

<?php

	}
//}
?>
