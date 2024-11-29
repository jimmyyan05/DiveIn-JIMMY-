<?php
require_once("../db_project_connect.php");

// 接收並解析 JSON 數據
$json = file_get_contents('php://input');
$data = json_decode($json, true);

$response = array();

if (isset($data['id'])) {
    $id = $data['id'];

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
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // 提交事務
            $conn->commit();
            $response['status'] = 'success';
            $response['message'] = '商品及相關資料刪除成功';
        } else {
            // 如果執行失敗，回滾事務
            $conn->rollback();
            $response['status'] = 'error';
            $response['message'] = '刪除失敗：' . $conn->error;
        }

        $stmt->close();
    } catch (Exception $e) {
        // 發生錯誤時回滾事務
        $conn->rollback();
        $response['status'] = 'error';
        $response['message'] = '刪除失敗：' . $e->getMessage();
    }
} else {
    $response['status'] = 'error';
    $response['message'] = '未提供商品ID';
}

// 關閉資料庫連線
$conn->close();

// 返回 JSON 響應
header('Content-Type: application/json');
echo json_encode($response);
