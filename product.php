<?php
require_once("../db_project_connect.php");

// 取得所有大類別供下拉選單使用
$sql_categories = "SELECT DISTINCT pcb.id, pcb.name 
                  FROM product_category_big pcb";
$result_categories = $conn->query($sql_categories);
$big_categories = $result_categories->fetch_all(MYSQLI_ASSOC);

// 取得所有小類別供下拉選單使用
$sql_subcategories = "SELECT DISTINCT pcs.id, pcs.name, pcs.product_category_big_id 
                     FROM product_category_small pcs";
$result_subcategories = $conn->query($sql_subcategories);
$small_categories = $result_subcategories->fetch_all(MYSQLI_ASSOC);

// 建立篩選條件
$where_conditions = ["product.isDeleted = 0"];

if (isset($_GET['big_category']) && !empty($_GET['big_category'])) {
    $big_category = $conn->real_escape_string($_GET['big_category']);
    $where_conditions[] = "product_category_big.id = '$big_category'";
}

if (isset($_GET['small_category']) && !empty($_GET['small_category'])) {
    $small_category = $conn->real_escape_string($_GET['small_category']);
    $where_conditions[] = "product_category_small.id = '$small_category'";
}

// 組合 WHERE 條件
$where_clause = implode(" AND ", $where_conditions);

// 修改原本的查詢
$sql = "SELECT 
    product.*,
    product_image.imgUrl,
    product_image.name AS image_name,
    product_category_small.name AS category_name,
    product_category_big.name AS big_category_name,
    brand.name AS brand_name
FROM product 
LEFT JOIN product_image ON product_image.product_id = product.id AND product_image.isMain = 1 AND product_image.isDeleted = 0
LEFT JOIN product_category_small ON product.product_category_small_id = product_category_small.id
LEFT JOIN product_category_big ON product_category_big.id = product_category_small.product_category_big_id
LEFT JOIN product_specification ON product_specification.product_id = product.id
LEFT JOIN brand ON brand.id = product_specification.brand_id
WHERE $where_clause";

