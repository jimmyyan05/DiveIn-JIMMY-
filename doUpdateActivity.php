<?php
require_once("../db_project_connect.php");
session_start();

// print_r($_POST);


$activityId = $_POST["activityID"];
$name = $_POST["activityName"];
$categoryBig = $_POST["activityCategoryBig"];
$categorySmall = $_POST["activityCategorySmall"];
$price = $_POST["activityPrice"];
$signDate = $_POST["activitySignDate"];
$signEndDate = $_POST["activitySignEndDate"];
$startDate = $_POST["activityStartDate"];
$endDate = $_POST["activityEndDate"];
$article = $_POST["activityArticle"];
$startTime=$_POST["activityStartTime"];
$endTime=$_POST["activityEndTime"];
$teacher=$_POST["activity_teacher_id"];


if (empty($name)) {
    $_SESSION["error"]["updateActivity"] = "請輸入活動名稱";
    header("location:activity.php");
    exit;
}
if (empty($categoryBig)) {
    $_SESSION["error"]["updateActivity"] = "請選擇活動類型";
    header("location:activity.php");
    exit;
}

if (empty($categorySmall)) {
    $_SESSION["error"]["updateActivity"] = "請選擇活動類別";
    header("location:activity.php");
    exit;
}
if (empty($signDate)) {
    $_SESSION["error"]["updateActivity"] = "請輸入報名開始日期";
    header("location:activity.php");
    exit;
}

if (empty($signEndDate)) {
    $_SESSION["error"]["updateActivity"] = "請輸入報名結束日期";
    header("location:activity.php");
    exit;
}

if (empty($startDate)) {
    $_SESSION["error"]["updateActivity"] = "請輸入活動開始日期";
    header("location:activity.php");
    exit;
}

if (empty($endDate)) {
    $_SESSION["error"]["updateActivity"] = "請輸入活動結束日期";
    header("location:activity.php");
    exit;
}

// if (empty($article)) {
//     $_SESSION["error"]["updateActivity"] = "請輸入活動內容";
//     header("location:activity.php");
//     exit;
// }

if (empty($price)) {
    $_SESSION["error"]["updateActivity"] = "請輸入活動費用";
    header("location:activity.php");
    exit;
}

if (empty($teacher)) {
    $_SESSION["error"]["updateActivity"] = "請選擇師資";
    header("location:activity.php");
    exit;
}   

if (empty($startTime)) {
    $_SESSION["error"]["updateActivity"] = "請輸入活動開始時間";
    header("location:activity.php");
    exit;
}

if (empty($endTime)) {
    $_SESSION["error"]["updateActivity"] = "請輸入活動結束時間";
    header("location:activity.php");
    exit;
}

$_SESSION["error"]["updateActivity"] = "";


$sql1 = "UPDATE activity SET name='$name', activityCategorySmall_id='$categorySmall', signUpDate='$signDate', signUpEndDate='$signEndDate', startDate='$startDate', endDate='$endDate', startTime='$startTime', endTime='$endTime', price='$price', description='$article', activity_teacher_id='$teacher' WHERE id = $activityId";

// $sql1 = "UPDATE activity SET name='$name', activityCategorySmall_id='$categorySmall', signUpDate='$signDate', signUpEndDate='$signEndDate', startDate='$startDate', endDate='$signEndDate', startTime='$startTime', endTime='$endTime', price='$price', description='$article',	activity_teacher_id='$teacher' WHERE id = $activityId";

if($conn->query($sql1) === TRUE){
    // echo "新資料輸入成功";
    header("location: activity.php");
} else {
    echo "Error:".$sql."<br>".$conn->error;
    exit;
}

// print_r($_FILES["myFile"]);

// print_r($_FILES["myFile"]);

if ($_FILES["myFile"]["error"] == 0) {
    // echo "有收到！";
    $imageName = time();
    $extension = pathinfo($_FILES["myFile"]["name"], PATHINFO_EXTENSION);
    $fullimageName = $imageName . ".$extension";
    // echo $fullimageName;
    if (move_uploaded_file($_FILES["myFile"]["tmp_name"], "img/activity/$fullimageName")) {
        echo "Upload success!<br>";
    } else {
        echo "Upload fail!<br>";
    }
    $sql2 = "UPDATE activity_image SET imgUrl='$fullimageName' WHERE activity_id = $activityId ";

    if ($conn->query($sql2) === TRUE) {
        // echo "新資料輸入成功";
    header("location: activity.php");
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
        exit;
    }
} else {
    // echo "沒有";
    // var_dump($_FILES["myFile"]["error"]);
    exit;
};



$conn->close();


