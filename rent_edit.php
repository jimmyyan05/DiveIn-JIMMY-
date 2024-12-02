<?php
include 'PDO_connect.php';

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

    // 更新產品資料
    $sql = "UPDATE rent_item SET name = :name, price = :price, start_date = :start_date, end_date = :end_date WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
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
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DiveIn-rent-items</title>
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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">編輯租賃商品</h1>
                    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0font-weight-bold text-primary">後台CRUD</h6>
                        </div>
                        <div class="d-flex justify-content-end">
                            <!-- 返回 -->
                            <a href="rent_items.php" class="btn btn-secondary mb-3">返回租賃商品列表</a>
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