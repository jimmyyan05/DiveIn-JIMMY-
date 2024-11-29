<?php
require_once("articleConnect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 接收表單數據
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = $_POST['status']; // 0 或 1
    $type = $_POST['type'];     // 0, 1 或 2

    // 設置文章創建時間
    $createdAt = date('Y-m-d H:i:s');
    $upgradeDate = null; // 暫為空值
    $isDeleted = 0;      // 默認值為 0

    // 處理文章圖片上傳
    $uploadDir = 'articleImgUpload/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // 如果目錄不存在則創建
    }

    $imageName = date('YmdHis') . '_' . $_FILES['articleImage']['name'];
    $uploadFile = $uploadDir . $imageName;

    if (isset($_FILES['articleImage']) && $_FILES['articleImage']['error'] === UPLOAD_ERR_OK) {
        if (!move_uploaded_file($_FILES['articleImage']['tmp_name'], $uploadFile)) {
            die("圖片上傳失敗！");
        }
    } else {
        die("無效的圖片文件！");
    }

    // 插入文章數據到 article 表
    $sql_article = "INSERT INTO article (title, content, status, type, createdAt, upgradeDate, isDeleted) 
                    VALUES ('$title', '$content', '$status', '$type', '$createdAt', NULL, '$isDeleted')";

    if ($conn->query($sql_article) === TRUE) {
        // 獲取新插入的文章 ID
        $articleId = $conn->insert_id;

        // 插入圖片數據到 article_image 表
        $sql_image = "INSERT INTO article_image (article_id, name, imgUrl) 
                      VALUES ('$articleId', '$imageName', '$uploadFile')";

        if ($conn->query($sql_image) === TRUE) {
            echo "文章與圖片創建成功！";
            header("Location: articleList.php"); // 重定向到文章列表頁
        } else {
            die("圖片數據插入失敗！" . $conn->error);
        }
    } else {
        die("文章數據插入失敗！" . $conn->error);
    }
}

$conn->close();
?>
