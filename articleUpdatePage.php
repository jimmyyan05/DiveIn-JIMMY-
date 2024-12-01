<?php
require_once("../db_project_connect.php");

// 獲取文章ID並查詢文章資料
$id = $_GET['id'];
$sql_article = "SELECT * FROM article WHERE id = ?";
$stmt = $conn->prepare($sql_article);
$stmt->bind_param("i", $id);
$stmt->execute();
$result_article = $stmt->get_result();
$article = $result_article->fetch_assoc();

// 獲取文章圖片，並過濾掉已刪除的圖片
$sql_images = "SELECT * FROM article_image WHERE article_id = ? AND isDeleted = 0";
$stmt_images = $conn->prepare($sql_images);
$stmt_images->bind_param("i", $id);
$stmt_images->execute();
$result_images = $stmt_images->get_result();
?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編輯文章</title>
    <?php include "css.php"; ?>
    <style>
        #image-<?php echo $image['id']; ?>img {
            width: 100px;
            /* 設定圖片的最大寬度 */
            height: 100px;
            /* 設定圖片的最大高度 */
            object-fit: contain;
            /* 讓圖片保持比例顯示，且不會被壓縮 */
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include "sidebar.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <?php include "topbar.php"; ?>

            <div id="content">
                <div class="container-fluid">
                    <div class="d-flex gap-2 my-3">
                        <h2 class="mb-4">編輯文章</h2>
                        <a href="articleList.php" class="btn bg-info text-white" style="height: 70%; line-height: 1.5;">
                            <i class="fa-solid fa-rotate-left"></i> 返回
                        </a>
                    </div>
                    <form action="articleDoUpdate.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">

                        <!-- 文章標題 -->
                        <div class="mb-3">
                            <label for="title" class="form-label">文章標題</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $article['title']; ?>" required>
                        </div>

                        <!-- 文章詳情 -->
                        <div class="mb-3">
                            <label for="content" class="form-label">文章詳情</label>
                            <textarea class="form-control" id="content" name="content" rows="5" required><?php echo $article['content']; ?></textarea>
                        </div>

                        <!-- 發布狀態 -->
                        <div class="mb-3">
                            <label for="status" class="form-label">發布狀態</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="0" <?php echo $article['status'] == 0 ? 'selected' : ''; ?>>待發布</option>
                                <option value="1" <?php echo $article['status'] == 1 ? 'selected' : ''; ?>>發布</option>
                            </select>
                        </div>

                        <!-- 現有圖片顯示與刪除 -->
                        <div class="mb-3">
                            <h4>現有圖片</h4>
                            <?php while ($image = $result_images->fetch_assoc()) { ?>
                                <div id="image-<?php echo $image['id']; ?>" class="mb-3">
                                    <div>
                                        <img src="<?php echo $image['imgUrl']; ?>" alt="文章圖片" style="width: 200px; height: 100px; object-fit: contain;">

                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteImage(<?php echo $image['id']; ?>)">刪除</button>
                                    </div>
                                    <div class="my-2">
                                        <label for="isMain<?php echo $image['id']; ?>" class="form-label">是否為主圖</label>
                                        <select name="isMain[<?php echo $image['id']; ?>]" class="form-select" id="isMain<?php echo $image['id']; ?>">
                                            <option value="0" <?php echo $image['isMain'] == 0 ? 'selected' : ''; ?>>非主圖</option>
                                            <option value="1" <?php echo $image['isMain'] == 1 ? 'selected' : ''; ?>>主圖</option>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <!-- 動態新增圖片欄位 -->
                        <div id="imageFields">
                            <div class="imageField mb-3">
                                <label for="articleImage1" class="form-label">文章照片</label>
                                <input type="file" class="form-control" name="articleImage[]" accept=".png, .jpg, .jpeg">
                                <label for="isMain1" class="form-label my-2">是否為主圖</label>
                                <select name="isMain[]" class="form-select">
                                    <option value="0">非主圖</option>
                                    <option value="1">主圖</option>
                                </select>
                                <button type="button" class="btn btn-warning btn-sm my-2" onclick="removeImageField(this)">取消新增圖片</button>
                            </div>
                        </div>

                        <!-- 增加圖片欄位按鈕 -->
                        <button type="button" class="btn btn-secondary" onclick="addImageField()">新增圖片欄位</button>

                        <!-- 提交按鈕 -->
                        <button type="submit" class="btn btn-primary">儲存變更</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        let imageIndex = 1;

        function addImageField() {
            imageIndex++;
            const imageField = document.createElement('div');
            imageField.classList.add('imageField', 'mb-3');
            imageField.innerHTML = ` 
                <label for="articleImage${imageIndex}" class="form-label">文章照片</label>
                <input type="file" class="form-control" name="articleImage[]" accept=".png, .jpg, .jpeg">
                <label for="isMain${imageIndex}" class="form-label">是否為主圖</label>
                <select name="isMain[]" class="form-select">
                    <option value="0">非主圖</option>
                    <option value="1">主圖</option>
                </select>
                <button type="button" class="btn btn-warning btn-sm" onclick="removeImageField(this)">取消新增圖片</button>
            `;
            document.getElementById('imageFields').appendChild(imageField);
        }

        function removeImageField(button) {
            button.parentElement.remove();
        }

        function deleteImage(imageId) {
            $.get('articleimgDoDelete.php', {
                id: imageId,
                type: 'image'
            }, function(response) {
                if (response === 'success') {
                    // 刪除成功，刷新頁面
                    alert("刪除成功！");
                    document.querySelector(`#image-${imageId}`).remove();
                    location.reload(); // 重整頁面
                } else {
                    alert("刪除失敗：" + response); // 顯示具體錯誤訊息
                }
            });
        }
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- bootstrap5的JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>