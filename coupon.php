<?php
require_once("../db_project_connect.php");

$couponSql = "SELECT * FROM coupon"; // 查詢優惠券的代碼
$resultCoupon = $conn->query($couponSql); // 執行查詢
$rows = $resultCoupon->fetch_all(MYSQLI_ASSOC); // 取得所有優惠券的資料

?>


<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>優惠券管理</title>

    <!-- 統一的css -->
    <?php include "css.php"; ?>

    <!-- 自訂css樣式 -->
    <?php include "coupon_css.php"; ?>

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
                <?php include "topbar.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">優惠券列表</h1>

                    <!-- 搜索表單 -->
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 p-0 mb-4 mt-3">
                        <form method="get" action="">
                            <div class="input-group">
                                <!-- 輸入框 -->
                                <input type="text" class="form-control" name="search" placeholder="搜尋優惠券名稱或代碼" value="">

                                <!-- 搜尋按鈕 -->
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Main Page Content -->
                <div class="mx-4">

                    <!-- 選項卡導航 -->
                    <div class="mb-1">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">全部</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">進行中</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">接下來的活動</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">已結束</a>
                            </li>
                        </ul>
                    </div>


                    <div class="d-flex justify-content-between my-2">

                        <!-- 顯示資料數量和頁數的區塊 -->
                        <div class="pagination-info pl-2 pt-1">
                            <span>共 <strong id="totalCount">X</strong> 筆資料，</span>
                            <span>共 <strong id="totalPages">Y</strong> 頁</span>
                        </div>

                        <div class="d-flex justify-content-end">
                            <!-- 日期篩選表單 -->
                            <div class="d-flex justify-content-end mr-1">
                                <form id="dateFilterForm" class="d-flex align-items-center">
                                    <!-- 開始日期 -->
                                    <div class="me-1">
                                        <label for="startDate" class="form-label visually-hidden">開始日期</label>
                                        <input type="date" class="form-control form-control-sm" id="startDate" name="startDate" placeholder="開始日期">
                                    </div>

                                    <!-- 波浪線 -->
                                    <div class="me-1">
                                        <span>~</span>
                                    </div>

                                    <!-- 結束日期 -->
                                    <div class="me-1">
                                        <label for="endDate" class="form-label visually-hidden">結束日期</label>
                                        <input type="date" class="form-control form-control-sm" id="endDate" name="endDate" placeholder="結束日期">
                                    </div>

                                    <!-- 提交按鈕 -->
                                    <button type="submit" class="btn btn-primary btn-sm mr-3">
                                        <i class="fa-solid fa-filter" style="color: #ffffff;"></i>
                                    </button>
                                </form>
                            </div>

                            <!-- 新增優惠券按鈕 -->
                            <div>
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fa-solid fa-plus" style="color: #ffffff;"></i> 新增
                                </button>
                            </div>
                        </div>

                    </div>

                    <!-- 優惠券列表 -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="coupon-list">序號</th>
                                    <th class="coupon-list-name">優惠券名稱 | 代碼</th>
                                    <th class="coupon-list">
                                        適用服務
                                        <!-- 下拉選單 -->
                                        <button class="dropdown-toggle custom-dropdown-sm" type="submit" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">全部</a></li>
                                            <li><a class="dropdown-item" href="#">商品</a></li>
                                            <li><a class="dropdown-item" href="#">租賃</a></li>
                                            <li><a class="dropdown-item" href="#">課程</a></li>
                                            <li><a class="dropdown-item" href="#">活動</a></li>
                                            <li><a class="dropdown-item" href="#">揪團</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#">清除篩選</a></li>
                                        </ul>
                                    </th>
                                    <th class="coupon-list">
                                        目標買家
                                        <!-- 下拉選單 -->
                                        <button class="dropdown-toggle custom-dropdown-sm" type="submit" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">全部會員</a></li>
                                            <li><a class="dropdown-item" href="#">新會員</a></li>
                                            <li><a class="dropdown-item" href="#">VIP會員</a></li>
                                            <li><a class="dropdown-item" href="#">學生會員</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#">清除篩選</a></li>
                                        </ul>
                                    </th>
                                    <th class="coupon-list">
                                        折扣方式
                                        <!-- 下拉選單 -->
                                        <button class="dropdown-toggle custom-dropdown-sm" type="submit" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">折數</a></li>
                                            <li><a class="dropdown-item" href="#">金額</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#">清除篩選</a></li>
                                        </ul>
                                    </th>
                                    <th class="coupon-list">
                                        折扣額度
                                        <!-- 排序按鈕 -->
                                        <button class="btn btn-link btn-sm" onclick="sortTable(5)">
                                            <i id="discount-sort-icon" class="fas fa-sort"></i>
                                        </button>
                                    </th>
                                    <th class="coupon-list">
                                        可使用
                                        <!-- 排序按鈕 -->
                                        <button class="btn btn-link btn-sm" onclick="sortTable(5)">
                                            <i id="discount-sort-icon" class="fas fa-sort"></i>
                                        </button>
                                    </th>
                                    <th class="coupon-list">
                                        已使用
                                        <!-- 排序按鈕 -->
                                        <button class="btn btn-link btn-sm" onclick="sortTable(5)">
                                            <i id="discount-sort-icon" class="fas fa-sort"></i>
                                        </button>
                                    </th>
                                    <th class="coupon-list">
                                        <!-- 排序按鈕 -->
                                        開始日期
                                        <button class="btn btn-link btn-sm" onclick="sortTable(5)">
                                            <i id="discount-sort-icon" class="fas fa-sort"></i>
                                        </button>
                                    </th>
                                    <th class="coupon-list">
                                        <!-- 排序按鈕 -->
                                        結束日期
                                        <button class="btn btn-link btn-sm" onclick="sortTable(5)">
                                            <i id="discount-sort-icon" class="fas fa-sort"></i>
                                        </button>
                                    </th>
                                    <th class="coupon-list">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $index => $coupon): ?>
                                    <tr>
                                        <td class="coupon-list coupon-tbody-list"><?= $index + 1 ?></td>
                                        <td class="coupon-list-name">
                                            <?php
                                            if ($coupon["status"] == 'active') {
                                                echo "<span class='badge rounded-pill text-bg-danger'>進行中</span>";
                                            } elseif ($coupon["status"] == 'inactive') {
                                                echo "<span class='badge rounded-pill text-bg-success'>接下來的活動</span>";
                                            } elseif ($coupon["status"] == 'expired') {
                                                echo "<span class='badge rounded-pill text-bg-secondary'>已結束</span>";
                                            }
                                            ?><br>
                                            <?= $coupon["name"] ?><br>
                                            <?= $coupon["code"] ?>
                                        </td>
                                        <td class="coupon-list coupon-tbody-list"><?= $coupon["product_id"] ?></td>
                                        <td class="coupon-list coupon-tbody-list"><?= $coupon["targetMembers"] ?></td>
                                        <td class="coupon-list coupon-tbody-list">
                                            <?php
                                            if ($coupon["discountType"] == 'percentage') {
                                                echo "折數";
                                            } elseif ($coupon["discountType"] == 'fixed') {
                                                echo "金額";
                                            }
                                            ?>
                                        </td>
                                        <td class="coupon-list coupon-tbody-list">
                                            <?php
                                            if ($coupon["discountType"] == 'percentage') {
                                                echo floor($coupon["discountValue"]) . '%'; //顯示百分比， 向下取整，去掉小數 
                                            } elseif ($coupon["discountType"] == 'fixed') {
                                                echo '$' . number_format($coupon["discountValue"], 0); // 顯示固定金額，格式化為貨幣
                                            }
                                            ?>
                                        </td>
                                        <td class="coupon-list coupon-tbody-list"><?= $coupon["usageLimit"] ?></td><!--可使用-->
                                        <td class="coupon-list coupon-tbody-list"><?= $coupon["usedCount"] ?></td><!--已使用-->
                                        <td class="coupon-list coupon-tbody-list"><?= date('Y-m-d', strtotime($coupon["startDate"])) ?></td>
                                        <td class="coupon-list coupon-tbody-list"><?= date('Y-m-d', strtotime($coupon["endDate"])) ?></td>
                                        <td class="text-center">
                                            <a href=""><i class="fa-solid fa-pen-to-square" style="color: #3f8ad9;"></i></a><br>
                                            <a href=""><i class="fa-solid fa-trash-can" style="color: #e55757;"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- 優惠券列表 結束 -->

                    <!-- 分頁導航 -->
                    <div class="d-flex justify-content-center mt-2">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer> -->
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
                    <a class="btn btn-info" href="login.html">Logout</a>
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

    <!-- bootstrap5的JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- <?php // include "coupon_js.php"; 
            ?> -->
</body>

</html>