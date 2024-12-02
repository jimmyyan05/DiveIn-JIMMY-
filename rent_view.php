<?php
include 'PDO_connect.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    $sql = "
SELECT ri.id AS product_id, ri.name, ri.price, ri.start_date, ri.end_date,
       rcs.name AS small_category_name, rcb.name AS big_category_name,
       ri.stock, ri.description,
       IFNULL(ri_img.img_url, '') AS main_img_url,
       ri.price * 0.6 AS deposit
        FROM rent_item ri
        LEFT JOIN rent_image ri_img ON ri.id = ri_img.rent_item_id AND ri_img.is_main = 1
        LEFT JOIN rent_category_small rcs ON ri.rent_category_small_id = rcs.id
        LEFT JOIN rent_category_big rcb ON rcs.rent_category_big_id = rcb.id
        WHERE ri.id = :id AND ri.is_deleted = 0
        ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        echo json_encode($product);
    } else {
        echo json_encode(['error' => '產品未找到']);
    }
} else {
    echo json_encode(['error' => '無效的產品id']);
}
