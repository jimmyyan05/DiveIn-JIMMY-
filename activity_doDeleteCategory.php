<?php

require_once("../db_project_connect.php");

// 刪除小分類
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['small_id']) && !empty($_POST['small_id'])) {
        $smallId = $_POST['small_id'];

        // 刪除單獨的小分類
        $stmt = $conn->prepare("DELETE FROM activity_category_small WHERE id = ?");
        $stmt->bind_param("i", $smallId);

        if ($stmt->execute()) {
            echo "小分類刪除成功";
        } else {
            echo "小分類刪除失敗：" . $conn->error;
        }
    }
    // 刪除大分類及其所有小分類
    elseif (isset($_POST['big_id']) && !empty($_POST['big_id'])) {
        $bigId = $_POST['big_id'];

        // 開始刪除大分類之前，先刪除該大分類下的所有小分類
        $stmt = $conn->prepare("DELETE FROM activity_category_small WHERE activityCategoryBig_id = ?");
        $stmt->bind_param("i", $bigId);
        $stmt->execute();  // 刪除該大分類下的所有小分類

        // 然後刪除大分類
        $stmt = $conn->prepare("DELETE FROM activity_category_big WHERE id = ?");
        $stmt->bind_param("i", $bigId);

        if ($stmt->execute()) {
            echo "大分類及其小分類刪除成功";
        } else {
            echo "大分類刪除失敗：" . $conn->error;
        }
    } else {
        echo "無效的分類 ID";
    }
}

header("location: activityCategory.php"); // 完成後返回活動分類頁
?>