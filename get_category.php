<?php
require_once("../db_project_connect.php");

$id = $_GET['id'];
$sql = "SELECT * FROM product_category_big WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

header('Content-Type: application/json');
echo json_encode($data);
