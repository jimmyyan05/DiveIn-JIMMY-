<?php
require_once("../db_project_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];

    // 檢查品牌名稱是否已存在
    $checkSql = "SELECT id FROM brand WHERE name = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("s", $name);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        $response = array(
            "success" => false,
            "message" => "品牌名稱已存在"
        );
    } else {
        $sql = "INSERT INTO brand (name, description) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $name, $description);

        if ($stmt->execute()) {
            $response = array(
                "success" => true,
                "message" => "品牌新增成功"
            );
        } else {
            $response = array(
                "success" => false,
                "message" => "新增失敗: " . $conn->error
            );
        }
    }

    echo json_encode($response);
    exit;
}
