<?php
ob_start();
session_start();
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="movie_booking"; // Database name 
$tbl_name="users_tbl"; // Table name
// Connect to server and select databse.
$db = mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($db,"$db_name")or die("cannot select DB");

// Define $myusername and $mypassword 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = md5($mypassword);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($db,$myusername);
$mypassword = mysqli_real_escape_string($db,$mypassword);

$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result=mysqli_query($db,$sql);

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
$r = mysqli_fetch_assoc($result);
//print_r($r);
$myemail=$r['email'];
$userlevel=$r["userlevel"];

$_SESSION["myusername"]=$myusername;
$_SESSION["mypassword"]=$mypassword;
//echo $_SESSION['myusername'];
header("location:first.php");
}
else {
echo "Wrong Username or Password";
}

ob_end_flush();
?>


