<?php
require_once("../db_project_connect.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // 查詢指定ID的資料
    $sql = "SELECT * FROM article WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編輯文章</title>
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

            <!-- Topbar -->
            <?php include "topbar.php"; ?>

            <div id="content">
                <div class="container-fluid">
                    <div class="d-flex align-items-center mb-4 gap-2">
                        <h2 class="mb-0">編輯文章</h2>
                        <a href="articleList.php" class="btn bg-info text-white" style="height: 70%; line-height: 1.5;">
                            <i class="fa-solid fa-rotate-left"></i> 返回
                        </a>
                    </div>


                    <form action="articleDoEdit.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                        <!-- 文章標題 -->
                        <div class="mb-3">
                            <label for="title" class="form-label">文章標題</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>" required>
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

                        <!-- 文章類型 -->
                        <div class="mb-3">
                            <label for="type" class="form-label">文章類型</label>
                            <select name="type" class="form-select" required>
                                <option value="0" <?php echo ($row['type'] == 0) ? 'selected' : ''; ?>>官方文章</option>
                                <option value="1" <?php echo ($row['type'] == 1) ? 'selected' : ''; ?>>商品描述</option>
                                <option value="2" <?php echo ($row['type'] == 2) ? 'selected' : ''; ?>>活動描述</option>
                            </select>
                        </div>

                        <!-- 文章圖片 -->
                        <div class="mb-3">
                            <label for="articleImage" class="form-label">文章照片</label>
                            <input type="file" class="form-control" name="articleImage_id" accept=".png, .jpg, .jpeg" onchange="previewImage(event)" />
                        </div>

                        <!-- 提交按鈕 -->
                        <button type="submit" class="btn btn-primary">送出更新</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- 統一的腳本 -->
    <?php include "scripts.php"; ?>
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<?php
$conn->close(); // 關閉資料庫連線
?>