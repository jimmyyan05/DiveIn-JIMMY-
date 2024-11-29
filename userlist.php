<?php
require_once("../pj_connect.php");

if (isset($_GET["user"])) {
    $user_id = $_GET["user"];
}

// $limit = 10;
// $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
// $start = ($page - 1) * $limit;

// $valid_cols = ["id", "account", "name"];
// $sort_cols = isset($_GET["sort_by"]) && in_array($_GET["sort_by"], $valid_cols) ? $_GET["sort_by"] : "id";
// if (isset($_GET['sort_order']) && $_GET['sort_order'] === 'desc') {
//     $sort_order = 'desc';
// } else {
//     $sort_order = 'asc';
// }



$levels = [
    0 => "青銅",
    1 => "白銀",
    2 => "黃金",
];


$sql = "SELECT * FROM users WHERE manager = 0 AND is_deleted = 0";
$result = $conn->query($sql);
$user_count = $result->num_rows;
$users = $result->fetch_all(MYSQLI_ASSOC);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>會員列表</title>

    <?php include("./css.php") ?>

</head>

<body id="page-top" class="sidebar-toggled">
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

                    <h1 class="h3 mb-2 text-gray-800">會員列表</h1>
                    <p></p>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <form class="d-flex mt-2 col-4" method="GET" action="">
                                <input class="form-control" type="search" name="query" placeholder="輸入關鍵字搜尋..."
                                    aria-label="Search"
                                    value="<?= isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '' ?>">
                                <button class="btn btn-info" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm overflow-y-scroll" style="height: 63vh; min-width: 320px;">
                                <?php if ($user_count > 0): ?>
                                    <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0" style="min-width: 50px;">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>帳號</th>
                                                <th>姓名</th>
                                                <th>電話</th>
                                                <th>email</th>
                                                <th>更多資料</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>id</th>
                                                <th>帳號</th>
                                                <th>姓名</th>
                                                <th>電話</th>
                                                <th>email</th>
                                                <th>更多資料</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $query = isset($_GET['query']) ? $_GET['query'] : '';

                                            if (!empty($query)) {
                                                $sql = "SELECT * FROM users WHERE name LIKE ? OR account LIKE ?";
                                                $stmt = $conn->prepare($sql);
                                                $likeQuery = "%$query%";
                                                $stmt->bind_param("ss", $likeQuery, $likeQuery);
                                                $stmt->execute();
                                                $stmt_result = $stmt->get_result();
                                                $users = $stmt_result->fetch_all(MYSQLI_ASSOC);
                                            } else {
                                                $sql = "SELECT * FROM users WHERE manager = 0 AND is_deleted = 0";
                                                $stmt_result = $conn->query($sql);
                                                $users = $stmt_result->fetch_all(MYSQLI_ASSOC);
                                            }
                                            if (!empty($users)) {
                                                foreach ($users as $user):
                                            ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($user["id"]) ?></td>
                                                        <td><?= htmlspecialchars($user["account"]) ?></td>
                                                        <td><?= htmlspecialchars($user["name"]) ?></td>
                                                        <td><?= htmlspecialchars($user["phone"]) ?></td>
                                                        <td><?= htmlspecialchars($user["email"]) ?></td>
                                                        <td>
                                                            <div class="btn-group" style="border: 0px;">
                                                                <!-- 檢視按鈕 -->
                                                                <button class="btn bg-primary-subtle" data-bs-toggle="modal" data-bs-target="#viewModal<?= $user["id"] ?>">檢視</button>
                                                                <!-- 修改按鈕 -->
                                                                <button class="btn bg-success-subtle" data-bs-toggle="modal" data-bs-target="#editModal<?= $user["id"] ?>">修改</button>
                                                                <!-- 刪除按鈕 -->
                                                                <button class="btn bg-danger-subtle" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $user["id"] ?>">刪除</button>
                                                            </div>
                                                            <!-- 檢視 Modal -->
                                                            <div class="modal fade" id="viewModal<?= $user["id"] ?>" tabindex="-1" aria-labelledby="viewModalLabel<?= $user["id"] ?>" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="viewModalLabel<?= $user["id"] ?>">檢視使用者資料</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p><strong>姓名：</strong><?= htmlspecialchars($user["name"]) ?></p>
                                                                            <p><strong>帳號：</strong><?= htmlspecialchars($user["account"]) ?></p>
                                                                            <p><strong>電話：</strong><?= htmlspecialchars($user["phone"]) ?></p>
                                                                            <p><strong>Email：</strong><?= htmlspecialchars($user["email"]) ?></p>
                                                                            <p><strong>生日:</strong> <?= htmlspecialchars($user["birthday"]) ?></p>
                                                                            <p><strong>地址:</strong> <?= htmlspecialchars($user["address"]) ?></p>
                                                                            <p><strong>建立時間:</strong> <?= htmlspecialchars($user["created_at"]) ?></p>
                                                                            <p><strong>更新時間:</strong> <?= htmlspecialchars($user["updated_at"]) ?></p>
                                                                            <p><strong>等級:</strong> <?= $levels[$user["level_id"]] ?? "未知等級" ?></p>
                                                                            <p><strong>緊急聯絡人:</strong> <?= htmlspecialchars($user["emergency_contact"]) ?></p>
                                                                            <p><strong>緊急連絡人電話:</strong> <?= htmlspecialchars($user["emergency_phone"]) ?></p>
                                                                            <p><strong>持有證照:</strong> <?= $user["is_certify"] > 0 ? "是" : "否" ?></p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- 修改 Modal -->
                                                            <div class="modal fade" id="editModal<?= $user["id"] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $user["id"] ?>" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="editModalLabel<?= $user["id"] ?>">修改等級</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="edit_user.php" method="POST">
                                                                                <input type="hidden" name="user_id" value="<?= $user["id"] ?>">
                                                                                <div class="mb-3">
                                                                                    <label for="userLevelId<?= $user["id"] ?>" class="form-label">等級</label>
                                                                                    <select name="level_id" class="form-control" id="userLevelId<?= $user["id"] ?>">
                                                                                        <?php foreach ($levels as $level_id => $level_name): ?>
                                                                                            <option value="<?= $level_id ?>" <?= $user["level_id"] == $level_id ? 'selected' : '' ?>><?= htmlspecialchars($level_name) ?></option>
                                                                                        <?php endforeach; ?>
                                                                                    </select>
                                                                                </div>
                                                                                <button type="submit" class="btn btn-info">儲存變更</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- 刪除 Modal -->
                                                            <div class="modal fade" id="deleteModal<?= $user["id"] ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $user["id"] ?>" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="deleteModalLabel<?= $user["id"] ?>">刪除確認</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            您確定要刪除使用者 **<?= $user["name"] ?>** 的資料嗎？
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <form action="delete_user.php" method="POST">
                                                                                <input type="hidden" name="user_id" value="<?= $user["id"] ?>">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                                                <button type="submit" class="btn btn-danger">確認刪除</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php endforeach;
                                            } else {
                                                echo "<tr><td colspan='6' class='text-center'>找不到符合條件的資料</td></tr>";
                                            } ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            </div>

                            <div class="p-2 pt-3">共計 <?= htmlspecialchars($user_count) ?> 位會員</div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->
                <!-- Footer -->
                <?php include("./footer.php") ?>
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
    </div>


    <?php include("./js.php") ?>
</body>

</html>