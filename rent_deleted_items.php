<!-- php -->
<?php
include 'PDO_connect.php';

// 每頁顯示的記錄數
$limit = 10;

// 當前頁碼
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// 設定排序字段和順序
$valid_columns = ['id', 'start_date', 'end_date'];
$sort_column = isset($_GET['sort_by']) && in_array($_GET['sort_by'], $valid_columns) ? $_GET['sort_by'] : 'id';
$sort_order = isset($_GET['sort_order']) && $_GET['sort_order'] === 'desc' ? 'desc' : 'asc';
$next_sort_order = $sort_order === 'asc' ? 'desc' : 'asc';

// 設定篩選條件
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// 根據篩選條件獲取總記錄數
$filter_query = "";
if ($filter === 'active') {
    $filter_query = "WHERE end_date IS NULL OR end_date > NOW()";
} elseif ($filter === 'expired') {
    $filter_query = "WHERE end_date IS NOT NULL AND end_date <= NOW()";
} elseif ($filter === 'permanent') {
    $filter_query = "WHERE end_date IS NULL";
}

try {
    // 計算總記錄數
    $sql = "SELECT COUNT(*) FROM rent_item $filter_query";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $total_results = $stmt->fetchColumn();
    $total_pages = ceil($total_results / $limit);

    // 根據篩選條件獲取資料
    $sql = "SELECT * FROM rent_item WHERE is_deleted = 1 LIMIT :start, :limit";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    $deletedItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
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

    <title>DiveIn-rent-items</title>
    <!-- 統一的css -->
    <?php include "css.php"; ?>

    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


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

        .custom-btn {
            width: 120px;
            height: 30px;
            line-height: 24px;
            text-align: center;
            font-size: 16px;
        }

        .column-action.d-flex .custom-btn {
            margin-right: 8px;
        }

        .column-action.d-flex .custom-btn:last-child {
            margin-right: 0;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sidebar.php"; ?>

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
                        <li class="breadcrumb-item active" aria-current="page">已刪除租賃商品列表</li>
                    </ol>
                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">已刪除租賃商品列表</h1>


                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-start align-items-center">
                            <!-- 返回 -->
                            <a href="rent_items.php" class="btn btn-secondary my-2"><i class="fa-solid fa-reply"></i> 返回租賃商品列表</a>
                        </div>

                        <div class="d-flex flex-column">
                            <div class="d-flex bg-light p-2 mb-2">
                                <!-- <div class="p-2 column-seq">序號</div> -->
                                <div class="p-2 column-id sortable" onclick="window.location.href='?filter=<?= $filter; ?>&sort_by=id&sort_order=<?= $next_sort_order; ?>'">編號<?php if ($sort_column === 'id') : ?>
                                    <i class="bi bi-caret-<?= $sort_order === 'asc' ? 'up' : 'down'; ?>-fill"></i>
                                <?php endif; ?>
                                </div>
                                <div class="p-2 column-name">產品名稱</div>
                                <div class="p-2 column-price">價格</div>
                                <div class="p-2 column-start sortable" onclick="window.location.href='?filter=<?= $filter; ?>&sort_by=start_date&sort_order=<?= $next_sort_order; ?>'">
                                    上架時間
                                    <?php if ($sort_column === 'start_date') : ?>
                                        <i class="bi bi-caret-<?= $sort_order === 'asc' ? 'up' : 'down'; ?>-fill"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="p-2 column-end sortable" onclick="window.location.href='?filter=<?= $filter; ?>&sort_by=end_date&sort_order=<?= $next_sort_order; ?>'">
                                    下架時間
                                    <?php if ($sort_column === 'end_date') : ?>
                                        <i class="bi bi-caret-<?= $sort_order === 'asc' ? 'up' : 'down'; ?>-fill"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="p-2 column-action">恢復</div>
                            </div>
                            <?php foreach ($deletedItems as $index => $deletedItem) : ?>
                                <div class="d-flex p-0 px-2 mb-1 border hover">
                                    <!-- <div class="p-2 column-seq"><?= $index + 1 + ($page - 1) * $limit; ?></div> -->
                                    <div class="p-2 column-id"><?= $deletedItem['id']; ?></div>
                                    <div class="p-2 column-name"><?= $deletedItem['name']; ?></div>
                                    <div class="p-2 column-price"><?= number_format($deletedItem['price'], 0); ?> 元</div>
                                    <div class="p-2 column-start"><?= $deletedItem['start_date']; ?></div>
                                    <div class="p-2 column-end"><?= $deletedItem['end_date']; ?></div>
                                    <div class="p-2 column-action d-flex justify-content-center">
                                        <a href="rent_restore.php?id=<?= $deletedItem['id']; ?>&page=<?= $page; ?>&filter=<?= $filter; ?>" class="btn btn btn-outline-dark btn-sm custom-btn"><i class="fa-solid fa-trash-can-arrow-up"></i></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

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