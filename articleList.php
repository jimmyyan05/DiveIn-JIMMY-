<?php

require_once("../db_project_connect.php");

// 檢查是否有搜尋字串
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// 修改 SQL 查詢，結合 article 和 article_image 資料表
$sql = "
    SELECT 
        a.id, 
        a.title, 
        a.content, 
        a.createdAt, 
        a.upgradeDate, 
        a.status, 
        a.type, 
        ai.imgUrl 
    FROM 
        article a
    LEFT JOIN 
        article_image ai 
    ON 
        a.id = ai.article_id"; // 使用 LEFT JOIN 確保即使沒有對應的圖片資料，文章資料也能顯示

// 根據搜尋字串過濾文章
if ($searchTerm) {
    $sql .= " WHERE a.title LIKE '%" . $conn->real_escape_string($searchTerm) . "%'";
}

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>服務項目</title>

    <!-- 統一的css -->
    <?php include "css.php"; ?>

    <!-- 自訂css樣式 -->
    <link rel="stylesheet" href="activity_style.css">

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
                    <!-- Page Heading -->
                    <h1 class="h3 text-gray-800 mb-4">文章列表</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <!-- 搜尋與新增按鈕 -->
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <!-- 左侧按钮组 -->
                            <div class="d-flex gap-2">
                                <a href="articleCreate.php" class="btn bg-info text-white">
                                    <i class="fa-solid fa-circle-plus"></i> 新增文章
                                </a>
                                <a href="articleList.php" class="btn bg-info text-white">
                                    <i class="fa-solid fa-list-ul"></i> 全部文章
                                </a>
                            </div>
                            <!-- 右侧搜索框 -->
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

                        <!-- 表格 -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>title</th>
                                            <th>articleImage</th>
                                            <th>content</th>
                                            <th>createdAt</th>
                                            <th>upgradeDate</th>
                                            <th>status</th>
                                            <th>type</th>
                                            <th>operate</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>title</th>
                                            <th>articleImage</th>
                                            <th>content</th>
                                            <th>createdAt</th>
                                            <th>upgradeDate</th>
                                            <th>status</th>
                                            <th>type</th>
                                            <th>operate</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) {
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

                                                echo "<tr>";
                                                echo "<td>" . $row['id'] . "</td>";
                                                echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                                                echo "<td>";
                                                if ($row['imgUrl']) {
                                                    echo "<img src='" . htmlspecialchars($row['imgUrl']) . "' alt='Image' style='width: 100px;'>";
                                                } else {
                                                    echo "No Image";
                                                }
                                                echo "</td>";
                                                echo "<td>" . htmlspecialchars($row['content']) . "</td>";
                                                echo "<td>" . $row['createdAt'] . "</td>";
                                                echo "<td>" . $row['upgradeDate'] . "</td>";
                                                echo "<td>" . $statusText . "</td>";
                                                echo "<td>" . $typeText . "</td>";
                                                echo "<td>
                                                    <a href='articleEdit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                                    <a href='articleDelete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete?\");'>Delete</a>
                                                  </td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='9'>No records found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<?php
$conn->close(); // 關閉資料庫連線
?>