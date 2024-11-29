<?php
include 'PDO_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';

    try {
        $pdo->beginTransaction();

        // 查詢圖片路徑
        $sql_image = "SELECT img_url FROM rent_image WHERE rent_item_id = :id AND is_deleted = 0";
        $stmt_image = $pdo->prepare($sql_image);
        $stmt_image->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt_image->execute();
        $images = $stmt_image->fetchAll(PDO::FETCH_ASSOC);

        // 設定上傳資料夾和備份資料夾的路徑
        $upload_folder = 'img/rent_item/';
        $backup_folder = 'deleted_uploads/';

        // 檢查 'uploads' 資料夾是否存在，若不存在則顯示錯誤
        if (!file_exists($upload_folder)) {
            echo "uploads 資料夾不存在: $upload_folder<br>";
            exit();
        }

        // 如果備份資料夾不存在，創建它
        if (!file_exists($backup_folder)) {
            if (mkdir($backup_folder, 0777, true)) {
                echo "成功創建軟刪除資料夾: $backup_folder<br>";
            } else {
                echo "無法創建軟刪除資料夾: $backup_folder<br>";
                throw new Exception("目錄創建失敗");
            }
        }

        // 移動圖片檔案到備份資料夾
        foreach ($images as $image) {
            $file_name = $image['img_url']; // 圖片名稱
            $file_path = $upload_folder . $file_name; // 原始檔案的完整路徑
            $new_path = $backup_folder . $file_name; // 移動後的檔案路徑

            // 檢查檔案是否存在，並進行移動
            if (file_exists($file_path)) {
                if (rename($file_path, $new_path)) {
                    echo "成功移動檔案: $file_path -> $new_path<br>";
                } else {
                    echo "移動失敗: $file_path -> $new_path<br>";
                }
            } else {
                echo "檔案不存在: $file_path<br>";
            }
        }

        // 更新圖片記錄為軟刪除
        $sql_soft_delete_images = "UPDATE rent_image SET is_deleted = 1 WHERE rent_item_id = :id";
        $stmt_soft_delete_images = $pdo->prepare($sql_soft_delete_images);
        $stmt_soft_delete_images->bindParam(':id', $id);
        $stmt_soft_delete_images->execute();

        // 軟刪除產品記錄
        $sql_soft_delete_product = "UPDATE rent_item SET is_deleted = 1 WHERE id = :id";
        $stmt_soft_delete_product = $pdo->prepare($sql_soft_delete_product);
        $stmt_soft_delete_product->bindParam(':id', $id);
        $stmt_soft_delete_product->execute();

        $pdo->commit();

        // 刪除完成後跳轉回主頁
        header("Location: rent_items.php?page=$page&filter=$filter");
        exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "錯誤: " . $e->getMessage();
    }
} else {
    echo "無效動作!!";
}
