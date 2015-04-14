<?php
$servername = "localhost";
$username = "root";
$password = "passwd";
$dbname = "CASS";

$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
	die("Connection failed :".$conn->connect_error);
else
	echo "Connected";
	
$sql1 = "DELETE FROM Organization WHERE Time  < DATE_SUB(NOW(),INTERVAL 1 HOUR)";
if ($conn->query($sql1) === TRUE) {
    echo "Deleted successfully";
} else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
}

$conn->close();
?>
