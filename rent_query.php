<!-- php -->
<?php
include 'PDO_connect.php';

// 獲取查詢參數
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$filter = isset($_GET['filter']) ? $_GET['filter'] : ''; // 搜尋過濾條件
$limit = 10;
$offset = ($page - 1) * $limit;

// 設定基礎查詢語法
$sql = "SELECT * FROM rent_item WHERE is_deleted = 0";
$params = [];

// 如果有過濾條件，加入查詢條件
if (!empty($filter)) {
    $sql .= " AND name LIKE :filter"; // 模糊搜尋
    $params[':filter'] = '%' . $filter . '%';
}

// 添加排序和分頁
$sql .= " ORDER BY start_date DESC LIMIT :limit OFFSET :offset";
$params[':limit'] = $limit;
$params[':offset'] = $offset;


// 準備查詢
$stmt = $pdo->prepare($sql);

// 綁定參數
foreach ($params as $key => $value) {
    if ($key === ':limit' || $key === ':offset') {
        $stmt->bindValue($key, $value, PDO::PARAM_INT); // LIMIT 和 OFFSET 使用整數
    } else {
        $stmt->bindValue($key, $value, PDO::PARAM_STR); // 其他條件使用字串
    }
}

$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 計算總項目數量以支援分頁
$countSql = "SELECT COUNT(*) FROM rent_item WHERE is_deleted = 0";
if (!empty($filter)) {
    $countSql .= " AND name LIKE :filter"; // 同樣的過濾條件用於計算總數
}
$countStmt = $pdo->prepare($countSql);

if (!empty($filter)) {
    $countStmt->bindValue(':filter', '%' . $filter . '%', PDO::PARAM_STR);
}

$countStmt->execute();
$totalItems = $countStmt->fetchColumn();
$totalPages = ceil($totalItems / $limit);
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>查詢租賃商品</title>
    <!-- 統一的css -->
    <?php include("./css.php") ?>

    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom fonts (Gabarito)-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">



    <style>
        .column-seq {
            width: 80px;
        }

        .column-id {
            width: 100px;
        }

        .column-name {
            flex: 1;
        }

        .column-start {
            width: 200px;
        }

        .column-end {
            width: 200px;
        }

        .column-action {
            width: 80px;
        }

        .sortable {
            display: flex;
            align-items: center;
            cursor: pointer;
            color: #2c78db;
        }

        .sortable .bi {
            margin-left: 5px;
        }

        .w120px {
            width: 120px;
            padding-top: 0;
            padding-bottom: 0;
            line-height: 1;
            font-size: 16px;
            height: 40px;
        }

        .hover:hover {
            background-color: #e3efff;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include("./sidebar.php") ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include("./topbar.php") ?>
                <!-- End of Topbar -->
                <!-- 麵包屑 -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb rounded-0 p-3">
                        <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="rent_items.php">租賃商品列表</a></li>
                        <li class="breadcrumb-item active" aria-current="page">新增租賃商品</li>
                    </ol>
                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">新增租賃商品</h1>


                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-start align-items-center">
                            <!-- 返回 -->
                            <a href="rent_items.php" class="btn btn-secondary my-2"><i class="fa-solid fa-reply"></i> 返回租賃商品列表</a>
                        </div>



        

                            <div class="d-flex flex-column">
                                <div class="d-flex bg-light p-2 mb-2">


                                    <!-- 顯示搜尋結果 -->
                                    <?php if (!empty($items)): ?>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>名稱</th>
                                                    <th>上架時間</th>
                                                    <th>下架時間</th>
                                                    <th>操作</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($items as $item): ?>
                                                    <tr>
                                                        <td><?php echo $item['id']; ?></td>
                                                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                                                        <td><?php echo $item['start_date']; ?></td>
                                                        <td><?php echo $item['end_date'] ?? '未設置'; ?></td>
                                                        <td>
                                                            <a href="edit.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                                            <a href="delete.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('確定要刪除嗎？')"><i class="fa-solid fa-xmark"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                        <p class="text-muted">未找到符合條件的產品。</p>
                                    <?php endif; ?>
                                </div>

                            </div>
                            <!-- /.container-fluid -->

                        </div>
                        <!-- End of Main Content -->



                    </div>
                    <!-- End of Content Wrapper -->

                </div>
                <!-- End of Page Wrapper -->

                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

                <!-- Logout Modal-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-primary" href="login.html">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>

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

</body>

</html>