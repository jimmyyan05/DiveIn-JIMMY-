<?php
require_once("../db_project_connect.php");

// 隨機生成優惠券代碼
function generateCouponCode()
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $couponCode = '';
    for ($i = 0; $i < 8; $i++) {
        $couponCode .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $couponCode;
}

// 檢查優惠券代碼是否已存在
function checkCouponCodeExists($couponCode)
{
    global $conn;
    $sql = "SELECT * FROM coupon WHERE code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $couponCode);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0; // 如果存在，返回 true
}

// 確保生成的代碼不與資料庫重複
function generateUniqueCouponCode()
{
    do {
        $newCouponCode = generateCouponCode();
    } while (checkCouponCodeExists($newCouponCode)); // 如果代碼已存在，繼續生成
    return $newCouponCode;
}

// 生成唯一的優惠券代碼
$couponCode = generateUniqueCouponCode(); // 生成唯一代碼



?>

<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增優惠券</title>
    <!-- 包含CSS -->
    <?php include "css.php"; ?>
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
                <?php include "topbar.php" ?>
                <!-- End of Topbar -->
                <!-- 麵包屑 -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb rounded-0 p-3">
                        <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                        <li class="breadcrumb-item"><a href="coupon_list.php">優惠券列表</a></li>
                        <li class="breadcrumb-item active" aria-current="page">新增優惠券</li>
                    </ol>
                </nav>


                <!-- 優惠券代碼顯示區 -->
                <div class="container mt-5">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-primary btn-sm me-2 mb-4" href="coupon_list.php"><i class="fa-solid fa-left-long fa-fw"></i></a>
                        <h1 class="h3 text-gray-800 mb-4">新增優惠券</h1>
                    </div>

                    <form action="coupon_doCreate.php" method="POST">
                        <!-- 顯示生成的優惠券代碼 -->
                        <div class="mb-3">
                            <label for="code" class="form-label">優惠券代碼</label>
                            <input type="text" class="form-control" id="couponCode" name="code" value="<?php echo $couponCode; ?>" readonly>
                            <button type="button" class="btn btn-outline-secondary mt-2" id="generateCouponBtn">
                                <i class="fas fa-sync-alt"></i> 生成優惠券代碼
                            </button>
                        </div>

                        <!-- 優惠券名稱 -->
                        <div class="mb-3">
                            <label for="name" class="form-label">優惠券名稱</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <!-- 折扣類型與折扣數值 -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="discountType" class="form-label">折扣類型</label>
                                <select class="form-select" id="discountType" name="discountType" required>
                                    <option value="percentage">折數</option>
                                    <option value="fixed">金額</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="discountValue" class="form-label">折扣數值</label>
                                <input type="number" class="form-control" id="discountValue" name="discountValue" required>
                            </div>
                        </div>

                        <!-- 目標會員與產品類型 -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="targetMembers" class="form-label">目標會員</label>
                                <select class="form-select" id="targetMembers" name="targetMembers" required>
                                    <option value="全部會員">全部會員</option>
                                    <option value="新會員">新會員</option>
                                    <option value="VIP會員">VIP會員</option>
                                    <option value="學生會員">學生會員</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="productType" class="form-label">適用服務</label>
                                <select class="form-select" id="product_id" name="product_id" required>
                                    <option value="全部">全部</option>
                                    <option value="商品">商品</option>
                                    <option value="租賃">租賃</option>
                                    <option value="課程">課程</option>
                                    <option value="活動">活動</option>
                                    <option value="揪團">揪團</option>
                                </select>
                            </div>
                        </div>

                        <!-- 日期範圍 -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="startDate" class="form-label">開始日期</label>
                                <input type="date" class="form-control" id="startDate" name="startDate" required>
                            </div>
                            <div class="col-md-6">
                                <label for="endDate" class="form-label">結束日期</label>
                                <input type="date" class="form-control" id="endDate" name="endDate" required>
                            </div>
                        </div>

                        <!-- 最低消費金額與最大折扣 -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="minPurchase" class="form-label">最低消費金額</label>
                                <input type="number" class="form-control" id="minPurchase" name="minPurchase" required>
                            </div>
                            <div class="col-md-4">
                                <label for="maxDiscountValue" class="form-label">最大折扣金額</label>
                                <input type="number" class="form-control" id="maxDiscountValue" name="maxDiscountValue" required>
                            </div>
                            <!-- 使用與用戶限制 -->
                            <div class="col-md-4">
                                <label for="usageLimit" class="form-label">優惠券數量</label>
                                <input type="number" class="form-control" id="usageLimit" name="usageLimit" required>
                            </div>

                        </div>

                        <!-- 優惠券描述 -->
                        <div class="mb-3">
                            <label for="description" class="form-label">優惠券描述</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>

                        <!-- 送出按鈕 -->
                        <div class="d-flex justify-content-end my-3">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                送出
                            </button>
                        </div>
                    </form>
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


            <!-- End of Content Wrapper -->


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

    <!-- 引入Bootstrap的JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- 生成新優惠券代碼的功能 -->
    <script>
        // 點擊生成優惠券代碼按鈕，頁面重新整理，並生成新的優惠券代碼
        document.getElementById("generateCouponBtn").addEventListener("click", function() {
            window.location.reload(); // 重新整理頁面
        });
    </script>



</body>

</html>