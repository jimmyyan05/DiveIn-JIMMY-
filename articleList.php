<?php

require_once("../db_project_connect.php");

// 檢查是否有搜尋字串
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// 檢查是否有篩選條件
$statusFilter = isset($_GET['status']) ? $_GET['status'] : '';
$typeFilter = isset($_GET['type']) ? $_GET['type'] : '';
$isDeletedFilter = isset($_GET['isDeleted']) ? $_GET['isDeleted'] : '';

// 預設每頁顯示的資料數量
$itemsPerPage = 5;

// 取得當前頁數
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page <= 0) $page = 1; // 防止頁數為負數

// 計算偏移量
$offset = ($page - 1) * $itemsPerPage;

// 修改 SQL 查詢，結合 article 和 article_image 資料表，並過濾 isDeleted = 0
$sql = "
    SELECT 
        a.id, 
        a.title, 
        a.content, 
        a.createdAt, 
        a.upgradeDate, 
        a.status, 
        a.type, 
        COALESCE(ai.imgUrl, '') AS imgUrl
    FROM 
        article a
    LEFT JOIN 
        article_image ai 
    ON 
        a.id = ai.article_id AND ai.isMain = 1  -- 確保只選擇主圖片
    WHERE 
        a.isDeleted = 0";

// 根據搜尋字串過濾文章
if ($searchTerm) {
    $sql .= " AND a.title LIKE '%" . $conn->real_escape_string($searchTerm) . "%'";
}

// 根據狀態過濾
if ($statusFilter !== '') {
    $sql .= " AND a.status = " . (int)$statusFilter;
}

// 根據文章類型過濾
if ($typeFilter !== '') {
    $sql .= " AND a.type = " . (int)$typeFilter;
}

// 根據刪除狀態過濾
if ($isDeletedFilter == '1') {
    $sql .= " AND a.isDeleted = 1";
}

// 按照 `upgradeDate` 排序，如果 `upgradeDate` 為 `NULL` 則選擇 `createdAt` 的圖片
$sql .= " ORDER BY 
            CASE WHEN a.upgradeDate IS NOT NULL THEN a.upgradeDate ELSE a.createdAt END DESC";

// 限制每頁顯示的資料
$sql .= " LIMIT $itemsPerPage OFFSET $offset";

// 執行 SQL 查詢
$result = $conn->query($sql);

// 取得資料總數，用來計算總頁數
$totalSql = "
    SELECT COUNT(*) AS total
    FROM article a
    WHERE a.isDeleted = 0";
