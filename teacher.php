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
}else{
    $whereClause = "ORDER BY id ASC";
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
$searchWord="";

//如果沒有p，跳轉至第一頁
if(!isset($_GET["p"])){
    if(isset($_GET["search"])){
    header("location:teacher.php?p=1&search=".$_GET["search"]);
    }else{
        header("location:teacher.php?p=1");

    }
}

// 獲取總數（包括搜尋條件）
$sqlAll = "SELECT COUNT(*) AS total 
          FROM activity_teacher 
          WHERE 1 AND is_deleted=0 $searchCondition"; 
$resultAll = $conn->query($sqlAll);
$teachersCount = $resultAll->fetch_assoc()['total'];

// 獲取分頁數據
$sql = "SELECT 
            activity_teacher.*, 
            activity_teacher_image.imageUrl AS image
        FROM activity_teacher
        LEFT JOIN activity_teacher_image 
            ON activity_teacher_image.teacher_id = activity_teacher.id
        WHERE 1 $searchCondition AND activity_teacher.is_deleted=0 $whereClause 
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

    <title>課程師資</title>

    <!-- Custom fonts for this template -->
    <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> -->

    <!-- Custom styles for this template -->
    <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->

    <!-- Custom styles for this page -->
    <!-- <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->


    <!-- fontawesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

    <!-- bootstrap5 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

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
                        <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">師資列表</li>
                    </ol>
                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">師資列表</h1>
                    

                    <!-- 搜尋列 -->
                    <div class="row justify-content-start">
                        <form class="col-2 d-flex justify-content-start" action="" method="get">
                            <div class="input-group mb-3 search-bar justify-content-end gx-0">
                                <input type="text" class="form-control" placeholder="<?php if (!isset($_GET["search"])): ?>輸入活動關鍵字 <?php else: ?><?= $_GET["search"] ?><?php endif; ?>"
                                    aria-label="Recipient's username" aria-describedby="basic-addon2" name="search" <?php if (isset($_GET["search"])): ?> value="<?= $_GET["search"] ?>" <?php endif; ?>>
                                <div class="input-group-append p-0">
                                    <button class="btn btn-outline-secondary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </div>
                            <?php if (isset($_GET["search"])): ?>
                                <div class="ms-1">
                                    <a href="teacher.php" class="btn btn-secondary"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>

                    <!-- 新增課程按鈕及排序按鈕 -->
                    <div class="d-flex justify-content-between my-2">
                        <a href="create-teacher.php" class="btn btn-info"><i class="fa-solid fa-plus fa-fw"></i>新增教練</a>
                        <div class="d-flex justify-content-center">
                            <?php if (isset($_GET["order"])): ?>
                                <div class="me-2">
                                    <a href="teacher.php?p=1<?php if (isset($search)): ?>&search=<?= $search ?><?php endif; ?>" class="btn btn-secondary"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                            <?php endif; ?>

                            <div class="btn-group ">
                                <a href="teacher.php?p=1<?php if (isset($search)): ?>&search=<?= $search ?><?php endif; ?>&order=1" class="btn btn-info <?php if (isset($_GET["order"]) && $_GET["order"] == 1): ?> active<?php endif; ?>" id="sort-time-down">教練年資 <i class="fa-solid fa-arrow-down-1-9"></i></a>
                                <a href="teacher.php?p=1<?php if (isset($search)): ?>&search=<?= $search ?><?php endif; ?>&order=2" class="btn btn-info <?php if (isset($_GET["order"]) && $_GET["order"] == 2): ?> active<?php endif; ?>" id="sort-time-up">教練年資<i class="fa-solid fa-arrow-up-1-9"></i></a>
                            </div>
                            <div class="ms-2">
                                <a href="teacher_isDeleted.php" class="btn btn-danger" title="已刪除的項目"><i class="fa-solid fa-trash-can-arrow-up fa-fw"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- 教練列表 開始 -->
                    <?php if ($teachersCount > 0): ?>
                        <table id="teacher-table" class="table table-style table-hover">
                            <tr>
                                <th>編號</th>
                                <th>姓名</th>
                                <th>教練照片</th>
                                <th>聯絡方式</th>
                                <th>性別</th>
                                <th>教練等級</th>
                                <th>年資</th>
                                <th>編輯</th>
                            </tr>
                            <?php $index=$start_item+1;
                            foreach ($teachers as $teacher): ?>
                                <tr>
                                    <td><?= $index ?></td>
                                    <td><?= $teacher["name"] ?></td>
                                    <td class="img-td-container">
                                        <div class="activity-img"><img class="mx-auto" src="img/teacher/<?= $teacher["image"] ?>" alt=""></div>  
                                    </td>
                                    <td><?= $teacher["email"] ?></td>
                                    <td><?php if ($teacher["sex"] == 1): ?>男性<?php endif; ?><?php if ($teacher["sex"] == 2): ?>女性<?php endif; ?></td>
                                    <td>
                                        <?php
                                        switch($teacher["level"]){
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
                                        <!-- 修改按鈕，跳出modal -->
                                        <button id="change-btn" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateModal<?= $teacher["id"] ?>"><i class="fa-solid fa-pen-to-square fa-fw"></i></button>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $teacher["id"] ?>"><i class="fa-solid fa-trash-can fa-fw"></i></button>
                                    </td>

                                    <!-- 修改用的modal -->
                                    <div class="modal fade" id="updateModal<?= $teacher["id"] ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel">更新項目資訊</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <!-- 修改服務資訊內容的form -->
                                                <form class="py-2" action="doUpdateteacher.php" method="post" enctype="multipart/form-data">
                                                    <!-- 隱藏的教師 ID -->
                                                    <input type="hidden" name="teacherID" value="<?= $teacher['id'] ?>">
                                                    <div class="modal-body">
                                                        <div class="mb-2">
                                                            <div class="bg-light update-img d-flex justify-content-center mb-2 rounded">
                                                                <img id="previewImage<?=$teacher["id"]?>" src="img/teacher/<?= $teacher["image"] ?>" alt="">
                                                            </div>
                                                            <label for="" class="form-label">修改圖片</label>
                                                            <input id="fileInput<?=$teacher["id"]?>" type="file" class="form-control" name="myFile" accept="image/*">
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col">
                                                                <label for="" class="form-label">教練姓名</label>
                                                                <input type="text" class="form-control" name="teacherName" value="<?= $teacher["name"] ?>" placeholder="請輸入新的名稱" required>
                                                            </div>
                                                            <div class="col">
                                                                <label for="" class="form-label">教練性別</label>
                                                                <select class="form-control" name="sex" id="" required>
                                                                    <option value="1" <?php if ($teacher["sex"] == 1): ?>selected<?php endif; ?>>男性</option>
                                                                    <option value="2" <?php if ($teacher["sex"] == 2): ?>selected<?php endif; ?>>女性</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="" class="form-label">教練聯絡方式</label>
                                                            <input type="text" class="form-control" name="teacherEmail" value="<?= $teacher["email"] ?>" placeholder="請輸入電子信箱" required>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">教練年資</label>
                                                                <input type="text" class="form-control" name="teacherYears" value="<?= $teacher["years"] ?>" placeholder="請輸入教練年資" required>
                                                            </div>
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">教練等級</label>
                                                                <select class="form-control" name="level" id="" required>
                                                                    <option value="1" <?= $teacher["level"] == 1 ? "selected" : "" ?>>OWSI 開放水域潛水教練</option>
                                                                    <option value="2" <?= $teacher["level"] == 2 ? "selected" : "" ?>>MSDT 潛水大師教練</option>
                                                                    <option value="3" <?= $teacher["level"] == 3 ? "selected" : "" ?>>教練開發課程助教</option>
                                                                    <option value="4" <?= $teacher["level"] == 4 ? "selected" : "" ?>>潛水大師教練</option>
                                                                    <option value="5" <?= $teacher["level"] == 5 ? "selected" : "" ?>>課程總監</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                        <button type="submit" class="btn btn-info">儲存修改</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- 刪除的recheck modal -->
                                    <div class="modal fade" id="deleteModal<?= $teacher["id"] ?>" tabindex="-1" aria-labelledby="deleteModallLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModallLabel">將此項目移至垃圾桶</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    您是否確認要將此項目移至垃圾桶？
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                    <form action="doDeleteTeacher.php" method="post">
                                                        <input type="hidden" name="teacherID" value="<?= $teacher["id"] ?>">
                                                        <button type="submit" class="btn btn-danger" name="deleted" value="1">確認</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            <?php $index++;
                        endforeach; ?>
                        </table>
                        <!-- 服務列表 結束 -->
                    <?php else: ?>
                        <div class="text-danger">沒有找到相關資料！</div>
                    <?php endif; ?>


                    <!-- 做出頁籤 -->
                    <?php if ($total_page > 1): ?>
                        <div class="d-flex justify-content-center">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <?php if ($p - 1 > 0): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="teacher.php?p=<?= $_GET["p"] - 1 ?><?php if (isset($_GET["search"])): ?><?= "&search=" . $_GET["search"] ?><?php endif; ?><?php if (isset($_GET["order"])): ?><?= "&order=" . $_GET["order"] ?><?php endif; ?>" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php for ($i = 1; $i <= $total_page; $i++): ?>
                                        <li class="page-item <?php if ($i == $_GET["p"]) echo "active"; ?>"><a class="page-link" href="teacher.php?p=<?= $i ?><?php if (isset($_GET["search"])): ?><?= "&search=" . $_GET["search"] ?><?php endif; ?><?php if (isset($_GET["order"])): ?><?= "&order=" . $_GET["order"] ?><?php endif; ?>">
                                                <?= $i ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>
                                    <?php if ($p + 1 <= $total_page): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="teacher.php?p=<?= $_GET["p"] + 1 ?><?php if (isset($_GET["search"])): ?><?= "&search=" . $_GET["search"] ?><?php endif; ?><?php if (isset($_GET["order"])): ?><?= "&order=" . $_GET["order"] ?><?php endif; ?>" aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                        </div>
                    <?php endif; ?>
                    <!-- 頁籤結束 -->



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



    <script>
        // 上傳圖片預覽
        <?php foreach ($teachers as $teacher): ?>
        const fileInput<?=$teacher["id"]?> = document.querySelector("#fileInput<?=$teacher["id"]?>");
        fileInput<?=$teacher["id"]?>.addEventListener("change", function(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById("previewImage<?=$teacher["id"]?>");
            previewImage.src = "";
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result; // 設定預覽圖片為選擇的檔案
                };
                reader.readAsDataURL(file); // 讀取檔案
            }
        })
        <?php endforeach; ?>
        // // 圖片修改第二次時應該怎麼處理呢？
        // const changebtn = document.querySelector("#change-btn")
        // changebtn.addEventListener("click", function() {
        //     previewImage.src = "img/teacher/<?= $teacher["image"] ?>";
        // })
    </script>
</body>

</html>