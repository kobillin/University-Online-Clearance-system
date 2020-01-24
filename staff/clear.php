<?php require_once('connection.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
if($fac="RAA"){$status="1";}else{$status="0";}
  $insertSQL = sprintf("INSERT INTO clear (clearid,regno, staffno, departmentid,status) VALUES (%s, %s, %s,%s, '$status')",
                       GetSQLValueString($_POST['clearid'], "int"),
					    GetSQLValueString($_POST['regno'], "text"),
                       GetSQLValueString($_POST['staffno'], "text"),
                       GetSQLValueString($_POST['departmentid'], "text"));

  mysql_select_db($database_kibabii, $kibabii);
  $Result1 = mysql_query($insertSQL, $kibabii) or die(mysql_error());

  $insertGoTo = "clear.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}



$colname_stffdets = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_stffdets = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
mysql_select_db($database_kibabii, $kibabii);
$query_stffdets = sprintf("SELECT * FROM staffdetails,facultydetails WHERE facultydetails.facultyid=staffdetails.facultyid and staffno = '%s'", $colname_stffdets);
$stffdets = mysql_query($query_stffdets, $kibabii) or die(mysql_error());
$row_stffdets = mysql_fetch_assoc($stffdets);
$totalRows_stffdets = mysql_num_rows($stffdets);

$maxRows_clear = 10;
$pageNum_clear = 0;
if (isset($_GET['pageNum_clear'])) {
  $pageNum_clear = $_GET['pageNum_clear'];
}
mysql_select_db($database_kibabii, $kibabii);
$query_facdets = sprintf("SELECT facultydetails.facultyid,departmentdetails.facultyid FROM departmentdetails,facultydetails where departmentdetails.facultyid=facultydetails.facultyid group by facultydetails.facultyid", $colname_facdets);
$facdets = mysql_query($query_facdets, $kibabii) or die(mysql_error());
$row_facdets = mysql_fetch_assoc($facdets);
$totalRows_facdets = mysql_num_rows($facdets);
$startRow_clear = $pageNum_clear * $maxRows_clear;

$colname_clear = "-1";
$dept =  $row_stffdets['departmentid'];
$user = $_SESSION['MM_Username'];
$usert = $_SESSION['MM_UserGroup'];
$fac = $row_stffdets['facultyid'];
if($fac != "RAA" && $fac != "VD"){
$dep=$_GET['dep'];
mysql_select_db($database_kibabii, $kibabii);
$query_clear = sprintf("SELECT clearance.regno,clearance.programmeid,clearance.departmentid,clearance.facultyid,clear.status,clear.staffno FROM clearance,clear WHERE clearance.departmentid='$dept' and clear.staffno<>'$user' and clear.regno<>clearance.regno and clear.status=0 group by clearance.regno", $colname_clear);
$query_limit_clear = sprintf("%s LIMIT %d, %d", $query_clear, $startRow_clear, $maxRows_clear);
$clear = mysql_query($query_limit_clear, $kibabii) or die(mysql_error());
$row_clear = mysql_fetch_assoc($clear);
}

else if($fac == "VD"){

$dep=$_GET['dep'];
mysql_select_db($database_kibabii, $kibabii);
$query_clear = sprintf("SELECT clearance.regno,clearance.programmeid,clearance.departmentid,clearance.facultyid,clear.status,clear.staffno FROM clearance,clear WHERE clear.staffno<>'$user' and clear.regno<>clearance.regno and clearance.departmentid='$dep' and clear.status=0 group by clearance.regno", $colname_clear);
$query_limit_clear = sprintf("%s LIMIT %d, %d", $query_clear, $startRow_clear, $maxRows_clear);
$clear = mysql_query($query_limit_clear, $kibabii) or die(mysql_error());
$row_clear = mysql_fetch_assoc($clear);
}
else if($fac == "RAA"){
$dep=$_GET['dep'];
mysql_select_db($database_kibabii, $kibabii);
$query_clear = sprintf("SELECT clearance.regno,clearance.programmeid,clearance.departmentid,clearance.facultyid,clear.status,clear.staffno FROM clearance,clear WHERE clear.staffno<>'$user' and clear.regno<>clearance.regno and clearance.departmentid='$dep' and clear.status=0  group by clearance.regno", $colname_clear);
$query_limit_clear = sprintf("%s LIMIT %d, %d", $query_clear, $startRow_clear, $maxRows_clear);
$clear = mysql_query($query_limit_clear, $kibabii) or die(mysql_error());
$row_clear = mysql_fetch_assoc($clear);
}

else{
mysql_select_db($database_kibabii, $kibabii);
$query_clear = sprintf("SELECT * FROM clear where status=0", $colname_clear);
$query_limit_clear = sprintf("%s LIMIT %d, %d", $query_clear, $startRow_clear, $maxRows_clear);
$clear = mysql_query($query_limit_clear, $kibabii) or die(mysql_error());
$row_clear = mysql_fetch_assoc($clear);}
if (isset($_GET['totalRows_clear'])) {
  $totalRows_clear = $_GET['totalRows_clear'];
} else {
  $all_clear = mysql_query($query_clear);
  $totalRows_clear = mysql_num_rows($all_clear);
}
$totalPages_clear = ceil($totalRows_clear/$maxRows_clear)-1;
$dept =  $row_stffdets['departmentid'];
mysql_select_db($database_kibabii, $kibabii);
$query_cleared = "SELECT clear.regno,clear.staffno,clear.departmentid FROM clear";
$cleared = mysql_query($query_cleared, $kibabii) or die(mysql_error());
$row_cleared = mysql_fetch_assoc($cleared);
$totalRows_cleared = mysql_num_rows($cleared);

$colname_approval = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_approval = (get_magic_quotes_gpc()) ? $_SESSION['MM_Username'] : addslashes($_SESSION['MM_Username']);
}
$reg = $row_clear['regno'];
mysql_select_db($database_kibabii, $kibabii);
$query_approval = sprintf("SELECT * FROM clear WHERE staffno = '%s' AND regno='$reg'", $colname_approval);
$approval = mysql_query($query_approval, $kibabii) or die(mysql_error());
$row_approval = mysql_fetch_assoc($approval);
$totalRows_approval = mysql_num_rows($approval);

