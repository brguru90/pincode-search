<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="place";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
$sql = "create table kar_dist
(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
dist varchar(20) unique
);";
$conn->query($sql);
$sql = "create table kar_taluk
(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
dist varchar(20),
taluk varchar(20) unique
);";
$conn->query($sql);



$sql="select * from place_name where state='karnataka'";
$result=$conn->query($sql);
if ($result->num_rows > 0) {
	
    while($row = $result->fetch_assoc()) 
	{
			$district=$row["district"];
			$taluk=$row["taluk"];
			$sql= "insert into kar_dist (dist) values ('$district')";
			$conn->query($sql);
			$sql= "insert into kar_taluk (dist,taluk) values ('$district','$taluk')";
			$conn->query($sql);
	}
}

?>