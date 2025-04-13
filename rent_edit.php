<?php
require_once("../db_project_connect.php");


// 分頁參數
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
if ($page < 1) {
    $page = 1;
}

if (isset($_POST['submit'])) {
    // 取得表單資料
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $start_date = $_POST['start_date'];
    $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : null;
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    $rent_category_big = $_POST['rent_category_big'];
    $rent_category_small = $_POST['rent_category_small'];

    // 更新產品資料
    $sql = "UPDATE rent_item 
    SET name = :name, price = :price, start_date = :start_date, end_date = :end_date,
        description = :description, stock = :stock, rent_category_big_id = :rent_category_big,
        rent_category_small_id = :rent_category_small 
    WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':rent_category_big', $rent_category_big);
    $stmt->bindParam(':rent_category_small', $rent_category_small);
    $stmt->execute();

    if (isset($_FILES['image']) && count($_FILES['image']['name']) > 0) {
        // 設定檔案的儲存目錄
        $upload_dir = 'uploads/';

        // 檢查目錄是否存在，若無則創建
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // 設定允許的檔案類型
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

        // 遍歷每個上傳的檔案
        $is_first_image = true; // 用來標記第一張圖片
        for ($i = 0; $i < count($_FILES['image']['name']); $i++) {
            // 檢查檔案是否有錯誤
            if ($_FILES['image']['error'][$i] === UPLOAD_ERR_OK) {
                // 取得檔案的副檔名
                $file_extension = pathinfo($_FILES['image']['name'][$i], PATHINFO_EXTENSION);

                // 使用時間戳和隨機數生成唯一的檔案名稱
                $new_file_name = time() . '_' . rand(1000, 9999) . '.' . $file_extension;

                // 設定新的檔案儲存路徑
                $img_url = $upload_dir . $new_file_name;

                // 檢查檔案類型
                if (in_array($_FILES['image']['type'][$i], $allowed_types)) {
                    // 檢查檔案大小（最大5MB）
                    if ($_FILES['image']['size'][$i] <= 5 * 1024 * 1024) { // 5MB
                        // 移動檔案到伺服器目錄
                        if (move_uploaded_file($_FILES['image']['tmp_name'][$i], $img_url)) {
                            // 判斷是否是第一張圖片（作為主圖）
                            $is_main = $is_first_image ? 1 : 0;
                            $is_first_image = false; // 第一張圖片已經設定為主圖

                            // 在這裡處理圖片的插入資料庫
                            $sql_image = "INSERT INTO rent_image (img_url, rent_item_id, is_main) 
                                      VALUES (:img_url, :item_id, :is_main)";
                            $stmt_image = $pdo->prepare($sql_image);
                            $stmt_image->bindParam(':img_url', $img_url);
                            $stmt_image->bindParam(':item_id', $id); // 這裡需要根據您的需求指定 `rent_item_id`
                            $stmt_image->bindParam(':is_main', $is_main);
                            $stmt_image->execute();
                        } else {
                            echo "檔案上傳失敗，請再試一次。";
                        }
                    } else {
                        echo "檔案大小超過限制，請選擇較小的圖片。";
                    }
                } else {
                    echo "只允許上傳 JPEG、PNG 或 GIF 格式的圖片檔案。";
                }
            } else {
                echo "檔案上傳錯誤，錯誤代碼：" . $_FILES['image']['error'][$i];
            }
        }
    }

    // 完成後重定向或顯示成功訊息
    header("Location: rent_items.php");
    exit();
}

// 載入產品資料
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM rent_item WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}
// 取得大分類資料
$sql_big = "SELECT id, name FROM rent_category_big";
$stmt_big = $pdo->query($sql_big);
$big_categories = $stmt_big->fetchAll();

// 取得小分類資料
$sql_small = "SELECT id, name FROM rent_category_small WHERE rent_category_big_id = :big_category_id";
$stmt_small = $pdo->prepare($sql_small);
$stmt_small->bindParam(':big_category_id', $product['rent_category_big_id']);
$stmt_small->execute();
$small_categories = $stmt_small->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>編輯租賃商品</title>
    <!-- 統一的css -->
    <?php include("./css.php") ?>

    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom fonts for this template-->
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom fonts (Gabarito)-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Gabarito:wght@400..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">


    <style>
        .column-seq {
            width: 80px;
        }

        .column-id {
            width: 100px;
        }

        .column-name {
            flex: 1;
        }

        .column-start {
            width: 200px;
        }

        .column-end {
            width: 200px;
        }

        .column-action {
            width: 80px;
        }

        .sortable {
            display: flex;
            align-items: center;
            cursor: pointer;
            color: #2c78db;
        }

        .sortable .bi {
            margin-left: 5px;
        }

        .w120px {
            width: 120px;
            padding-top: 0;
            padding-bottom: 0;
            line-height: 1;
            font-size: 16px;
            height: 40px;
        }

        .hover:hover {
            background-color: #e3efff;
        }
    </style>

