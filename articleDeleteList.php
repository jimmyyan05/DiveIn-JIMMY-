<?php
require_once("../db_project_connect.php");

// 檢查是否有搜尋字串
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// 查詢已刪除的文章 (isDeleted = 1)
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
        a.id = ai.article_id
    WHERE 
        a.isDeleted = 1
";

// 根據搜尋字串過濾文章
if ($searchTerm) {
    $sql .= " AND a.title LIKE '%" . $conn->real_escape_string($searchTerm) . "%'";
}

$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['restoreId'])) {
    $restoreId = intval($_POST['restoreId']);

    // 更新文章的 isDeleted 欄位為 0
    $restoreSql = "UPDATE article SET isDeleted = 0 WHERE id = ?";
    $stmt = $conn->prepare($restoreSql);
    $stmt->bind_param("i", $restoreId);

    if ($stmt->execute()) {
        echo "<script>alert('復原成功！'); window.location.href = 'articleDeleteList.php';</script>";
    } else {
        echo "<script>alert('復原失敗！請再試一次。');</script>";
    }
    $stmt->close();
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

    <title>刪除文章管理</title>

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
                        <h1 class="h3 text-gray-800">已刪除文章</h1>
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
                            <div class="d-flex gap-2">
                                <a href="articleList.php" class="btn bg-info text-white">
                                    <i class="fa-solid fa-list-ul"></i> 文章列表
                                </a>
                            </div>
                        </div>
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
                                                    <form method='post' style='display:inline-block;'>
                                                        <input type='hidden' name='restoreId' value='" . $row['id'] . "'>
                                                        <button type='submit' class='btn btn-success btn-sm'>復原</button>
                                                    </form>
                                                  </td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='9'>No deleted records found</td></tr>";
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