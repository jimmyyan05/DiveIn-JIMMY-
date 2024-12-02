<?php
require_once("../db_project_connect.php");

// 檢查 session 是否已經啟動
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 接收表單數據
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = $_POST['status']; // 0 或 1
    $createdAt = date('Y-m-d H:i:s');
    $upgradeDate = null; // 暫為空值
    $isDeleted = 0;      // 默認值為 0

    // 插入文章數據到 article 表
    $sql_article = "INSERT INTO article (title, content, status, createdAt, upgradeDate, isDeleted) 
                    VALUES ('$title', '$content', '$status', '$createdAt', NULL, '$isDeleted')";

    if ($conn->query($sql_article) === TRUE) {
        // 獲取新插入的文章 ID
        $articleId = $conn->insert_id;

        // 處理圖片上傳
        $uploadDir = 'img/article/'; // 修改圖片儲存的目錄
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // 如果目錄不存在則創建
        }

        // 遍歷所有圖片
        $articleImages = $_FILES['articleImage'];
        $isMainOptions = $_POST['isMain'];

        for ($i = 0; $i < count($articleImages['name']); $i++) {
            // 生成圖片名稱
            $imageName = date('YmdHis') . '_' . $articleImages['name'][$i];
            $uploadFile = $uploadDir . $imageName;

            // 處理圖片上傳
            if (isset($articleImages['error'][$i]) && $articleImages['error'][$i] === UPLOAD_ERR_OK) {
                if (!move_uploaded_file($articleImages['tmp_name'][$i], $uploadFile)) {
                    die("圖片上傳失敗！");
                }
            } else {
                die("無效的圖片文件！");
            }

            // 插入圖片數據到 article_image 表
            $isMain = $isMainOptions[$i] == 1 ? 1 : 0;
            $sql_image = "INSERT INTO article_image (article_id, name, imgUrl, isMain) 
                          VALUES ('$articleId', '$imageName', '$uploadFile', '$isMain')";

            if ($conn->query($sql_image) !== TRUE) {
                die("圖片數據插入失敗！" . $conn->error);
            }
        }

        // 設定 session 變數以顯示成功訊息
        $_SESSION['message'] = "文章及圖片建立成功！";

        // 立即重定向到文章列表頁
        header("Location: articleList.php");
        exit;
    } else {
        die("文章數據插入失敗！" . $conn->error);
    }
}

$conn->close();
