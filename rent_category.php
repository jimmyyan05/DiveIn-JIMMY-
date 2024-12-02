<?php
include 'PDO_connect.php';

header('Content-Type: application/json');

// 檢查是否傳遞大分類ID
if (isset($_GET['big_category_id'])) {
    $bigCategoryId = intval($_GET['big_category_id']); // 確保ID是整數
    $subcategoryId = isset($_GET['subcategory_id']) ? intval($_GET['subcategory_id']) : 0; // 小分類ID，預設為0（無篩選）
    $smallCategories = [];

    try {
        // 查詢小分類，確保與大分類相關聯
        $stmt = $pdo->prepare("
        SELECT rcs.id, rcs.name
        FROM rent_category_small AS rcs
        INNER JOIN rent_category_big AS rcb
        ON rcs.rent_category_big_id = rcb.id
        WHERE rcb.id = :bigCategoryId
    ");
        $stmt->execute(['bigCategoryId' => $bigCategoryId]);

        // 獲取結果並返回
        $smallCategories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // 捕獲錯誤並返回錯誤信息
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
        exit;
    }

    // 返回小分類數據
    echo json_encode($smallCategories);
    exit;
}

// 如果大分類ID未提供，返回錯誤信息
http_response_code(400);
echo json_encode(['error' => 'Invalid request: big_category_id is missing']);
exit;
