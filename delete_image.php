<?php
require_once("../db_project_connect.php");

// 啟用錯誤報告
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 設定回應的內容類型為 JSON
header('Content-Type: application/json');

// 檢查請求方法
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => '無效的請求方法']);
    exit;
}

// 檢查是否有圖片ID
if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => '未提供圖片ID']);
    exit;
}

$image_id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

if ($image_id === false) {
    echo json_encode(['success' => false, 'message' => '無效的圖片ID']);
    exit;
}

try {
    $conn->begin_transaction();

    // 先獲取圖片信息
    $query = "SELECT imgUrl, isMain, product_id FROM product_image WHERE id = ? AND isDeleted = 0";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $image_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $image = $result->fetch_assoc();

    if (!$image) {
        throw new Exception('找不到該圖片');
    }

    // 軟刪除圖片記錄
    $sql = "UPDATE product_image SET isDeleted = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $image_id);

    if (!$stmt->execute()) {
        throw new Exception('刪除圖片記錄失敗');
    }

    // 如果是主圖，需要設定其他圖片為主圖
    if ($image['isMain']) {
        $update_main_sql = "UPDATE product_image 
                           SET isMain = 1 
                           WHERE product_id = ? 
                           AND id != ? 
                           AND isDeleted = 0 
                           LIMIT 1";
        $stmt = $conn->prepare($update_main_sql);
        $stmt->bind_param("ii", $image['product_id'], $image_id);
        $stmt->execute();
    }

    // 嘗試從檔案系統中刪除圖片檔案
    $file_path = 'img/' . $image['imgUrl'];
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    $conn->commit();
    echo json_encode(['success' => true, 'message' => '圖片已成功刪除']);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
