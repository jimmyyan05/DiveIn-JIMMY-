<?php
require_once("../db_project_connect.php");

// 設定錯誤報告
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 接收並解析 JSON 數據
$json = file_get_contents('php://input');
$data = json_decode($json, true);

$response = array();

if (isset($data['id']) && isset($data['status'])) {
    try {
        // 開始交易
        $conn->begin_transaction();

        // 更新商品狀態
        $sql = "UPDATE product SET status = ? WHERE id = ? AND isDeleted = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $data['status'], $data['id']);

        if ($stmt->execute()) {
            // 提交交易
            $conn->commit();

            $response['status'] = 'success';
            $response['message'] = "商品狀態已更新為：" . $data['status'];
        } else {
            throw new Exception($conn->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        // 發生錯誤時回滾交易
        $conn->rollback();

        $response['status'] = 'error';
        $response['message'] = '狀態更新失敗：' . $e->getMessage();
    }
} else {
    $response['status'] = 'error';
    $response['message'] = '缺少必要參數';
}

// 關閉資料庫連線
$conn->close();

// 返回 JSON 響應
header('Content-Type: application/json');
echo json_encode($response);
