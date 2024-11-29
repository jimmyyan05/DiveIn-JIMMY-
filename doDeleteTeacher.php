<?php

require_once("../db_project_connect.php");


$teacherID=$_POST["teacherID"];
$delete=$_POST["deleted"];

if($delete == 1){
    $sql="UPDATE activity_teacher SET is_deleted='1' WHERE id = $teacherID";
    if($conn->query($sql) === TRUE){
        echo "新資料輸入成功";
    } else {
        echo "Error:".$sql."<br>".$conn->error;
        exit;
    }
}

header("location: teacher.php");

