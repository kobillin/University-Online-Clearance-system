<?php
   
$servername="localhost";
$username="root";
$password=" ";
$dbname="clearance";
 $con=mysqli_connect("localhost","root","","clearance");
if(mysqli_connect_error())
{
	echo "connection failed;".mysqli_connect_error();

}
else
{
	echo "Uko ndani";

}

?>
