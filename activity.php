<?php
require_once("../db_project_connect.php");

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

$sqlTeachers = "SELECT id, name FROM activity_teacher";
$resultTeachers = $conn->query($sqlTeachers);

$teachers = [];
if ($resultTeachers->num_rows > 0) {
    $teachers = $resultTeachers->fetch_all(MYSQLI_ASSOC);
}

$whereClause = "";
$whereCate = "";

$per_page = 5;




// echo"$allActivitysCount";

if (isset($_GET["search"])) {
    if ($_GET["search"] == "") {
        header("location:activity.php");
    };
    if (isset($_GET["order"])) {
        $order = $_GET["order"];
        switch ($order) {
            case 1:
                $whereClause = "ORDER BY startDate ASC";
                break;
            case 2:
                $whereClause = "ORDER BY startDate DESC";
                break;
        }
    } else {
        $whereClause = "ORDER BY id ASC";
    }
    if (!isset($_GET["p"])) {
        header("location:activity.php?p=1&search=" . $_GET["search"]);
    } else {
        $p = $_GET["p"];
    }


    $search = $_GET["search"];
    $start_item = ($p - 1) * $per_page;
    $sqlAll = "SELECT * FROM activity WHERE activity.name LIKE '%$search%' AND activity.isDeleted=0";
    $resultAll = $conn->query($sqlAll);
    $allActivitysCount = $resultAll->num_rows;
    // $sql = "SELECT * FROM users WHERE name LIKE '%$search%' AND is_deleted=0";
    // $sql = "SELECT 
    // activity.*, 
    // activity_category_small.name AS smallCategory_name,
    // activity_category_big.name AS bigCategory_name,
    // activity_category_big.id AS big_id,
    // activity_teacher.id AS teacher_id, 
    // activity_teacher.name AS teacher_name, 
    //     (SELECT activity_image.imgUrl FROM activity_image 
    //     WHERE activity_image.activity_id = activity.id AND activity_image.isMain = 1
    //     LIMIT 1) AS main_image
    //     FROM activity
    // JOIN activity_category_small ON activity.activityCategorySmall_id = activity_category_small.id
    // JOIN activity_category_big ON activity_category_small.activityCategoryBig_id = activity_category_big.id
    // LEFT JOIN activity_teacher ON activity.activity_teacher_id = activity_teacher.id  -- 連接老師表格
    // WHERE (activity.name LIKE '%$search%'
    // OR bigCategory_name LIKE '%$search%'
    // OR smallCategory_name LIKE '%$search%'
    // OR activity_teacher.name LIKE '%$search%')
    // AND activity.isDeleted=0 
    // $whereClause
    // LIMIT $start_item,$per_page
    // ";
    $sql = "SELECT 
    activity.*, 
    activity_category_small.name AS smallCategory_name,
    activity_category_big.name AS bigCategory_name,
    activity_category_big.id AS big_id,
    activity_teacher.id AS teacher_id, 
    activity_teacher.name AS teacher_name, 
    (SELECT activity_image.imgUrl FROM activity_image 
        WHERE activity_image.activity_id = activity.id AND activity_image.isMain = 1
        LIMIT 1) AS main_image
FROM activity
JOIN activity_category_small ON activity.activityCategorySmall_id = activity_category_small.id
JOIN activity_category_big ON activity_category_small.activityCategoryBig_id = activity_category_big.id
LEFT JOIN activity_teacher ON activity.activity_teacher_id = activity_teacher.id -- 連接老師表格
WHERE (activity.name LIKE '%$search%'
       OR activity_category_big.name LIKE '%$search%'
       OR activity_category_small.name LIKE '%$search%'
       OR activity_teacher.name LIKE '%$search%')
  AND activity.isDeleted=0 
$whereClause
LIMIT $start_item, $per_page";


    $result = $conn->query($sql);

    $activityCount = $result->num_rows;
    $activitys = $result->fetch_all(MYSQLI_ASSOC);

    //每頁編號
    // $index=$start_item+1;
    // while($row=$result->fetch_assoc()){
    //     echo "<p>編號:$index</p>".$index."-"    .$row["name"]."</p>";
    //     $index++;
    // }

    $total_page = ceil($allActivitysCount / $per_page);
} elseif (isset($_GET["p"])) {
    if (isset($_GET["order"])) {
        $order = $_GET["order"];
        switch ($order) {
            case 1:
                $whereClause = "ORDER BY startDate ASC";
                break;
            case 2:
                $whereClause = "ORDER BY startDate DESC";
                break;
        }
    } else {
        $whereClause = "ORDER BY id ASC";
    }
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
    activity_teacher.id AS teacher_id, 
    activity_teacher.name AS teacher_name, 
        (SELECT activity_image.imgUrl FROM activity_image 
        WHERE activity_image.activity_id = activity.id AND activity_image.isMain = 1
        LIMIT 1) AS main_image
        FROM activity
    JOIN activity_category_small ON activity.activityCategorySmall_id = activity_category_small.id
    JOIN activity_category_big ON activity_category_small.activityCategoryBig_id = activity_category_big.id
    LEFT JOIN activity_teacher ON activity.activity_teacher_id = activity_teacher.id  -- 連接老師表格
    WHERE activity.isDeleted=0
    $whereClause
    LIMIT $start_item,$per_page
    ";

    $result = $conn->query($sql);

    $activityCount = $result->num_rows;
    $activitys = $result->fetch_all(MYSQLI_ASSOC);

    //每頁編號
    //    $index=$start_item+1;
    //    while($row=$result->fetch_assoc()){
    //        echo "<p>編號:$index</p>".$index."-"    .$row["name"]."</p>";
    //        $index++;
    //    }

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
                        <li class="breadcrumb-item active" aria-current="page">服務列表</li>
                    </ol>
                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">服務列表</h1>


                    <!-- 搜尋列 -->
                    <div class="row justify-content-start">
                        <form class="col-2 d-flex justify-content-start" action="" method="get">
                            <div class="input-group mb-3 search-bar justify-content-end gx-0">
                                <input type="text" class="form-control" placeholder="<?php if (!isset($_GET["search"])): ?>輸入關鍵字 <?php else: ?><?= $_GET["search"] ?><?php endif; ?>"
                                    aria-label="Recipient's username" aria-describedby="basic-addon2" name="search" <?php if (isset($_GET["search"])): ?> value="<?= $_GET["search"] ?>" <?php endif; ?>>
                                <div class="input-group-append p-0">
                                    <button class="btn btn-outline-info" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
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
                        <a href="create-activity.php" class="btn btn-info"><i class="fa-solid fa-plus fa-fw"></i>新增服務</a>
                        <div class="d-flex justify-content-center">
                            <?php if (isset($_GET["order"])): ?>
                                <div class="me-1">
                                    <a href="activity.php?p=1<?php if (isset($search)): ?>&search=<?= $search ?><?php endif; ?>" class="btn btn-secondary"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                            <?php endif; ?>
                            <div class="btn-group ">
                                <a href="activity.php?p=1<?php if (isset($search)): ?>&search=<?= $search ?><?php endif; ?>&order=1" class="btn btn-info <?php if (isset($_GET["order"]) && $_GET["order"] == 1): ?> active<?php endif; ?>" id="sort-time-down">活動時間 <i class="fa-solid fa-arrow-down-1-9"></i></a>
                                <a href="activity.php?p=1<?php if (isset($search)): ?>&search=<?= $search ?><?php endif; ?>&order=2" class="btn btn-info <?php if (isset($_GET["order"]) && $_GET["order"] == 2): ?> active<?php endif; ?>" id="sort-time-up">活動時間 <i class="fa-solid fa-arrow-up-1-9"></i></a>
                            </div>
                            <!-- 分類 -->
                            <!-- <div class="filter-options d-flex justify-content-center ms-1">
                                <form method="GET" action="activity.php">
                                    <div class="d-flex">
                                        <select class="form-select" id="category-filter" name="category">
                                            <option value="">所有分類</option>
                                            <?php foreach ($avticityCategoryArr as $big_id => $big_data): ?>
                                                <option value="<?= $big_id ?>" <?php if (isset($_GET['category']) && $_GET['category'] == $big_id) echo 'selected'; ?>>
                                                    <?= $big_data["name"] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select> -->
                            <!-- <select class="form-select" id="status-filter" name="status">
                                            <option value="">所有狀態</option>
                                            <option value="尚未開始報名" <?php if (isset($_GET['status']) && $_GET['status'] == '尚未開始報名') echo 'selected'; ?>>尚未開始報名</option>
                                            <option value="活動報名中" <?php if (isset($_GET['status']) && $_GET['status'] == '活動報名中') echo 'selected'; ?>>活動報名中</option>
                                            <option value="報名結束，等待活動開始" <?php if (isset($_GET['status']) && $_GET['status'] == '報名結束，等待活動開始') echo 'selected'; ?>>報名結束，等待活動開始</option>
                                            <option value="活動進行中！" <?php if (isset($_GET['status']) && $_GET['status'] == '活動進行中！') echo 'selected'; ?>>活動進行中！</option>
                                            <option value="活動結束" <?php if (isset($_GET['status']) && $_GET['status'] == '活動結束') echo 'selected'; ?>>活動結束</option>
                                        </select> -->
                            <!-- <button type="submit" class="btn btn-info ms-2"><i class="fa-solid fa-magnifying-glass fa"></i></button>
                                    </div>
                                </form>
                            </div> -->

                            <div class="ms-1">
                                <a href="activity_isDeleted.php" class="btn btn-danger" title="已刪除的項目"><i class="fa-solid fa-trash-can-arrow-up fa-fw"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- 服務列表 開始 -->
                    <?php if ($activityCount > 0): ?>
                        <table id="activity-table" class="table table-style table-hover">
                            <tr>
                                <th>編號</th>
                                <th>名稱</th>
                                <th>圖片</th>
                                <th>類型</th>
                                <th>子分類</th>
                                <th>報名日期</th>
                                <th>活動日期</th>
                                <th>活動時間</th>
                                <th>師資</th>
                                <th>費用</th>
                                <th>狀態</th>
                                <th>編輯</th>
                            </tr>
                            <?php
                            $index = $start_item + 1;
                            foreach ($activitys as $activity): ?>
                                <tr>
                                    <td><?= $index ?></td>
                                    <td><?= $activity["name"] ?></td>
                                    <td class="img-td-container">
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
                                    <td><?php if ($activity["startTime"] == $activity["endTime"]): ?>
                                            <?= $activity["startTime"] ?>
                                        <?php else: ?>
                                            <?= $activity["startTime"] ?><br>|<br><?= $activity["endTime"] ?>
                                        <?php endif; ?></td>

                                    <td><?= $activity["teacher_name"] ?></td>
                                    <td>$<?= number_format($activity["price"]) ?></td>
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
                                        <button id="change-btn" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateModal<?= $activity["id"] ?>"><i class="fa-solid fa-pen-to-square fa-fw"></i></button>
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
                                                            <input id="fileInput" type="file" class="form-control" name="myFile" accept="image/*">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="" class="form-label">服務名稱</label>
                                                            <input type="text" class="form-control" name="activityName" value="<?= $activity["name"] ?>" placeholder="請輸入新的名稱" required>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">服務類型</label>
                                                                <select class="form-select " name="activityCategoryBig" id="activityCategoryBig<?= $activity["id"] ?>" required>
                                                                    <!--<select class="form-control " name="activityCategoryBig">-->
                                                                    <option selected>請選擇服務類型</option>
                                                                    <?php foreach ($avticityCategoryArr as $big_id => $big_data): ?>
                                                                        <option value="<?= $big_id ?>" <?= $big_id == $activity["big_id"] ? "selected" : "" ?>><?= $big_data["name"] ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">服務類別</label>
                                                                <select class="form-select" name="activityCategorySmall" id="activityCategorySmall<?= $activity["id"] ?>" required>
                                                                    <option value="<?= $activity['smallCategory_name'] ?>" selected><?= $activity['smallCategory_name'] ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col">
                                                                <label for="" class="form-label">費用</label>
                                                                <input type="number" class="form-control" name="activityPrice" value="<?= $activity["price"] ?>" min="1" step="1" required>
                                                            </div>
                                                            <div class="col">
                                                                <label for="" class="form-label">師資</label>
                                                                <?php $selectedTeacherId = $activity['activity_teacher_id'] ?? null; ?>
                                                                <select name="activity_teacher_id" class="form-select" required>
                                                                    <option value="">請選擇師資</option> <!-- 預設空選項 -->
                                                                    <?php foreach ($teachers as $teacher): ?>
                                                                        <option value="<?= htmlspecialchars($teacher['id']) ?>"
                                                                            <?= $teacher['id'] == $selectedTeacherId ? 'selected' : '' ?>>
                                                                            <?= htmlspecialchars($teacher['name']) ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">報名開始日</label>
                                                                <input type="date" class="form-control" name="activitySignDate" value="<?= $activity["signUpDate"] ?>" id="sign-start-date" required>
                                                            </div>
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">報名截止日</label>
                                                                <input type="date" class="form-control" name="activitySignEndDate" value="<?= $activity["signUpEndDate"] ?>" min="<?= $activity["signUpDate"] ?>" id="sign-end-date" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">活動開始日</label>
                                                                <input type="date" class="form-control" name="activityStartDate" value="<?= $activity["startDate"] ?>" min="<?= $activity["signUpEndDate"] ?>" id="start-date" required>
                                                            </div>
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">活動結束日</label>
                                                                <input type="date" class="form-control" name="activityEndDate" value="<?= $activity["endDate"] ?>" min="<?= $activity["startDate"] ?>" id="end-date" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">開始時間</label>
                                                                <input type="time" class="form-control" name="activityStartTime" value="<?= $activity["startTime"] ?>" id="start-time" required>
                                                            </div>
                                                            <div class="mb-2 col">
                                                                <label for="" class="form-label">結束時間</label>
                                                                <input type="time" class="form-control" name="activityEndTime" value="<?= $activity["endTime"] ?>" min="<?= $activity["startTime"] ?>" id="end-time" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">活動介紹</label>
                                                            <textarea class="form-control" name="activityArticle" rows="5"><?= $activity["description"] ?></textarea>
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
                                                    <form action="doDeleteActivity.php" method="post">
                                                        <input type="hidden" name="activityID" value="<?= $activity["id"] ?>">
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
                                            <a class="page-link" href="activity.php?p=<?= $_GET["p"] - 1 ?><?php if (isset($_GET["search"])): ?><?= "&search=" . $_GET["search"] ?><?php endif; ?><?php if (isset($_GET["order"])): ?><?= "&order=" . $_GET["order"] ?><?php endif; ?>" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php for ($i = 1; $i <= $total_page; $i++): ?>
                                        <li class="page-item <?php if ($i == $_GET["p"]) echo "active"; ?>"><a class="page-link" href="activity.php?p=<?= $i ?><?php if (isset($_GET["search"])): ?><?= "&search=" . $_GET["search"] ?><?php endif; ?><?php if (isset($_GET["order"])): ?><?= "&order=" . $_GET["order"] ?><?php endif; ?>">
                                                <?= $i ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>
                                    <?php if ($p + 1 <= $total_page): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="activity.php?p=<?= $_GET["p"] + 1 ?><?php if (isset($_GET["search"])): ?><?= "&search=" . $_GET["search"] ?><?php endif; ?><?php if (isset($_GET["order"])): ?><?= "&order=" . $_GET["order"] ?><?php endif; ?>" aria-label="Next">
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




    <!-- 修改活動的下拉式選單的JS -->
    <script>
        //點擊時獲取大分類和小分類的資料
        const categories = <?= json_encode($avticityCategoryArr) ?>;
        <?php foreach ($activitys as $activity): ?>
            const activityCategoryBig<?= $activity["id"] ?> = document.querySelector("#activityCategoryBig<?= $activity["id"] ?>");
            const activityCategorySmall<?= $activity["id"] ?> = document.querySelector("#activityCategorySmall<?= $activity["id"] ?>");
            activityCategoryBig<?= $activity["id"] ?>.addEventListener("click", function() {
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

        //限制日期的選擇
        const signStartDate = document.getElementById('sign-start-date');
        const signEndDate = document.getElementById('sign-end-date');
        const startDate = document.getElementById('start-date');
        const endDate = document.getElementById('end-date');
        const startTime = document.getElementById('start-time');
        const endTime = document.getElementById('end-time');

        // 當報名開始日變更時，動態設定報名截止日的最小值
        signStartDate.addEventListener('change', function() {
            const SignStartDate = this.value; // 獲取選擇的開始日期
            if (SignStartDate) {
                signEndDate.min = SignStartDate; // 設定截止日的最小值
            } else {
                signEndDate.removeAttribute('min'); // 如果未選擇日期，移除限制
            }
        });

        // 當報名結束日變更時，動態設定活動開始日的最小值
        signEndDate.addEventListener('change', function() {
            const SignEndDate = this.value; // 獲取選擇的開始日期
            if (SignEndDate) {
                startDate.min = SignEndDate; // 設定截止日的最小值
            } else {
                startDate.removeAttribute('min'); // 如果未選擇日期，移除限制
            }
        });


        // 當報名截止日變更時，動態設定活動開始日最小值
        startDate.addEventListener('change', function() {
            const StartDate = this.value; // 獲取選擇的開始日期
            if (StartDate) {
                endDate.min = StartDate; // 設定截止日的最小值
            } else {
                endDate.removeAttribute('min'); // 如果未選擇日期，移除限制
            }
        });




        //排序按鈕的點擊效果
        // const timeDown=document.querySelector("#sort-time-down")
        // const timeUp=document.querySelector("#sort-time-up")

        // timeDown.addEventListener("click",function(){
        //     timeUp.classList.remove('active')
        //     timeDown.classList.add('active')
        // })

        // timeUp.addEventListener("click",function(){
        //     timeDown.classList.remove('active')
        //     timeUp.classList.add('active')

        // })



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