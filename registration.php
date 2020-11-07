<?php
session_start();
include('config.php');
?>

<!-- PHP CODE STARTS HERE -->


<?php


if (isset($_POST['register_btn'])) {
    

    // TAKING DATA FROM THE FORM INTO VARIABLES

    $name = mysqli_real_escape_string($conn, $_POST['name']);          // Taking Username
    $email = mysqli_real_escape_string($conn, $_POST['email']);            // Taking User Email
    $pass1 = mysqli_real_escape_string($conn, $_POST['pass1']);              // Taking Password
    $pass2 = mysqli_real_escape_string($conn, $_POST['pass2']);            // Taking Password Again


    /* EMAIL VERIFICATION START */
    $sql_email = "SELECT * FROM $db_users_table WHERE email = '$email'";
    $run_sql_email = mysqli_query($conn, $sql_email);
    $select_email = mysqli_num_rows($run_sql_email);
    /* EMAIL VERIFICATION END*/

    if ($pass1 == $pass2 && $select_email == 0) {
        
        $confirm_code = rand();         // Generating CONFIRMATION CODE
        $ip = $_SERVER['REMOTE_ADDR'];  // Getting Users IP

        //md5 enc password
        $encryptedPassword = md5($pass1);

        /* INSERTION OF DATA INTO DATABASE START */

        $sql = "INSERT INTO $db_users_table(name, email, password, ip, confirm_code) VALUES('$name', '$email', '$encryptedPassword', '$ip', '$confirm_code')";
        $insert = mysqli_query($conn, $sql);

        if ($insert) {
            $_SESSION['reg_success'] = "YES";
            $_SESSION['not_confirmed'] = "YES";
            
            /*
            
            echo "Registration Complete. <a href='emailconfirm.php?email=$email&code=$confirm_code'>CLICK HERE TO CONFIRM</a>";
            
            */

            //VERIFICATION EMAIL
            
            $message = 
            "
            Confirm Your Email
            Click the link below to confirm your account :
            http://www.mrarijit.tk/emailconfirm.php?email=$email&code=$confirm_code
            ";

            mail($email,"EmailID Verification : MrArijit.tk",$message,"From: DoNotReply@mrarijit.tk");
            
            echo "<br><br><b>Please check your Mail Inbox and Spam Folder for a Confirmation Email and CLICK THE LINK IN THE EMAIL to Confirm Your Account & E-Mail</b>.";
            
            

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
        window.location.href='registration.php';
        </script>";
    }

    elseif ($pass1 != $pass2) {
        echo"<script type='text/javascript'>
        alert('Passwords DO NOT MATCH! Please try again!');
        window.location.href='registration.php';
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
  <title>Members Area | Arijit Banerjee</title> <link rel="shortcut icon" href="../logo.png">

<script type="text/javascript" src="style/loginjs.js"></script>
<link href="style/logincss.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div class="login-page">
  <div class="form">
  <font size="6"><b>MEMBER'S AREA<br></font><font size="4"><br>Registration | <a href="posts.php">View Posts</a></b></font><br><br>

    <form class="login-form" method="post" action="registration.php">
      <input type="text" name="name" placeholder="Full Name" required="" />
      <input type="email" name="email" placeholder="Email Address" required />
      <input type="password" name="pass1" placeholder="Password" required />
      <input type="password" name="pass2" placeholder="Password Again" required />
      <button name="register_btn">create account</button>
      <p class="message">Already registered? <a href="index.php">Log In</a></p>
    </form>

  </div>
</div>

</body>
</html>


<!-- HTML CODE ENDS HERE -->