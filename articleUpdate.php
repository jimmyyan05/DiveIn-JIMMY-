<?php
require_once("articleConnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = $_POST['status'];
    $type = $_POST['type'];

    // 設定當前時間為 upgradeDate
    $upgradeDate = date("Y-m-d H:i:s");

    // 構建 SQL 更新語句
    $sql = "UPDATE article SET 
                title = ?, 
                content = ?, 
                status = ?, 
                type = ?, 
                upgradeDate = ? 
            WHERE id = ?";

    // 使用預備語句避免 SQL 注入
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssi", $title, $content, $status, $type, $upgradeDate, $id);

        if ($stmt->execute()) {
            echo "更新成功！";
            header("Location: articleList.php"); // 成功後跳轉回列表頁
        } else {
            echo "更新失敗：" . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "預備語句錯誤：" . $conn->error;
    }
}

$conn->close();
?>
