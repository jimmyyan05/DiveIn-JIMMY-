<?php
// 引入資料庫連線設定檔案
require_once("../db_project_connect.php");

// 定義一個用來快速回應 JSON 格式資料的函數，包含狀態和訊息
function jsonResponse($status, $message)
{
    // 將回應資料轉換成 JSON 格式並輸出
    echo json_encode(["status" => $status, "message" => $message]);
    // 終止程式執行，避免後續程式碼繼續執行
    exit;
}

// 檢查是否從正確管道傳遞 `code` 參數（通常透過 POST 方法）
if (!isset($_POST["code"])) {
    jsonResponse(0, "請循正常管道進入此頁"); // 如果未傳遞 `code`，回傳錯誤訊息
}

// 接收前端傳遞的資料
$code = $_POST["code"];                  // 優惠券代碼
$name = $_POST["name"];                  // 優惠券名稱
$product_id = $_POST["product_id"];      // 適用的產品 ID
$targetMembers = $_POST["targetMembers"]; // 目標會員類型
$discountType = $_POST["discountType"];  // 折扣方式（例如百分比或固定金額）
$discountValue = $_POST["discountValue"];// 折扣值
$usageLimit = $_POST["usageLimit"];      // 使用次數限制
$startDate = $_POST["startDate"];        // 開始日期
$endDate = $_POST["endDate"];            // 結束日期
$now=date('Y-m-d H:i:s');                // 取得當前的日期和時間


// 驗證：檢查優惠券代碼是否為空
if (empty($code)) {
    jsonResponse(0, "請輸入優惠券代碼");
}

// 驗證：檢查資料庫中是否已存在相同的優惠券代碼
$sqlCheck = "SELECT * FROM coupon WHERE code='$code'";
$resultCheck = $conn->query($sqlCheck);
if ($resultCheck->num_rows > 0) {
    jsonResponse(0, "優惠券代碼已存在"); // 如果代碼已存在，回傳錯誤訊息
}

// 驗證：檢查優惠券名稱是否為空
if (empty($name)) {
    jsonResponse(0, "請輸入優惠券名稱");
}

// 驗證：檢查是否選擇適用的產品
if (empty($product_id)) {
    jsonResponse(0, "請選擇適用服務");
}

// 驗證：檢查是否選擇目標會員類型
if (empty($targetMembers)) {
    jsonResponse(0, "請選擇目標會員");
}

// 驗證：檢查是否選擇折扣方式
if (empty($discountType)) {
    jsonResponse(0, "請選擇折扣方式");
}

// 驗證：檢查是否填寫折扣值
if (empty($discountValue)) {
    jsonResponse(0, "未填入折扣值");
}

// 驗證：檢查使用次數限制是否為空
if (empty($usageLimit)) {
    jsonResponse(0, "請輸入優惠券數量");
}

// 驗證：檢查開始日期是否為空
if (empty($startDate)) {
    jsonResponse(0, "請選擇開始日期");
}

// 驗證：檢查結束日期是否為空
if (empty($endDate)) {
    jsonResponse(0, "請選擇結束日期");
}

// 驗證：檢查開始日期不得晚於結束日期
if (strtotime($startDate) > strtotime($endDate)) {
    jsonResponse(0, "開始日期不得晚於結束日期");
}

// SQL 語句：插入新的優惠券資料到資料庫
$sql = "INSERT INTO coupon (code, name, product_id, targetMembers, discountType, discountValue, usageLimit, startDate, endDate) 
        VALUES ('$code', '$name', '$product_id', '$targetMembers', '$discountType', '$discountValue', '$usageLimit', '$startDate', '$endDate')";

// // 執行 SQL 語句並檢查是否成功
// if ($conn->query($sql) === TRUE) {
//     $last_id = $conn->insert_id; // 獲取插入的資料的 ID
//     jsonResponse(1, "新優惠券創建成功， 優惠券ID: $last_id"); // 成功訊息
// } else {
//     // 如果資料插入失敗，回傳錯誤訊息
//     jsonResponse(0, "Error:" . $conn->error);
// }

if ($conn->query($sql) === TRUE) {
    // 設置成功訊息
    $_SESSION['success_message'] = "新優惠券創建成功， 優惠券ID: $last_id";

    // 重定向到優惠券列表頁面
    header("Location: coupon_list.php");
    exit;  // 確保程式不繼續執行
}

// 關閉資料庫連線
$conn->close();

// // 將使用者重導向到優惠券列表頁面（非必要）
// header("location: coupon_list");

