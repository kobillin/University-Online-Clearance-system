<!DOCTYPE html>
<html>
<head>
	<title>Request</title>
	<link rel="stylesheet" type="text/css" href="Css/style.css">
</head>
<body style="
    background-color: darkcyan;
">
<header>
	<div class="main">
	    <div class="logo">
	    	<img src="images/logo2.png">
	    </div>
		<ul>
		    <li class="active"><a href="index.html">HOME</a></li>
			<li><a href="staff.html">STAFF</a></li>
			<li><a href="student.html">STUDENT</a></li>
			<li><a href="staff/clear.php">CLEAR</a></li>
		</ul>
	</div>
	<form action="contact.php" method="POST"></form>
    

<div class="contact-form">
	<div class="header">
	<h2 style="margin-top: 30px;">Request for clearance </h2>
</div>
	<form id="contact">
		<input type="text" name="names" id="button" placeholder="Enter Your Names" required><br> <br>
		<input type="text" name="regno" id="button" placeholder="Enter Your Regno" required><br> <br>
		<input type="email" name="email" id="button" placeholder="Your Email" required><br> <br>
		<select name="progcode" id="type">
	        <option value="-1">Select Your Progcode</option>
	    	<option value="Admin">BIT</option>
	    	<option value="Student">CCS</option>
	    	<option value="Admin">BCOM</option>
	    	<option value="Student">ELIT</option>
	    	<option value="Staff">EDS</option><br><br>
	    </select><br><br>
		<select name="depcode" id="type">
	        <option value="-1">Select Your Department</option>
	    	<option value="Admin">IT</option>
	    	<option value="Student">CS</option>
	    	<option value="Admin">BCOM</option>
	    	<option value="Student">LIT</option>
	    	<option value="Staff">EDUCATION</option><br><br>
	    </select><br><br>
		<textarea type="text" name="reason" id="button2" placeholder="Reason For Clearing" rows="4" required></textarea><br><br>
		<!-- <input type="text" name="message" id="button2" placeholder="Your Message"><br> <br> -->
		<input type="submit" value="SEND REQUEST" name="submit" id="butt">
		<!-- <p>
			Not yet a Member? <a href="register.html" style="
    color: red;
    font-family: cursive;
    font-style: bold;
    /* text-decoration-style: solid; */
">Contact Admin</a>
		</p> -->
	</form>
</header>

</body>
</html>