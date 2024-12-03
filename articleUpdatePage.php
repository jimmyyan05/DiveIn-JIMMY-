<?php
require_once("../db_project_connect.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 查詢指定文章的資料
    $sql = "SELECT * FROM article WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // 確保查詢有返回結果
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        // 如果沒有找到資料，顯示錯誤並跳轉回 articleList.php
        echo "<script>alert('文章未找到！'); window.location.href = 'articleList.php';</script>";
        exit();
    }

    // 查詢該文章相關的圖片
    $sql_images = "SELECT * FROM article_image WHERE article_id = ? AND isDeleted = 0";
    $stmt_images = $conn->prepare($sql_images);
    $stmt_images->bind_param("i", $id);
    $stmt_images->execute();
    $images_result = $stmt_images->get_result();

    // 確保有相關圖片
    if ($images_result->num_rows > 0) {
        $images = $images_result->fetch_all(MYSQLI_ASSOC);
    } else {
        $images = []; // 如果沒有圖片，設定為空陣列
    }

    $stmt->close();
    $stmt_images->close();
} else {
    // 如果沒有傳遞 ID，顯示錯誤或跳轉
    die("無效的文章ID！");
}
?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編輯文章</title>
    <?php include "css.php"; ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include "sidebar.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <?php include "topbar.php"; ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content-wrapper" class="d-flex flex-column">
                    <div class="row justify-content-start p-4">
                        <div class="container-fluid">
                            <div class="d-flex gap-2 my-3">
                                <h2 class="mb-4">編輯文章</h2>
                                <a href="articleList.php" class="btn bg-info text-white" style="height: 70%; line-height: 1.5;">
                                    <i class="fa-solid fa-rotate-left"></i> 返回
                                </a>
                            </div>

                            <form action="articleDoUpdate.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                <!-- 文章標題 -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">文章標題</label>
                                    <input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="articleImage" class="form-label">文章照片</label>

                                    <!-- 顯示所有圖片 -->
                                    <div class="d-flex gap-3">
                                        <?php foreach ($images as $image): ?>
                                            <div style="text-align: center;">
                                                <img id="preview-<?php echo $image['id']; ?>"
                                                    src="<?php echo htmlspecialchars($image['imgUrl']); ?>"
                                                    alt="Image"
                                                    style="width: 100px; height: 100px; object-fit: contain;" />

                                                <input type="file"
                                                    name="updateImage[<?php echo $image['id']; ?>]"
                                                    class="form-control mt-2"
                                                    accept=".png,.jpg,.jpeg"
                                                    onchange="previewUpdatedImage(event, <?php echo $image['id']; ?>)" />

                                                <button type="button"
                                                    class="btn btn-danger mt-2"
                                                    onclick="deleteImage(<?php echo $image['id']; ?>)">刪除</button>

                                                <!-- 主圖選擇下拉選單 -->
                                                <div class="mt-2">
                                                    <label for="isMain-<?php echo $image['id']; ?>" class="form-label">是否為主圖</label>
                                                    <select name="isMain[<?php echo $image['id']; ?>]" class="form-select" id="isMain-<?php echo $image['id']; ?>">
                                                        <option value="0" <?php echo ($image['isMain'] == 0) ? 'selected' : ''; ?>>非主圖</option>
                                                        <option value="1" <?php echo ($image['isMain'] == 1) ? 'selected' : ''; ?>>主圖</option>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <!-- 新增圖片 -->
                                    <div class="mt-3">
                                        <input type="file"
                                            name="newImage[]"
                                            id="newImage"
                                            class="form-control"
                                            accept=".png,.jpg,.jpeg"
                                            multiple />
                                        <!-- 新增圖片的主圖設定 -->
                                        <div id="newImageMain" class="mt-2" style="display: none;">
                                            <label for="newIsMain" class="form-label">是否為主圖</label>
                                            <select name="newIsMain" id="newIsMain" class="form-select">
                                                <option value="0">非主圖</option>
                                                <option value="1">主圖</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- 文章詳情 -->
                                <div class="mb-3">
                                    <label for="content" class="form-label">文章詳情</label>
                                    <textarea name="content" class="form-control" rows="5" required><?php echo $row['content']; ?></textarea>
                                </div>

                                <!-- 發布狀態 -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">發布狀態</label>
                                    <select name="status" class="form-select" required>
                                        <option value="0" <?php echo ($row['status'] == 0) ? 'selected' : ''; ?>>待發布</option>
                                        <option value="1" <?php echo ($row['status'] == 1) ? 'selected' : ''; ?>>已發布</option>
                                    </select>
                                </div>

                                <!-- 提交按鈕 -->
                                <button class="btn btn-primary" type="submit">送出更新</button>
                            </form>

                            <script>
                                // 如果有選擇新增圖片，顯示主圖選項
                                document.getElementById("newImage").addEventListener("change", function() {
                                    if (this.files.length > 0) {
                                        document.getElementById("newImageMain").style.display = "block";
                                    } else {
                                        document.getElementById("newImageMain").style.display = "none";
                                    }
                                });
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        // 圖片刪除功能
        function deleteImage(imageId) {
            if (confirm("確定要刪除這張圖片嗎？")) {
                window.location.href = `articleimgDoDelete.php?id=${imageId}`;
            }
        }
    </script>
</body>

</html>