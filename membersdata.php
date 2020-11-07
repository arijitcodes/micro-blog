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
	<!--<p class='a_left'>Hi <?php echo $name; ?>, Welcome<p align='right'></p>-->
	<p class='a_right'>Menu : <a href='home.php'>Home</a> | <a href='profile.php'>My Profile</a> | <a href='logout.php'>Log Out</a></p>
</div>
<font size="2">
<br><br><br><br>
<center><h1>Member's Details</h1><br>
<style>
table#t1 {
   border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: center;
}
</style>

<!--<center>-->
<table border="2" align="center" id="t1">
<tr>
	<th>
	<h3>Serial</h3>
	</th>
	<th>
	<h3>Name</h3>
	</th>
	<th>
	<h3>Phone No.</h3>
	</th>
</tr>
<tr><td>1. </td><td> ( NILACHAL ) BENU TALUKDAR </td><td>8016330651 </td></tr>
<tr><td>2. </td><td> ABHIJIT BOSE </td><td> 9434629427 , 9531629684</td></tr>
<tr><td>3. </td><td> AMIT KUMAR ROY </td><td> 9635455346</td></tr>
<tr><td>4. </td><td> ANAMIKA BOSE </td><td> 9733275210</td></tr>
<tr><td>5. </td><td> ANANGSHA SIDDHANTA </td><td> 9614418886</td></tr>
<tr><td>6. </td><td> ANIRBAN DAS </td><td> 9874458812</td></tr>
<tr><td>7. </td><td> APURBA SAHA </td><td> 9831275331</td></tr>
<tr><td>8. </td><td> ARIJIT BANERJEE </td><td> 9126698470</td></tr>
<tr><td>9. </td><td> DEBABRATA MUKHERJEE </td><td> 9434242080</td></tr>
<tr><td>10.</td><td> DEBASHISH DAS </td><td>9475139520</td></tr>
<tr><td>11.</td><td> HRISHIKESH BANERJEE </td><td> 9434242095</td></tr>
<tr><td>12.</td><td> KARABI GOSWAMI </td><td> 9932862337</td></tr>
<tr><td>13.</td><td> LUNA SAHA </td><td> 9831243326</td></tr>
<tr><td>14.</td><td> MANOJIT ROY </td><td> 9475200457</td></tr>
<tr><td>15.</td><td> MIHIR BANERJEE </td><td> 9434500457</td></tr>
<tr><td>16.</td><td> NILANJAN GUHA </td><td> 9734999995</td></tr>
<tr><td>17.</td><td> POULAMI MUKHERJEE </td><td> 9733625996</td></tr>
<tr><td>18.</td><td> PRASUN KAR </td><td> 8016504004</td></tr>
<tr><td>19.</td><td> PRIYADARSHI CHANDA </td><td> 9647728173</td></tr>
<tr><td>20.</td><td> PRIYAJIT RAY </td><td> 9434606301</td></tr>
<tr><td>21.</td><td> RAJIB CHAKRABARTY </td><td> 9434217103</td></tr>
<tr><td>22.</td><td> RATNA SEN ROY </td><td> 9474013304</td></tr>
<tr><td>23.</td><td> RITU SENGUPTA </td><td> 9476225261</td></tr>
<tr><td>24.</td><td> SANKAR SARKAR </td><td> 8101490997</td></tr>
<tr><td>25.</td><td> SANTANU KHAN </td><td> 9434319696 , 8972339034</td></tr>
<tr><td>26.</td><td> SARIT CHAKRABARTY </td><td> 9531623056</td></tr>
<tr><td>27.</td><td> SAUBHIK DHAR </td><td> 9832650097</td></tr>
<tr><td>28.</td><td> SHAMIK BHOWMIK </td><td> 9832090718</td></tr>
<tr><td>29.</td><td> SHINJINI GOSWAMI </td><td> 9434217532</td></tr>
<tr><td>30.</td><td> SOURADEEPA ROY </td><td> 9800317546</td></tr>
<tr><td>31.</td><td> SOURAV GHOSH </td><td> 7098206105</td></tr>
<tr><td>32.</td><td> SOUGATA GHOSH </td><td> 8637355121</td></tr>
<tr><td>33.</td><td> SRITAMA SAHA </td><td> 9775229784</td></tr>
<tr><td>34.</td><td> SUBHADEEP SAHA </td><td> 9832503126 , 9475651952</td></tr>
<tr><td>35.</td><td> SUBRATA MUKHERJEE </td><td> 9434174999</td></tr>
<tr><td>36.</td><td> SUDESHNA BARMAN </td><td> 7479363435</td></tr>
<tr><td>37.</td><td> SUTAPA SENGUPTA ROY </td><td> 9475902908 , 7583975914</td></tr>
<tr><td>38.</td><td> SWAPAN KUNDU </td><td> 9832048185 , 8900074707</td></tr>
<tr><td>39.</td><td> TAMAGHNI SHIL </td><td> 9734007248</td></tr>
<tr><td>40.</td><td> TAMOJIT ROY </td><td> 9434257822 , 8637023045</td></tr>
<tr><td>41.</td><td> URMIMALA PAUL </td><td> 7679174703</td></tr>
</table>
</fonts>
<?php
mysqli_close($conn);
?>
<br><br><b>
Copyrights &copy; 2017 - <a href="../index.html">Arijit Banerjee</a></b></center>
</body>
</html>

<!-- HTML CODE ENDS HERE -->
