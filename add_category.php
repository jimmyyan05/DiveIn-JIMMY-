<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_log("Received POST request: " . print_r($_POST, true));
require_once("../db_project_connect.php");

// 檢查是否為 POST 請求
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die(json_encode(['success' => false, 'message' => '無效的請求方法']));
}

// 設定回傳的內容類型
header('Content-Type: application/json');

try {
    // 檢查必要欄位
    if (empty($_POST['name'])) {
        throw new Exception('分類名稱不能為空');
    }

    $name = $_POST['name'];
    $description = !empty($_POST['description']) ? $_POST['description'] : "";
    $categoryType = $_POST['categoryType'] ?? 'big';

    // 根據分類類型執行不同的插入操作
    if ($categoryType === 'big') {
        // 新增大分類
        $sql = "INSERT INTO product_category_big (name, description) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception('準備 SQL 語句失敗：' . $conn->error);
        }
        $stmt->bind_param("ss", $name, $description);
    } else {
        // 新增小分類
        if (empty($_POST['parent_id'])) {
            throw new Exception('請選擇所屬大分類');
        }
        $parent_id = $_POST['parent_id'];

        $sql = "INSERT INTO product_category_small (name, description, product_category_big_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception('準備 SQL 語句失敗：' . $conn->error);
        }
        $stmt->bind_param("ssi", $name, $description, $parent_id);
    }

    // 執行 SQL
    if (!$stmt->execute()) {
        throw new Exception('執行 SQL 失敗：' . $stmt->error);
    }

    // 回傳成功訊息
    echo json_encode([
        'success' => true,
        'message' => '分類新增成功',
        'id' => $stmt->insert_id
    ]);
} catch (Exception $e) {
    // 回傳錯誤訊息
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

// 關閉資料庫連線
if (isset($stmt)) {
    $stmt->close();
}
$conn->close();
