<?php
require_once("../db_project_connect.php");

if(!isset($_POST["teacherName"])){
    exit("請循正常管道進入此頁");
}

var_dump($_POST);

$name=$_POST["teacherName"];
$sex=$_POST["sex"];
$email=$_POST["teacherEmail"];
$years=$_POST["teacherYears"];
$level=$_POST["level"];

// $location=$_POST["teacherLocation"];


$sql1="INSERT INTO 	activity_teacher (name, email, sex, level,years)
VALUES('$name', '$email', '$sex', '$level','$years')
";
if($conn->query($sql1) === TRUE){
    $last_teacher_id=$conn->insert_id;
    echo "新資料輸入成功，id為$last_teacher_id";
} else {
    echo "Error:".$sql."<br>".$conn->error;
    exit;
}



$teacherImagName=$name."教練照片";


if($_FILES["myFile"]["error"]==0){
    $imageName=time();
    $extension=pathinfo($_FILES["myFile"]["name"],PATHINFO_EXTENSION);
    $teacherImageName=$imageName.".$extension";
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
$sql2="INSERT INTO activity_teacher_image (teacher_id, name,imageUrl)VALUES('$last_teacher_id', '$teacherImagName','$imageName') ";
if($conn->query($sql2) === TRUE){
    $last_id=$conn->insert_id;
    echo "新資料輸入成功，id為$last_id";
} else {
    echo "Error:".$sql."<br>".$conn->error;
    exit;
}

$conn->close();

header("location: teacher.php");