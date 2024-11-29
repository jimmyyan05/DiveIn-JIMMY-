<?php
require_once("../pj_connect.php");

if (isset($_GET["user_id"])) {
    $user_id = $_GET["user_id"];

    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); // 取得該使用者的資料
    } else {
        echo "找不到該使用者。";
        exit;
    }
} else {
    echo "沒有傳遞 user_id。";
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>使用者詳細資料</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php include("./css.php") ?>
</head>

<body>
    <div class="container mt-4">
        <h1>使用者詳細資料</h1>
        <div class="card">
            <div class="card-header">
                使用者: <?= $user["name"] ?>
            </div>
            <div class="card-body">
                <p><strong>姓名:</strong> <?= $user["name"] ?></p>
                <p><strong>帳號:</strong> <?= $user["account"] ?></p>
                <p><strong>電話:</strong> <?= $user["phone"] ?></p>
                <p><strong>Email:</strong> <?= $user["email"] ?></p>
                <p><strong>生日:</strong> <?= $user["birthday"] ?></p>
                <p><strong>地址:</strong> <?= $user["address"] ?></p>
                <p><strong>建立時間:</strong> <?= $user["created_at"] ?></p>
                <p><strong>更新時間:</strong> <?= $user["updated_at"] ?></p>
                <p><strong>等級:</strong> <?= $user["level_id"] ?></p>
                <p><strong>緊急聯絡人:</strong> <?= $user["emergency_contact"] ?></p>
                <p><strong>緊急連絡人電話:</strong> <?= $user["emergency_phone"] ?></p>
                <p><strong>持有證照:</strong> <?= $user["is_certify"] > 0 ? "是" : "否" ?></p>
            </div>
            <div class="card-footer text-end">
                <a href="userlist.php" class="btn btn-secondary">返回使用者列表</a>
            </div>
        </div>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>