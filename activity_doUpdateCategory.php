<?php

require_once("../db_project_connect.php");


// $smallId=$_POST["smallId"];
// $bigName=$_POST["bigName"];

//新增大分類
if (isset($_POST["newBigCategoryName"])) {
    $newBigCateName = $_POST["newBigCategoryName"];
    $sql1 = "INSERT INTO activity_category_big (name) VALUES('$newBigCateName')";
    if ($conn->query($sql1) === TRUE) {
        $last_big_id = $conn->insert_id;
        echo "新資料輸入成功，id為$last_big_id";
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
        exit;
    }
    header("location: activityCategory.php");
}
//新增小分類
if (isset($_POST["newSmaillCategoryName"])) {
    $newSmallCateName = $_POST["newSmaillCategoryName"];
    $bigId = $_POST["big_id"];

    $sql1 = "INSERT INTO activity_category_small (name, activityCategoryBig_id) VALUES('$newSmallCateName', '$bigId')";
    if ($conn->query($sql1) === TRUE) {
        $last_small_id = $conn->insert_id;
        echo "新資料輸入成功，id為$last_small_id";
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
        exit;
    }
    header("location: activityCategory.php");
};


// 修改大分類
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['big_id']) && isset($_POST['big_name'])) {
    $bigId = $_POST['big_id'];
    $bigName = $_POST['big_name'];

    // 確保輸入不為空，並避免 SQL 注入
    if (!empty($bigId) && !empty($bigName)) {
        $stmt = $conn->prepare("UPDATE activity_category_big SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $bigName, $bigId);

        if ($stmt->execute()) {
            echo "大分類更新成功";
        } else {
            echo "更新失敗：" . $conn->error;
        }
    } else {
        echo "請輸入有效的資料";
    }
    header("location: activityCategory.php");
}

// 修改小分類
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $smallId = $_POST['small_id'];
    $smallName = $_POST['small_name'];

    // 確保輸入不為空，並避免 SQL 注入
    if (!empty($smallId) && !empty($smallName)) {
        $stmt = $conn->prepare("UPDATE activity_category_small SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $smallName, $smallId);

        if ($stmt->execute()) {
            echo "更新成功";
        } else {
            echo "更新失敗：" . $conn->error;
        }
    } else {
        echo "請輸入有效的資料";
    }
    header("location: activityCategory.php");
}


