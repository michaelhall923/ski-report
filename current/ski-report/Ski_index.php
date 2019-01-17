<script src='https://d3js.org/d3.v4.min.js'></script>
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
$reports = $conn->query($query);
echo $query
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include("head.php") ?>
    <title></title>
  </head>
  <body>
    <?php include("header.php") ?>
            <div class="row">
            <div class="column" style="background-color:white;">
              <h2>Column 1</h2>
              <p>Some text..</p>
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
            $query = "SELECT * FROM reports;";
            $row = $conn->query($query)->fetch_assoc();
            print_r($row)

      ?>
    </table>
    <h1>
      Best Value
    </h1>
    <?php include("footer.php") ?>
  </body>
</html>
<?php
$conn->close();
?>
