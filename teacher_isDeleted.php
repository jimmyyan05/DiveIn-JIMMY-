<?php
require_once("../db_project_connect.php");

// $sql = "SELECT activity_teacher.*, 
//         activity_teacher_image.imageUrl AS image
//         FROM activity_teacher
//         JOIN activity_teacher_image 
//         ON activity_teacher_image.teacher_id = activity_teacher.id";
// $result = $conn->query($sql);
// $teachers = $result->fetch_all(MYSQLI_ASSOC);
// $teachersCount = $result->num_rows;

// 初始化變數
$whereClause = "";
$per_page = 5;
$p = isset($_GET["p"]) ? (int)$_GET["p"] : 1;
$start_item = ($p - 1) * $per_page;

// 處理排序參數
if (isset($_GET["order"])) {
    $order = (int)$_GET["order"];
    switch ($order) {
        case 1:
            $whereClause .= " ORDER BY activity_teacher.years ASC";
            break;
        case 2:
            $whereClause .= " ORDER BY activity_teacher.years DESC";
            break;
    }
}

// 處理搜尋參數
$searchCondition = "";
if (isset($_GET["search"]) && $_GET["search"] !== "") {
    $search = $conn->real_escape_string($_GET["search"]);
    $searchCondition = " AND activity_teacher.name LIKE '%$search%'";
} elseif (isset($_GET["search"])) {
    // 如果搜尋欄是空的，重新導向到首頁
    header("location:teacher.php");
    exit();
}

// 獲取總數（包括搜尋條件）
$sqlAll = "SELECT COUNT(*) AS total 
          FROM activity_teacher 
          WHERE 1 $searchCondition AND activity_teacher.is_deleted=1";
$resultAll = $conn->query($sqlAll);
$teachersCount = $resultAll->fetch_assoc()['total'];

// 獲取分頁數據
$sql = "SELECT 
            activity_teacher.*, 
            activity_teacher_image.imageUrl AS image
        FROM activity_teacher
        LEFT JOIN activity_teacher_image 
            ON activity_teacher_image.teacher_id = activity_teacher.id
        WHERE 1 $searchCondition $whereClause AND activity_teacher.is_deleted=1
        LIMIT $start_item, $per_page";

$result = $conn->query($sql);
$teachers = $result->fetch_all(MYSQLI_ASSOC);

// 計算總頁數
$total_page = ceil($teachersCount / $per_page);


?>

<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>已刪除的師資</title>

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

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "topbar.php"; ?>
                <!-- End of Topbar -->
                <!-- 麵包屑 -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb rounded-0 p-3">
                        <li class="breadcrumb-item"><a href="index.html">首頁</a></li>
                        <li class="breadcrumb-item"><a href="teacher.php">師資列表</a></li>
                        <li class="breadcrumb-item active" aria-current="page">已刪除的師資</li>
                    </ol>
                </nav>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">已刪除的師資</h1>

                    <a href="teacher.php" class="btn btn-info mb-3" title="返回服務列表"><i class="fa-solid fa-reply fa-fw"></i></a>

                    <!-- 教練列表 開始 -->
                    <?php if ($teachersCount > 0): ?>
                        <table id="teacher-table" class="table table-style table-hover">
                            <tr>
                                <th>編號</th>
                                <th>姓名</th>
                                <th>教師照片</th>
                                <th>聯絡方式</th>
                                <th>性別</th>
                                <th>教練等級</th>
                                <th>年資</th>
                                <th>復原</th>
                                <th>刪除</th>
                            </tr>
                            <?php foreach ($teachers as $teacher): ?>
                                <tr>
                                    <td><?= $teacher["id"] ?></td>
                                    <td><?= $teacher["name"] ?></td>
                                    <td>
                                        <div class="activity-img"><img class="mx-auto" src="img/teacher/<?= $teacher["image"] ?>" alt=""></div>
                                    </td>
                                    <td><?= $teacher["email"] ?></td>
                                    <td><?php if ($teacher["sex"] == 1): ?>男性<?php endif; ?><?php if ($teacher["sex"] == 2): ?>女性<?php endif; ?></td>
                                    <td>
                                        <?php
                                        switch ($teacher["level"]) {
                                            case 1:
                                                echo "OWSI 開放水域潛水教練";
                                                break;
                                            case 2:
                                                echo "MSDT 潛水大師教練";
                                                break;
                                            case 3:
                                                echo "教練開發課程助教";
                                                break;
                                            case 4:
                                                echo "潛水大師教練";
                                                break;
                                            case 5:
                                                echo "課程總監";
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td><?= $teacher["years"] ?></td>

                                    <td>
                                        <form action="doRestoreTeacher.php" method="post">
                                            <input type="hidden" name="teacherID" value="<?= $teacher['id'] ?>">
                                            <button title="復原" type="submit" class="btn btn-info" name="deleted" value="0"><i class="fa-fw fa-solid fa-trash-can-arrow-up"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <input type="hidden" name="teacherID" value="<?= $teacher['id'] ?>">
                                        <!-- <button title="刪除" type="submit" class="btn btn-danger" name="deleted" value="0"><i class="fa-solid fa-burst fa-fw"></i></button> -->
                                        <button title="刪除" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $teacher["id"] ?>"><i class="fa-solid fa-burst fa-fw"></i></button>
                                    </td>
                                    <!-- 刪除的recheck modal -->
                                    <div class="modal fade" id="deleteModal<?= $teacher["id"] ?>" tabindex="-1" aria-labelledby="deleteModallLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModallLabel">刪除此項目</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    您是否確認要永久刪除此項目？此操作將無法復原！
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                    <form action="doReallyDeleteTeacher.php" method="post">
                                                        <input type="hidden" name="teacherID" value="<?= $teacher["id"] ?>">
                                                        <button type="submit" class="btn btn-danger" name="deleted" value="0">確認刪除</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php else: ?>
                        <div class="text-danger">目前沒有已刪除的師資</div>
                    <?php endif; ?>


                </div>
                <!-- /.container-fluid -->

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

</body>

</html>