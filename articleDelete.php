<?php
require_once("../db_project_connect.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 修改為更新 isDeleted 欄位為 1
    $sql = "UPDATE article SET isDeleted = 1 WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // 更新成功後跳轉回文章列表頁
        header("Location: articleList.php");
        exit;  // 確保在跳轉後停止執行後續程式碼
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
