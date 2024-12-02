<?php
require_once("../db_project_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $description = $_POST["description"];

    // 檢查品牌名稱是否已存在(排除自己)
    $checkSql = "SELECT id FROM brand WHERE name = ? AND id != ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("si", $name, $id);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        $response = array(
            "success" => false,
            "message" => "品牌名稱已存在"
        );
    } else {
        $sql = "UPDATE brand SET name = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $description, $id);

        if ($stmt->execute()) {
            $response = array(
                "success" => true,
                "message" => "品牌更新成功"
            );
        } else {
            $response = array(
                "success" => false,
                "message" => "更新失敗: " . $conn->error
            );
        }
    }

    echo json_encode($response);
    exit;
}
