 <?php
$servername = "178.159.5.249";
$username = "nsitfmai";
$password = "qDtp:}BlM7Qh";

try {
  $conn = new PDO("mysql:host=$servername;dbname=nsitfmai_ebss", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?> 