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
$con = $_POST["Contact"];
//$pass = $_POST["Password"];
$loc = $_POST["Location"];


 
 $address = str_replace(" ", "+", $loc); // replace all the white space with "+" sign to match with google search pattern
 $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";
 $response = file_get_contents($url);
 $json = json_decode($response,TRUE); //generate array object from the response from the web
 $lat=$json['results'][0]['geometry']['location']['lat'];
 //echo $lat;
 $lon=$json['results'][0]['geometry']['location']['lng'];
 //echo $lon;

$sql = "INSERT INTO Contributor ( Name, Contact, Location, Time, Latitude, Longitude) VALUES ('$name',$con,'$loc',NOW(),'$lat', '$lon')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

/*$to = "SELECT * FROM Organization";
$result = $conn->query($to);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo "Email".$row["Email"]."<br>"; 
		//$mail->AddAddress($row["Email"]);
		 
    }
} else {
    echo "0 results";
}*/

$conn->close();
?>
