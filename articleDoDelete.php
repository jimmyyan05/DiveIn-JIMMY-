<?php
require_once("../db_project_connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $type = $_GET['type']; // 'article' 或 'image'

    if ($type === 'article') {
        // 標記文章為已刪除
        $sql = "UPDATE article SET isDeleted = 1 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // 刪除成功，重定向到 articleList.php
            header("Location: articleList.php?delete=success");
            exit();
        } else {
            // 刪除失敗，重定向回 articleList.php 並傳遞錯誤訊息
            header("Location: articleList.php?delete=error");
            exit();
        }
    } else {
        echo "invalid type"; // 無效的請求類型
    }
} else {
    echo "invalid request"; // 無效的請求方法
}

$conn->close();
