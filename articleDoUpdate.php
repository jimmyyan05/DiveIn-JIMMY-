<?php
require_once("../db_project_connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = $_POST['status'];

    try {
        $conn->begin_transaction();

        // 更新文章基本資訊
        $sql_update_article = "UPDATE article SET title = ?, content = ?, status = ?, upgradeDate = NOW() WHERE id = ?";
        $stmt_update_article = $conn->prepare($sql_update_article);

        if (!$stmt_update_article) {
            throw new Exception("SQL 語句準備失敗: " . $conn->error);
        }

        $stmt_update_article->bind_param("ssii", $title, $content, $status, $id);
        $stmt_update_article->execute();

        // 更新圖片的 isMain
        if (!empty($_POST['isMain'])) {
            foreach ($_POST['isMain'] as $imageId => $isMain) {
                $sql_update_image = "UPDATE article_image SET isMain = ? WHERE id = ?";
                $stmt_update_image = $conn->prepare($sql_update_image);

                if (!$stmt_update_image) {
                    throw new Exception("SQL 語句準備失敗: " . $conn->error);
                }

                $stmt_update_image->bind_param("ii", $isMain, $imageId);
                $stmt_update_image->execute();
            }
        }

        // 處理新增圖片
        if (!empty($_FILES['newImage']['name'][0])) {
            $uploadDir = 'img/article/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            foreach ($_FILES['newImage']['name'] as $key => $imageName) {
                if ($_FILES['newImage']['error'][$key] === UPLOAD_ERR_OK) {
                    $newImageName = date('YmdHis') . '_' . basename($imageName);
                    $uploadFile = $uploadDir . $newImageName;

                    if (move_uploaded_file($_FILES['newImage']['tmp_name'][$key], $uploadFile)) {
                        $newIsMain = isset($_POST['newIsMain']) ? $_POST['newIsMain'] : 0;

                        // 插入新的圖片資料
                        $sql_insert_image = "INSERT INTO article_image (article_id, imgUrl, isMain, isDeleted) 
                                             VALUES (?, ?, ?, 0)";
                        $stmt_insert_image = $conn->prepare($sql_insert_image);

                        if (!$stmt_insert_image) {
                            throw new Exception("SQL 語句準備失敗: " . $conn->error);
                        }

                        $stmt_insert_image->bind_param("isi", $id, $uploadFile, $newIsMain);
                        $stmt_insert_image->execute();
                    } else {
                        throw new Exception("上傳檔案失敗: " . $_FILES['newImage']['error'][$key]);
                    }
                } else {
                    throw new Exception("檔案上傳錯誤: " . $_FILES['newImage']['error'][$key]);
                }
            }
        }

        $conn->commit();
        header("Location: articleList.php");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        die("錯誤: " . $e->getMessage());
    }
}

$conn->close();
?>
