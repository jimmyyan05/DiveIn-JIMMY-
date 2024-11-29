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

?>


<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>新增師資</title>

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
                    <h1 class="h3 mb-2 text-gray-800">新增師資</h1>
                    <!-- 麵包屑 -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">首頁</a></li>
                            <li class="breadcrumb-item"><a href="activity.php">師資列表</a></li>
                            <li class="breadcrumb-item active" aria-current="page">新增師資</li>
                        </ol>
                    </nav>
                    <a href="teacher.php" class="btn btn-info mb-3" title="返回師資列表"><i class="fa-solid fa-reply fa-fw"></i></a>

                    <div class="container bg-white">
                        <form class="py-2" action="doCreateTeacher.php" method="post" enctype="multipart/form-data">

                            <div class="mb-2">
                                <div class="bg-light update-img d-flex justify-content-center mb-2">
                                    <img id="previewImage" src="img/teacher/<?= $teacher["main_image"] ?>" alt="">
                                </div>
                                <label for="" class="form-label">新增圖片</label>
                                <input id="fileInput" type="file" class="form-control" name="myFile" accept="image/*" require>
                            </div>
                            <div class="mb-2 row">
                                <div class="col">
                                    <label for="" class="form-label">教練姓名</label>
                                    <input type="text" class="form-control" name="teacherName" placeholder="請輸入教練姓名">
                                </div>
                                <div class="col">
                                    <label for="" class="form-label">教練性別</label>
                                    <select class="form-control" name="sex" id="">
                                        <option selected>請選擇教練性別</option>
                                        <option value="1">男性</option>
                                        <option value="2">女性</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">教練聯絡方式</label>
                                <input type="text" class="form-control" name="teacherEmail" placeholder="請輸入教練的電子信箱">
                            </div>
                            <div class="row mb-2">
                                <div class="mb-2 col">
                                    <label for="" class="form-label">教練年資</label>
                                    <input type="number" class="form-control" name="teacherYears" placeholder="請輸入教練年資">
                                </div>
                                <div class="mb-2 col">
                                    <label for="" class="form-label">教練等級</label>
                                    <select class="form-control" name="level" id="">
                                        <option select>請選擇教練等級</option>
                                        <option value="1">OWSI 開放水域潛水教練</option>
                                        <option value="2">MSDT 潛水大師教練</option>
                                        <option value="3">教練開發課程助教</option>
                                        <option value="4">潛水大師教練</option>
                                        <option value="5">課程總監</option>
                                    </select>
                                </div>
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