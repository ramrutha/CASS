<?php
error_reporting(E_ALL);
$servername="localhost";
$username="root";
$password="passwd";
$dbname = "CASS";
$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
	die("Connection failed :".$conn->connect_error);
else
	echo "Connected";

$to = "SELECT Email FROM Organization";
$result = $conn->query($to);

require("class.phpmailer.php");
require("class.smtp.php");
$mail=new PHPMailer();

$mail->IsSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
//$mail->SMTPDebug = 0;
$mail->Mailer = "smtp";
$mail->SMTPAuth = true;

$mail->Username = 'myemail@gmail.com';
$mail->Password = 'password';
$mail->SMTPSecure = 'ssl';

$mail->From = "myemail@gmail.com";

if ($result->num_rows > 0) {
     while($row = $result->fetch_assoc()) {
		//echo "Email".$row["Email"]."<br>"; 
		$mail->AddAddress($row["Email"]);
		 
    }
} else {
    echo "0 results";
}
$mail->AddAddress("$to");

$mail->WordWrap = 50;
$mail->Subject = "First Trial";
//$mail->Body = "This is a trial message being sent to you to confirm that this PHP script is working perfectly\r\nThe neext step is to try extracting the values from my database as PDO's and automate this process\r\nCheers\r\n";
$mail->Body = "This is an email to notify that there are people who wish to contribute food to your Organization\r\nHis Contact details can be viewed on the Map marker(onclick)\r\n Link:http://localhost/maps.html";

if(!$mail->Send())
{
	echo 'Message was not sent';
	echo 'Mailer error:'.$mail->ErrorInfo;
}
else
{
	echo 'Message sent';
}
?>
