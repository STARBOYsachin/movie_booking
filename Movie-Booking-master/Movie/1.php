<html>
<?php
	//session_start();
	$city = $_POST['city'];
	$movie = $_POST['movie'];
	$date = $_POST['date'];
    //$city = $_SESSION["city"];
    $_SESSION['city'] = $city;
    $_SESSION['movie'] = $movie;
    $_SESSION['date'] = $date;
	$tname = $_POST['tname'];
	$stime = $_POST['stime'];
	$stime = stripslashes($stime);
	$_SESSION["stime"]=$stime;
	$tname = stripslashes($tname);
	$_SESSION["tname"]=$tname;
	?>
<head>
    <?php
    $con = mysqli_connect('localhost', 'root', '');
    if (!$con)
      {
      die('Could not connect: ' . mysqli_error());
      }
    mysqli_select_db($con,"movie_booking");
    ?>
    <title>Book Ur Show</title>
</head>
<body>
      <?php
           // echo $movie;
            $sql= "select distinct(movie_name) from movie where movie_name='$movie'";
            $result = mysqli_query($con,$sql);
            //echo mysqli_error($con);
            $row = mysqli_fetch_assoc($result);
            $movie= $row['movie_name'];

            $sql= "select distinct(city_name) from city where city_name='$city'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result);
            $city= $row['city_name'];
            
            $sql3 = "select * from city where city_name='$city'";
            $result3= mysqli_query($con,$sql3);
            $row = mysqli_fetch_array($result3);
            $cid= $row['city_id'];
            
            $sql4 = "select * from theatre where theatre_name='$tname'";
            $result4= mysqli_query($con,$sql4);
            $row = mysqli_fetch_array($result4);
            $tid= $row['theatre_id'];
            
            $sql2 = "select * from movie where movie_name='$movie' and theatre_id='$tid' and date='$date' and city_id='$cid' and showtiming='$stime'";
            $result2 = mysqli_query($con,$sql2);
            $row = mysqli_fetch_array($result2);
            $movieid= $row['movie_id'];
            echo $movieid;

      ?>
      <form method="post" action="booked.php">
            city:
            <input name="city" value="<?php echo $city; ?>">
            <br>
            movie:
            <input name="movie" value="<?php echo $movie; ?>">
            <br>
            Theathre:
            <input name="tname" value="<?php echo $tname?>">
            <br>
            Date:
            <input name="date" value="<?php echo $date?>">
            <br>
            show time:
            <input name="stime" value="<?php echo $stime?>">

            <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="">
<tr>
<td width="108">Select Seat</td>
<td width="6">:</td>
<td width="294">
<select name ='seat' id = 'seat'>
<option value=""> </option>
<?php $tbl_name="seats"; // Table name ?>
<?php $result= mysqli_query($con,"SELECT * FROM $tbl_name where date='$date' and movie_id='$movieid' and time='$stime' and status='not booked' and theatre_id='$tid'"); ?> 
    <?php while($row= mysqli_fetch_assoc($result)) { ?> 
        <option value="<?php echo $row['seat'];?>"> 
            <?php echo $row['seat']; ?> 
        </option> 
    <?php } ?> 
</select>
</td>
</tr>
<tr>
<td></td>
<td></td>
<td><input name="submit" type="Submit" value="Book Ticket" />
</tr>
</table>
</td>
</tr>
</table> 
</form>
</body>
</html>
