<?php
echo "<pre>";
print_r($images);
echo "</pre>";
session_start();
require_once("../db_project_connect.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

// 檢查是否有 POST 請求
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("錯誤的請求方法");
}

// 先打印所有接收到的POST數據，用於除錯
echo "<pre>接收到的POST數據：\n";
print_r($_POST);
echo "</pre>";

// 驗證每個欄位並記錄問題
$validation_errors = [];

// 檢查並驗證 ID
if (!isset($_POST["id"])) {
    $validation_errors[] = "缺少商品ID";
} else {
    $id = filter_var($_POST["id"], FILTER_VALIDATE_INT);
    if ($id === false) {
        $validation_errors[] = "商品ID格式錯誤：" . $_POST["id"];
    }
}

// 檢查並驗證名稱
if (!isset($_POST["name"]) || empty(trim($_POST["name"]))) {
    $validation_errors[] = "商品名稱不能為空";
} else {
    $name = trim($_POST["name"]);
}

// 檢查並驗證分類
if (!isset($_POST["category_small"]) || $_POST["category_small"] === "") {
    if (isset($_POST["category_big"]) && !empty($_POST["category_big"])) {
        // 如果有主分類，查找該主分類下的第一個子分類
        $sql = "SELECT id FROM product_category_small WHERE product_category_big_id = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_POST["category_big"]);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $category_small = $row["id"];
        } else {
            $validation_errors[] = "所選主分類下沒有子分類";
        }
    } else {
        $validation_errors[] = "缺少商品分類";
    }
} else {
    $category_small = filter_var($_POST["category_small"], FILTER_VALIDATE_INT);
    if ($category_small === false) {
        $validation_errors[] = "商品分類格式錯誤：" . $_POST["category_small"];
    }
}

// 檢查並驗證價格
if (!isset($_POST["price"])) {
    $validation_errors[] = "缺少商品價格";
} else {
    $price = filter_var($_POST["price"], FILTER_VALIDATE_FLOAT);
    if ($price === false || $price < 0) {
        $validation_errors[] = "商品價格格式錯誤：" . $_POST["price"];
    }
}

// 檢查並驗證庫存
if (!isset($_POST["stock"])) {
    $validation_errors[] = "缺少商品庫存";
} else {
    $stock = filter_var($_POST["stock"], FILTER_VALIDATE_INT);
    if ($stock === false || $stock < 0) {
        $validation_errors[] = "商品庫存格式錯誤：" . $_POST["stock"];
    }
}

// 檢查並驗證狀態
if (!isset($_POST["status"]) || empty($_POST["status"])) {
    $validation_errors[] = "缺少商品狀態";
} else {
    $status = $_POST["status"];
    $allowed_statuses = ["上架中", "下架中", "待上架"];
    if (!in_array($status, $allowed_statuses)) {
        $validation_errors[] = "商品狀態不正確：" . $_POST["status"];
    }
}

// 規格相關驗證（可選）
$size_id = isset($_POST["size_id"]) && !empty($_POST["size_id"]) ?
    filter_var($_POST["size_id"], FILTER_VALIDATE_INT) : null;
$color_id = isset($_POST["color_id"]) && !empty($_POST["color_id"]) ?
    filter_var($_POST["color_id"], FILTER_VALIDATE_INT) : null;
$brand_id = isset($_POST["brand_id"]) && !empty($_POST["brand_id"]) ?
    filter_var($_POST["brand_id"], FILTER_VALIDATE_INT) : null;

