<?php
session_start();
?>
<?php
 $movieid=$_GET["q"];
$cityid= $_SESSION['city'];
$con = mysqli_connect('localhost', 'root', '');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysqli_select_db($con,"movie_booking");

$sql="SELECT * FROM movie WHERE movie_id = '$movieid' and status='Now Showing' and city_id='$cityid' group by date";

$result = mysqli_query($con,$sql);

	 echo "<select name ='date' id ='date'>";
	 echo "<option value=\"\">--Select Date--</option>";
while($row = mysqli_fetch_array($result))
  {
	  
	 echo "<option value=".$row['date'].">".$row['date']." </option> ";
  }
		echo "</select>";


//mysqli_close($con);
?>
