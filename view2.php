<?php
session_start();
$dist=$_GET['dist'];
$_SESSION["dist"] = $dist;
include('db.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
$sql="select * from kar_taluk where dist='$dist'";
$result=$conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) 
	{
		echo "<option>".$row["taluk"]."</option>";
	}
}
?>