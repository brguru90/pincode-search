<?php
$dist=$_GET['dist'];
$village=$_GET['village'];
include('db.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
$sql="select * from place_name where (district='$dist' and village='$village')";
$result=$conn->query($sql);
if ($result->num_rows > 0) {
	$res="";
    while($row = $result->fetch_assoc()) 
	{
		$taluk=$row["taluk"];
		$village=$row["village"];
		$pin=$row["pincode"];
		$res.="$dist\t\t$taluk\t\t$village\t\t$pin\t\t\t\t";
		/*
		echo "<td id='lat'>$lat</td>";
		echo "<td id='lon'>$lon</td>";
		echo "<td><input type='button' value='view on map' onclick='view_map($lat,$lon);' /></td>";
		*/
	}
	echo $res;
}
?>