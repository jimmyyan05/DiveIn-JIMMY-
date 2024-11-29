<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
require_once("../db_project_connect.php");

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$response = array();

if (isset($data['id'])) {
    $id = $data['id'];

    try {
        $conn->begin_transaction();

        // 首先刪除相關的產品圖片記錄
        $sql_delete_images = "DELETE FROM product_image WHERE product_id = ?";
        $stmt_images = $conn->prepare($sql_delete_images);
        $stmt_images->bind_param("i", $id);
        $stmt_images->execute();
        $stmt_images->close();

        // 刪除產品規格記錄
        $sql_delete_specs = "DELETE FROM product_specification WHERE product_id = ?";
        $stmt_specs = $conn->prepare($sql_delete_specs);
        $stmt_specs->bind_param("i", $id);
        $stmt_specs->execute();
        $stmt_specs->close();

        // 最後刪除產品主記錄
        $sql_delete_product = "DELETE FROM product WHERE id = ?";
        $stmt_product = $conn->prepare($sql_delete_product);
        $stmt_product->bind_param("i", $id);

        if ($stmt_product->execute()) {
            $conn->commit();
            $response['status'] = 'success';
            $response['message'] = '商品已永久刪除';
        } else {
            throw new Exception($conn->error);
        }

        $stmt_product->close();
    } catch (Exception $e) {
        $conn->rollback();
        $response['status'] = 'error';
        $response['message'] = '刪除失敗：' . $e->getMessage();
    }
} else {
    $response['status'] = 'error';
    $response['message'] = '未提供商品ID';
}

$conn->close();

echo json_encode($response);
exit;
