<?php
require_once("../db_project_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id']; // 文章 ID
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = $_POST['status'];
    $type = $_POST['type'];

    // 設定當前時間為 upgradeDate
    $upgradeDate = date("Y-m-d H:i:s");

    // 初始化圖片相關變數
    $imageUpdated = false;
    $imageName = null;
    $uploadFile = null;

    // 確保圖片目錄存在
    $uploadDir = 'img/article/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // 若目錄不存在則創建
    }

    // 檢查是否有新圖片上傳（表單名稱應為 articleImage_id）
    if (isset($_FILES['articleImage_id']) && $_FILES['articleImage_id']['error'] === UPLOAD_ERR_OK) {
        // 使用當前時間命名檔案
        $imageName = date('YmdHis') . '_' . basename($_FILES['articleImage_id']['name']);
        $uploadFile = $uploadDir . $imageName;

        // 嘗試移動上傳檔案到指定目錄
        if (move_uploaded_file($_FILES['articleImage_id']['tmp_name'], $uploadFile)) {
            $imageUpdated = true;
        } else {
            die("圖片上傳失敗！");
        }
    }

    // 更新文章表（更新 title、content、status、type 和 upgradeDate）
    $sql = "UPDATE article 
            SET title = ?, 
                content = ?, 
                status = ?, 
                type = ?, 
                upgradeDate = ? 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssssi", $title, $content, $status, $type, $upgradeDate, $id);

        if ($stmt->execute()) {
            // 如果有圖片上傳，處理圖片資料庫操作
            if ($imageUpdated) {
                // 先取得 article 的 createdAt 或 upgradeDate
                $sql_get_dates = "SELECT createdAt, upgradeDate FROM article WHERE id = ?";
                $stmt_get_dates = $conn->prepare($sql_get_dates);
                if ($stmt_get_dates) {
                    $stmt_get_dates->bind_param("i", $id);
                    $stmt_get_dates->execute();
                    $stmt_get_dates->bind_result($createdAt, $articleUpgradeDate);
                    $stmt_get_dates->fetch();
                    $stmt_get_dates->close();

                    // 根據 upgradeDate 優先更新，如果 upgradeDate 為空則使用 createdAt
                    $effectiveDate = $articleUpgradeDate ? $articleUpgradeDate : $createdAt;

                    // 格式化圖片命名為時間
                    $imageName = date('YmdHis', strtotime($effectiveDate)) . '_' . basename($_FILES['articleImage_id']['name']);
                    $uploadFile = $uploadDir . $imageName;

                    // 更新圖片資料庫
                    $sql_image_update = "
                        UPDATE article_image 
                        SET name = ?, imgUrl = ? 
                        WHERE article_id = ?";
                    $stmt_image_update = $conn->prepare($sql_image_update);
                    if ($stmt_image_update) {
                        $stmt_image_update->bind_param("ssi", $imageName, $uploadFile, $id);
                        if ($stmt_image_update->execute()) {
                            echo "文章與圖片更新成功！";
                        } else {
                            die("圖片更新失敗：" . $stmt_image_update->error);
                        }
                        $stmt_image_update->close();
                    } else {
                        die("圖片更新語句錯誤：" . $conn->error);
                    }
                } else {
                    die("讀取文章日期錯誤：" . $conn->error);
                }
            } else {
                echo "文章更新成功（無圖片更新）！";
            }

            header("Location: articleList.php");
            exit();
        } else {
            die("更新文章失敗：" . $stmt->error);
        }
        $stmt->close();
    } else {
        die("文章更新語句錯誤：" . $conn->error);
    }
}

$conn->close();
?>