$queryString_clear = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_clear") == false && 
        stristr($param, "totalRows_clear") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_clear = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_clear = sprintf("&totalRows_clear=%d%s", $totalRows_clear, $queryString_clear);


mysql_select_db($database_kibabii, $kibabii);
$query_DEFAC = "SELECT * FROM departmentdetails WHERE facultyid != 'VD'and facultyid != 'RAA'";
$DEFAC = mysql_query($query_DEFAC, $kibabii) or die(mysql_error());
$row_DEFAC = mysql_fetch_assoc($DEFAC);
$totalRows_DEFAC = mysql_num_rows($DEFAC);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../styles.css" />
<title>Untitled Document</title>
</head>

<body>
<div class="header"><a href="<?php echo $logoutAction ?>" style="float:right; margin-right:30px; text-decoration:none;">Logout</a></div>
<center>
<p>&nbsp;</p><main><section class="panel1">
<?php echo $row_stffdets['departmentid']; echo $_SESSION['MM_Username'];?>
<a href="../printcleared.php"><button>View Cleared</button></a>
<p><form method="get" name="for1" >
<select name="dep">
<?php do { ?>
<option value="<?PHP echo $row_DEFAC['departmentid']; ?>"><?PHP if($fac == "VD" || $fac == "RAA"){
echo $row_DEFAC['departmentname'];}
else{ '';}
 ?></option>

 <?php } while ($row_DEFAC = mysql_fetch_assoc($DEFAC)); ?>
</select>
<input type="submit" value="Filter" />
</form></p>
<table border="1" cellpadding="4" cellspacing="0" align="center">
  <tr>
    <td>regno</td>
    <td>programmeid</td>
    <td>departmentid</td>
    <td>facultyid</td>
	<td>&nbsp;</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><a href="stdcleardetails.php?recordID=<?php echo $row_clear['regno']; ?>"> <?php echo $row_clear['regno']; ?>&nbsp; </a> </td>
      <td><?php echo $row_clear['programmeid']; ?>&nbsp; </td>
      <td><?php echo $row_clear['departmentid']; ?>&nbsp; </td>
      <td><?php echo $row_clear['facultyid']; ?>&nbsp; </td>
	  <td><form method="POST" name="form1" action="<?php echo $editFormAction; ?>">
      <?php
	    
		$r = $row_approval['regno'];
		$r2 = $row_clear['regno'];
		$r3 = $row_clear['status'];
		$s = $_SESSION['MM_Username'];
		$s1 = $row_clear['staffno'];
		
		
			if(($r == $r2) && ($s == $s1))
			{
			print '<input type="submit" value="Approved">';
			}
			else{
			print '<input type="submit" value="Clear"><br>
			<a href="dissaprove.php?id='.$r2.'"><input style="display:block;
	width:80%;
	font-size:1rem;
	padding:0.5rem;
	border:2px solid #0cf;
	color:#000;
	border-radius:0.2rem;
	outline:0;
	margin:0 0.2rem;
	background:#0cf;" type="button" value="Unclear"></a>';
			}
		?>
		
		
	    <input type="hidden" name="MM_update" value="form1">
        <input type="hidden" name="clearid" value="<?php echo $row_clear['clearanceid']; ?>">
		  <input type="hidden" name="regno" value="<?php echo $row_clear['regno']; ?>">
		<input type="hidden" name="departmentid" value="<?php echo $row_stffdets['departmentid']; ?>">
		<input type="hidden" name="staffno" value="<?php echo $row_stffdets['staffno']; ?>" />
		<input type="hidden" name="MM_insert" value="form1">

      </form>
	    </td>
    </tr>
    <?php } while ($row_clear = mysql_fetch_assoc($clear)); ?>
</table>
<br>
<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_clear > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_clear=%d%s", $currentPage, 0, $queryString_clear); ?>">First</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_clear > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_clear=%d%s", $currentPage, max(0, $pageNum_clear - 1), $queryString_clear); ?>">Previous</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_clear < $totalPages_clear) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_clear=%d%s", $currentPage, min($totalPages_clear, $pageNum_clear + 1), $queryString_clear); ?>">Next</a>
          <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_clear < $totalPages_clear) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_clear=%d%s", $currentPage, $totalPages_clear, $queryString_clear); ?>">Last</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
Records <?php echo ($startRow_clear + 1) ?> to <?php echo min($startRow_clear + $maxRows_clear, $totalRows_clear) ?> of <?php echo $totalRows_clear ?> </section>
</main>

</body>
</html>
<?php
mysql_free_result($stffdets);

mysql_free_result($clear);

mysql_free_result($cleared);

mysql_free_result($approval);
?>
 