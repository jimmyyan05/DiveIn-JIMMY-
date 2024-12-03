<!-- php -->
<?php
include 'PDO_connect.php';

// 每頁顯示的記錄數
$limit = 10;

// 當前頁碼
$page = isset($_GET['page']) ? max((int)$_GET['page'], 1) : 1;
$start = ($page - 1) * $limit;

// 設定排序字段和順序
$valid_columns = ['id', 'start_date', 'end_date'];
$sort_column = isset($_GET['sort_by']) && in_array($_GET['sort_by'], $valid_columns) ? $_GET['sort_by'] : 'id';
$sort_order = isset($_GET['sort_order']) && $_GET['sort_order'] === 'desc' ? 'desc' : 'asc';
$next_sort_order = $sort_order === 'asc' ? 'desc' : 'asc';

// 設定篩選條件
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// 根據篩選條件獲取總記錄數
$filter_query = '';
if ($filter === 'active') {
    $filter_query = "AND (ri.end_date IS NULL OR ri.end_date > NOW())";
} elseif ($filter === 'expired') {
    $filter_query = "AND (ri.end_date IS NOT NULL AND ri.end_date <= NOW())";
} elseif ($filter === 'permanent') {
    $filter_query = "AND ri.end_date IS NULL";
}

// 獲取分類篩選條件
$category_filter = isset($_GET['category']) ? (int)$_GET['category'] : 0; // 大分類
$subcategory_filter = isset($_GET['subcategory']) ? (int)$_GET['subcategory'] : 0; // 小分類

// 根據大小分類添加篩選條件
$category_query = $category_filter > 0 ? "AND rcb.id = :category_id" : "";
$subcategory_query = $subcategory_filter > 0 ? "AND rcs.id = :subcategory_id" : "";

// 取得搜尋條件
$search = isset($_GET['search']) ? $_GET['search'] : '';
$search = trim(preg_replace('/\s+/', ' ', $search)); // 移除多餘空格
$keywords = explode(' ', $search); // 按空格拆分關鍵字
$search_query = '';

// 如果有搜尋關鍵字，則構建搜尋查詢
if ($search) {
    $search_query = "AND (";
    foreach ($keywords as $index => $keyword) {
        // 用 % 包裹每個關鍵字，這樣進行模糊查詢
        $search_query .= "ri.name LIKE :search{$index} OR ";
    }
    // 去除最後多餘的 "OR"
    $search_query = rtrim($search_query, " OR ");
    $search_query .= ")";
}

// 查詢所有大分類名稱 (用於篩選bar)
$sql_categories = "SELECT id, name FROM rent_category_big";
$stmt = $pdo->prepare($sql_categories);
$stmt->execute();

// 檢查是否成功取得分類數據
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

// 如果 $categories 是 null 或空數組，初始化為空陣列
if ($categories === false) {
    $categories = [];
}


