<?php
session_start();
?>
<?php

echo $city= $_GET["q"];
$city = stripslashes($city);
$_SESSION['city']=$city;
$con = mysqli_connect('localhost', 'root', '');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }

mysqli_select_db($con,"movie_booking");

$sql="SELECT * FROM movie WHERE city_id = '$city' and status='Now Showing' group by movie_name";

$result = mysqli_query($con,$sql);

	 echo "<select name ='movie' id ='movie' onchange=\"showdate(this.value)\">";
	 echo "<option value=\"\">--Select Movie--</option>";
while($row = mysqli_fetch_array($result))
  {
	 echo "<option value=".$row['movie_id'].">".$row['movie_name']." </option> ";

  }
		echo "</select>";


//mysqli_close($con);
?>
