<?php
session_start();
include('config.php');
?>


<!-- PHP CODE STARTS HERE -->

<?php

// CHECKING IF A SESSION W'LOGGEDIN HAS BEEN GENERATED
if (isset($_SESSION['LoggedIn'])) {
  if ($_SESSION['LoggedIn']) {
    echo"<script type='text/javascript'>
          alert('YOU ARE ALREADY LOGGED IN!');
          window.location.href='home.php';
          </script>";
  }
}

// Taking DATA from the FORM into Different Variables
if (isset($_POST['login_btn'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);          // Taking DATA from the FORM into Different Variables
  $pass = mysqli_real_escape_string($conn, $_POST['pass']);            // Taking DATA from the FORM into Different Variables

  //md5 pass
  $encryptedPassword = md5($pass);

  // Our SQL Query
  $sel_user = "SELECT * FROM $db_users_table WHERE email ='$email' AND password ='$encryptedPassword'";

  // INSERTING DATA INTO DATABASE
  $run_user = mysqli_query($conn, $sel_user);

  // CHECKING DATA WITH DATABASE
  $check_user = mysqli_num_rows($run_user);

  if($check_user>0){


    // Our SQL Query
    $query = "SELECT * FROM $db_users_table WHERE email ='$email'";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
      $db_confirmed = $row['confirmed'];
    }

    if ($db_confirmed == 1) {
      $_SESSION['useremail'] = $email;
      $_SESSION['LoggedIn'] = "YES";
      //header("location: home.php");
      echo"<script type='text/javascript'>
          window.location.href='home.php';
          </script>";
    }

    else if ($db_confirmed == 0) {
      echo "<center><font color=red><b><br><br>ERROR : </font>You haven't confirmed your E-MAil Yet.</b></font><br><br><b>Please check your Mail Inbox and Spam Folder for a Confirmation Email and CLICK THE LINK IN THE EMAIL to Confirm Your Account & E-Mail.</b></center>";
    }

    else {
      die("Error Occured! Please Contact the administrator with the page and error details!");
    }
  }

  else {
    echo '<script language="javascript">';
    echo 'alert("LogIn Failed!! Wrong Username / Password!")';
    echo '</script>';
  }
}



?>

<!-- PHP CODE ENDS HERE -->



<!-- HTML CODE STARTS HERE -->


<!DOCTYPE html>
<html>
<head>
  <title>Members Area | Arijit Banerjee</title> <link rel="shortcut icon" href="../logo.png">

<script type="text/javascript" src="style/loginjs.js"></script>
<link href="style/logincss.css" rel="stylesheet" type="text/css" />

</head>

<body>

<div class="login-page">
  <div class="form">
  <font size="6"><b>MEMBER'S AREA<br></font><font size="4"><br>Log In | <a href="posts.php">View Posts</a></b></font><br><br>

    <form class="login-form" method="post" action="index.php">
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="pass" placeholder="Password" required />
      <button name="login_btn">Log In</button>
      <p class="message">Not registered? <a href="registration.php">Create an account</a></p>
      <p class="message">Forgot Password ? <a href="forgot/forgotpassword.php">Click Here to Reset your Password</a></p>
    </form>

  </div>
</div>

</body>

</html>


<!-- HTML CODE ENDS HERE -->
