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

        $sql = "UPDATE product 
                LEFT JOIN product_specification 
                    ON product.id = product_specification.product_id
                LEFT JOIN product_image 
                    ON product.id = product_image.product_id
                SET product.isDeleted = 0,
                    product.deleted_at = NULL,
                    product_specification.isDeleted = 0,
                    product_image.isDeleted = 0
                WHERE product.id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $conn->commit();
            $response['status'] = 'success';
            $response['message'] = '商品復原成功';
        } else {
            $conn->rollback();
            $response['status'] = 'error';
            $response['message'] = '復原失敗：' . $conn->error;
        }

        $stmt->close();
    } catch (Exception $e) {
        $conn->rollback();
        $response['status'] = 'error';
        $response['message'] = '復原失敗：' . $e->getMessage();
    }
} else {
    $response['status'] = 'error';
    $response['message'] = '未提供商品ID';
}

$conn->close();

echo json_encode($response);
exit;
