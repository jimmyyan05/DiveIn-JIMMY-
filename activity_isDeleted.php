<?php
require_once("../db_project_connect.php");

$sql = "SELECT 
    activity.*, 
    activity_category_small.name AS smallCategory_name,
    activity_category_big.name AS bigCategory_name,
activity_category_big.id AS big_id,

    (SELECT activity_image.imgUrl FROM activity_image 
     WHERE activity_image.activity_id = activity.id AND activity_image.isMain = 1
     LIMIT 1) AS main_image
FROM activity
JOIN activity_category_small ON activity.activityCategorySmall_id = activity_category_small.id
JOIN activity_category_big ON activity_category_small.activityCategoryBig_id = activity_category_big.id
WHERE activity.isDeleted=1";

$result = $conn->query($sql);

$activityCount = $result->num_rows;
$activitys = $result->fetch_all(MYSQLI_ASSOC);

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

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "topbar.php"; ?>                    
                <!-- End of Topbar -->


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">已刪除的服務</h1>
                    <!-- 麵包屑 -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">首頁</a></li>
                            <li class="breadcrumb-item"><a href="activity.php">服務列表</a></li>
                            <li class="breadcrumb-item active" aria-current="page">已刪除的服務</li>
                        </ol>
                    </nav>
                    <a href="activity.php" class="btn btn-info mb-3" title="返回服務列表"><i class="fa-solid fa-reply fa-fw"></i></a>

                    <!-- 服務列表 -->
                    <table class="table table-hover">
                        <tr>
                            <th>編號</th>
                            <th>名稱</th>
                            <th>圖片</th>
                            <th>類型</th>
                            <th>子分類</th>
                            <th>報名日期</th>
                            <th>活動時間</th>
                            <th>費用</th>
                            <th>復原</th>
                            <th>刪除</th>
                        </tr>
                        <?php foreach ($activitys as $activity): ?>
                            <tr>
                                <td><?= $activity["id"] ?></td>
                                <td><?= $activity["name"] ?></td>
                                <td>
                                    <div class="activity-img"><img class="mx-auto" src="img/activity/<?= $activity["main_image"] ?>" alt=""></div>
                                </td>
                                <td><?= $activity["bigCategory_name"] ?></td>
                                <td><?= $activity["smallCategory_name"] ?></td>
                                <td><?= $activity["signUpDate"] ?><br>|<br><?= $activity["signUpEndDate"] ?></td>
                                <td>
                                    <?php if ($activity["startDate"] == $activity["endDate"]): ?>
                                        <?= $activity["startDate"] ?>
                                    <?php else: ?>
                                        <?= $activity["startDate"] ?><br>|<br><?= $activity["endDate"] ?>
                                    <?php endif; ?>
                                </td>

                                <td>$<?= number_format($activity["price"]) ?>

                                </td>
                                <td>
                                    <form action="doRestoreActivity.php" method="post">
                                        <input type="hidden" name="activityID" value="<?= $activity['id'] ?>">
                                        <button title="復原" type="submit" class="btn btn-info" name="deleted" value="0"><i class="fa-fw fa-solid fa-trash-can-arrow-up"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <input type="hidden" name="activityID" value="<?= $activity['id'] ?>">
                                    <!-- <button title="刪除" type="submit" class="btn btn-danger" name="deleted" value="0"><i class="fa-solid fa-burst fa-fw"></i></button> -->
                                    <button title="刪除" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $activity["id"] ?>"><i class="fa-solid fa-burst fa-fw"></i></button>
                                </td>
                                <!-- 刪除的recheck modal -->
                                <div class="modal fade" id="deleteModal<?= $activity["id"] ?>" tabindex="-1" aria-labelledby="deleteModallLabel" aria-hidden="true">
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
                                                <form action="doReallyDeleteActivity.php" method="post">
                                                    <input type="hidden" name="activityID" value="<?= $activity["id"] ?>">
                                                    <button type="submit" class="btn btn-danger" name="deleted" value="0">確認刪除</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        <?php endforeach; ?>
                    </table>


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