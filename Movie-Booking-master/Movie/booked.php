<?php
//session_start();
?>
<?php
//$q=$_GET["q"];

$con = mysqli_connect('localhost', 'root', '');
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }
mysqli_select_db($con,"movie_booking");
?>
<html>
<head>
<!--<meta http-equiv="refresh" content="3; URL=main.php">-->
<body>
<p>
  <?php
	$username=$_SESSION['myusername'];
	$movie = $_SESSION['movie'];
	//echo $movie;
	//echo "<br>";
	$date = $_SESSION['date'];
	//echo $date;
	//echo "<br>";
	$stime = $_SESSION['stime'];
	//echo $stime;
	//echo "<br>";
	$tname = 	$_SESSION['tname'];
	//echo $tname;
	//echo "<br>";
	$seat = $_POST['seat'];
	//echo $seat;
	//echo "<br>";
	$sql = "select * from theatre where theatre_name='$tname'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	$tid = $row['theatre_id'];
	//echo $tid;
	//echo "<br>";
	$city=$_SESSION['city'];

	$sql = "select price from movie where movie_name='$movie' and theatre_id='$tid' and date='$date' and showtiming='$stime'";
	$result =mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	$price = $row['price'];
	//echo $price;

	$sql3 = "select * from city where city_name='$city'";
	$result3= mysqli_query($con,$sql3);
	$row = mysqli_fetch_array($result3);
	$cid= $row['city_id'];
	
	
	$sql2 = "select * from movie where movie_name='$movie' and theatre_id='$tid' and date='$date' and city_id='$cid' and showtiming='$stime'";
	$result2 = mysqli_query($con,$sql2);
	$row = mysqli_fetch_array($result2);
	$movieid= $row['movie_id'];



	$sql = "Insert into booked (username,seat,movie_id,theatre_id,date,time,price) values ('$username','$seat','$movieid','$tid','$date','$stime','$price')";
	$result = mysqli_query($con,$sql);
	if($result)
	{
		echo "Ticket booked succesfully";
	}

	$sql = "Update seats set status='booked' where seat=".$_POST['seat']." and movie_id='$movieid' and theatre_id='$tid' and date='$date' and time='$stime'";
	$result = mysqli_query($con,$sql);
?>
</p>
</body>
</head>
</html>