if ($searchTerm) {
    $totalSql .= " AND a.title LIKE '%" . $conn->real_escape_string($searchTerm) . "%'";
}
if ($statusFilter !== '') {
    $totalSql .= " AND a.status = " . (int)$statusFilter;
}
if ($typeFilter !== '') {
    $totalSql .= " AND a.type = " . (int)$typeFilter;
}
if ($isDeletedFilter == '1') {
    $totalSql .= " AND a.isDeleted = 1";
}
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

    <title>服務項目</title>

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
                        <h1 class="h3 text-gray-800">文章列表</h1>
                        <!-- 搜尋框 -->
                        <form class="form-inline" method="get" action="articleList.php">
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
                                <a href="articleCreatePage.php" class="btn bg-info text-white">
                                    <i class="fa-solid fa-circle-plus"></i> 新增文章
                                </a>
                                <a href="articleList.php" class="btn bg-info text-white">
                                    <i class="fa-solid fa-list-ul"></i> 文章列表
                                </a>
                                <a href="articleDeleteList.php" class="btn bg-info text-white">
                                    <i class="fa-solid fa-trash-alt"></i> 已刪除列表
                                </a>
                            </div>
                            <!-- 右侧下拉式選單组 -->
                            <div class="d-flex gap-2">
                                <select class="form-control" onchange="window.location.href=this.value">
                                    <option value="articleList.php" <?php if (!$statusFilter) echo 'selected'; ?>>文章狀態</option>
                                    <option value="articleList.php?status=0" <?php if ($statusFilter == '0') echo 'selected'; ?>>待發布</option>
                                    <option value="articleList.php?status=1" <?php if ($statusFilter == '1') echo 'selected'; ?>>已發布</option>
                                </select>
                                <select class="form-control" onchange="window.location.href=this.value">
                                    <option value="articleList.php" <?php if (!$typeFilter) echo 'selected'; ?>>文章類型</option>
                                    <option value="articleList.php?type=0" <?php if ($typeFilter == '0') echo 'selected'; ?>>官方文章</option>
                                    <option value="articleList.php?type=1" <?php if ($typeFilter == '1') echo 'selected'; ?>>商品描述</option>
                                    <option value="articleList.php?type=2" <?php if ($typeFilter == '2') echo 'selected'; ?>>活動描述</option>
                                </select>
                            </div>
                        </div>

                        <!-- 表格 -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>編號</th>
                                            <th>標題</th>
                                            <th>文章圖片</th>
                                            <th>內容</th>
                                            <th>創建時間</th>
                                            <th>更新時間</th>
                                            <th>狀態</th>
                                            <th>類型</th>
                                            <th>操作</th>
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
                                            <th>類型</th>
                                            <th>操作</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) {
                                            $counter = 1 + $offset; // 顯示正確的編號
                                            while ($row = $result->fetch_assoc()) {
                                                // 狀態轉換
                                                $statusText = $row['status'] == 1 ? '已發布' : '待發布';
                                                // 類型轉換
                                                $typeText = match ((int)$row['type']) {
                                                    0 => '官方文章',
                                                    1 => '商品描述',
                                                    2 => '活動描述',
                                                    default => '未知類型'
                                                };

                                                // 顯示圖片
                                                $imageHtml = $row['imgUrl'] ? "<img src='img/article/" . htmlspecialchars($row['imgUrl']) . "' alt='Image' style='width: 100px;'>" : "無圖片";

                                                echo "<tr>";
                                                echo "<td>" . $counter++ . "</td>"; // 顯示流水號
                                                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                                echo "<td>" . $imageHtml . "</td>";
                                                echo "<td>" . htmlspecialchars($row['content']) . "</td>";
                                                echo "<td>" . $row['createdAt'] . "</td>";
                                                echo "<td>" . $row['upgradeDate'] . "</td>";
                                                echo "<td>" . $statusText . "</td>";
                                                echo "<td>" . $typeText . "</td>";
                                                echo "<td>
                                                    <a href='articleEditPage.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>編輯</a>
                                                    <a href='articleDelete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"您確定要刪除嗎?\");'>刪除</a>
                                                </td>";
                                                echo "</tr>";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 分頁 -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php if ($page == 1) echo 'disabled'; ?>">
                        <a class="page-link" href="?page=1&search=<?php echo htmlspecialchars($searchTerm); ?>&status=<?php echo $statusFilter; ?>&type=<?php echo $typeFilter; ?>&isDeleted=<?php echo $isDeletedFilter; ?>" aria-label="First">
                            <span aria-hidden="true">&laquo;&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item <?php if ($page == 1) echo 'disabled'; ?>">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo htmlspecialchars($searchTerm); ?>&status=<?php echo $statusFilter; ?>&type=<?php echo $typeFilter; ?>&isDeleted=<?php echo $isDeletedFilter; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item <?php if ($page == $totalPages) echo 'disabled'; ?>">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo htmlspecialchars($searchTerm); ?>&status=<?php echo $statusFilter; ?>&type=<?php echo $typeFilter; ?>&isDeleted=<?php echo $isDeletedFilter; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <li class="page-item <?php if ($page == $totalPages) echo 'disabled'; ?>">
                        <a class="page-link" href="?page=<?php echo $totalPages; ?>&search=<?php echo htmlspecialchars($searchTerm); ?>&status=<?php echo $statusFilter; ?>&type=<?php echo $typeFilter; ?>&isDeleted=<?php echo $isDeletedFilter; ?>" aria-label="Last">
                            <span aria-hidden="true">&raquo;&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>

    </div>
</body>
</html>
