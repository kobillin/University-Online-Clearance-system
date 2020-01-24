<?php 

  include("connection.php");

$error="";

if ((isset($_POST['submit'])))
{

$regno = $_POST ['regno'];
$name = $_POST ['names'];
//$gender= $_POST['lname'];
$mobile = $_POST ['Mobile'];
$progcode = $_POST ['progcode'];
$password = $_POST['pass'];
$conpassword = $_POST['pass2'];

if (strlen($password) < 3) 
{
    $error="password is too short";
}
else
{

 $insertQuery ="INSERT INTO student3(RegNo, Name, Mobile_Number, Programme_code, Password, Confirm_password) VALUES('$regno','$name','$mobile','$progcode','$password','$conpassword')";
    if(mysqli_query($con, $insertQuery))
    {
      $error="sucess";
    }
    else{
      $error="failed";
    } 
}

}

  ?>

<!DOCTYPE html>
<html>
<head>
	<title>Simple Registration Form</title>
	<link rel="stylesheet" type="text/css" href="Css/style.css">
</head>
<body style="
    background-color: darkcyan;
">
<header>
	<div class="main">
	    <div class="logo">
	    	<img src="images/logo2.png" >
	    </div>
		<ul>
		    <li><a href="index.php">HOME</a></li>
			<!-- <li><a href="stafflogin.html">STAFF</a></li> -->
			<li class="active"><a href="register.php">STUDENTREGISTRATION</a></li>
			<li><a href="contact.php">CONTACT</a></li>
            <li><a href="about.php">ABOUT</a></li>
		</ul>
	</div>
</header>
	<form action="register.php" method="POST" >
	<?php echo $error;?>
<div class="simple-form">
	</form>
	<div class="header">
	<!-- <h1>Student Registration Form</h1> -->
    <div class="register">
    <h2>Fill The Form Here & Submit Below</h2>
    	<form method="post" id="register" action="">
    	<label>Registration no :</label><br>
    	<input type="text" name="regno" id="name" placeholder="Enter your Regno" required><br><br>
    	<label>Name :</label><br>
    	<input type="text" name="names" id="name" placeholder="Enter your Names" required><br><br>
    	<!-- <label>Last Name :</label><br>
    	<input type="text" name="lname" id="name" placeholder="Enter your lname"><br><br>
    	<label>Sur Name :</label><br>
    	<input type="text" name="sname" id="name" placeholder="Enter your Surname"><br><br> -->
       <!--  <input type="radio" name="male" id="male" checked><span id="male"> &nbsp; Male</span> &nbsp;&nbsp; 
        <input type="radio" name="male" id="male"><span id="male"> &nbsp; Female</span> &nbsp;&nbsp; 
        <input type="radio" name="male" id="male"><span id="male"> &nbsp; Other</span> &nbsp;&nbsp; <br><br> -->
    	<!-- <label>National ID :</label><br>
    	<input type="text" name="nID" id="name" placeholder="Enter your ID no"><br><br> -->
    	<label>Mobile :</label><br>
    	<!-- <select id="ph">
    	<option>+254</option>
    	<option>+255</option>
    	<option>+256</option> -->
    	</select>
        <input type="number" name="Mobile" id="num" placeholder="Enter your Mobile no" required><br><br>
    	<label>ProgrameCode :</label><br>
    	<input type="text" name="progcode" id="name" placeholder="Enter your ProgrameCode" required><br><br>
    	<label>Password :</label><br>
    	<input type="password" name="pass" id="name" placeholder="Enter your Password" required><br><br>
    	<label>Confirm password :</label><br>
    	<input type="Password" name="pass2" id="name" placeholder="Confirm your Password" required><br><br>
    	<input type="submit" value="SUBMIT" name="submit" id="sub">
    	<label id="login">Already Registered <a href="login.php" style="
    font-family: fantasy;
    font: bold;
    font-style: normal;
    color: #1707f7;
"> Login</a></label>

    	</form>
    </div>

</body>
</html>