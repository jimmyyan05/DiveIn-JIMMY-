<?php
require_once("../db_project_connect.php");

if (isset($_GET['id'])) {
    $articleId = (int)$_GET['id'];

    // 更新 isDeleted 為 0，表示復原文章
    $sql = "UPDATE article SET isDeleted = 0 WHERE id = $articleId";
    if ($conn->query($sql)) {
        header("Location: articleDeleteList.php");
    } else {
        echo "復原失敗。";
    }
} else {
    echo "無效的文章ID。";
}
?>
