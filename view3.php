<?php
session_start();
$taluk=$_GET['taluk'];
$_SESSION["taluk"] = $taluk;
include('db.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
$sql="select * from place_name where district='".$_SESSION['dist']."' and taluk='$taluk'";
$result=$conn->query($sql);
echo "<form action='view4.php' method='get'>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) 
	{
		echo "<option value='".$row["village"]."'>".$row["village"]."</option>";
	}
}
?>