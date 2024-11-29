<?php
require_once("articleConnect.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // 查詢指定ID的資料
    $sql = "SELECT * FROM article WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>新增文章</title>

    <!-- Custom fonts for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Nav Item - Article Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>article</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <div class="collapse-divider"></div>
                        <a class="collapse-item" href="articleCreate.php">article create</a>
                        <a class="collapse-item" href="articleList.php">article list</a>
                    </div>
                </div>
            </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row justify-content-start p-4">
                                <div class="col-lg-8 col-md-10">
                                    <h2 class="mb-4">編輯文章</h2>
                                    <form action="articleDoEdit.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                        <!-- 文章標題 -->
                                        <div class="mb-3">
                                            <label for="title" class="form-label">文章標題</label>
                                            <input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>" required>
                                        </div>

                                        <!-- 文章照片 -->
                                        <div class="mb-3">
                                            <label for="articleImage_id" class="form-label">文章照片</label>
                                            <input type="file" name="articleImage_id" id="articleImage_id" class="form-control" accept=".png,.jpg,.jpeg" onchange="previewImage(event)" />
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

                                        <!-- 提交按鈕 -->
                                        <button class="btn btn-primary" type="submit">送出更新</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

<?php
$conn->close(); // 關閉資料庫連線
?>
