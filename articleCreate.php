<?php
require_once("../db_project_connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增文章</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
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


                <!-- Main Content -->
                <div class="container-fluid">
                    <h2 class="mb-4">新增文章</h2>
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
                                <option value="1">已發布</option>
                            </select>
                        </div>

                        <!-- 文章類型 -->
                        <div class="mb-3">
                            <label for="type" class="form-label">文章類型</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="0">官方文章</option>
                                <option value="1">商品描述</option>
                                <option value="2">活動描述</option>
                            </select>
                        </div>

                        <!-- 文章圖片 -->
                        <div class="mb-3">
                            <label for="articleImage" class="form-label">文章照片</label>
                            <input type="file" class="form-control" id="articleImage" name="articleImage" accept=".png, .jpg, .jpeg" required>
                        </div>

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

</body>

</html>