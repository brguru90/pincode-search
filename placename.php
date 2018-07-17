<html>
<body>
<p id="status">0</p>
<?php
include('db.php');
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br />";
}
$conn->close();
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
$sql = "create table place_name
(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
country varchar(20),
pincode varchar(20),
village varchar(100),
state varchar(50),
state_code INT(20),
district varchar(50),
dist_code INT(20),
taluk varchar(50),
latitude varchar(50),
longitude varchar(50),
accuracy INT(1),
contact varchar(100)
);";
if ($conn->query($sql) === TRUE) {
	$file="IN.txt";
    echo "New record created successfully";
	echo "<br />";
	$count1=0;
	$count2=0;
	
	$count1=count(file($file));
	$myfile = fopen("$file", "r") or die("Unable to open file!");

	while(!feof($myfile)) {
		$contents=explode("\t",fgets($myfile));
		$sql2= "insert into place_name (country,pincode,village,state,state_code,district,dist_code,taluk,latitude,longitude,accuracy,contact) values('$contents[0]','$contents[1]','$contents[2]','$contents[3]','$contents[4]','$contents[5]','$contents[6]','$contents[7]','$contents[9]','$contents[10]','$contents[11]','Email:brguru90@gmail.com\nWebsite:guruinfo.6te.net');";
		$conn->query($sql2);
		$count2++;
		$per=sprintf ("%d",(($count2*100)/$count1));
		echo "<script>document.getElementById('status').innerHTML='$per%'</script>";
	}
	fclose($myfile);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
</body>
</html>