<?php
require_once("../db_project_connect.php");


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

$sql1 = "UPDATE activity SET name='$name', activityCategorySmall_id='$categorySmall', signUpDate='$signDate', signUpEndDate='$signEndDate', startDate='$startDate', endDate='$signEndDate', price='$price', description='$article' WHERE id = $activityId";

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


