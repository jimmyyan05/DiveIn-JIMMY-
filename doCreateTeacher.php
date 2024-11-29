<?php
require_once("../db_project_connect.php");

if(!isset($_POST["teacherName"])){
    exit("請循正常管道進入此頁");
}

var_dump($_POST);

$name=$_POST["teacherName"];
$categoryBig=$_POST["teacherCategoryBig"];
$categorySmall=$_POST["teacherCategorySmall"];
$price=$_POST["teacherPrice"];
$signDate=$_POST["teacherSignDate"];
$signEndDate=$_POST["teacherSignEndDate"];
$startDate=$_POST["teacherStartDate"];
$endDate=$_POST["teacherEndDate"];
$article=$_POST["teacherArticle"];
// $location=$_POST["teacherLocation"];


$sql1="INSERT INTO teacher (name, teacherCategorySmall_id, signUpDate, signUpEndDate, startDate, endDate, price, description)
VALUES('$name', '$categorySmall', '$signDate', '$signEndDate', '$startDate', '$endDate', '$price', '$article')
";
if($conn->query($sql1) === TRUE){
    $last_teacher_id=$conn->insert_id;
    echo "新資料輸入成功，id為$last_teacher_id";
} else {
    echo "Error:".$sql."<br>".$conn->error;
    exit;
}



$teacherImagName=$_POST["teacherName"]."教練";


if($_FILES["myFile"]["error"]==0){
    $imageName=time();
    $extension=pathinfo($_FILES["myFile"]["name"],PATHINFO_EXTENSION);
    $imageName=$imageName.".$extension";
    if(move_uploaded_file($_FILES["myFile"]["tmp_name"],"img/teacher/$imageName"))
    {
        echo "Upload success!<br>";
    }else{
        echo "Upload fail!<br>";
    }
}else{
    var_dump($_FILES["myFile"]["error"]);
    exit;
}

$now=date('Y-m-d H:i:s');
$sql2="INSERT INTO teacher_image (teacher_id, name, imgUrl, isMain)VALUES('$last_teacher_id', '$teacherImagName','$imageName',1) ";
if($conn->query($sql2) === TRUE){
    $last_id=$conn->insert_id;
    echo "新資料輸入成功，id為$last_id";
} else {
    echo "Error:".$sql."<br>".$conn->error;
    exit;
}

$conn->close();

header("location: teacher.php");