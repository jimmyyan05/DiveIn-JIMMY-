<?php
require_once("../db_project_connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    $type = $_GET['type']; // 'image'

    if ($type === 'image') {
        // 標記圖片為已刪除
        $sql = "UPDATE article_image SET isDeleted = 1 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // 刪除成功，返回 success
            echo 'success';
            exit();
        } else {
            // 刪除失敗，返回 error
            echo 'error';
            exit();
        }
    } else {
        echo "invalid type"; // 無效的請求類型
    }
} else {
    echo "invalid request"; // 無效的請求方法
}

$conn->close();
