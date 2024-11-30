<?php
// 資料庫設定
$servername = "localhost";
$username = "admin";
$password = "12345";
$dbname = "test01";

// 建立資料庫連線
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查資料庫連線是否成功
if ($conn->connect_error) {
    echo "<script>console.error('資料庫連線失敗: " . $conn->connect_error . "');</script>";
} else {
    echo "<script>console.log('資料庫連線成功！');</script>";
}

session_start();
