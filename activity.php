<?php
require_once("../create/db_project_connect.php");

$cateSql = "SELECT * FROM `activity_category_small`";
$resultCate = $conn->query($cateSql);

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

$categories = $resultCate->fetch_all(MYSQLI_ASSOC);

$categoryArr = [];
foreach ($categories as $category) {
    $categoryArr[$category["id"]] = $category["name"];
}

$whereClause = "";

$per_page = 5;




// echo"$allActivitysCount";

if (isset($_GET["search"])) {
    if ($_GET["search"] == "") {
        header("location:activity.php");
    };
    if (!isset($_GET["p"])) {
        header("location:activity.php?p=1&search=".$_GET["search"]);
    } else {
        $p = $_GET["p"];
    }
    $search = $_GET["search"];
    $start_item = ($p - 1) * $per_page;
    $sqlAll = "SELECT * FROM activity WHERE activity.name LIKE '%$search%' AND activity.isDeleted=0";
    $resultAll = $conn->query($sqlAll);
    $allActivitysCount = $resultAll->num_rows;
    // $sql = "SELECT * FROM users WHERE name LIKE '%$search%' AND is_deleted=0";
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
    WHERE activity.name LIKE '%$search%' AND activity.isDeleted=0 
    LIMIT $start_item,$per_page
    $whereClause";

    $result = $conn->query($sql);

    $activityCount = $result->num_rows;
    $activitys = $result->fetch_all(MYSQLI_ASSOC);

    $total_page = ceil($allActivitysCount / $per_page);
} elseif (isset($_GET["p"])) {
    $sqlAll = "SELECT * FROM activity WHERE isDeleted=0";
    $resultAll = $conn->query($sqlAll);
    $allActivitysCount = $resultAll->num_rows;
    $p = $_GET["p"];
    $start_item = ($p - 1) * $per_page;
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
    WHERE activity.isDeleted=0
    LIMIT $start_item,$per_page
    $whereClause";

    $result = $conn->query($sql);

    $activityCount = $result->num_rows;
    $activitys = $result->fetch_all(MYSQLI_ASSOC);

    $total_page = ceil($allActivitysCount / $per_page);
} else {
    header("location: activity.php?p=1");
};

// if (isset($_GET["p"])) {
//     $p = $_GET["p"];
//     $start_item = ($p - 1) * $per_page;
// }



// $sql = "SELECT 
// activity.*, 
// activity_category_small.name AS smallCategory_name,
// activity_category_big.name AS bigCategory_name,
// activity_category_big.id AS big_id,
//     (SELECT activity_image.imgUrl FROM activity_image 
//     WHERE activity_image.activity_id = activity.id AND activity_image.isMain = 1
//     LIMIT 1) AS main_image
//     FROM activity
// JOIN activity_category_small ON activity.activityCategorySmall_id = activity_category_small.id
// JOIN activity_category_big ON activity_category_small.activityCategoryBig_id = activity_category_big.id
// WHERE activity.isDeleted=0
// LIMIT $start_item,$per_page
// $whereClause";

// $result = $conn->query($sql);

// $activityCount = $result->num_rows;
// $activitys = $result->fetch_all(MYSQLI_ASSOC);

// $total_page = ceil($allActivitysCount / $per_page);

// if ($activityCount === 0) {
//     echo "沒有找到活動資料";
// };




// $sql="SELECT 
// activity.*, 
// activity_category_small.name AS smallCategory_name,
// activity_image.imgUrl 
// FROM activity
// JOIN activity_category_small ON activity.activityCategorySmall_id = activity_category_small.id
// JOIN activity_image ON activity.id = activity_image.activity_id
// $whereClause
// ";
// $sql = "SELECT 
//     activity.*, 
//     activity_category_small.name AS smallCategory_name,
//     activity_category_big.name AS bigCategory_name,
//     activity_category_big.id AS big_id,

//     (SELECT activity_image.imgUrl FROM activity_image 
//      WHERE activity_image.activity_id = activity.id AND activity_image.isMain = 1
//      LIMIT 1) AS main_image
// FROM activity
// JOIN activity_category_small ON activity.activityCategorySmall_id = activity_category_small.id
// JOIN activity_category_big ON activity_category_small.activityCategoryBig_id = activity_category_big.id
// WHERE activity.isDeleted=0
// $whereClause";

// $result = $conn->query($sql);

// $activityCount = $result->num_rows;
// $activitys = $result->fetch_all(MYSQLI_ASSOC);

