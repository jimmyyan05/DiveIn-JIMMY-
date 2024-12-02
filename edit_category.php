<?php
require_once("../db_project_connect.php");

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];

$sql = "UPDATE product_category_big SET name = ?, description = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $name, $description, $id);

$result = $stmt->execute();

header('Content-Type: application/json');
echo json_encode(['success' => $result]);
