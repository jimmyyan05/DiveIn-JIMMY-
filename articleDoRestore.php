<?php
require_once("../db_project_connect.php");

// 檢查是否提供了文章 ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $articleId = (int)$_GET['id'];

    // 更新資料庫，將該文章的 isDeleted 欄位設為 0 (復原)
    $sql = "UPDATE article SET isDeleted = 0 WHERE id = $articleId";

    if ($conn->query($sql) === TRUE) {
        // 成功，重定向到文章列表頁
        header("Location: articleList.php?status=1&isDeleted=1");
        exit;
    } else {
        // 失敗，顯示錯誤信息
        echo "錯誤: " . $conn->error;
    }
} else {
    echo "無效的文章 ID。";
}
