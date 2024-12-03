<?php
// 引入資料庫連線檔案
require_once("../db_project_connect.php");

// 每頁顯示的項目數量
$per_page = 10;

// 取得篩選條件
$status = isset($_GET['status']) ? $_GET['status'] : 'all'; // 默認為顯示所有優惠券
$targetMembers = isset($_GET['targetMembers']) ? $_GET['targetMembers'] : 'all';
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : 'all';  // 添加 product_id 變數
$discountType = isset($_GET['discountType']) ? $_GET['discountType'] : 'all';
$search = isset($_GET['search']) ? $_GET['search'] : '';  // 搜尋關鍵字
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : ''; // 開始日期
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : ''; // 結束日期

// 排序設定
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'ID'; // 默認排序字段
$order = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'DESC' : 'ASC'; // 默認為升序

// 查詢所有未刪除的優惠券，假設 is_deleted 欄位為 NULL 表示未刪除
$sqlAll = "SELECT * FROM coupon WHERE is_deleted IS NULL";
$resultAll = $conn->query($sqlAll); // 執行查詢所有未刪除的優惠券
$couponAllCount = $resultAll->num_rows; // 儲存所有未刪除優惠券的總數量

// 篩選條件的 SQL 查詢
$sqlWhere = "WHERE is_deleted IS NULL"; // 默認為所有未刪除的優惠券

// 根據選擇的篩選條件進行處理
if ($status != 'all') {
    $sqlWhere .= " AND status = '$status'";
}
if ($product_id != 'all') {
    $sqlWhere .= " AND product_id = '$product_id'";
}
if ($targetMembers != 'all') {
    $sqlWhere .= " AND targetMembers = '$targetMembers'";
}
if ($discountType != 'all') {
    $sqlWhere .= " AND discountType = '$discountType'";
}
if (!empty($search)) {
    $sqlWhere .= " AND (name LIKE '%$search%' OR code LIKE '%$search%')";
}
if (!empty($startDate)) {
    $sqlWhere .= " AND startDate >= '$startDate'"; // 開始日期篩選
}
if (!empty($endDate)) {
    $sqlWhere .= " AND endDate <= '$endDate'"; // 結束日期篩選
}

// 計算符合篩選條件的資料數量
$sql = "SELECT * FROM coupon $sqlWhere";
$resultFiltered = $conn->query($sql);
$coupon_count = $resultFiltered->num_rows; // 符合篩選條件的資料數量

// 計算總頁數
$total_page = ceil($coupon_count / $per_page);

// 預設頁數為 1
$p = isset($_GET["p"]) ? $_GET["p"] : 1; // 當前頁數
$start_item = ($p - 1) * $per_page; // 計算當前頁數的起始項目
$sql .= " ORDER BY $sort_by $order LIMIT $start_item, $per_page"; // 設定排序並限制每頁顯示的資料數量

// 執行最終的查詢，根據搜尋或分頁結果來取得優惠券資料
$result = $conn->query($sql);

// 檢查搜尋結果是否為空，若為空顯示提示訊息
$no_results_message = $coupon_count == 0 ? "目前沒有符合條件的資料。" : "";

// 取得查詢結果的所有資料，並以關聯陣列的方式儲存
$rows = $result->fetch_all(MYSQLI_ASSOC);

// 分頁鏈接生成
function createPaginationLink($page_num)
{
    $url = "?p=$page_num";
    // 保留其他篩選參數
    $filters = ['status', 'targetMembers', 'product_id', 'discountType', 'search', 'startDate', 'endDate'];
    foreach ($filters as $param) {
        if (isset($_GET[$param])) {
            $url .= "&$param=" . $_GET[$param];
        }
    }
    return $url;
}

// 用來顯示排序方向的圖示
function getSortIcon($current_sort_by, $current_order, $column)
{
    if ($current_sort_by == $column) {
        return $current_order == 'ASC' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>';
    }
    return '<i class="fas fa-sort"></i>';
}

function createReturnLink()
{
    // 保留所有篩選和排序參數
    $url = "coupon_list.php";
    $filters = ['status', 'targetMembers', 'product_id', 'discountType', 'search', 'startDate', 'endDate', 'sort_by', 'order'];
    foreach ($filters as $param) {
        if (isset($_GET[$param])) {
            $url .= "&$param=" . urlencode($_GET[$param]);
        }
    }
    return $url;
}

