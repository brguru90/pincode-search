<html>
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
		echo $row["pincode"];
	}
}
?>
</html>