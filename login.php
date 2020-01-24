<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
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
		    <li ><a href="index.php">HOME</a></li>
			<li class="active"><a href="login.php">LOGIN</a></li>
			<!-- <li><a href="student.html">STUDENT</a></li> -->
			<li><a href="contact.php">CONTACT</a></li>
            <li><a href="about.php">ABOUT</a></li>
		</ul>
	</div>
</header>
	<form method="POST" action="login.php"></form>
<div class="simple-form">
	<div class="header">
	<h2>LOGIN HERE</h2>
</div>
	<form id="sign-in">
	    <select name="type" id="type">
	        <option value="-1">Select User type</option>
	    	<option value="Admin">Admin</option>
	    	<option value="Student">Student</option>
	    	<option value="Staff">Staff</option><br><br>
	    </select><br><br>
		<input type="text" name="regno" id="button" placeholder="Enter Your Regno/Staffno" required><br> <br>
		<input type="password" name="pass" id="button" placeholder="Enter Your Password" required><br> <br>
		<input type="submit" value="Login" id="butt">
		<p>
			Not yet a Registered ? <a href="register.php" style="
    color: red;
    font-family: cursive;
    font-style: bold;
    /* text-decoration-style: solid; */
">Register Here!</a>
<p>
			Staff Members Contact Admin ? <a href="contact.php" style="
    color: red;
    font-family: cursive;
    font-style: bold;
    /* text-decoration-style: solid; */
">Contact !</a>
		</p>
	</form>
</div>
</body>
</html>
mysqli_select_db

<?php 
$con=mysqli_connect("localhost", "root","");
if (!$con)
{
	echo "Unable to establish connection " .mysql_error();
}
   $db=mysqli_select_db("clearance", $con);
   if (!$db)
   {
   	echo "Database not found ".mysql_error();
   }
   if (isset($_POST['submit'])){
   	$type=$_POST['type'];
   	$username = $_POST['username'];
   	$password=$_POST['pass'];

   	$query ="select * from login where username='$username' and password ='$password' and type='$type'";
   	$result=mysql_query($query);

   	while ($row=mysql_fetch_array($query)){

   		if ($row['username'] == $username && $row ['password']==$password && $row['type'] =='Admin'){
   			header("location:Admin.html");
   			# code...
   		}
   		elseif ($row['username'] == $username && $row ['password']==$password && $row['type'] =='Student'){
   			header("location:Student.html");
   		}
   		elseif ($row['username'] == $username && $row ['password']==$password && $row['type'] =='Staff'){
   			header("location:Staff.html");
   		}

   	}
  


	# code...
}




 ?>