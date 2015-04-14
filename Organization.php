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

$name = $_POST["Name"];
$email = $_POST["Email"];
$pass = $_POST["Password"];
$loc = $_POST["Location"];


 
 $address = str_replace(" ", "+", $loc); // replace all the white space with "+" sign to match with google search pattern
 $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";
 $response = file_get_contents($url);
 $json = json_decode($response,TRUE); //generate array object from the response from the web
 $lat=$json['results'][0]['geometry']['location']['lat'];
 //echo $lat;
 $lon=$json['results'][0]['geometry']['location']['lng'];
 //echo $lon;

$sql = "INSERT INTO Organization ( Name, Email, Password, Location, Latitude, Longitude) VALUES ('$name',$email,'$pass','$lat', '$lon')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
