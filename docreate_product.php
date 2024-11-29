<?php
require_once("../db_project_connect.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST["name"])) {
    die("請循正常管道進入");
}

$name = $_POST["name"];
$category_small = $_POST["category_small"];
$price = $_POST["price"];
$stock = $_POST["stock"];
$size_id = $_POST["size_id"] ?? null;
$color_id = $_POST["color_id"] ?? null;
$brand_id = $_POST["brand_id"] ?? null;

// 檢查必填欄位
if (empty($name) || empty($category_small) || empty($price) || empty($stock)) {
    die("請確實填寫欄位");
}

try {
    // 開始交易
    $conn->begin_transaction();

    // 新增商品資料
    $sql = "INSERT INTO product (product_category_small_id, name, price, stock, status, isDeleted, brand_id) VALUES (?, ?, ?, ?, '上架中', 0, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isiii", $category_small, $name, $price, $stock, $brand_id);

    if (!$stmt->execute()) {
        throw new Exception("商品新增失敗");
    }

    $product_id = $conn->insert_id;

    // 新增商品規格
    if ($size_id || $color_id || $brand_id) {
        $sql = "INSERT INTO product_specification (product_id, size_id, color_id, brand_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiii", $product_id, $size_id, $color_id, $brand_id);

        if (!$stmt->execute()) {
            throw new Exception("商品規格新增失敗");
        }
    }

    // 確保處理多張圖片
    if (isset($_FILES["photo"]) && count($_FILES["photo"]["name"]) > 0) {
        // 處理每一張上傳的圖片
        $upload_dir = __DIR__ . "/img/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // 遍歷每一個上傳的圖片
        for ($i = 0; $i < count($_FILES["photo"]["name"]); $i++) {
            $file = $_FILES["photo"];
            $ext = pathinfo($file["name"][$i], PATHINFO_EXTENSION);
            $filename = time() . "_" . $i . "." . $ext;

            // 檢查圖片是否成功上傳
            if ($file["error"][$i] === 0) {
                if (move_uploaded_file($file["tmp_name"][$i], $upload_dir . $filename)) {
                    // 每張圖片插入資料庫
                    $sql = "INSERT INTO product_image (product_id, name, imgUrl, isMain) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);

                    // 設定第一張圖片為主圖，其他圖片為副圖
                    $isMain = ($i === 0) ? 1 : 0; // 如果是第一張圖片，設為主圖

                    $stmt->bind_param("isss", $product_id, $name, $filename, $isMain);

                    if (!$stmt->execute()) {
                        throw new Exception("圖片資料新增失敗");
                    }
                } else {
                    throw new Exception("圖片上傳失敗");
                }
            }
        }
    }






    // 提交交易
    $conn->commit();
    header("Location: product.php");
    exit;
} catch (Exception $e) {
    // 發生錯誤時回滾交易
    $conn->rollback();
    header("Location: create_product.php?error=" . urlencode($e->getMessage()));
    exit;
} finally {
    $stmt->close();
    $conn->close();
}
