<?php
session_start();
$village=$_GET['village'];
include('db.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
$sql="select * from place_name where (district='".$_SESSION['dist']."' and taluk='".$_SESSION['taluk']."') and village='$village'";
$result=$conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) 
	{
		$lat=$row["latitude"];
		$lon=$row["longitude"];
		echo "$lat\t$lon";
		/*
		echo "<td id='lat'>$lat</td>";
		echo "<td id='lon'>$lon</td>";
		echo "<td><input type='button' value='view on map' onclick='view_map($lat,$lon);' /></td>";
		*/
	}
}
?>