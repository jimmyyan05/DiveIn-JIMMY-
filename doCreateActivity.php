<?php
require_once("../db_project_connect.php");
session_start();

if (!isset($_POST["activityName"])) {
    exit("請循正常管道進入此頁");
}

// var_dump($_POST);


$name = $_POST["activityName"];
$categoryBig = $_POST["activityCategoryBig"];
$categorySmall = $_POST["activityCategorySmall"];
$price = $_POST["activityPrice"];
$signDate = $_POST["activitySignDate"];
$signEndDate = $_POST["activitySignEndDate"];
$startDate = $_POST["activityStartDate"];
$endDate = $_POST["activityEndDate"];
$article = $_POST["activityArticle"];
$teacher = $_POST["teacher"];
$startTime = $_POST["activityStartTime"];
$endTime = $_POST["activityEndTime"];
// $location=$_POST["activityLocation"];


if (empty($name)) {
    $_SESSION["error"]["createActivity"] = "請輸入活動名稱";
    header("location:create-activity.php");
    exit;
}
if (empty($categoryBig)) {
    $_SESSION["error"]["createActivity"] = "請選擇活動類型";
    header("location:create-activity.php");
    exit;
}

if (empty($categorySmall)) {
    $_SESSION["error"]["createActivity"] = "請選擇活動類別";
    header("location:create-activity.php");
    exit;
}
if (empty($signDate)) {
    $_SESSION["error"]["createActivity"] = "請輸入報名開始日期";
    header("location:create-activity.php");
    exit;
}

if (empty($signEndDate)) {
    $_SESSION["error"]["createActivity"] = "請輸入報名結束日期";
    header("location:create-activity.php");
    exit;
}

if (empty($startDate)) {
    $_SESSION["error"]["createActivity"] = "請輸入活動開始日期";
    header("location:create-activity.php");
    exit;
}

if (empty($endDate)) {
    $_SESSION["error"]["createActivity"] = "請輸入活動結束日期";
    header("location:create-activity.php");
    exit;
}

// if (empty($article)) {
//     $_SESSION["error"]["createActivity"] = "請輸入活動內容";
//     header("location:create-activity.php");
//     exit;
// }

if (empty($price)) {
    $_SESSION["error"]["createActivity"] = "請輸入活動費用";
    header("location:create-activity.php");
    exit;
}

if (empty($teacher)) {
    $_SESSION["error"]["createActivity"] = "請選擇師資";
    header("location:create-activity.php");
    exit;
}   

if (empty($startTime)) {
    $_SESSION["error"]["createActivity"] = "請輸入活動開始時間";
    header("location:create-activity.php");
    exit;
}

if (empty($endTime)) {
    $_SESSION["error"]["createActivity"] = "請輸入活動結束時間";
    header("location:create-activity.php");
    exit;
}

$_SESSION["error"]["createActivity"] = "";


$sql1 = "INSERT INTO activity (name, activityCategorySmall_id, signUpDate, signUpEndDate, startDate, endDate,startTime, endTime, price, description, activity_teacher_id)
VALUES('$name', '$categorySmall', '$signDate', '$signEndDate', '$startDate', '$endDate','$startTime', '$endTime', '$price', '$article', '$teacher')
";
if ($conn->query($sql1) === TRUE) {
    $last_activity_id = $conn->insert_id;
    echo "新資料輸入成功，id為$last_activity_id";
} else {
    echo "Error:" . $sql . "<br>" . $conn->error;
    exit;
}



$activityImagName = $_POST["activityName"] . "（主圖）";


if ($_FILES["myFile"]["error"] == 0) {
    $imageName = time();
    $extension = pathinfo($_FILES["myFile"]["name"], PATHINFO_EXTENSION);
    $imageName = $imageName . ".$extension";
    if (move_uploaded_file($_FILES["myFile"]["tmp_name"], "img/activity/$imageName")) {
        echo "Upload success!<br>";
    } else {
        echo "Upload fail!<br>";
    }
} else {
    var_dump($_FILES["myFile"]["error"]);
    exit;
}

$now = date('Y-m-d H:i:s');
$sql2 = "INSERT INTO activity_image (activity_id, name, imgUrl, isMain)VALUES('$last_activity_id', '$activityImagName','$imageName',1) ";
if ($conn->query($sql2) === TRUE) {
    $last_id = $conn->insert_id;
    echo "新資料輸入成功，id為$last_id";
} else {
    echo "Error:" . $sql . "<br>" . $conn->error;
    exit;
}

$conn->close();

header("location: activity.php");
