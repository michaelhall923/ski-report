<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ski_resort";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$date = gmdate('Y-m-d');
$query = "SELECT * FROM reports;";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include("head.php") ?>
    <script src="../d3.min.js"></script>
    <title></title>
    <style>
    svg rect {
            fill: orange;
        }

        svg text {
            fill:white;
            font: 10px sans-serif;
            text-anchor: end;
        }
    </style>
  </head>
  <body>
    <?php include("header.php") ?>
            <div class="row">
            <div class="column" style="background-color:white;">
              <h2>Column 1</h2>
              <p>wtf is this</p>
            </div>
            <div class="column" style="background-color:white;">
              <h2>Column 2</h2>
              <p>Some text..</p>
            </div>
            <div class="column" style="background-color:white;">
              <h2>Column 3</h2>
              <p>Some text..</p>
            </div>
          </div>
          <table>
      <?php

            $query = "SELECT * FROM reports where id = 1;";
            $row = $conn->query($query)->fetch_assoc();

            $data = array($row);
            echo json_encode($data);
  ?>
    </table>
    <h1>
      <svg class="chart" width="420" height="120">
        <g transform="translate(0,0)">
            <rect width="50" height="19"></rect>
            <text x="47" y="9.5" dy=".35em">5</text>
        </g>
        <g transform="translate(0,20)">
            <rect width="100" height="19"></rect>
            <text x="97" y="9.5" dy=".35em">10</text>
        </g>
        <g transform="translate(0,40)">
            <rect width="120" height="19"></rect>
            <text x="117" y="9.5" dy=".35em">12</text>
    </h1>
    <?php include("footer.php") ?>
  </body>
</html>
<?php
$conn->close();
?>
