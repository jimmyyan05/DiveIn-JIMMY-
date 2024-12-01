<?php

require_once("../db_project_connect.php");


$teacherID=$_POST["teacherID"];
$delete=$_POST["deleted"];

if($delete == 0){
    $sql="DELETE FROM activity_teacher WHERE id = $teacherID;
    DELETE FROM activity_teacher_image WHERE teacher_id = $teacherID";
    
    if($conn->multi_query($sql) === TRUE){
        echo "資料刪除成功";
    } else {
        echo "Error:".$sql."<br>".$conn->error;
        exit;
    }
}

header("location: teacher.php");