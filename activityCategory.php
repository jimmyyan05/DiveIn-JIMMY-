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
// echo "<pre>";
// print_r($bigCates);
// echo "</pre>";

$categories = [];
foreach ($bigCates as $cate) {
    $categories[$cate['big_id']]['big_name'] = $cate['big_name'];
    if ($cate['small_id'] != "") {
        $categories[$cate['big_id']]['small_categories'][] = [
            'small_id' => $cate['small_id'],
            'small_name' => $cate['small_name'],
        ];
    }
}

// print_r($categories);

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
                            <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                            <li class="breadcrumb-item"><a href="#">類別管理</a></li>
                            <li class="breadcrumb-item active" aria-current="page">服務類別管理</li>
                        </ol>
                    </nav>

                    <!-- 服務類別 -->
                    <div class="row justify-content-start gx-2">
                        <?php foreach ($categories as $big_id => $category): ?>
                            <div class="col-4 mt-2">
                                <!-- 大分類按鈕 -->
                                <!-- <button class="btn btn-info w-100 d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapseExample<?= $big_id ?>"
                                    aria-expanded="false"
                                    aria-controls="collapseExample<?= $big_id ?>">
                                    <div class="d-flex justify-content-between w-100 align-items-center">
                                        <h3 class="m-0">
                                            <?= $category["big_name"] ?>
                                        </h3>
                                        <div class="btn-group"> -->
                                <!-- 修改按鈕 -->
                                <!-- <button
                                                class="btn btn-warning edit-big-category-btn"
                                                data-big-id="<?= $big_id ?>"
                                                data-big-name="<?= $category['big_name'] ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editBigCategoryModal">
                                                <i class="fa-solid fa-pen-to-square fa-fw"></i>
                                            </button> -->
                                <!-- 刪除按鈕 -->
                                <!-- <button
                                                class="btn btn-danger delete-big-category-btn"
                                                data-big-id="<?= $big_id ?>"
                                                data-big-name="<?= $category['big_name'] ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteBigCategoryModal">
                                                <i class="fa-solid fa-trash fa-fw"></i>
                                            </button>
                                        </div>
                                    </div>
                                </button> -->
                                <!-- 大分類按鈕 -->
                                <div class="btn btn-info w-100 d-flex justify-content-center align-items-center"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapseExample<?= $big_id ?>"
                                    aria-expanded="false"
                                    aria-controls="collapseExample<?= $big_id ?>">
                                    <div class="d-flex justify-content-between w-100">
                                        <h3 class="align-middle m-0">
                                            <?= $category["big_name"] ?>
                                        </h3>
                                        <div class="btn-group">
                                            <!-- 修改按鈕 -->
                                            <button
                                                class="btn btn-light edit-big-category-btn"
                                                data-big-id="<?= $big_id ?>"
                                                data-big-name="<?= $category['big_name'] ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editBigCategoryModal">
                                                <i class="fa-solid fa-pen-to-square fa-fw"></i>
                                            </button>
                                            <!-- 刪除按鈕 -->
                                            <button
                                                class="btn btn-danger delete-big-category-btn"
                                                data-big-id="<?= $big_id ?>"
                                                data-big-name="<?= $category['big_name'] ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteBigCategoryModal">
                                                <i class="fa-solid fa-trash fa-fw"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- 小分類列表 -->
                                <div class="collapse" id="collapseExample<?= $big_id ?>">
                                    <div class="bg-white hovers border border-info rounded">


                                        <!-- 如果有小分類的話就顯示小分類，沒有的話就只顯示增加的按鈕 -->
                                        <?php if (isset($category['small_categories'])): ?>
                                            <!-- 小分類列表 -->
                                            <?php foreach ($category['small_categories'] as $small_category): ?>
                                                <div class="d-flex justify-content-between p-1 border-bottom boder-info">
                                                    <h4 class="text-black m-0 p-1"><?= $small_category["small_name"] ?></h4>
                                                    <div class="btn-group">
                                                        <!-- 修改按鈕 -->
                                                        <button
                                                            class="btn btn-info edit-small-category-btn"
                                                            data-small-id="<?= $small_category['small_id'] ?>"
                                                            data-small-name="<?= $small_category['small_name'] ?>"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editSmallCategoryModal">
                                                            <i class="fa-solid fa-pen-to-square fa-fw"></i>
                                                        </button>
                                                        <!-- 刪除按鈕 -->
                                                        <!-- <button class="btn btn-danger" data-small-id="<?= $small_category['small_id'] ?>"
                                                            data-small-name="<?= $small_category['small_name'] ?>"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteSmallCategoryModal"><i class="fa-solid fa-trash fa-fw"></i></button> -->
                                                        <button
                                                            class="btn btn-danger delete-small-category-btn"
                                                            data-small-id="<?= $small_category['small_id'] ?>"
                                                            data-small-name="<?= $small_category['small_name'] ?>"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteSmallCategoryModal">
                                                            <i class="fa-solid fa-trash fa-fw"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <!-- 新增小分類的按鈕 -->
                                        <div class="bg-white w-100 rounded text-center">
                                            <button class="plus-btn btn btn-white text-info w-100" data-bs-toggle="modal" data-bs-target="#smallCateModal<?= $big_id ?>"><i class="fa-solid fa-plus fa-fw"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <!--新建小分類的Modal -->
                                <div class="modal fade" id="smallCateModal<?= $big_id ?>" tabindex="-1" aria-labelledby="smallCateModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="activity_doUpdateCategory.php" method="post">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">新增服務類別</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="big_id" value="<?= $big_id ?>">
                                                    <label for="" class="form-label">請輸入要新增的服務類別</label>
                                                    <input class="form-control" type="text" name="newSmaillCategoryName">
                                                    <!-- <label for="" class="form-label">請輸入對此類型的描述</label>
                                            <textarea class="form-control" name="newBigCategoryDescription" rows="3"></textarea> -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                    <button type="submit" class="btn btn-info">新增</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- 新建大分類 -->
                        <div class="col-4 mt-2">
                            <button class="btn btn-white border border-info w-100 d-flex justify-content-center align-items-center text-info" data-bs-toggle="modal" data-bs-target="#bigCateModal">
                                <h3 class="align-middle m-0"><i class="fa-solid fa-plus fa-fw"></i></h3>
                            </button>
                        </div>

                        <!--新建大分類的Modal -->
                        <div class="modal fade" id="bigCateModal" tabindex="-1" aria-labelledby="bigCateModal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="activity_doUpdateCategory.php" method="post">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">新增服務類型</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="" class="form-label">請輸入要新增的服務類型</label>
                                            <input class="form-control" type="text" name="newBigCategoryName">
                                            <!-- <label for="" class="form-label">請輸入對此類型的描述</label>
                                            <textarea class="form-control" name="newBigCategoryDescription" rows="3"></textarea> -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                            <button type="submit" class="btn btn-info">新增</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- 修改大分類的 Modal -->
                        <div class="modal fade" id="editBigCategoryModal" tabindex="-1" aria-labelledby="editBigCategoryModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="activity_doUpdateCategory.php" method="post" id="editBigCategoryForm">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editBigCategoryModalLabel">修改大分類</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="big_id" id="editBigCategoryId">
                                            <label for="editBigCategoryName" class="form-label">大分類名稱</label>
                                            <input type="text" class="form-control" id="editBigCategoryName" name="big_name" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                            <button type="submit" class="btn btn-info">保存更改</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- 修改小分類的Modal -->
                        <div class="modal fade" id="editSmallCategoryModal" tabindex="-1" aria-labelledby="editSmallCategoryModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="activity_doUpdateCategory.php" method="post">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editSmallCategoryModalLabel">修改服務類別</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="small_id" id="editSmallCategoryId"> <!-- 小分類ID -->
                                            <label for="editSmallCategoryName" class="form-label">服務類別名稱</label>
                                            <input class="form-control" type="text" name="small_name" id="editSmallCategoryName">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                            <button type="submit" class="btn btn-info">保存修改</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- 刪除大分類的 Modal -->
                        <div class="modal fade" id="deleteBigCategoryModal" tabindex="-1" aria-labelledby="deleteBigCategoryModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="activity_doDeleteCategory.php" method="post" id="deleteBigCategoryForm">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteBigCategoryModalLabel">刪除大分類</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="big_id" id="deleteBigCategoryId">
                                            <p>您確定要刪除大分類 "<span id="deleteBigCategoryName"></span>" 嗎？</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                            <button type="submit" class="btn btn-danger">刪除</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- 刪除小分類的recheck modal -->
                        <div class="modal fade" id="deleteSmallCategoryModal" tabindex="-1" aria-labelledby="deleteSmallCategoryModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="activity_doDeleteCategory.php" method="post">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteSmallCategoryModalLabel">確認刪除</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="small_id" id="deleteSmallCategoryId"> <!-- 小分類ID -->
                                            <div>確定要刪除小分類 "<span id="deleteSmallCategoryName"></span>" 嗎？<br>此操作將無法復原！</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                            <button type="submit" class="btn btn-danger">刪除</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>




                    </div>


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


    <script>
        // 修改大分類
        document.querySelectorAll('.edit-big-category-btn').forEach(button => {
            button.addEventListener('click', function() {
                const bigId = this.getAttribute('data-big-id');
                const bigName = this.getAttribute('data-big-name');

                // 設置 modal 中的隱藏字段和大分類名稱
                document.getElementById('editBigCategoryId').value = bigId;
                document.getElementById('editBigCategoryName').value = bigName;
            });
        });

        // 刪除大分類
        document.querySelectorAll('.delete-big-category-btn').forEach(button => {
            button.addEventListener('click', function() {
                const bigId = this.getAttribute('data-big-id');
                const bigName = this.getAttribute('data-big-name');

                // 設置 modal 中的隱藏字段和顯示大分類名稱
                document.getElementById('deleteBigCategoryId').value = bigId;
                document.getElementById('deleteBigCategoryName').textContent = bigName;
            });
        });

        // 修改小分類按鈕
        document.addEventListener('DOMContentLoaded', () => {
            // 獲取所有修改按鈕
            const editButtons = document.querySelectorAll('.edit-small-category-btn');

            // 為每個按鈕添加點擊事件
            editButtons.forEach(button => {
                button.addEventListener('click', (event) => {
                    // 獲取按鈕上的數據屬性
                    const smallId = button.getAttribute('data-small-id');
                    const smallName = button.getAttribute('data-small-name');

                    // 將數據填充到 modal 中的表單
                    document.getElementById('editSmallCategoryId').value = smallId;
                    document.getElementById('editSmallCategoryName').value = smallName;
                });
            });
        });

        // 刪除小分類
        document.addEventListener('DOMContentLoaded', () => {
            // 獲取所有刪除按鈕
            const deleteButtons = document.querySelectorAll('.delete-small-category-btn');

            // 為每個按鈕添加點擊事件
            deleteButtons.forEach(button => {
                button.addEventListener('click', (event) => {
                    // 獲取按鈕上的數據屬性
                    const smallId = button.getAttribute('data-small-id');
                    const smallName = button.getAttribute('data-small-name');

                    // 將數據填充到 modal 中
                    document.getElementById('deleteSmallCategoryId').value = smallId;
                    document.getElementById('deleteSmallCategoryName').textContent = smallName;
                });
            });
        });
    </script>
</body>

</html>