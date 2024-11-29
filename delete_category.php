<?php
require_once("../db_project_connect.php");


$validTables = ['product_category_big', 'product_category_small'];

try {
    // 從 POST 中獲取 id 和 table
    $id = $_POST["id"];
    $table = $_POST["table"];

    // 檢查傳遞的表名是否有效
    if (!in_array($table, $validTables)) {
        throw new Exception("無效的表名");
    }

    // 準備 SQL 刪除語句
    $sql = "DELETE FROM `$table` WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // 執行刪除操作
    if ($stmt->execute()) {
        echo "刪除成功";
    } else {
        // 如果執行失敗，拋出異常
        throw new Exception("刪除失敗，錯誤原因：" . $stmt->error);
    }
} catch (Exception $e) {
    // 捕捉異常並顯示詳細錯誤訊息
    echo "發生錯誤: " . $e->getMessage();
}
