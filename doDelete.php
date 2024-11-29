<?php

require_once("../db_project_connect.php");


$activityID=$_POST["activityID"];
$delete=$_POST["deleted"];

if($delete == 1){
    $sql="UPDATE activity SET isDeleted='1' WHERE id = $activityID";
    if($conn->query($sql) === TRUE){
        echo "新資料輸入成功";
    } else {
        echo "Error:".$sql."<br>".$conn->error;
        exit;
    }
}

header("location: activity.php");

