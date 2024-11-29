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

// 檢查必要參數
if (!isset($_POST['image_id']) || !isset($_POST['product_id'])) {
    echo json_encode(['success' => false, 'message' => '缺少必要參數']);
    exit;
}

$image_id = filter_var($_POST['image_id'], FILTER_VALIDATE_INT);
$product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);

if ($image_id === false || $product_id === false) {
    echo json_encode(['success' => false, 'message' => '無效的參數值']);
    exit;
}

try {
    $conn->begin_transaction();

    // 先將該產品的所有圖片設為非主圖
    $reset_sql = "UPDATE product_image 
                 SET isMain = 0 
                 WHERE product_id = ? AND isDeleted = 0";
    $reset_stmt = $conn->prepare($reset_sql);
    $reset_stmt->bind_param("i", $product_id);
    $reset_stmt->execute();

    // 設定新的主圖
    $update_sql = "UPDATE product_image 
                  SET isMain = 1 
                  WHERE id = ? AND isDeleted = 0";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("i", $image_id);
    $update_stmt->execute();

    $conn->commit();
    echo json_encode(['success' => true, 'message' => '已成功設定為主圖']);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
