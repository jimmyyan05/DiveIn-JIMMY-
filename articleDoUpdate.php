<?php
require_once("../db_project_connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = $_POST['status'];

    // 更新文章內容
    $sql_article = "UPDATE article SET title = ?, content = ?, status = ?, upgradeDate = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql_article);
    $stmt->bind_param("ssii", $title, $content, $status, $id);
    $stmt->execute();

    // 更新現有圖片的 isMain
    if (isset($_POST['isMain'])) {
        foreach ($_POST['isMain'] as $imageId => $isMain) {
            if ($isMain == 1) {
                // 先將其他圖片的 isMain 設為 0
                $sql_reset = "UPDATE article_image SET isMain = 0 WHERE article_id = ? AND id != ?";
                $stmt_reset = $conn->prepare($sql_reset);
                $stmt_reset->bind_param("ii", $id, $imageId);
                $stmt_reset->execute();
            }

            // 更新該圖片的 isMain
            $sql_image = "UPDATE article_image SET isMain = ? WHERE id = ?";
            $stmt_image = $conn->prepare($sql_image);
            $stmt_image->bind_param("ii", $isMain, $imageId);
            $stmt_image->execute();
        }
    }

    // 處理新增圖片
    $uploadDir = 'img/article/';
    foreach ($_FILES['articleImage']['name'] as $index => $name) {
        if ($_FILES['articleImage']['error'][$index] === UPLOAD_ERR_OK) {
            // 生成圖片名稱（使用當前時間戳避免重名）
            $imageName = date('YmdHis') . '_' . basename($name);
            $imagePath = $uploadDir . $imageName;

            // 上傳圖片
            move_uploaded_file($_FILES['articleImage']['tmp_name'][$index], $imagePath);

            // 取得是否為主圖的選擇值
            // 在此處捕捉該圖片的 `isMain` 值
            $isMain = isset($_POST['isMain'][$index]) && $_POST['isMain'][$index] == 1 ? 1 : 0;

            // 插入圖片資料
            $sql_image = "INSERT INTO article_image (article_id, imgUrl, isMain, isDeleted, name) 
                      VALUES (?, ?, ?, 0, ?)";
            $stmt_image = $conn->prepare($sql_image);
            $stmt_image->bind_param("isis", $id, $imagePath, $isMain, $imageName); // 確保 isMain 正確傳遞
            $stmt_image->execute();
        }
    }

    // 重定向到列表頁
    header("Location: articleList.php?id=$id&update=success");
}
