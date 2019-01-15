<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$date = gmdate('Y-m-d');
$query = "SELECT * FROM reports WHERE date = \"{$date}\";";
$reports = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include("head.php") ?>
    <title></title>
  </head>
  <body>
    <?php include("header.php") ?>
    <table>
      <tr>
        <td>Name</td>
        <td>Snowfall</td>
        <td>Price</td>
        <td>Date</td>
      </tr>
      <?php
      if ($reports->num_rows > 0) {
          while($row = $reports->fetch_assoc()) {
            $query = "SELECT * FROM resorts WHERE id = {$row['resort_id']};";
            $resort = $conn->query($query)->fetch_assoc();
            echo "<tr>";
            echo "<td>{$resort['name']}</td>";
            echo "<td>{$row['snowfall']}</td>";
            echo "<td>{$row['price']}</td>";
            echo "<td>{$row['date']}</td>";
            echo "</tr>";
          }
      }
      ?>
    </table>
    <h1>
    </h1>
    <?php include("footer.php") ?>
  </body>
</html>
<?php
$conn->close();
?>
