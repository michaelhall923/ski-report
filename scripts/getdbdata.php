<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ski_resort";

$conn = new mysqli($servername, $username, $password, $database);
$myquery =  "select * from reports where id = 1;";
$query = mysqli_query($conn,$myquery);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
$mydata = array();

for ($x = 0; $x < mysqli_num_rows($query); $x++){
  $mydata [] = mysqli_fetch_assoc($query);
}
echo json_encode($mydata);
mysqli_close($conn);
