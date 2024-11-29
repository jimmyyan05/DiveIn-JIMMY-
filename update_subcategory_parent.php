<?php
require_once("../db_project_connect.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

try {
    $subcategoryId = $_POST['subcategory_id'] ?? null;
    $newParentId = $_POST['new_parent_id'] ?? null;

    $sql = "UPDATE product_category_small SET product_category_big_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $newParentId, $subcategoryId);

    $result = $stmt->execute();

    echo json_encode([
        'success' => $result,
        'message' => $result ? '更新成功' : $conn->error
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