$image_paths = []; // 改用陣列來儲存所有圖片路徑
if (isset($_FILES['photos'])) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $max_size = 5 * 1024 * 1024; // 5MB
    $upload_dir = 'img/';

    // 確保上傳目錄存在
    if (!is_dir($upload_dir)) {
        if (!@mkdir($upload_dir, 0777, true)) {
            $validation_errors[] = "無法創建上傳目錄，請檢查權限";
        }
    }

    // 檢查是否已有主圖
    $check_main_sql = "SELECT COUNT(*) as main_count FROM product_image WHERE product_id = ? AND isMain = 1";
    $check_main_stmt = $conn->prepare($check_main_sql);
    $check_main_stmt->bind_param("i", $id);
    $check_main_stmt->execute();
    $has_main_image = $check_main_stmt->get_result()->fetch_assoc()['main_count'] > 0;

    // 處理每個上傳的檔案
    foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['photos']['error'][$key] === UPLOAD_ERR_OK) {
            // 驗證檔案類型
            if (!in_array($_FILES['photos']['type'][$key], $allowed_types)) {
                $validation_errors[] = "檔案 {$_FILES['photos']['name'][$key]} 格式不支援。請上傳 JPG、PNG 或 GIF 格式的圖片";
                continue;
            }

            // 驗證檔案大小
            if ($_FILES['photos']['size'][$key] > $max_size) {
                $validation_errors[] = "檔案 {$_FILES['photos']['name'][$key]} 超過大小限制";
                continue;
            }

            // 生成新檔名
            $file_extension = pathinfo($_FILES['photos']['name'][$key], PATHINFO_EXTENSION);
            $new_filename = 'product_' . $id . '_' . time() . '_' . $key . '.' . $file_extension;

            // 上傳檔案
            if (move_uploaded_file($tmp_name, $upload_dir . $new_filename)) {
                $image_paths[] = [
                    'filename' => $new_filename,
                    'original_name' => $_FILES['photos']['name'][$key],
                    'is_main' => ($key === 0 && !$has_main_image) ? 1 : 0 // 如果是第一張且沒有主圖，則設為主圖
                ];
            } else {
                $validation_errors[] = "檔案 {$_FILES['photos']['name'][$key]} 上傳失敗";
            }
        }
    }
}

try {
    $conn->begin_transaction();

    // 1. 更新產品基本資訊
    $sql = "UPDATE product SET 
            name = ?,
            product_category_small_id = ?,
            price = ?,
            stock = ?,
            status = ?,
            updated_at = NOW()
            WHERE id = ? AND isDeleted = 0";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sidisi", $name, $category_small, $price, $stock, $status, $id);


    if (!$stmt->execute()) {
        throw new Exception("更新產品資訊失敗: " . $stmt->error);
    }
    // 2. 更新產品規格
    $spec_sql = "UPDATE product_specification 
SET size_id = ?, color_id = ?, brand_id = ?
WHERE product_id = ?";

    $spec_stmt = $conn->prepare($spec_sql);
    $spec_stmt->bind_param("iiii", $size_id, $color_id, $brand_id, $id);

    if (!$spec_stmt->execute()) {
        throw new Exception("更新產品規格失敗: " . $spec_stmt->error);
    }

    // 2. 如果有指定主圖，先處理主圖設定
    if (isset($_POST['mainImage'])) {
        // 重置所有圖片為非主圖
        $reset_sql = "UPDATE product_image SET isMain = 0 WHERE product_id = ? AND isDeleted = 0";
        $reset_stmt = $conn->prepare($reset_sql);
        $reset_stmt->bind_param("i", $id);
        $reset_stmt->execute();

        // 設定新主圖
        $update_main_sql = "UPDATE product_image SET isMain = 1 WHERE id = ? AND isDeleted = 0";
        $update_main_stmt = $conn->prepare($update_main_sql);
        $update_main_stmt->bind_param("i", $_POST['mainImage']);
        $update_main_stmt->execute();
    }

    // 3. 處理新上傳的圖片
    if (!empty($image_paths)) {
        foreach ($image_paths as $image) {
            $insert_image_sql = "INSERT INTO product_image (product_id, imgUrl, name, isMain) VALUES (?, ?, ?, ?)";
            $image_stmt = $conn->prepare($insert_image_sql);
            $image_stmt->bind_param("issi", $id, $image['filename'], $name, $image['is_main']);

            if (!$image_stmt->execute()) {
                throw new Exception("新增圖片資訊失敗: " . $image_stmt->error);
            }
        }
    }

    $conn->commit();
    $_SESSION["message"] = ["type" => "success", "content" => "商品更新成功"];
    header("Location: product.php");
    exit;
} catch (Exception $e) {
    $conn->rollback();
    // 刪除已上傳的圖片
    if (!empty($image_paths)) {
        foreach ($image_paths as $image) {
            $file_path = 'img/' . $image['filename'];
            if (file_exists($file_path)) {
                @unlink($file_path);
            }
        }
    }
    echo "錯誤：" . $e->getMessage();
}
