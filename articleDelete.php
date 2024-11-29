<?php
require_once("../db_project_connect.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM article WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header("Location: articleList.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
