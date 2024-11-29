<?php
require_once("../db_project_connect.php");
header('Content-Type: application/json');

try {
    $subcategoryId = $_POST['subcategory_id'];
    $targetIndex = $_POST['target_index'];

    $sql = "SELECT product_category_big_id, sort_order FROM product_category_small WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $subcategoryId);
    $stmt->execute();
    $currentItem = $stmt->get_result()->fetch_assoc();

    // 先執行順序交換
    $sql1 = "UPDATE product_category_small 
            SET sort_order = CASE
                WHEN id = ? THEN ?  
                WHEN sort_order = ? THEN ?
                ELSE sort_order
            END
            WHERE product_category_big_id = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param(
        'iiiii',
        $subcategoryId,
        $targetIndex,
        $targetIndex,
        $currentItem['sort_order'],
        $currentItem['product_category_big_id']
    );
    $stmt1->execute();

    // 然後執行重新排序
    $sql2 = "SET @rank := 0";
    $conn->query($sql2);

    $sql3 = "UPDATE product_category_small 
             SET sort_order = (@rank:= @rank + 1)
             WHERE product_category_big_id = ?
             ORDER BY sort_order";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->bind_param('i', $currentItem['product_category_big_id']);
    $stmt3->execute();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
