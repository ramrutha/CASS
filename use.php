<?php

$servername="localhost";
$username="root";
$password="#ammu123";
$dbname="CASS";

$dom = new DOMDocument("1.0");
$node = $dom->createElement("mark");
$parnode = $dom->appendChild($node);

$connection=mysql_connect ('localhost', $username, $password);
if (!$connection) {  die('Not connected : ' . mysql_error());}

$db_selected = mysql_select_db($dbname, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

$query = "SELECT * FROM Contributor WHERE 1";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}
header("Content-type: text/xml");

while ($row = @mysql_fetch_assoc($result)){
  
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name",$row['Name']);
  $newnode->setAttribute("address", $row['Address']);
  $newnode->setAttribute("contact", $row['Contact']);
  $newnode->setAttribute("lat", $row['Latitude']);
  $newnode->setAttribute("lng", $row['Longitude']);
 }
echo $dom->saveXML();
?>
