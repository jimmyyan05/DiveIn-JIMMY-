<?php
$servername = "127.0.0.1";
$username = "admin";
$password = "12345";
$dbname = "my_project_rent";
$port = 3306;
$dsn = "mysql:host=$servername;port=$port;dbname=$dbname";

try {
  $pdo = new PDO(
    "mysql:host={$servername};
     dbname={$dbname};
     port={$port};
     charset=utf8", 
    $username, 
    $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e) {
  echo "資料庫連線失敗<br>";
  echo "Error: " .$e->getMessage() ."<br>";
  exit;
}
?>