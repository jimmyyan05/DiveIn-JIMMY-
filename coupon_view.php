<?php
// 引入資料庫連線設定檔案
require_once("../db_project_connect.php");

if (!isset($_GET["id"])) {
    echo "請帶入 id 到此頁";
    exit;
}
$id = $_GET["id"];

$sql = "SELECT * FROM coupon WHERE id='$id' AND is_deleted IS Null";

$result = $conn->query($sql);
$row = $result->fetch_assoc();



?>


<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>檢視優惠券</title>
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
                <?php include "topbar.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container mt-5">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-primary btn-sm me-2 mb-4" href="coupon_list.php"><i class="fa-solid fa-left-long fa-fw"></i></a>
                        <h1 class="h3 text-gray-800 mb-4">優惠券基本資訊</h1>
                    </div>
                    <!-- 優惠券新增表單 -->
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="POST">
                                <!-- 送出按鈕 -->
                                 <div class="d-flex justify-content-end">
                                <a href="coupon_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">編輯</a>
                                </div>
                                <!-- 隱藏 ID 用於更新 -->
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <!-- 優惠券代碼輸入欄位 -->
                                <div class="mb-3">
                                    <label for="code" class="form-label">優惠券代碼</label>
                                    <input type="text" name="code" class="form-control" value="<?php echo htmlspecialchars($row['code']); ?>" readonly>
                                </div>

                                <!-- 優惠券名稱輸入欄位 -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">優惠券名稱</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($row['name']); ?>" readonly>
                                </div>

                                <!-- 折扣類型選擇欄位 -->
                                <div class="mb-3">
                                    <label for="discountType" class="form-label">折扣類型</label>
                                    <select name="discountType" class="form-select" disabled>
                                        <option value="percentage" <?php echo ($row['discountType'] == 'percentage' ? 'selected' : ''); ?>>折數</option>
                                        <option value="fixed" <?php echo ($row['discountType'] == 'fixed' ? 'selected' : ''); ?>>金額</option>
                                    </select>
                                </div>

                                <!-- 折扣數值輸入欄位 -->
                                <div class="mb-3">
                                    <label for="discountValue" class="form-label">折扣數值</label>
                                    <input type="number" name="discountValue" class="form-control" value="<?php echo htmlspecialchars($row['discountValue']); ?>" readonly>
                                </div>

                                <!-- 開始日期欄位 -->
                                <div class="mb-3">
                                    <label for="startDate" class="form-label">開始日期</label>
                                    <!-- 使用 date 函數將日期轉換為 YYYY-MM-DD 格式 -->
                                    <input type="date" name="startDate" class="form-control" value="<?php echo htmlspecialchars(date('Y-m-d', strtotime($row['startDate']))); ?>" readonly>
                                </div>

                                <!-- 結束日期欄位 -->
                                <div class="mb-3">
                                    <label for="endDate" class="form-label">結束日期</label>
                                    <!-- 使用 date 函數將 endDate 轉換為 YYYY-MM-DD 格式 -->
                                    <input type="date" name="endDate" class="form-control" value="<?php echo htmlspecialchars(date('Y-m-d', strtotime($row['endDate']))); ?>" readonly>
                                </div>

                                <!-- 最低消費金額欄位 -->
                                <div class="mb-3">
                                    <label for="minPurchase" class="form-label">最低消費金額</label>
                                    <input type="number" name="minPurchase" class="form-control" value="<?php echo htmlspecialchars($row['minPurchase']); ?>" readonly>
                                </div>

                                <!-- 最大折扣金額欄位 -->
                                <div class="mb-3">
                                    <label for="maxDiscountValue" class="form-label">最大折扣金額</label>
                                    <input type="number" name="c" class="form-control" value="<?php echo htmlspecialchars($row['maxDiscountValue']); ?>" readonly>
                                </div>

                                <!-- 目標會員欄位 -->
                                <div class="mb-3">
                                    <label for="targetMembers" class="form-label">目標會員</label>
                                    <select name="targetMembers" class="form-select" disabled>
                                        <option value="全部會員" <?php echo ($row['targetMembers'] == '全部會員' ? 'selected' : ''); ?>>全部會員</option>
                                        <option value="新會員" <?php echo ($row['targetMembers'] == '新會員' ? 'selected' : ''); ?>>新會員</option>
                                        <option value="VIP會員" <?php echo ($row['targetMembers'] == 'VIP會員' ? 'selected' : ''); ?>>VIP會員</option>
                                        <option value="學生會員" <?php echo ($row['targetMembers'] == '學生會員' ? 'selected' : ''); ?>>學生會員</option>
                                    </select>
                                </div>

                                <!-- 產品類型欄位 -->
                                <div class="mb-3">
                                    <label for="product_id" class="form-label">適用服務</label>
                                    <select name="product_id" class="form-select" disabled>
                                        <option value="全部" <?php echo ($row['product_id'] == '全部' ? 'selected' : ''); ?>>全部</option>
                                        <option value="商品" <?php echo ($row['product_id'] == '商品' ? 'selected' : ''); ?>>商品</option>
                                        <option value="租賃" <?php echo ($row['product_id'] == '租賃' ? 'selected' : ''); ?>>租賃</option>
                                        <option value="課程" <?php echo ($row['product_id'] == '課程' ? 'selected' : ''); ?>>課程</option>
                                        <option value="活動" <?php echo ($row['product_id'] == '活動' ? 'selected' : ''); ?>>活動</option>
                                        <option value="揪團" <?php echo ($row['product_id'] == '揪團' ? 'selected' : ''); ?>>揪團</option>
                                    </select>
                                </div>

                                <!-- 優惠券數量欄位 -->
                                <div class="mb-3">
                                    <label for="usageLimit" class="form-label">優惠券數量</label>
                                    <input type="number" name="usageLimit" class="form-control" value="<?php echo htmlspecialchars($row['usageLimit']); ?>" readonly>
                                </div>

                                <!-- 使用者數量限制欄位 -->
                                <div class="mb-3">
                                    <label for="userLimit" class="form-label">每個用戶可使用次數</label>
                                    <input type="number" name="userLimit" class="form-control" value="<?php echo htmlspecialchars($row['userLimit']); ?>" readonly>
                                </div>

                                <!-- 優惠券描述欄位 -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">優惠券描述</label>
                                    <textarea name="description" rows="3" class="form-control" readonly><?php echo htmlspecialchars($row['description']); ?></textarea>
                                </div>

                            </form>
                        </div>
                    </div>
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