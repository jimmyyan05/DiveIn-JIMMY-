<?php
require_once("../create/db_project_connect.php");

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
          WHERE 1 $searchCondition"; 
$resultAll = $conn->query($sqlAll);
$teachersCount = $resultAll->fetch_assoc()['total'];

// 獲取分頁數據
$sql = "SELECT 
            activity_teacher.*, 
            activity_teacher_image.imageUrl AS image
        FROM activity_teacher
        LEFT JOIN activity_teacher_image 
            ON activity_teacher_image.teacher_id = activity_teacher.id
        WHERE 1 $searchCondition $whereClause 
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
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

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
                                            <button class="btn btn-info" type="button">
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
                                        <div class="icon-circle bg-info">
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
                                    teacher Log
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
                    <h1 class="h3 mb-2 text-gray-800">師資列表</h1>
                    <!-- 麵包屑 -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">首頁</a></li>
                            <li class="breadcrumb-item active" aria-current="page">師資列表</li>
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
                                    <a href="teacher.php" class="btn btn-secondary"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>

                    <!-- 新增課程按鈕及排序按鈕 -->
                    <div class="d-flex justify-content-between my-2">
                        <a href="create-teacher.php" class="btn btn-info"><i class="fa-solid fa-plus fa-fw"></i>新增師資</a>
                        <div class="d-flex justify-content-center">
                            <?php if (isset($_GET["order"])): ?>
                                <div class="me-2">
                                    <a href="teacher.php?p=1<?php if (isset($search)): ?>&search=<?= $search ?><?php endif; ?>" class="btn btn-secondary"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                            <?php endif; ?>

                            <div class="btn-group ">
                                <a href="teacher.php?p=1<?php if (isset($search)): ?>&search=<?= $search ?><?php endif; ?>&order=1" class="btn btn-info <?php if (isset($_GET["order"]) && $_GET["order"] == 1): ?> active<?php endif; ?>" id="sort-time-down">教師年資 <i class="fa-solid fa-arrow-down-1-9"></i></a>
                                <a href="teacher.php?p=1<?php if (isset($search)): ?>&search=<?= $search ?><?php endif; ?>&order=2" class="btn btn-info <?php if (isset($_GET["order"]) && $_GET["order"] == 2): ?> active<?php endif; ?>" id="sort-time-up">教師年資<i class="fa-solid fa-arrow-up-1-9"></i></a>
                            </div>
                            <div class="ms-2">
                                <a href="isDeleted.php" class="btn btn-danger" title="已刪除的項目"><i class="fa-solid fa-trash-can-arrow-up fa-fw"></i></a>
                            </div>
                        </div>
                    </div>

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
                                <th>編輯</th>
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
                                                                <img id="previewImage" src="img/teacher/<?= $teacher["image"] ?>" alt="">
                                                            </div>
                                                            <label for="" class="form-label">修改圖片</label>
                                                            <input id="fileInput" type="file" class="form-control" name="myFile" accept="image/*" require>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col">
                                                                <label for="" class="form-label">教練姓名</label>
                                                                <input type="text" class="form-control" name="teacherName" value="<?= $teacher["name"] ?>" placeholder="請輸入新的名稱">
                                                            </div>
                                                            <div class="col">
                                                                <label for="" class="form-label">教練性別</label>
                                                                <select class="form-control" name="sex" id="">
                                                                    <option value="1">男性</option>
                                                                    <option value="2">女性</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="" class="form-label">教練聯絡方式</label>
                                                            <input type="text" class="form-control" name="teacherEmail" value="<?= $teacher["email"] ?>" placeholder="請輸入電子信箱">
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">教練年資</label>
                                                                <input type="text" class="form-control" name="teacherYears" value="<?= $teacher["years"] ?>" placeholder="請輸入教練年資">
                                                            </div>
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">教練等級</label>
                                                                <select class="form-control" name="level" id="">
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
                                                    <form action="doDelete.php" method="post">
                                                        <input type="hidden" name="teacherID" value="<?= $teacher["id"] ?>">
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



    <script>
        // // 上傳圖片預覽
        // const fileInput = document.querySelector("#fileInput");
        // fileInput.addEventListener("change", function() {
        //     const file = event.target.files[0];
        //     previewImage.src = "";
        //     if (file) {
        //         const reader = new FileReader();
        //         reader.onload = function(e) {
        //             const previewImage = document.getElementById("previewImage");
        //             previewImage.src = e.target.result; // 設定預覽圖片為選擇的檔案
        //         };
        //         reader.readAsDataURL(file); // 讀取檔案
        //     }
        // })

        // // 圖片修改第二次時應該怎麼處理呢？
        // const changebtn = document.querySelector("#change-btn")
        // changebtn.addEventListener("click", function() {
        //     previewImage.src = "img/teacher/<?= $teacher["image"] ?>";
        // })
    </script>
</body>

</html>