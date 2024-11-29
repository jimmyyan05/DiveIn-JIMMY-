<?php
require_once("../db_project_connect.php");

// 接收 POST 數據
$response = array();

if (isset($_POST['ids']) && is_array($_POST['ids'])) {
    $ids = $_POST['ids'];

    try {
        // 開始事務
        $conn->begin_transaction();

        // 完整的資料庫名稱和表格名稱
        $sql = "UPDATE my_project_db.product AS product
                LEFT JOIN my_project_db.product_specification AS product_specification 
                    ON product.id = product_specification.product_id
                LEFT JOIN my_project_db.product_image AS product_image 
                    ON product.id = product_image.product_id
                SET product.isDeleted = 1,
                    product.deleted_at = NOW(),
                    product_specification.isDeleted = 1,
                    product_image.isDeleted = 1
                WHERE product.id = ?";

        $stmt = $conn->prepare($sql);

        $success = true;
        $deleteCount = 0;

        // 對每個 ID 執行刪除操作
        foreach ($ids as $id) {
            $stmt->bind_param("i", $id);
            if (!$stmt->execute()) {
                $success = false;
                break;
            }
            $deleteCount++;
        }

        if ($success) {
            // 提交事務
            $conn->commit();
            $response['success'] = true;
            $response['message'] = "成功刪除 {$deleteCount} 個商品及其相關資料";
        } else {
            // 如果執行失敗，回滾事務
            $conn->rollback();
            $response['success'] = false;
            $response['message'] = '批次刪除過程中發生錯誤：' . $conn->error;
        }

        $stmt->close();
    } catch (Exception $e) {
        // 發生錯誤時回滾事務
        $conn->rollback();
        $response['success'] = false;
        $response['message'] = '批次刪除失敗：' . $e->getMessage();
    }
} else {
    $response['success'] = false;
    $response['message'] = '未提供要刪除的商品ID清單';
}

// 關閉資料庫連線
$conn->close();

// 返回 JSON 響應
header('Content-Type: application/json');
echo json_encode($response);
