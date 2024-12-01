<?php
require_once("../db_project_connect.php");

$avticityCateSql = "SELECT 
activity_category_big.id AS big_id,
activity_category_big.name AS big_name,
activity_category_small.id AS small_id,
activity_category_small.name AS small_name 
FROM activity_category_big
LEFT JOIN activity_category_small 
ON activity_category_big.id = activity_category_small.activityCategoryBig_id";

$avticityResultcate = $conn->query($avticityCateSql);

$avticityCategoryArr = [];
while ($cates = $avticityResultcate->fetch_assoc()) {
    $avticityCategoryArr[$cates['big_id']]['name'] = $cates['big_name'];
    $avticityCategoryArr[$cates['big_id']]['children'][] = [
        'id' => $cates['small_id'],
        'name' => $cates['small_name']
    ];
}
$sqlTeachers = "SELECT id, name FROM activity_teacher";
$resultTeachers = $conn->query($sqlTeachers);

$teachers = [];
if ($resultTeachers->num_rows > 0) {
    $teachers = $resultTeachers->fetch_all(MYSQLI_ASSOC);
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

    <title>新增服務項目</title>


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
                    <h1 class="h3 mb-2 text-gray-800">新增服務</h1>
                    <!-- 麵包屑 -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">首頁</a></li>
                            <li class="breadcrumb-item"><a href="activity.php">服務列表</a></li>
                            <li class="breadcrumb-item active" aria-current="page">新增服務</li>
                        </ol>
                    </nav>
                    <a href="activity.php" class="btn btn-info mb-3" title="返回服務列表"><i class="fa-solid fa-reply fa-fw"></i></a>

                    <div class="container bg-white">
                        <form class="py-2" action="doCreateActivity.php" method="post" enctype="multipart/form-data">

                            <div class="mb-2">
                                <div class="bg-light update-img d-flex justify-content-center mb-2">
                                    <img id="previewImage" src="img/activity/<?= $activity["main_image"] ?>" alt="">
                                </div>
                                <label for="" class="form-label">新增圖片</label>
                                <input id="fileInput" type="file" class="form-control" name="myFile" accept="image/*" require>
                            </div>

                            <div class="mb-2">
                                <label for="" class="form-label">服務名稱</label>
                                <input type="text" class="form-control" name="activityName" placeholder="請輸入服務名稱">
                            </div>

                            <!-- 下拉式選單 -->
                            <div class="row">
                                <div class="mb-2 col">
                                    <label for="" class="form-label">服務類型</label>
                                    <select class="form-control" name="activityCategoryBig" id="activityCategoryBig">
                                        <option selected>請選擇服務類型</option>
                                        <?php foreach ($avticityCategoryArr as $big_id => $big_data): ?>
                                            <option value="<?= $big_id ?>"><?= $big_data["name"] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-2 col">
                                    <label for="" class="form-label">服務類別</label>
                                    <select class="form-control" name="activityCategorySmall" id="activityCategorySmall" disabled>
                                        <option selected>請先選擇服務類型</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="mb-2 col">
                                    <label for="" class="form-label">地點</label>
                                    <select class="form-control" name="activityLocation" id="">
                                        <option selected>請選擇</option>
                                        <option value="1">選項 1</option>
                                    </select>
                                </div> -->
                            <div class="row mb-2">
                                <div class="col mb-2">
                                    <label for="" class="form-label">費用</label>
                                    <input type="number" class="form-control" name="activityPrice" placeholder="請輸入金額" min="1" step="1">
                                </div>
                                <div class="col">
                                    <label for="" class="form-label">師資</label>
                                    <select name="teacher" class="form-select">
                                        <option value="">請選擇師資</option> <!-- 預設空選項 -->
                                        <?php foreach ($teachers as $teacher): ?>
                                            <option value="<?= htmlspecialchars($teacher['id']) ?>">
                                                <?= htmlspecialchars($teacher['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- </div> -->

                            <div class="row">
                                <div class="mb-2 col">
                                    <label for="" class="form-label">報名開始日</label>
                                    <input type="date" class="form-control" name="activitySignDate">
                                </div>
                                <div class="mb-2 col">
                                    <label for="" class="form-label">報名截止日</label>
                                    <input type="date" class="form-control" name="activitySignEndDate">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-2 col">
                                    <label for="" class="form-label">活動開始時間</label>
                                    <input type="datetime-local" class="form-control" name="activityStartDate">
                                </div>
                                <div class="mb-2 col">
                                    <label for="" class="form-label">活動結束時間</label>
                                    <input type="datetime-local" class="form-control" name="activityEndDate">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">活動介紹</label>
                                <textarea class="form-control" name="activityArticle" rows="5"></textarea>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-info w-100" type="submit">送出</button>

                            </div>
                        </form>
                    </div>


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
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> <!-- This includes Popper.js, which is required for dropdowns and tooltips in Bootstrap 5 -->

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap5.min.js"></script> <!-- Updated for Bootstrap 5 -->

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- bootstrap5的JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- 活動的下拉式選單的JS -->
    <script>
        const activityCategoryBig = document.querySelector("#activityCategoryBig");
        const activityCategorySmall = document.querySelector("#activityCategorySmall");
        const categories = <?= json_encode($avticityCategoryArr) ?>;

        activityCategoryBig.addEventListener("change", function() {
            const bigCategoryId = this.value; // 取得大分類的選擇值
            activityCategorySmall.innerHTML = ""; // 清空小分類選單

            if (bigCategoryId && categories[bigCategoryId]) { // 如果選擇的 ID 有對應的資料
                const smallCategories = categories[bigCategoryId]['children']; // 取得該大分類的子分類
                activityCategorySmall.disabled = false; // 啟用小分類選單

                // 為小分類選單新增選項
                smallCategories.forEach(smallCategory => {
                    const option = document.createElement('option');
                    option.value = smallCategory['id'];
                    option.textContent = smallCategory['name'];
                    activityCategorySmall.appendChild(option);
                });
            } else {
                // 如果沒有選擇大分類，禁用小分類選單並重設選項
                activityCategorySmall.disabled = true;
                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = '請先選擇活動類型';
                activityCategorySmall.appendChild(defaultOption);
            }
        });
        // 上傳圖片預覽
        const fileInput = document.querySelector("#fileInput");
        fileInput.addEventListener("change", function() {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.getElementById("previewImage");
                    previewImage.src = e.target.result; // 設定預覽圖片為選擇的檔案
                };

                reader.readAsDataURL(file); // 讀取檔案
            }
        })
    </script>
</body>

</html>