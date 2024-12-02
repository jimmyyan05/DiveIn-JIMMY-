<?php
require_once("../db_project_connect.php");

// 初始化變數
$searchTerm = $_GET['search'] ?? ''; // 搜尋字串
$statusFilter = $_GET['status'] ?? ''; // 狀態過濾條件
$isDeletedFilter = '1'; // 固定為1，顯示已刪除的資料

// 預設每頁顯示的資料數量
$itemsPerPage = 5;

// 取得當前頁數
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;

// 計算偏移量
$offset = ($page - 1) * $itemsPerPage;

// 基本 SQL 查詢語句：篩選已刪除的資料
$sql = "
    SELECT 
        a.id, 
        a.title, 
        a.content, 
        a.createdAt, 
        a.upgradeDate, 
        a.status, 
        COALESCE(ai.imgUrl, '') AS imgUrl
    FROM 
        article a
    LEFT JOIN 
        article_image ai 
    ON 
        a.id = ai.article_id 
        AND ai.isMain = 1 
        AND ai.isDeleted = 0
    WHERE 
        a.isDeleted = 1"; // 只顯示已刪除的資料

// 加入搜尋條件
if ($searchTerm !== '') {
    $sql .= " AND a.title LIKE '%" . $conn->real_escape_string($searchTerm) . "%'";
}

// 加入狀態過濾條件
if ($statusFilter !== '') {
    $sql .= " AND a.status = " . (int)$statusFilter;
}

// 按照 `upgradeDate` 排序，如果 `upgradeDate` 為 NULL 則選擇 `createdAt`
$sql .= " ORDER BY 
            CASE WHEN a.upgradeDate IS NOT NULL THEN a.upgradeDate ELSE a.createdAt END DESC";

// 分頁
$sql .= " LIMIT $itemsPerPage OFFSET $offset";

// 執行 SQL 查詢
$result = $conn->query($sql);

// 獲取總數據量，用於分頁
$totalSql = "
    SELECT COUNT(*) AS total
    FROM article a
    WHERE a.isDeleted = 1"; // 只計算已刪除的資料

// 同樣加入搜尋與過濾條件
if ($searchTerm !== '') {
    $totalSql .= " AND a.title LIKE '%" . $conn->real_escape_string($searchTerm) . "%'";
}
if ($statusFilter !== '') {
    $totalSql .= " AND a.status = " . (int)$statusFilter;
}

// 執行總數查詢並計算總頁數
$totalResult = $conn->query($totalSql);
$totalRow = $totalResult->fetch_assoc();
$totalItems = $totalRow['total'];
$totalPages = ceil($totalItems / $itemsPerPage);

?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>已刪除文章列表</title>

    <!-- 統一的css -->
    <?php include "css.php"; ?>

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
                <div class="container-fluid">
                    <!-- Page Heading 與搜尋框的行 -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="h3 text-gray-800">已刪除文章列表</h1>
                        <!-- 搜尋框 -->
                        <form class="form-inline" method="get" action="articleDeleteList.php">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2"
                                    value="<?php echo htmlspecialchars($searchTerm); ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <!-- 左侧按钮组 -->
                            <div class="d-flex gap-2">
                                <a href="articleList.php" class="btn bg-info text-white">
                                    <i class="fa-solid fa-list-ul"></i> 文章列表
                                </a>
                            </div>
                        </div>

                        <!-- 表格 -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 6%;">編號</th>
                                            <th style="width: 16%;">標題</th>
                                            <th style="width: 15%;">文章圖片</th>
                                            <th style="width: 30%;">內容</th>
                                            <th style="width: 6%;">創建時間</th>
                                            <th style="width: 6%;">更新時間</th>
                                            <th style="width: 7%;">狀態</th>
                                            <th style="width: 8%;">操作</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>編號</th>
                                            <th>標題</th>
                                            <th>文章圖片</th>
                                            <th>內容</th>
                                            <th>創建時間</th>
                                            <th>更新時間</th>
                                            <th>狀態</th>
                                            <th>操作</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        // 計算從哪一個序號開始
                                        $serialNumber = ($page - 1) * $itemsPerPage + 1;
                                        if ($result->num_rows > 0) : ?>
                                            <?php while ($row = $result->fetch_assoc()) : ?>
                                                <tr>
                                                    <!-- 編號顯示流水號 -->
                                                    <td><?php echo $serialNumber++; ?></td>
                                                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                                                    <td>
                                                        <?php if ($row['imgUrl']) : ?>
                                                            <img src="./<?php echo htmlspecialchars($row['imgUrl']); ?>" alt="文章圖片"
                                                                class="img-fluid" style="max-width: 100px; height: auto;">
                                                        <?php else : ?>
                                                            <span>無圖片</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($row['content']); ?></td>

                                                    <td><?php echo $row['createdAt']; ?></td>
                                                    <td><?php echo $row['upgradeDate'] ? $row['upgradeDate'] : '無更新'; ?></td>
                                                    <td>
                                                        <?php echo $row['status'] == 1 ? '已發布' : '待發布'; ?>
                                                    </td>
                                                    <td>
                                                        <!-- "復原" 按鈕 -->
                                                        <a href="articleDoRestore.php?id=<?php echo $row['id']; ?>"
                                                            class="btn btn-success btn-sm"
                                                            onclick="return confirm('確定復原？')">
                                                            復原
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="8">目前沒有任何已刪除的文章。</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- 分頁 -->
                    <div class="d-flex justify-content-center">
                        <div>
                            <!-- 跳至第一頁 -->
                            <?php if ($page > 1) : ?>
                                <a href="?page=1&search=<?php echo urlencode($searchTerm); ?>"
                                    class="btn btn-secondary">第一頁</a>
                            <?php endif; ?>

                            <!-- 上一頁 -->
                            <?php if ($page > 1) : ?>
                                <a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($searchTerm); ?>"
                                    class="btn btn-primary">上一頁</a>
                            <?php endif; ?>

                            <!-- 頁碼顯示 -->
                            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($searchTerm); ?>"
                                    class="btn <?php echo $i == $page ? 'btn-info' : 'btn-light'; ?>">
                                    <?php echo $i; ?>
                                </a>
                            <?php endfor; ?>

                            <!-- 下一頁 -->
                            <?php if ($page < $totalPages) : ?>
                                <a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($searchTerm); ?>"
                                    class="btn btn-primary">下一頁</a>
                            <?php endif; ?>

                            <!-- 跳至最後一頁 -->
                            <?php if ($page < $totalPages) : ?>
                                <a href="?page=<?php echo $totalPages; ?>&search=<?php echo urlencode($searchTerm); ?>"
                                    class="btn btn-secondary">最後一頁</a>
                            <?php endif; ?>
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
</body>

</html>