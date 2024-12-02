<?php
// 引入資料庫連接檔案
require_once("../db_project_connect.php");

// 確保 id 參數有效

    $id = $_GET['id'];

    // 更新優惠券狀態，標記為已刪除（軟刪除）
    $sql = "UPDATE coupon SET is_deleted = NOW() WHERE id = $id";

    // 執行 SQL 查詢
    if ($conn->query($sql) === TRUE) {
        // 如果成功，提示並重定向回優惠券列表頁
        header("Location: coupon_list.php");
        echo "刪除成功";
        exit;
    } else {
        // 如果失敗，顯示錯誤信息
        echo "刪除資料錯誤: " . $conn->error;
    }


// 關閉資料庫連線
$conn->close();
?>
