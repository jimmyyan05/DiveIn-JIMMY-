<?php
require_once("../db_project_connect.php");


// print_r($_POST);
$teacherID = $_POST["teacherID"];
$name=$_POST["teacherName"];
$sex=$_POST["sex"];
$email=$_POST["teacherEmail"];
$years=$_POST["teacherYears"];
$level=$_POST["level"];

// $location=$_POST["teacherLocation"];



$sql1="UPDATE activity_teacher SET name='$name', email='$email', sex='$sex', level='$level', years='$years' WHERE id = $teacherID;
";
if($conn->query($sql1) === TRUE){
    echo "新資料輸入成功";
} else {
    echo "Error:".$sql."<br>".$conn->error;
    exit;
}


if ($_FILES["myFile"]["error"] == 0) {
    // echo "有收到！";
    $imageName = time();
    $extension = pathinfo($_FILES["myFile"]["name"], PATHINFO_EXTENSION);
    $fullimageName = $imageName . ".$extension";
    // echo $fullimageName;
    if (move_uploaded_file($_FILES["myFile"]["tmp_name"], "img/teacher/$fullimageName")) {
        echo "Upload success!<br>";
    } else {
        echo "Upload fail!<br>";
    }
    $sql2 = "UPDATE activity_teacher_image SET imageUrl	='$fullimageName' WHERE teacher_id = $teacherID ";

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

header("location: teacher.php");