// if ($activityCount === 0) {
//     echo "沒有找到活動資料";
// }


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

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- 自訂css樣式 -->
    <link rel="stylesheet" href="activity_style.css">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- bootstrap5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
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
                                <button class="btn btn-info" type="button">
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
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
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
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
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
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
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
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
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
                    <h1 class="h3 mb-2 text-gray-800">服務列表</h1>
                    <!-- 麵包屑 -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">首頁</a></li>
                            <li class="breadcrumb-item active" aria-current="page">服務列表</li>
                        </ol>
                    </nav>

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
                                    <a href="activity.php" class="btn btn-secondary"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                            <?php endif; ?>
                        </form>

                    </div>

                    <!-- 新增課程按鈕及排序按鈕 -->
                    <div class="d-flex justify-content-between my-2">
                        <a href="create-activity.php" class="btn btn-primary"><i class="fa-solid fa-plus fa-fw"></i>新增服務</a>
                        <div class="d-flex justify-content-center">
                            <div class="btn-group ">
                                <button class="btn btn-primary">活動時間 <i class="fa-solid fa-arrow-down-short-wide"></i></button>
                                <button class="btn btn-primary">活動時間 <i class="fa-solid fa-arrow-down-wide-short"></i></button>
                            </div>
                            <div class="ms-2">
                                <a href="isDeleted.php" class="btn btn-danger" title="已刪除的項目"><i class="fa-solid fa-trash-can-arrow-up fa-fw"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- 服務列表 開始 -->
                    <?php if ($activityCount > 0): ?>
                        <table class="table table-style table-hover">
                            <tr>
                                <th>編號</th>
                                <th>名稱</th>
                                <th>圖片</th>
                                <th>類型</th>
                                <th>子分類</th>
                                <th>報名日期</th>
                                <th>活動時間</th>
                                <th>費用</th>
                                <th>狀態</th>
                                <th>編輯</th>
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
                                        <?php
                                        $now = strtotime('now');
                                        if ($now < strtotime($activity["signUpDate"])) {
                                            echo "尚未開始報名";
                                        } elseif (strtotime($activity["signUpDate"]) < $now && $now < strtotime($activity["signUpEndDate"])) {
                                            echo "活動報名中";
                                        } elseif (strtotime($activity["signUpEndDate"]) < $now && $now < strtotime($activity["startDate"])) {
                                            echo "報名結束，等待活動開始";
                                        } elseif (strtotime($activity["startDate"]) < $now && $now < strtotime($activity["endDate"])) {
                                            echo "活動進行中！";
                                        } else {
                                            echo "活動結束";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <!-- 修改按鈕，跳出modal -->
                                        <button id="change-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal<?= $activity["id"] ?>"><i class="fa-solid fa-pen-to-square fa-fw"></i></button>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $activity["id"] ?>"><i class="fa-solid fa-trash-can fa-fw"></i></button>

                                    </td>

                                    <!-- 修改用的modal -->
                                    <div class="modal fade" id="updateModal<?= $activity["id"] ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel">更新項目資訊</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <!-- 修改服務資訊內容的form -->
                                                <form class="py-2" action="doUpdateActivity.php" method="post" enctype="multipart/form-data">
                                                    <!-- 隱藏活動 ID -->
                                                    <input type="hidden" name="activityID" value="<?= $activity['id'] ?>">
                                                    <div class="modal-body">
                                                        <div class="mb-2">
                                                            <div class="bg-light update-img d-flex justify-content-center mb-2 rounded">
                                                                <img id="previewImage" src="img/activity/<?= $activity["main_image"] ?>" alt="">
                                                            </div>
                                                            <label for="" class="form-label">修改圖片</label>
                                                            <input id="fileInput" type="file" class="form-control" name="myFile" accept="image/*" require>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="" class="form-label">服務名稱</label>
                                                            <input type="text" class="form-control" name="activityName" value="<?= $activity["name"] ?>" placeholder="請輸入新的名稱">
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">服務類型</label>
                                                                <select class="form-control " name="activityCategoryBig" id="activityCategoryBig<?= $activity["id"] ?>">
                                                                    <!--<select class="form-control " name="activityCategoryBig">-->
                                                                    <option selected>請選擇服務類型</option>
                                                                    <?php foreach ($avticityCategoryArr as $big_id => $big_data): ?>
                                                                        <option value="<?= $big_id ?>" <?= $big_id == $activity["big_id"] ? "selected" : "" ?>><?= $big_data["name"] ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">服務類別</label>
                                                                <select class="form-control" name="activityCategorySmall" id="activityCategorySmall<?= $activity["id"] ?>">
                                                                    <option value="<?= $activity['smallCategory_name'] ?>" selected><?= $activity['smallCategory_name'] ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="" class="form-label">費用</label>
                                                            <input type="number" class="form-control" name="activityPrice" value="<?= $activity["price"] ?>" min="1" step="1">
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">報名開始日</label>
                                                                <input type="date" class="form-control" name="activitySignDate" value="<?= $activity["signUpDate"] ?>">
                                                            </div>
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">報名截止日</label>
                                                                <input type="date" class="form-control" name="activitySignEndDate" value="<?= $activity["signUpEndDate"] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">活動開始時間</label>
                                                                <input type="datetime-local" class="form-control" name="activityStartDate" value="<?= $activity["startDate"] ?>">
                                                            </div>
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">活動結束時間</label>
                                                                <input type="datetime-local" class="form-control" name="activityEndDate" value="<?= $activity["endDate"] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">活動介紹</label>
                                                            <textarea class="form-control" name="activityArticle" rows="5"><?= $activity["description"] ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                        <button type="submit" class="btn btn-primary">儲存修改</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- 刪除的recheck modal -->
                                    <div class="modal fade" id="deleteModal<?= $activity["id"] ?>" tabindex="-1" aria-labelledby="deleteModallLabel" aria-hidden="true">
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
                                                    <form action="doDelete.php" method="post">
                                                        <input type="hidden" name="activityID" value="<?= $activity["id"] ?>">
                                                        <button type="submit" class="btn btn-danger" name="deleted" value="1">確認</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            <?php endforeach; ?>
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
                                    <!-- <li class="page-item">
                                        <a class="page-link" href="activity.php?p=<?= $_GET["p"] - 1 ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li> -->
                                    <?php for ($i = 1; $i <= $total_page; $i++): ?>
                                        <li class="page-item <?php if ($i == $_GET["p"]) echo "active"; ?>">
                                            <a class="page-link" href="activity.php?p=<?= $i ?><?php if(isset($_GET["search"])): ?><?="&search=".$_GET["search"]?><?php endif;?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <!-- <li class="page-item">
                                        <a class="page-link" href="activity.php?p=<?= $_GET["p"] + 1 ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li> -->
                                </ul>
                        </div>
                    <?php endif; ?>
                    <!-- 頁籤結束 -->



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