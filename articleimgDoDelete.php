<?php
require_once("../db_project_connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $imageId = $_GET['id'];

    try {
        $conn->begin_transaction();

        // 確認該圖片是否為主圖
        $sql_check_main = "SELECT isMain, article_id FROM article_image WHERE id = ? AND isDeleted = 0";
        $stmt_check_main = $conn->prepare($sql_check_main);
        $stmt_check_main->bind_param("i", $imageId);
        $stmt_check_main->execute();
        $result_check_main = $stmt_check_main->get_result();

        if ($result_check_main->num_rows > 0) {
            $image = $result_check_main->fetch_assoc();
            $isMain = $image['isMain'];
            $articleId = $image['article_id'];

            // 如果是主圖，檢查是否還有其他圖片
            if ($isMain == 1) {
                $sql_check_others = "SELECT id FROM article_image WHERE article_id = ? AND isDeleted = 0 AND id != ?";
                $stmt_check_others = $conn->prepare($sql_check_others);
                $stmt_check_others->bind_param("ii", $articleId, $imageId);
                $stmt_check_others->execute();
                $result_check_others = $stmt_check_others->get_result();

                if ($result_check_others->num_rows > 0) {
                    // 將其中一張圖片設為主圖
                    $newMainImage = $result_check_others->fetch_assoc();
                    $sql_update_main = "UPDATE article_image SET isMain = 1 WHERE id = ?";
                    $stmt_update_main = $conn->prepare($sql_update_main);
                    $stmt_update_main->bind_param("i", $newMainImage['id']);
                    $stmt_update_main->execute();
                } else {
                    // 如果沒有其他圖片，提示無法刪除
                    header("Location: articleUpdatePage.php?id=$articleId&error=noOtherImage");
                    exit();
                }
            }

            // 標記該圖片為已刪除
            $sql_delete = "UPDATE article_image SET isDeleted = 1 WHERE id = ?";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bind_param("i", $imageId);
            $stmt_delete->execute();

            $conn->commit();
            header("Location: articleUpdatePage.php?id=$articleId&delete=success");
        } else {
            throw new Exception("圖片不存在或已刪除");
        }
    } catch (Exception $e) {
        $conn->rollback();
        header("Location: articleUpdatePage.php?error=" . urlencode($e->getMessage()));
    }
}

$conn->close();
?>
