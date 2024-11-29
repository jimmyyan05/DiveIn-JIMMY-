<?php 
require_once("../pj_connect.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 驗證是否有提交有效的 user_id
if (!isset($_POST["user_id"]) || empty($_POST["user_id"])) {
    $_SESSION["error"] = "未提供有效的使用者 ID。";
    header("location: user_list.php"); // 替換為您的使用者列表頁面
    exit;
}

$user_id = intval($_POST["user_id"]); // 確保 user_id 是整數

// 準備 SQL 查詢
$sql = "UPDATE users SET is_deleted = 1 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    $_SESSION["success"] = "使用者資料已成功軟刪除。";
} else {
    $_SESSION["error"] = "刪除失敗，請稍後再試。";
}

// 釋放資源並關閉連接
$stmt->close();
$conn->close();

// 重導回列表頁面
header("location: userlist.php");
exit;