<?php
require_once("../db_project_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = $_POST['status'];
    $type = $_POST['type'];

    // 設定當前時間為 upgradeDate
    $upgradeDate = date("Y-m-d H:i:s");

    // 處理圖片更新（如果有）
    $imageUpdated = false;
    $imageName = null;
    $uploadFile = null;

    if (isset($_FILES['articleImage']) && $_FILES['articleImage']['error'] === UPLOAD_ERR_OK) {
        // 上傳圖片
        $uploadDir = 'articleImgUpload/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // 如果目錄不存在則創建
        }

        $imageName = date('YmdHis') . '_' . basename($_FILES['articleImage']['name']);
        $uploadFile = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['articleImage']['tmp_name'], $uploadFile)) {
            $imageUpdated = true;
        } else {
            die("圖片上傳失敗！");
        }
    }

    // 更新文章數據
    $sql = "UPDATE article SET 
                title = ?, 
                content = ?, 
                status = ?, 
                type = ?, 
                upgradeDate = ? 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssssi", $title, $content, $status, $type, $upgradeDate, $id);

        if ($stmt->execute()) {
            // 如果圖片有更新，則插入或更新圖片表
            if ($imageUpdated) {
                $sql_image = "
                    INSERT INTO article_image (article_id, name, imgUrl, createdAt, upgradeDate)
                    VALUES (?, ?, ?, NULL, ?)
                    ON DUPLICATE KEY UPDATE 
                        name = VALUES(name), 
                        imgUrl = VALUES(imgUrl), 
                        upgradeDate = VALUES(upgradeDate)";
                $stmt_image = $conn->prepare($sql_image);
                if ($stmt_image) {
                    $stmt_image->bind_param("isss", $id, $imageName, $uploadFile, $upgradeDate);
                    if ($stmt_image->execute()) {
                        echo "文章與圖片更新成功！";
                    } else {
                        echo "圖片更新失敗：" . $stmt_image->error;
                    }
                    $stmt_image->close();
                } else {
                    echo "圖片表處理失敗：" . $conn->error;
                }
            } else {
                echo "文章更新成功（無圖片更新）！";
            }
            header("Location: articleList.php");
            exit();
        } else {
            echo "更新文章失敗：" . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "預備語句錯誤：" . $conn->error;
    }
}

$conn->close();
?>