$result = $conn->query($sql);
if (!$result) {
    die("查詢失敗: " . $conn->error);
}
$productCount = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>商品管理</title>

    <?php include("./css.php") ?>

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

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <h2>商品列表</h2>
                        <div class="d-flex gap-2 align-items-center">
                            <!-- 批次操作按鈕 -->
                            <div class="batch-actions d-none">
                                <button class="btn btn-danger" onclick="batchDelete()">
                                    <i class="fas fa-trash-alt me-1"></i>批次刪除
                                </button>
                            </div>
                            <!-- 新增商品按鈕 -->
                            <a href="create_product.php" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>新增商品
                            </a>
                            <!-- 垃圾桶按鈕 -->
                            <a href="trash.php" class="btn btn-secondary d-flex align-items-center gap-1">
                                <i class="fas fa-trash me-1"></i>垃圾桶
                                <?php
                                $trash_count = $conn->query("SELECT COUNT(*) as count FROM product WHERE isDeleted = 1")->fetch_assoc()['count'];
                                if ($trash_count > 0): ?>
                                    <span class="badge bg-danger"><?= $trash_count ?></span>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">商品管理系統</h1>
                    <a class="" href="create_product.php"><button class="btn btn-primary mb-2">新增商品</button></a> -->

                    <!-- DataTales Example -->
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">共計<?= $productCount ?>樣商品</h6>
                            <div>
                                <form class="d-flex align-items-center m-0" method="GET">
                                    <!-- 大類別選擇 -->
                                    <div class="input-group input-group-sm">
                                        <select class="form-select  me-2" aria-label="大類別選擇" name="big_category" id="big_category">
                                            <option value="">全部大類別</option>
                                            <?php foreach ($big_categories as $category): ?>
                                                <option value="<?= $category['id'] ?>" <?= (isset($_GET['big_category']) && $_GET['big_category'] == $category['id']) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($category['name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- 小類別選擇 -->
                                    <div class="input-group input-group-sm">
                                        <select class="form-select border-end-0" aria-label="小類別選擇" name="small_category" id="small_category">
                                            <option value="">全部小類別</option>
                                            <?php foreach ($small_categories as $category): ?>
                                                <option value="<?= $category['id'] ?>"
                                                    data-big-category="<?= $category['product_category_big_id'] ?>"
                                                    <?= (isset($_GET['small_category']) && $_GET['small_category'] == $category['id']) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($category['name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- 篩選按鈕 -->
                                    <button type="submit" class="btn btn-primary d-flex align-items-center rounded-start-0" data-bs-toggle="tooltip" data-bs-placement="top" title="篩選">
                                        <i class="fas fa-filter"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>編號</th>
                                            <th>照片</th>
                                            <th>商品名稱</th>
                                            <th>種類</th>
                                            <th>品牌</th>
                                            <th>價格</th>
                                            <th>狀態</th>
                                            <th>庫存</th>
                                            <th>修改</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($rows as $row): ?>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td><?= $row["id"] ?></td>
                                                <td>
                                                    <figure class="ratio ratio-4x3 rounded overflow-hidden" style="width: 100px; height: 100px;">
                                                        <?php if (!empty($row["imgUrl"])): ?>
                                                            <img class="object-fit-cover img-thumbnail" src="img/product/<?= htmlspecialchars($row["imgUrl"]) ?>" alt="<?= htmlspecialchars($row["name"]) ?>">
                                                        <?php else: ?>
                                                            <img class="object-fit-cover img-thumbnail" src="img/product/no-image.jpg" alt="無圖片">
                                                        <?php endif; ?>
                                                    </figure>
                                                </td>
                                                <td><?= htmlspecialchars($row["name"]) ?></td>
                                                <td>
                                                    <?= htmlspecialchars($row["big_category_name"] ?? '') ?>
                                                    ｜<?= htmlspecialchars($row["category_name"] ?? '') ?>
                                                </td>
                                                <td><?= ($row["brand_name"] ?? '') ?></td>
                                                <td><?= number_format($row["price"]) ?></td>
                                                <!-- 改進後的狀態顯示 -->
                                                <td>
                                                    <?php
                                                    $statusClass = '';
                                                    $statusIcon = '';
                                                    $statusText = htmlspecialchars($row["status"]);

                                                    switch ($row["status"]) {
                                                        case "上架中":
                                                            $statusClass = 'badge bg-success fs-5 p-2 text-white'; // 加入 text-white
                                                            $statusIcon = '<i class="fas fa-check-circle me-1"></i>';
                                                            break;
                                                        case "下架中":
                                                            $statusClass = 'badge bg-danger fs-5 p-2 text-white';
                                                            $statusIcon = '<i class="fas fa-times-circle me-1"></i>';
                                                            break;
                                                        case "待上架":
                                                            $statusClass = 'badge bg-warning fs-5 p-2 text-white';
                                                            $statusIcon = '<i class="fas fa-clock me-1"></i>';
                                                            break;
                                                    }
                                                    ?>
                                                    <span class="<?= $statusClass ?>">
                                                        <?= $statusIcon . $statusText ?>
                                                    </span>
                                                </td>
                                                <td><?= htmlspecialchars($row["stock"]) ?></td>


                                                <!-- 改進後的操作按鈕 -->
                                                <td class="d-flex gap-2">
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            操作
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="edit_product.php?id=<?= $row["id"] ?>">編輯</a></li>
                                                            <li><button class="dropdown-item" onclick="toggleStatus(<?= $row['id'] ?>, '<?= $row['status'] ?>')">
                                                                    <?= $row['status'] === '上架中' ? '下架' : '上架' ?>
                                                                </button></li>
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li><button class="dropdown-item text-danger" onclick="confirmDelete(<?= $row['id'] ?>)">刪除</button></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>
        <script>
            $(document).ready(function() {
                // 使用更精確的選擇器，確保能捕捉到事件
                $('body').on('change', '#dataTable tbody input[type="checkbox"]', function() {
                    console.log('Checkbox changed'); // 用於除錯
                    updateBatchActionVisibility();
                });
            });

            function updateBatchActionVisibility() {
                let checkedCount = $('#dataTable tbody input[type="checkbox"]:checked').length;
                console.log('Checked count:', checkedCount); // 用於除錯

                if (checkedCount > 0) {
                    $('.batch-actions').removeClass('d-none');
                } else {
                    $('.batch-actions').addClass('d-none');
                }
            }

            function batchDelete() {
                var selectedIds = [];

                $('#dataTable tbody input[type="checkbox"]:checked').each(function() {
                    var row = $(this).closest('tr');
                    var id = row.find('td:eq(1)').text(); // 假設 ID 在第二列
                    selectedIds.push(id);
                });

                if (selectedIds.length === 0) {
                    alert('請選擇要刪除的項目');
                    return;
                }

                if (confirm('確定要刪除選中的 ' + selectedIds.length + ' 個項目嗎？')) {
                    $.ajax({
                        url: 'batch_delete.php',
                        method: 'POST',
                        data: {
                            ids: selectedIds
                        },
                        success: function(response) {
                            if (response.success) {
                                location.reload();
                            } else {
                                alert('刪除失敗：' + response.message);
                            }
                        },
                        error: function() {
                            alert('刪除請求失敗，請稍後再試');
                        }
                    });
                }
            }
            //

            // 等待頁面完全載入後再初始化 tooltips
            document.addEventListener('DOMContentLoaded', function() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                })
            });

            document.getElementById('big_category').addEventListener('change', function() {
                const bigCategoryId = this.value;
                const smallCategorySelect = document.getElementById('small_category');
                const options = smallCategorySelect.getElementsByTagName('option');

                for (let option of options) {
                    if (option.value === '') continue; // 跳過"全部"選項

                    const bigCatId = option.getAttribute('data-big-category');
                    if (!bigCategoryId || bigCatId === bigCategoryId) {
                        option.style.display = '';
                    } else {
                        option.style.display = 'none';
                    }
                }

                // 重置小類別選擇
                smallCategorySelect.value = '';
            });

            function confirmDelete(id) {
                if (confirm('確定要刪除此商品嗎？')) {
                    // 使用 AJAX 發送刪除請求
                    fetch('delete_product.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                id: id
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                alert('商品已成功刪除！');
                                // 重新載入頁面或從 DOM 中移除該行
                                location.reload();
                            } else {
                                alert('刪除失敗：' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('刪除過程發生錯誤，請稍後再試。');
                        });
                }
            }
            // 新增 toggleStatus 函數
            function toggleStatus(id, currentStatus) {
                // 依照當前狀態決定下一個狀態
                let newStatus;
                switch (currentStatus) {
                    case '上架中':
                        newStatus = '下架中';
                        break;
                    case '下架中':
                        newStatus = '待上架';
                        break;
                    case '待上架':
                        newStatus = '上架中';
                        break;
                    default:
                        newStatus = '待上架';
                }

                fetch('update_product_status.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id: id,
                            status: newStatus
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('更新狀態失敗');
                    });
            }
        </script>
</body>

</html>