</head>


<body id="page-top">

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
                <!-- 麵包屑 -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb rounded-0 p-3">
                        <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="rent_items.php">租賃商品列表</a></li>
                        <li class="breadcrumb-item active" aria-current="page">編輯租賃商品</li>
                    </ol>
                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">編輯租賃商品</h1>


                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-start align-items-center">
                            <!-- 返回 -->
                            <a href="rent_items.php" class="btn btn-secondary my-2"><i class="fa-solid fa-reply"></i> 返回租賃商品列表</a>
                        </div>

                        <div class="d-flex flex-column">
                            <div class="d-flex bg-light p-2 mb-2">
                                <?php if ($product): ?>
                                    <form method="post" action="rent_edit.php" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                        <input type="hidden" name="page" value="<?php echo $page; ?>">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">產品名稱</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">價格</label>
                                            <input type="text" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
                                        </div>

                                        <!-- 大分類 -->
                                        <div class="mb-3">
                                            <label for="rent_category_big" class="form-label">大分類</label>
                                            <select class="form-select" id="rent_category_big" name="rent_category_big" required>
                                                <option value="">請選擇大分類</option>
                                                <?php foreach ($big_categories as $big_category): ?>
                                                    <option value="<?php echo $big_category['id']; ?>"
                                                        <?php echo $product['rent_category_big_id'] == $big_category['id'] ? 'selected' : ''; ?>>
                                                        <?php echo $big_category['name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- 小分類 -->
                                        <div class="mb-3">
                                            <label for="rent_category_small" class="form-label">小分類</label>
                                            <select class="form-select" id="rent_category_small" name="rent_category_small" required>
                                                <option value="">請先選擇大分類</option>
                                                <?php foreach ($small_categories as $small_category): ?>
                                                    <option value="<?php echo $small_category['id']; ?>"
                                                        <?php echo $product['rent_category_small_id'] == $small_category['id'] ? 'selected' : ''; ?>>
                                                        <?php echo $small_category['name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- 產品描述 -->
                                        <div class="mb-3">
                                            <label for="description" class="form-label">產品描述</label>
                                            <textarea class="form-control" id="description" name="description" rows="3"><?php echo $product['description']; ?></textarea>
                                        </div>

                                        <!-- 庫存 -->
                                        <div class="mb-3">
                                            <label for="stock" class="form-label">庫存</label>
                                            <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $product['stock']; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="start_date" class="form-label">上架時間</label>
                                            <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="<?php echo date('Y-m-d\TH:i', strtotime($product['start_date'])); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="end_date" class="form-label">下架時間</label>
                                            <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="<?php echo $product['end_date'] ? date('Y-m-d\TH:i', strtotime($product['end_date'])) : ''; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="images" class="form-label">上傳圖片</label>
                                            <input type="file" class="form-control" id="image" name="image[]" multiple>
                                        </div>

                                        <div class="mb-3">
                                            <label for="image" class="form-label">產品圖片</label>
                                            <?php if (!empty($product['img_url'])): ?>
                                                <!-- 如果資料庫中有圖片路徑，顯示圖片 -->
                                                <img src="<?= $product['img_url']; ?>" alt="圖片" style="max-width: 150px; margin-right: 10px;">
                                            <?php else: ?>
                                                <!-- 如果沒有圖片路徑，顯示提示訊息 -->
                                                <p>尚未上傳圖片</p>
                                            <?php endif; ?>
                                        </div>

                                        <button type="submit" name="submit" class="btn btn-primary">保存</button>
                                        <a href="rent_items.php?page=<?php echo $page; ?>" class="btn btn-secondary">返回</a>
                                    </form>

                                    <!-- <h2 class="my-4">產品圖片</h2>
                                    <div class="row">
                                        <?php foreach ($images as $image): ?>
                                            <div class="col-md-3 mb-3">
                                                <img src="<?php echo $image['img_url']; ?>" class="img-fluid" alt="產品圖片">
                                            </div>
                                        <?php endforeach; ?>
                                    </div> -->
                                <?php else: ?>
                                    <p>產品未找到。</p>
                                    <a href="index.php?page=<?php echo $page; ?>" class="btn btn-secondary">返回</a>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->



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

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.min.js"></script>
</body>

</html>