// 單獨清除排序條件的返回鏈接
function createClearSortLink()
{
    $url = "coupon_list.php";

    // 需要保留的篩選參數
    $filters = ['status', 'targetMembers', 'product_id', 'discountType', 'search', 'startDate', 'endDate'];

    // 遍歷篩選參數，保留其他篩選條件
    foreach ($filters as $param) {
        if (isset($_GET[$param]) && $_GET[$param] !== '') {
            $url .= "&$param=" . urlencode($_GET[$param]);
        }
    }

    return $url;
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

    <title>優惠券管理</title>

    <!-- 統一的css -->
    <?php include "css.php"; ?>

    <!-- 自訂css樣式 -->
    <?php include "couponCSS_list.php"; ?>

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
                <!-- 麵包屑 -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb rounded-0 p-3">
                        <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">優惠券列表</li>
                    </ol>
                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">



                    <!-- Page Heading -->
                    <div class="d-flex align-items-center">
                        <?php if (isset($_GET["search"]) || isset($_GET["targetMembers"]) || isset($_GET["product_id"]) || isset($_GET["discountType"]) || isset($_GET["startDate"]) || isset($_GET["endDate"]) || isset($_GET["sort"])): ?>
                            <!-- 返回鍵，清除篩選 -->
                            <a class="btn btn-primary btn-sm me-2 mb-4" href="coupon_list.php">
                                <i class="fa-solid fa-left-long fa-fw"></i>
                            </a>
                        <?php endif; ?>
                        <?php if (isset($_GET["sort_by"]) || isset($_GET["order"])): ?>
                            <!-- 清除排序的返回鍵 -->
                            <a class="btn btn-primary btn-sm me-2 mb-4" href="<?php echo createClearSortLink(); ?>">
                                <i class="fa-solid fa-left-long fa-fw"></i>
                            </a>
                        <?php endif; ?>
                        <div class="d-flex justify-content-between container-fluid p-0">
                            <h1 class="h3 text-gray-800 m-0">優惠券列表</h1>
                            <!-- 搜尋功能的 HTML 表單 -->
                            <div class="col-12 col-sm-8 col-md-3 p-0 mt-3">
                                <form method="get" action="coupon_list.php">
                                    <div class="input-group">
                                        <!-- 輸入框：搜尋優惠券名稱或代碼 -->
                                        <input type="search" class="form-control" name="search" placeholder="搜尋優惠券名稱或代碼" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

                                        <!-- 搜尋按鈕 -->
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i>
                                        </button>
                                    </div>

                                    <!-- 保留篩選條件 -->
                                    <input type="hidden" name="status" value="<?php echo isset($_GET['status']) ? $_GET['status'] : 'all'; ?>">
                                    <input type="hidden" name="targetMembers" value="<?php echo isset($_GET['targetMembers']) ? $_GET['targetMembers'] : 'all'; ?>">
                                    <input type="hidden" name="product_id" value="<?php echo isset($_GET['product_id']) ? $_GET['product_id'] : 'all'; ?>">
                                    <input type="hidden" name="discountType" value="<?php echo isset($_GET['discountType']) ? $_GET['discountType'] : 'all'; ?>">
                                </form>
                            </div>
                        </div>
                    </div>



                </div>

                <!-- Main Page Content -->
                <div class="mx-4">

                    <!-- 選項卡導航 -->
                    <div class="mb-1">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($status == 'all') ? 'active' : ''; ?>" href="?status=all<?php echo isset($_GET['search']) ? '&search=' . $_GET['search'] : ''; ?>">全部</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($status == 'active') ? 'active' : ''; ?>" href="?status=active<?php echo isset($_GET['search']) ? '&search=' . $_GET['search'] : ''; ?>">進行中</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($status == 'inactive') ? 'active' : ''; ?>" href="?status=inactive<?php echo isset($_GET['search']) ? '&search=' . $_GET['search'] : ''; ?>">接下來的活動</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($status == 'expired') ? 'active' : ''; ?>" href="?status=expired<?php echo isset($_GET['search']) ? '&search=' . $_GET['search'] : ''; ?>">已結束</a>
                            </li>
                        </ul>
                    </div>


                    <div class="d-flex justify-content-between my-2">

                        <!-- 顯示搜尋不到資料的提示 -->
                        <?php if (!empty($no_results_message)): ?>
                            <div class="alert">
                                <?php echo $no_results_message; ?>
                            </div>
                        <?php endif; ?>

                        <!-- 顯示資料數量和頁數 -->
                        <?php if ($coupon_count > 0): ?>
                            <div class="pagination-info pl-2 pt-1">
                                <span><strong><?php echo $coupon_count; ?></strong> 筆資料，</span>
                                <span>共 <strong><?php echo $total_page; ?></strong> 頁</span>
                            </div>
                        <?php endif; ?>

                        <div class="d-flex justify-content-end">
                            <!-- 日期篩選表單 -->
                            <div class="d-flex justify-content-end mr-1">
                                <form id="dateFilterForm" class="d-flex align-items-center" method="get" action="coupon_list.php">
                                    <!-- 開始日期 -->
                                    <div class="me-1">
                                        <label for="startDate" class="form-label visually-hidden">開始日期</label>
                                        <input type="date" class="form-control form-control-sm" id="startDate" name="startDate" value="<?php echo isset($_GET['startDate']) ? $_GET['startDate'] : ''; ?>" placeholder="開始日期">
                                    </div>

                                    <!-- 波浪線 -->
                                    <div class="me-1">
                                        <span>~</span>
                                    </div>

                                    <!-- 結束日期 -->
                                    <div class="me-1">
                                        <label for="endDate" class="form-label visually-hidden">結束日期</label>
                                        <input type="date" class="form-control form-control-sm" id="endDate" name="endDate" value="<?php echo isset($_GET['endDate']) ? $_GET['endDate'] : ''; ?>" placeholder="結束日期">
                                    </div>

                                    <!-- 提交按鈕 -->
                                    <button type="submit" class="btn btn-primary btn-sm mr-3">
                                        <i class="fa-solid fa-filter" style="color: #ffffff;"></i>
                                    </button>
                                </form>
                            </div>

                            <!-- 新增優惠券按鈕 -->
                            <form action="coupon_create.php" method="POST">
                                <div>
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa-solid fa-plus" style="color: #ffffff;"></i> 新增
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <!-- 優惠券列表 -->
                    <div class="table-responsive coupon-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="coupon-list" scope="col">ID</th>
                                    <th class="coupon-list-name" scope="col">優惠券名稱 | 代碼</th>
                                    <th class="coupon-list" scope="col">
                                        適用服務
                                        <button class="dropdown-toggle custom-dropdown-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu" id="serviceDropdown">
                                            <li><a class="dropdown-item" href="?product_id=all<?php echo isset($_GET['urlParams']) ? $_GET['urlParams'] : ''; ?>">全部</a></li>
                                            <li><a class="dropdown-item" href="?product_id=商品<?php echo isset($_GET['urlParams']) ? $_GET['urlParams'] : ''; ?>">商品</a></li>
                                            <li><a class="dropdown-item" href="?product_id=租賃<?php echo isset($_GET['urlParams']) ? $_GET['urlParams'] : ''; ?>">租賃</a></li>
                                            <li><a class="dropdown-item" href="?product_id=課程<?php echo isset($_GET['urlParams']) ? $_GET['urlParams'] : ''; ?>">課程</a></li>
                                            <li><a class="dropdown-item" href="?product_id=活動<?php echo isset($_GET['urlParams']) ? $_GET['urlParams'] : ''; ?>">活動</a></li>
                                            <li><a class="dropdown-item" href="?product_id=揪團<?php echo isset($_GET['urlParams']) ? $_GET['urlParams'] : ''; ?>">揪團</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="?product_id=all<?php echo isset($_GET['urlParams']) ? $_GET['urlParams'] : ''; ?>">清除篩選</a></li>
                                        </ul>
                                    </th>

                                    <th class="coupon-list" scope="col">
                                        目標會員
                                        <button class="dropdown-toggle custom-dropdown-sm" type="submit" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="?targetMembers=全部會員<?php echo isset($_GET['urlParams']) ? $_GET['urlParams'] : ''; ?>">全部會員</a></li>
                                            <li><a class="dropdown-item" href="?targetMembers=新會員<?php echo isset($_GET['urlParams']) ? $_GET['urlParams'] : ''; ?>">新會員</a></li>
                                            <li><a class="dropdown-item" href="?targetMembers=VIP會員<?php echo isset($_GET['urlParams']) ? $_GET['urlParams'] : ''; ?>">VIP會員</a></li>
                                            <li><a class="dropdown-item" href="?targetMembers=學生會員<?php echo isset($_GET['urlParams']) ? $_GET['urlParams'] : ''; ?>">學生會員</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="?targetMembers=all<?php echo isset($_GET['urlParams']) ? $_GET['urlParams'] : ''; ?>">清除篩選</a></li>
                                        </ul>
                                    </th>

                                    <th class="coupon-list" scope="col">
                                        折扣方式
                                        <button class="dropdown-toggle custom-dropdown-sm" type="submit" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="?discountType=percentage<?php echo isset($_GET['urlParams']) ? $_GET['urlParams'] : ''; ?>">折數</a></li>
                                            <li><a class="dropdown-item" href="?discountType=fixed<?php echo isset($_GET['urlParams']) ? $_GET['urlParams'] : ''; ?>">金額</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="?discountType=all<?php echo isset($_GET['urlParams']) ? $_GET['urlParams'] : ''; ?>">清除篩選</a></li>
                                        </ul>
                                    </th>
                                    <th class="coupon-list" scope="col">
                                        折扣額度
                                        <a href="?sort_by=discountValue&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">
                                            <button class="btn btn-link btn-sm">
                                                <?php echo getSortIcon($sort_by, $order, 'discountValue'); ?>
                                            </button>
                                        </a>
                                    </th>
                                    <th class="coupon-list" scope="col">
                                        可使用
                                        <a href="?sort_by=usageLimit&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">
                                            <button class="btn btn-link btn-sm">
                                                <?php echo getSortIcon($sort_by, $order, 'usageLimit'); ?>
                                            </button>
                                        </a>
                                    </th>
                                    <th class="coupon-list" scope="col">
                                        已使用
                                        <a href="?sort_by=usedCount&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">
                                            <button class="btn btn-link btn-sm">
                                                <?php echo getSortIcon($sort_by, $order, 'usedCount'); ?>
                                            </button>
                                        </a>
                                    </th>
                                    <th class="coupon-list" scope="col">
                                        開始日期
                                        <a href="?sort_by=startDate&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">
                                            <button class="btn btn-link btn-sm">
                                                <?php echo getSortIcon($sort_by, $order, 'startDate'); ?>
                                            </button>
                                        </a>
                                    </th>
                                    <th class="coupon-list" scope="col">
                                        結束日期
                                        <a href="?sort_by=endDate&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">
                                            <button class="btn btn-link btn-sm">
                                                <?php echo getSortIcon($sort_by, $order, 'endDate'); ?>
                                            </button>
                                        </a>
                                    </th>
                                    <th class="coupon-list" scope="col">操作</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $index => $coupon): ?>
                                    <tr>
                                        <td class="coupon-list coupon-tbody-list"><?= $coupon["id"] ?></td>
                                        <td class="coupon-list-name">
                                            <?php
                                            if ($coupon["status"] == 'active') {
                                                echo "<span class='badge text-bg-danger'>進行中</span>";
                                            } elseif ($coupon["status"] == 'inactive') {
                                                echo "<span class='badge text-bg-success'>接下來的活動</span>";
                                            } elseif ($coupon["status"] == 'expired') {
                                                echo "<span class='badge text-bg-secondary'>已結束</span>";
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
                                            <a href="coupon_view.php?id=<?= $coupon["id"] ?>"><i class="fa-solid fa-pen-to-square mt-3" style="color: #3f8ad9;font-size: 1.5rem;"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- 優惠券列表 結束 -->

                    <!-- 分頁導航 -->
                    <div class="d-flex justify-content-center mt-4">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <!-- 跳至第 1 頁 -->
                                <li class="page-item <?php echo ($p == 1) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?p=1<?php echo isset($search) && $search !== '' ? '&search=' . urlencode($search) : ''; ?><?php echo isset($status) && $status !== 'all' ? '&status=' . $status : ''; ?>" aria-label="First">
                                        <i class="fa-solid fa-angles-left" aria-hidden="true"></i>
                                    </a>
                                </li>

                                <!-- 上一頁 -->
                                <li class="page-item <?php echo ($p == 1) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?p=<?php echo $p - 1; ?><?php echo isset($search) && $search !== '' ? '&search=' . urlencode($search) : ''; ?><?php echo isset($status) && $status !== 'all' ? '&status=' . $status : ''; ?>" aria-label="Previous">
                                        <i class="fa-solid fa-angle-left" aria-hidden="true"></i>
                                    </a>
                                </li>

                                <!-- 分頁數字按鈕 -->
                                <?php for ($i = 1; $i <= $total_page; $i++): ?>
                                    <li class="page-item <?php echo ($i == $p) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?p=<?php echo $i; ?><?php echo isset($search) && $search !== '' ? '&search=' . urlencode($search) : ''; ?><?php echo isset($status) && $status !== 'all' ? '&status=' . $status : ''; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>

                                <!-- 下一頁 -->
                                <li class="page-item <?php echo ($p == $total_page) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?p=<?php echo $p + 1; ?><?php echo isset($search) && $search !== '' ? '&search=' . urlencode($search) : ''; ?><?php echo isset($status) && $status !== 'all' ? '&status=' . $status : ''; ?>" aria-label="Next">
                                        <i class="fa-solid fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                </li>

                                <!-- 跳至最後一頁 -->
                                <li class="page-item <?php echo ($p == $total_page) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?p=<?php echo $total_page; ?><?php echo isset($search) && $search !== '' ? '&search=' . urlencode($search) : ''; ?><?php echo isset($status) && $status !== 'all' ? '&status=' . $status : ''; ?>" aria-label="Last">
                                        <i class="fa-solid fa-angles-right" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
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

    <script>
        // 設置刪除表單的優惠券 ID
        document.addEventListener('DOMContentLoaded', function() {
            var deleteButtons = document.querySelectorAll('.btn-danger');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var couponId = button.getAttribute('data-id');
                    document.getElementById('couponId').value = couponId;
                });
            });
        });
    </script>
</body>

</html>