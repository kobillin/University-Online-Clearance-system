<?php
$regno = $_POST['regno'];
$nID = $_POST['nID'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$surname = $_POST['surname'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$status = $_POST['status'];
$nationality = $_POST['nationality'];
$county = $_POST['county'];
$dob = $_POST['dob'];
$prog_code = $_POST['prog_code'];
// $phonecode= $_POST['phonecode'];
$num= $_POST['num'];
$yos = $_POST['yos'];
$password = $_POST['password'];
$conn = new mysqli('localhost', 'root','','clearance');
  if ($conn->connect_error){
    die('connection Failed :'.$conn->connect_error);
  } else{
    $stmt = $conn->prepare("INSERT into student (regno, nID, fname,lname, surname, gender, num, address, yos, status, nationality, county, dob, prog_code, password) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssssii", $regno, $nID, $fname,$lname, $surname, $gender, $num, $address, $yos, $status, $nationality, $county, $dob, $prog_code, $password());
    $stmt->execute();
    echo "Registration sucessfully...";
    $stmt->close();
    $conn->close();
  }
?>








