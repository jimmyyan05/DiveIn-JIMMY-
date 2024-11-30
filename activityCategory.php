<?php
require_once("../db_project_connect.php");

// $sql = "SELECT * FROM activity_category_big";
$sql = "SELECT 
activity_category_big.id AS big_id,
activity_category_big.name AS big_name,
activity_category_small.id AS small_id,
activity_category_small.name AS small_name 
FROM activity_category_big
LEFT JOIN activity_category_small ON activity_category_big.id = activity_category_small.activityCategoryBig_id	
";

$result = $conn->query($sql);
$bigCates = $result->fetch_all(MYSQLI_ASSOC);

$categories = [];
foreach ($bigCates as $cate) {
    $categories[$cate['big_id']]['big_name'] = $cate['big_name'];
    $categories[$cate['big_id']]['small_categories'][] = [
        'small_id' => $cate['small_id'],
        'small_name' => $cate['small_name'],
    ];
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

    <title>類別－服務項目</title>

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
        <!-- End of Sidebar -->

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
                    <h1 class="h3 mb-2 text-gray-800">服務類別</h1>
                    <!-- 麵包屑 -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">首頁</a></li>
                            <li class="breadcrumb-item active" aria-current="page">服務類別管理</li>
                        </ol>
                    </nav>

                    <!-- 服務類別 -->
                    <div class="row justify-content-start gx-2">
                        <?php foreach ($categories as $big_id => $category): ?>
                            <div class="col-4 mt-2">
                                <!-- 大分類按鈕 -->
                                <button class="btn btn-info w-100 d-flex justify-content-center align-items-center"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapseExample<?= $big_id ?>"
                                    aria-expanded="false"
                                    aria-controls="collapseExample<?= $big_id ?>">
                                    <h3 class="align-middle m-0"><?= $category["big_name"] ?></h3>
                                </button>

                                <!-- 小分類列表 -->
                                <div class="collapse" id="collapseExample<?= $big_id ?>">
                                    <div class="bg-white hovers border border-info">
                                        <?php foreach ($category['small_categories'] as $small_category): ?>
                                            <div class="d-flex justify-content-between p-1 border-bottom boder-info">
                                                <h4 class="text-black m-0 p-1"><?= $small_category["small_name"] ?></h4>
                                                <div class="btn-group">
                                                    <button class="btn btn-info"><i class="fa-solid fa-pen-to-square fa-fw"></i></button>
                                                    <button class="btn btn-danger"><i class="fa-solid fa-trash fa-fw"></i></button>
                                                </div>
                                            </div>

                                        <?php endforeach; ?>
                                        <div class="bg-white">
                                            <button class="plus-btn btn btn-info w-100"><i class="fa-solid fa-plus fa-fw"></i></button>
                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        <?php endforeach; ?>
                        <!-- 新建大分類 -->
                        
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

    <!-- bootstrap5的JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



    <!-- 修改活動的下拉式選單的JS -->
    <script>
        const categories = <?= json_encode($avticityCategoryArr) ?>;
        <?php foreach ($activitys as $activity): ?>
            const activityCategoryBig<?= $activity["id"] ?> = document.querySelector("#activityCategoryBig<?= $activity["id"] ?>");
            const activityCategorySmall<?= $activity["id"] ?> = document.querySelector("#activityCategorySmall<?= $activity["id"] ?>");
            activityCategoryBig<?= $activity["id"] ?>.addEventListener("change", function() {
                const bigCategoryId = this.value;
                activityCategorySmall<?= $activity["id"] ?>.innerHTML = "";
                if (bigCategoryId && categories[bigCategoryId]) { // 如果選擇的 ID 有對應的資料
                    const smallCategories = categories[bigCategoryId]['children']; // 取得該大分類的子分類
                    activityCategorySmall<?= $activity["id"] ?>.disabled = false; // 啟用小分類選單

                    // 為小分類選單新增選項
                    smallCategories.forEach(smallCategory => {
                        const option = document.createElement('option');
                        option.value = smallCategory['id'];
                        option.textContent = smallCategory['name'];
                        activityCategorySmall<?= $activity["id"] ?>.appendChild(option);
                    });
                } else {
                    // 如果沒有選擇大分類，禁用小分類選單並重設選項
                    activityCategorySmall<?= $activity["id"] ?>.disabled = true;
                    const defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = '請先選擇活動類型';
                    activityCategorySmall<?= $activity["id"] ?>.appendChild(defaultOption);
                }
            });
        <?php endforeach; ?>



        // const activityCategoryBig = document.querySelector("#activityCategoryBig<?= $activity["id"] ?>");
        // const activityCategoryBigElements = document.querySelector("select[name='activityCategoryBig']");
        // const activityCategorySmall = document.querySelector("#activityCategorySmall");

        // console.log(activityCategoryBigElements);

        // activityCategoryBigElements.forEach(activityCategoryBig => {
        //     activityCategoryBig.addEventListener("change", function(a, b, c) {
        //         console.log("跑了" + a + "=" + b + "=" + c);
        //         const bigCategoryId = this.value; // 取得大分類的選擇值
        //         // const activityId = this.dataset.id; // 如果有 data-id，取得對應 ID
        //         // const activityCategorySmall = document.querySelector(`#activityCategorySmall-${activityId}`); // 找對應的小分類

        //         activityCategorySmall.innerHTML = ""; // 清空小分類選單

        //         if (bigCategoryId && categories[bigCategoryId]) { // 如果選擇的 ID 有對應的資料
        //             const smallCategories = categories[bigCategoryId]['children']; // 取得該大分類的子分類
        //             activityCategorySmall.disabled = false; // 啟用小分類選單

        //             // 為小分類選單新增選項
        //             smallCategories.forEach(smallCategory => {
        //                 const option = document.createElement('option');
        //                 option.value = smallCategory['id'];
        //                 option.textContent = smallCategory['name'];
        //                 activityCategorySmall.appendChild(option);
        //             });
        //         } else {
        //             // 如果沒有選擇大分類，禁用小分類選單並重設選項
        //             activityCategorySmall.disabled = true;
        //             const defaultOption = document.createElement('option');
        //             defaultOption.value = '';
        //             defaultOption.textContent = '請先選擇活動類型';
        //             activityCategorySmall.appendChild(defaultOption);
        //         }
        //     });
        // });


        // activityCategoryBig.addEventListener("change", function() {
        //     const bigCategoryId = this.value; // 取得大分類的選擇值
        //     activityCategorySmall.innerHTML = ""; // 清空小分類選單

        //     if (bigCategoryId && categories[bigCategoryId]) { // 如果選擇的 ID 有對應的資料
        //         const smallCategories = categories[bigCategoryId]['children']; // 取得該大分類的子分類
        //         activityCategorySmall.disabled = false; // 啟用小分類選單

        //         // 為小分類選單新增選項
        //         smallCategories.forEach(smallCategory => {
        //             const option = document.createElement('option');
        //             option.value = smallCategory['id'];
        //             option.textContent = smallCategory['name'];
        //             activityCategorySmall.appendChild(option);
        //         });
        //     } else {
        //         // 如果沒有選擇大分類，禁用小分類選單並重設選項
        //         activityCategorySmall.disabled = true;
        //         const defaultOption = document.createElement('option');
        //         defaultOption.value = '';
        //         defaultOption.textContent = '請先選擇活動類型';
        //         activityCategorySmall.appendChild(defaultOption);
        //     }
        // });




        // 上傳圖片預覽
        const fileInput = document.querySelector("#fileInput");
        fileInput.addEventListener("change", function() {
            const file = event.target.files[0];
            previewImage.src = "";
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.getElementById("previewImage");
                    previewImage.src = e.target.result; // 設定預覽圖片為選擇的檔案
                };
                reader.readAsDataURL(file); // 讀取檔案
            }
        })

        // 圖片修改第二次時應該怎麼處理呢？
        const changebtn = document.querySelector("#change-btn")
        changebtn.addEventListener("click", function() {
            previewImage.src = "img/activity/<?= $activity["main_image"] ?>";
        })
    </script>
</body>

</html>