try {
    // 計算總記錄數
    $sql_count = "
    SELECT COUNT(*)
    FROM rent_item AS ri
    LEFT JOIN rent_category_small AS rcs ON ri.rent_category_small_id = rcs.id
    LEFT JOIN rent_category_big AS rcb ON rcs.rent_category_big_id = rcb.id
    WHERE ri.is_deleted = 0 $filter_query $category_query $subcategory_query $search_query
";
    $stmt = $pdo->prepare($sql_count);
    if ($category_filter > 0) {
        $stmt->bindParam(':category_id', $category_filter, PDO::PARAM_INT);
    }
    if ($subcategory_filter > 0) {
        $stmt->bindParam(':subcategory_id', $subcategory_filter, PDO::PARAM_INT);
    }
    if ($search) {
        foreach ($keywords as $index => $keyword) {
            $search_param = "%$keyword%";
            $stmt->bindParam(":search{$index}", $search_param, PDO::PARAM_STR);
        }
    }
    $stmt->execute();
    $total_results = $stmt->fetchColumn();
    $total_pages = ceil($total_results / $limit);

    $sql = "
    SELECT DISTINCT 
        ri.*, 
        rcs.name AS small_category_name, 
        rcb.name AS big_category_name,
        IFNULL(ri_img.img_url, '') AS main_img_url,
        ri.price * 0.6 AS deposit
    FROM rent_item AS ri
    LEFT JOIN rent_category_small AS rcs ON ri.rent_category_small_id = rcs.id
    LEFT JOIN rent_category_big AS rcb ON rcs.rent_category_big_id = rcb.id
    LEFT JOIN rent_image ri_img ON ri.id = ri_img.rent_item_id AND ri_img.is_main = 1
    WHERE ri.is_deleted = 0 $filter_query $category_query $subcategory_query $search_query
    GROUP BY ri.id
    ORDER BY $sort_column $sort_order
    LIMIT :start, :limit
";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':start', $start, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    if ($category_filter > 0) {
        $stmt->bindParam(':category_id', $category_filter, PDO::PARAM_INT);
    }
    if ($subcategory_filter > 0) {
        $stmt->bindParam(':subcategory_id', $subcategory_filter, PDO::PARAM_INT);
    }
    if ($search) {
        foreach ($keywords as $index => $keyword) {
            $search_param = "%$keyword%";
            $stmt->bindParam(":search{$index}", $search_param, PDO::PARAM_STR);
        }
    }
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);



    // 定金計算
    foreach ($products as $product) {
        $calculated_rent = $product['price'] * 0.6;
        $update_sql = "UPDATE rent_item SET deposit = :deposit WHERE id = :id";
        $update_stmt = $pdo->prepare($update_sql);
        $update_stmt->bindParam(':deposit', $calculated_rent, PDO::PARAM_STR);
        $update_stmt->bindParam(':id', $product['id'], PDO::PARAM_INT);
        $update_stmt->execute();

        /// 查詢所有產品及其主圖片
        $sql = "SELECT ri.id AS rent_item_id, ri.name, ri.price, ri.start_date, ri.end_date, 
    IFNULL(ri_img.img_url, '') AS main_img_url
FROM rent_item ri
LEFT JOIN rent_image ri_img ON ri.id = ri_img.rent_item_id AND ri_img.is_main = 1";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // 結果儲存到陣列
        $products_with_images = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products_with_images[$row['rent_item_id']] = [
                'name' => $row['name'],
                'price' => $row['price'],
                'start_date' => $row['start_date'],
                'end_date' => $row['end_date'],
                'main_img_url' => $row['main_img_url'] ? $row['main_img_url'] : null
            ];
        }
    }
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

    <title>租賃管理</title>

    <!-- 統一的css -->
    <?php include("./css.php") ?>


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
        .column-id {
            width: 80px;
        }

        .column-image {
            width: 180px;
        }

        .column-name {
            flex: 1;
        }

        .column-price {
            width: 140px;
        }

        .column-deposit {
            width: 140px;
        }

        .column-start {
            width: 150px;
        }

        .column-end {
            width: 150px;
        }

        .column-date-time {
            text-align: center;
        }

        .column-action {
            width: 120px;
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

        .w200px {
            width: 200px;
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

        .product-details-container {
            display: flex;
            align-items: center;
            /* 使圖片和文字垂直居中對齊 */
            gap: 20px;
            /* 圖片與文字之間的間距 */
        }

        .product-details-container img {
            max-width: 350px;
            /* 限制圖片最大寬度 */
            height: auto;
            /* 高度自動調整 */
        }

        .product-info {
            display: flex;
            flex-direction: column;
            /* 使文字垂直排列 */
            align-items: flex-start;
            /* 文字靠左對齊 */
            max-width: 500px;
            /* 限制文字部分的最大寬度 */
        }

        .product-info p {
            margin: 5px 0;
            /* 讓每一行的文字有些微的間隔 */
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
                    </ol>
                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">租賃商品列表</h1>

                    <div class="card-header py-3 d-flex justify-content-start align-items-center">
                        <!-- 新增租賃商品 -->
                        <a href="rent_add.php" class="btn btn-warning mb-3 my-2"><i class="fa-solid fa-plus"></i> 新增租賃商品</a>
                        <!-- 刪除租賃商品 -->
                        <a href="rent_deleted_items.php" class="btn btn-secondary mb-3 ms-3 my-2"><i class="fa-solid fa-trash"></i> 回收桶</a>
                    </div>


                    <!-- DataTales -->
                    <div class="card shadow mb-4 ">


                        <!-- 顯示分類Bar -->
                        <div class="container m-4 p-0">
                            <div class="d-flex align-items-center">
                                <div class="category-nav">
                                    <button class="btn btn-outline-primary <?php echo $category_filter == 0 ? 'active' : ''; ?>"
                                        onclick="updateCategoryAndSmallCategory(0)">
                                        所有分類
                                    </button>
                                    <?php foreach ($categories as $category): ?>
                                        <button class="btn btn-outline-primary <?php echo $category_filter == $category['id'] ? 'active' : ''; ?>"
                                            onclick="updateCategoryAndSmallCategory(<?php echo $category['id']; ?>)">
                                            <?php echo $category['name']; ?>
                                        </button>
                                    <?php endforeach; ?>
                                </div>
                                <!-- 小分類select選單 -->
                                <div class="subcategory-select ms-auto">
                                    <div>
                                        <select id="small-category-select" class="form-select" disabled onchange="updateSubCategory()">
                                            <option value="" selected>小分類</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex justify-content-end align-item-center m-2">
                        <!-- 上架狀態篩選 -->

                        <select id="filter" class="form-select w200px me-3" onchange="location = this.value;">
                            <option value="?filter=all&search=<?= htmlspecialchars($_GET['search'] ?? '') ?>&category=<?= $category_filter ?>&sort_by=<?= $sort_column ?>&sort_order=<?= $sort_order ?>" <?= $filter === 'all' ? 'selected' : '' ?>>所有產品</option>
                            <option value="?filter=active&search=<?= htmlspecialchars($_GET['search'] ?? '') ?>&category=<?= $category_filter ?>&sort_by=<?= $sort_column ?>&sort_order=<?= $sort_order ?>" <?= $filter === 'active' ? 'selected' : '' ?>>上架中</option>
                            <option value="?filter=expired&search=<?= htmlspecialchars($_GET['search'] ?? '') ?>&category=<?= $category_filter ?>&sort_by=<?= $sort_column ?>&sort_order=<?= $sort_order ?>" <?= $filter === 'expired' ? 'selected' : '' ?>>已下架</option>
                            <option value="?filter=permanent&search=<?= htmlspecialchars($_GET['search'] ?? '') ?>&category=<?= $category_filter ?>&sort_by=<?= $sort_column ?>&sort_order=<?= $sort_order ?>" <?= $filter === 'permanent' ? 'selected' : '' ?>>永久上架</option>
                        </select>
                    </div>


                    <div class="d-flex flex-column ">
                        <div class="d-flex justify-content-between align-items-center mb-3 ms-3 text-black-50">
                            <p class="m-0">共有<strong><?= $total_results; ?></strong>件商品</p>
                            <p class="m-0">
                                <?php
                                switch ($filter) {
                                    case 'active':
                                        echo '上架中';
                                        break;
                                    case 'expired':
                                        echo '已下架';
                                        break;
                                    case 'permanent':
                                        echo '永久上架';
                                        break;
                                    default:
                                        echo '';
                                        break;
                                }
                                ?>
                                <!-- 查詢租賃商品 -->
                            <form class="form-inline ml-auto m-3 my-md-0 navbar-search" method="get" action="rent_items.php">
                                <!-- 清除搜尋按鈕 -->
                                <?php if (isset($_GET['search']) && $_GET['search'] !== ''): ?>
                                    <button class="btn btn-link" type="button" id="clear-search">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                <?php endif; ?>
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" name="search" placeholder="Search for..."
                                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>

                                    </div>
                                </div>
                            </form>
                            </p>

                        </div>
                    </div>
                    <div class="d-flex flex-column ">
                        <div class="d-flex bg-light p-2 mb-2">
                            <div class="p-2 column-id sortable" onclick="window.location.href='?filter=<?= $filter; ?>&category=<?= $category_filter; ?>&sort_by=id&sort_order=<?= $next_sort_order; ?>&page=<?= $page; ?>'">
                                編號
                                <?php if ($sort_column === 'id') : ?>
                                    <i class="bi bi-caret-<?= $sort_order === 'asc' ? 'up' : 'down'; ?>-fill"></i>
                                <?php endif; ?>
                            </div>
                            <div class="p-2 column-image">產品圖片</div>
                            <div class="p-2 column-name">產品名稱</div>
                            <div class="p-2 column-price">價格</div>
                            <div class="p-2 column-deposit">定金</div>
                            <div class="p-2 column-start sortable" onclick="window.location.href='?filter=<?= $filter; ?>&category=<?= $category_filter; ?>&sort_by=start_date&sort_order=<?= $next_sort_order; ?>&page=<?= $page; ?>'">
                                上架時間
                                <?php if ($sort_column === 'start_date') : ?>
                                    <i class="bi bi-caret-<?= $sort_order === 'asc' ? 'up' : 'down'; ?>-fill"></i>
                                <?php endif; ?>
                            </div>
                            <div class="p-2 column-end sortable" onclick="window.location.href='?filter=<?= $filter; ?>&category=<?= $category_filter; ?>&sort_by=end_date&sort_order=<?= $next_sort_order; ?>&page=<?= $page; ?>'">
                                下架時間
                                <?php if ($sort_column === 'end_date') : ?>
                                    <i class="bi bi-caret-<?= $sort_order === 'asc' ? 'up' : 'down'; ?>-fill"></i>
                                <?php endif; ?>
                            </div>
                            <div class="p-2 column-action">操作</div>
                        </div>
                        <?php foreach ($products as $index => $product) : ?>
                            <div class="d-flex p-0 px-2 mb-1 border hover">
                                <!-- <div class="p-2 column-seq"><?= $index + 1 + ($page - 1) * $limit; ?></div> -->
                                <div class="p-2 column-id d-flex align-items-center"><?= $product['id']; ?></div>
                                <div class="p-2 column-image d-flex align-items-center">
                                    <?php if (isset($products_with_images[$product['id']]) && $products_with_images[$product['id']]['main_img_url']): ?>
                                        <img src="<?php echo htmlspecialchars($products_with_images[$product['id']]['main_img_url']); ?>" alt="主圖" style="max-width: 150px;">
                                    <?php else: ?>
                                        <p>無圖片</p>
                                    <?php endif; ?>
                                </div>
                                <div class="p-2 column-name d-flex align-items-center"><?= $product['name']; ?></div>
                                <div class="p-2 column-price d-flex align-items-center"><?= number_format($product['price'], 0); ?> 元</div>
                                <div class="p-2 column-deposit d-flex align-items-center"><?= number_format($product['price'] * 0.6, 0); ?> 元</div>
                                <div class="p-2 column-start d-flex align-items-center column-date-time">
                                    <?php
                                    if ($product['start_date']) {
                                        echo substr($product['start_date'], 0, 10) . "<br>" . substr($product['start_date'], 11);
                                    } else {
                                        echo "未指定日期";
                                    }
                                    ?>
                                </div>
                                <div class="p-2 column-end d-flex align-items-center column-date-time">
                                    <?php
                                    if ($product['end_date']) {
                                        echo substr($product['end_date'], 0, 10) . "<br>" . substr($product['end_date'], 11);
                                    } else {
                                        echo "";
                                    }
                                    ?>
                                </div>
                                <div class="p-2 column-action d-flex justify-content-center align-items-center">
                                    <!-- 檢視 -->
                                    <button class="btn btn-success btn-sm custom-btn" onclick="viewProductDetails(<?= $product['id']; ?>)">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <!-- 編輯 -->
                                    <a href="rent_edit.php?id=<?= $product['id']; ?>&page=<?= $page; ?>&filter=<?= $filter; ?>" class="btn btn-primary btn-sm custom-btn"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <!-- 刪除 -->
                                    <a href="rent_delete.php?id=<?= $product['id']; ?>&page=<?= $page; ?>&filter=<?= $filter; ?>" class="btn btn-danger btn-sm custom-btn" onclick="return confirm('確定要刪除這個項目嗎？');"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="d-flex justify-content-between align-items-center m-3" style="height: 80px;">
                        <!-- 目前頁數顯示 -->
                        <p class="mb-0">
                            目前為第 <span class="text-primary"><?php echo $page; ?></span> 頁 / 共<?php echo $total_pages; ?> 頁
                        </p>

                        <!-- 分頁 -->
                        <nav class="me-2">
                            <ul class="pagination mb-0 justify-content-center">
                                <!-- 回到第一頁 -->

                                <li class="page-item <?php if ($page == 1) echo 'disabled'; ?>">
                                    <a class="page-link" href="rent_items.php?page=<?= $page - 1; ?>&sort_by=<?= $sort_column; ?>&sort_order=<?= $sort_order; ?>&filter=<?= urlencode($filter); ?>"><i class="fa-solid fa-angles-left"></i></a>
                                </li>

                                <!-- 回到上一頁 -->
                                <li class="page-item <?php if ($page == 1) echo 'disabled'; ?>">
                                    <a class="page-link" href="rent_items.php?page=<?= $page - 1; ?>&sort_by=<?= $sort_column; ?>&sort_order=<?= $sort_order; ?>&filter=<?= $filter; ?>">
                                        <i class="fa-solid fa-angle-left"></i></a>
                                </li>

                                <!-- 分頁按鈕 -->
                                <nav class="mx-1" style="margin-right:20px;">
                                    <ul class="pagination justify-content-center">
                                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                                <a class="page-link" href="rent_items.php?page=<?= $i; ?>&sort_by=<?= $sort_column; ?>&sort_order=<?= $sort_order; ?>&filter=<?= urlencode($filter); ?>"><?= $i; ?></a>
                                            </li>
                                        <?php endfor; ?>
                                    </ul>
                                </nav>

                                <!-- 下一頁 -->
                                <li class="page-item <?php if ($page == $total_pages) echo 'disabled'; ?>">
                                    <a class="page-link" href="rent_items.php?page=<?= $page + 1; ?>&sort_by=<?= $sort_column; ?>&sort_order=<?= $sort_order; ?>&filter=<?= urlencode($filter); ?>"><i class="fa-solid fa-angle-right"></i></a>
                                </li>

                                <!-- 到最後一頁 -->
                                <li class="page-item <?php if ($page == $total_pages) echo 'disabled'; ?>">
                                    <a class="page-link" href="rent_items.php?page=<?= $total_pages; ?>&sort_by=<?= $sort_column; ?>&sort_order=<?= $sort_order; ?>&filter=<?= urlencode($filter); ?>"><i class="fa-solid fa-angles-right"></i></a>
                                </li>
                            </ul>
                        </nav>

                    </div>
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
    <!-- Modal檢視資料 -->
    <div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewProductModalLabel">租賃產品詳情</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 產品資料會動態填入 -->
                    <div id="productDetails" class="product-details-container"></div>
                </div>
            </div>
        </div>
    </div>


    <!-- 引入 Bootstrap 和其他腳本 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function viewProductDetails(productId) {
            fetch(`rent_view.php?id=${productId}`)
                .then(response => response.json())
                .then(data => {
                    const productDetails = `
                <div class="product-details-container">
                    <img src="${data.main_img_url}" alt="產品圖片">
                    <div class="product-info">
                        <p><strong>產品id：</strong> ${data.product_id}</p>
                        <p><strong>產品名稱：</strong> ${data.name}</p>
                        <p><strong>價格：</strong> ${data.price} 元</p>
                        <p><strong>定金：</strong> ${data.deposit} 元</p>
                        <p><strong>大分類：</strong> ${data.big_category_name}</p>
                        <p><strong>小分類：</strong> ${data.small_category_name}</p>
                        <p><strong>上架時間：</strong> ${data.start_date}</p>
                        <p><strong>下架時間：</strong> ${data.end_date}</p>
                        <p><strong>庫存：</strong> ${data.stock}</p>
                        <p><strong>產品描述：</strong> ${data.description}</p>
                    </div>
                </div>
            `;
                    document.getElementById('productDetails').innerHTML = productDetails;
                    const modal = new bootstrap.Modal(document.getElementById('viewProductModal'));
                    modal.show();
                })
                .catch(error => console.error('Error fetching product details:', error));
        }
    </script>
    <script>
        // 更新小分類選單
        function updateSmallCategories(bigCategoryId, selectedSubCategoryId = null) {
            const smallCategorySelect = document.getElementById('small-category-select');
            smallCategorySelect.innerHTML = '<option value="" selected>請選擇</option>';
            smallCategorySelect.disabled = true;

            if (bigCategoryId === 0) {
                return; // 如果是 "所有分類"，則不進行任何動作
            }

            // 發送請求獲取小分類數據
            fetch(`rent_category.php?big_category_id=${bigCategoryId}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        smallCategorySelect.disabled = false; // 啟用小分類選單
                        data.forEach(smallCategory => {
                            const option = document.createElement('option');
                            option.value = smallCategory.id;
                            option.textContent = smallCategory.name;

                            // 如果有選中的小分類ID，則設置為選中狀態
                            if (selectedSubCategoryId && selectedSubCategoryId == smallCategory.id) {
                                option.selected = true;
                            }

                            smallCategorySelect.appendChild(option);
                        });
                    } else {
                        smallCategorySelect.disabled = true; // 如果沒有小分類，禁用選單
                    }
                })
                .catch(error => console.error('Error fetching small categories:', error));
        }
    </script>
    <script>
        // 更新大分類和小分類，並更新頁面
        // function updateCategoryAndSmallCategory(bigCategoryId) {
        //     // 更新 URL 並刷新頁面，這會根據大分類顯示該大分類的產品
        //     window.location.href = `rent_items.php?category=${bigCategoryId}&page=1`; // 頁面重新加載
        //     updateSmallCategories(bigCategoryId); // 更新小分類
        // }
        function updateCategoryAndSmallCategory(bigCategoryId) {
            const urlParams = new URLSearchParams(window.location.search);

            // 更新大分類參數，清除小分類參數
            urlParams.set('category', bigCategoryId);
            urlParams.delete('subcategory'); // 切換大分類時清除小分類
            urlParams.set('page', 1); // 重置到第一頁

            // 重新導向到篩選後的 URL
            window.location.href = `rent_items.php?${urlParams.toString()}`;
        }



        // 更新選擇的小分類
        // function updateSubCategory() {
        //     const smallCategoryId = document.getElementById('small-category-select').value;
        //     const bigCategoryId = new URLSearchParams(window.location.search).get('category'); // 從 URL 中獲取大分類 ID
        //     window.location.href = `rent_items.php?category=${bigCategoryId}&subcategory=${smallCategoryId}&page=1`;
        // }
        function updateSubCategory() {
            const smallCategoryId = document.getElementById('small-category-select').value;
            const urlParams = new URLSearchParams(window.location.search);

            // 保留大分類的 category 參數
            const bigCategoryId = urlParams.get('category') || 0;
            urlParams.set('category', bigCategoryId); // 確保大分類參數
            urlParams.set('subcategory', smallCategoryId); // 更新小分類參數
            urlParams.set('page', 1); // 重置到第一頁

            // 重新導向到篩選後的 URL
            window.location.href = `rent_items.php?${urlParams.toString()}`;
        }

        // 在頁面加載時初始化小分類選單
        document.addEventListener("DOMContentLoaded", function() {
            const categoryId = new URLSearchParams(window.location.search).get('category');
            const subcategoryId = new URLSearchParams(window.location.search).get('subcategory');

            if (categoryId) {
                updateSmallCategories(categoryId, subcategoryId);
            }
        });
        // 發送請求獲取小分類數據並根據當前選定的小分類設置選項
        function updateSmallCategories(bigCategoryId, selectedSubCategoryId = null) {
            const smallCategorySelect = document.getElementById('small-category-select');
            smallCategorySelect.innerHTML = '<option value="" selected>請選擇小分類</option>'; // 清空選單並設置默認值
            smallCategorySelect.disabled = true; // 默認禁用小分類

            if (bigCategoryId === '0') {
                return; // 如果大分類為 "所有分類"，則不更新小分類選單
            }

            fetch(`rent_category.php?big_category_id=${bigCategoryId}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        smallCategorySelect.disabled = false; // 啟用小分類選單
                        data.forEach(smallCategory => {
                            const option = document.createElement('option');
                            option.value = smallCategory.id;
                            option.textContent = smallCategory.name;

                            // 如果有選中的小分類ID，則設置為選中狀態
                            if (selectedSubCategoryId && selectedSubCategoryId == smallCategory.id) {
                                option.selected = true; // 保持選中狀態
                            }

                            smallCategorySelect.appendChild(option);
                        });
                    } else {
                        smallCategorySelect.disabled = true; // 如果沒有小分類，禁用選單
                    }
                })
                .catch(error => console.error('Error fetching small categories:', error));
        }
    </script>
    <script>
        // 清除搜尋欄位並重新載入頁面
        document.getElementById('clear-search').addEventListener('click', function() {
            // 清除搜尋框內容
            const searchInput = document.querySelector('input[name="search"]');
            searchInput.value = '';

            // 重新載入頁面，並清除 URL 中的搜尋參數
            const url = new URL(window.location.href);
            url.searchParams.delete('search');
            window.location.href = url.toString();
        });
    </script>


</body>

</html>