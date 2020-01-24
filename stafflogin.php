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
		     <li><a href="index.php">HOME</a></li>
			<li class="active"><a href="stafflogin.php">STAFFLOGIN</a></li>
			<li><a href="login.php">ADMIN</a></li>
			<li><a href="contact.php">CONTACT</a></li>
			<li><a href="about.php">ABOUT</a></li>
		</ul>
	</div>
</header>
	<form method="post" action="login.php"></form>
<div class="simple-form">
	<div class="header">
	<h2>STAFF LOGIN </h2>
</div>
	<form id="sign-in">
		<input type="text" name="username" id="button" placeholder="Enter Your Username"><br> <br>
		<input type="password" name="pass" id="button" placeholder="Enter Your Password"><br> <br>
		<input type="submit" value="Login" id="butt">
		<p>
			Not yet Registered? <a href="contact.php" style="
    color: red;
    font-family: cursive;
    font-style: bold;
    /* text-decoration-style: solid; */
">Contact Admin</a>
		</p>
	</form>
</div>
</body>
</html>