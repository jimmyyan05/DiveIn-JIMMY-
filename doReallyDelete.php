<?php

require_once("../db_project_connect.php");


$activityID=$_POST["activityID"];
$delete=$_POST["deleted"];

if($delete == 0){
    $sql="DELETE FROM activity WHERE id = $activityID;
    DELETE FROM activity_image WHERE activity_id = $activityID";
    
    if($conn->multi_query($sql) === TRUE){
        echo "資料刪除成功";
    } else {
        echo "Error:".$sql."<br>".$conn->error;
        exit;
    }
}

// header("location: activity.php");