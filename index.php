<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "ski_report";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

$query = "SELECT * FROM reports;";
$reports = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <table>
      <tr>
        <td>Name</td>
        <td>Snowfall</td>
        <td>Price</td>
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
            echo "</tr>";
          }
      }
      ?>
    </table>
  </body>
</html>
<?php
$conn->close();
?>
