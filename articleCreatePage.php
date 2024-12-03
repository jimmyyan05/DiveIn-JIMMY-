<?php
require_once("../db_project_connect.php");
?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增文章</title>
    <!-- 統一的css -->
    <?php include "css.php"; ?>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sidebar.php"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            

            <div id="content">
                <!-- Topbar -->
                <?php include "topbar.php"; ?>
                <!-- 麵包屑 -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb rounded-0 p-3">
                        <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                        <li class="breadcrumb-item"><a href="articleList.php">文章列表</a></li>
                        <li class="breadcrumb-item active">新增文章</li>
                    </ol>
                </nav>
                <div class="container-fluid">
                    <div class="d-flex gap-2 my-3">
                        <h2 class="mb-4">新增文章</h2>
                        <a href="articleList.php" class="btn bg-info text-white" style="height: 70%; line-height: 1.5;">
                            <i class="fa-solid fa-rotate-left"></i> 返回
                        </a>
                    </div>

                    <form action="articleDoCreate.php" method="POST" enctype="multipart/form-data">
                        <!-- 文章標題 -->
                        <div class="mb-3">
                            <label for="title" class="form-label">文章標題</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <!-- 文章詳情 -->
                        <div class="mb-3">
                            <label for="content" class="form-label">文章詳情</label>
                            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                        </div>

                        <!-- 發布狀態 -->
                        <div class="mb-3">
                            <label for="status" class="form-label">發布狀態</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="0">待發布</option>
                                <option value="1">發布</option>
                            </select>
                        </div>

                        <!-- 文章類型 -->
                        <!-- <div class="mb-3">
                            <label for="type" class="form-label">文章類型</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="0">官方文章</option>
                                <option value="1">商品描述</option>
                                <option value="2">活動描述</option>
                            </select>
                        </div> -->

                        <!-- 動態新增圖片欄位 -->
                        <div id="imageFields">
                            <div class="imageField mb-3">
                                <label for="articleImage1" class="form-label">文章照片</label>
                                <input type="file" class="form-control" name="articleImage[]" accept=".png, .jpg, .jpeg" required onchange="previewImage(event, this)">
                                <div class="imagePreview" id="imagePreview1" style="display: none;">
                                    <img src="" id="imagePreviewImg1" alt="圖片預覽" class="img-fluid" style="max-width: 150px; height: auto;">
                                </div>
                                <label for="isMain1" class="form-label my-2">是否為主圖</label>
                                <select name="isMain[]" class="form-select">
                                    <option value="0">非主圖</option>
                                    <option value="1">主圖</option>
                                </select>
                                <!-- 取消新增圖片按鈕 -->
                                <button type="button" class="btn btn-danger my-2" onclick="removeImageField(this)">取消新增圖片</button>
                            </div>
                        </div>

                        <!-- 增加圖片欄位按鈕 -->
                        <button type="button" class="btn btn-secondary" onclick="addImageField()">新增圖片欄位</button>

                        <!-- 提交按鈕 -->
                        <button type="submit" class="btn btn-primary">送出</button>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        let imageIndex = 1; // 初始圖片欄位索引

        // 動態增加圖片欄位
        function addImageField() {
            imageIndex++;
            const imageField = document.createElement('div');
            imageField.classList.add('imageField', 'mb-3');
            imageField.innerHTML = `
            <label for="articleImage${imageIndex}" class="form-label">文章照片</label>
            <input type="file" class="form-control" name="articleImage[]" accept=".png, .jpg, .jpeg" required onchange="previewImage(event, this)">
            <div class="imagePreview" id="imagePreview${imageIndex}" style="display: none;">
                <img src="" id="imagePreviewImg${imageIndex}" alt="圖片預覽" class="img-fluid" style="max-width: 150px; height: auto;">
            </div>
            <label for="isMain${imageIndex}" class="form-label">是否為主圖</label>
            <select name="isMain[]" class="form-select">
                <option value="0">非主圖</option>
                <option value="1">主圖</option>
            </select>
            <!-- 取消新增圖片按鈕 -->
            <button type="button" class="btn btn-danger" onclick="removeImageField(this)">取消新增圖片</button>
        `;
            document.getElementById('imageFields').appendChild(imageField);
        }

        // 刪除圖片欄位
        function removeImageField(button) {
            const imageField = button.closest('.imageField');
            imageField.remove();
        }

        // 預覽圖片
        function previewImage(event, input) {
            const file = input.files[0];
            const imagePreview = input.closest('.imageField').querySelector('.imagePreview');
            const imagePreviewImg = imagePreview.querySelector('img');

            // 檢查是否選擇了圖片
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreviewImg.src = e.target.result;
                    imagePreview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = 'none';
            }
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
<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 接收表單數據
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = $_POST['status']; // 0 或 1
    // $type = $_POST['type'];     // 0, 1 或 2

    // 設置文章創建時間
    $createdAt = date('Y-m-d H:i:s');
    $upgradeDate = null; // 暫為空值
    $isDeleted = 0;      // 默認值為 0

    // 處理文章圖片上傳
    $uploadDir = 'img/article/'; // 修改圖片儲存的目錄
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
    $sql_article = "INSERT INTO article (title, content, status, createdAt, upgradeDate, isDeleted) 
                    VALUES ('$title', '$content', '$status', '$createdAt', NULL, '$isDeleted')";

    if ($conn->query($sql_article) === TRUE) {
        // 獲取新插入的文章 ID
        $articleId = $conn->insert_id;

        // 插入圖片數據到 article_image 表
        $sql_image = "INSERT INTO article_image (article_id, name, imgUrl) 
                      VALUES ('$articleId', '$imageName', '$uploadFile')";

        if ($conn->query($sql_image) === TRUE) {
            // 顯示彈出消息並跳轉
            echo "<script>
                    alert('文章與圖片創建成功！');
                    window.location.href = 'articleList.php';
                  </script>";
        } else {
            die("圖片數據插入失敗！" . $conn->error);
        }
    } else {
        die("文章數據插入失敗！" . $conn->error);
    }
}

$conn->close();
?>