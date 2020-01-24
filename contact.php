<?php
include("connection.php");
$error="";

if (empty($_POST)===false)
{

$user = $_POST ['user'];
$names = $_POST ['names'];
$email = $_POST ['email'];
$message = $_POST ['message'];


       //$password = md5($password);

    $insertQuery ="INSERT INTO help(user, names, email, message) VALUES('$user','$names','$email','$message')";
    if(mysqli_query($con, $insertQuery))
    {
      $error="sucess";
    }
    else{
      $error="failed";
    } 
}


 ?>

<!DOCTYPE html>
<html>
<head>
	
	<title>Contact</title>
	<link rel="stylesheet" type="text/css" href="Css/style.css">
</head>
<?php echo $error;?>
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
			<!-- <li><a href="stafflogin.php">STAFF</a></li> -->
			<li><a href="login.php">LOGIN</a></li>
			<li><a href="about.php">ABOUT</a></li>
			<li class="active"><a href="contact.php">CONTACT</a></li>
		</ul>
	</div>
</header>
<!-- <?php echo $error;?> -->
	<form action="contact.php" method="POST"></form>
    

<div class="contact-form">
	<div class="header">
	<h2>We are always ready to serve you </h2>
</div>
	<form id="contact">
		<input type="text" name="names" id="button" placeholder="Your Name" required><br> <br>
		<input type="text" name="user" id="button" placeholder="Your Staffno or Regno" required><br> <br>
		<input type="email" name="email" id="button" placeholder="Your Email" required><br> <br>
		<textarea type="text" name="message" id="button2" placeholder="Your Message" rows="4" required></textarea><br><br>
		<!-- <input type="text" name="message" id="button2" placeholder="Your Message"><br> <br> -->
		<input type="submit" value="SEND MESSAGE" name="submit" id="butt">
		<!-- <p>
			Not yet a Member? <a href="register.html" style="
    color: red;
    font-family: cursive;
    font-style: bold;
    /* text-decoration-style: solid; */
">Contact Admin</a>
		</p> -->
	</form>
</div>
</body>
</html>