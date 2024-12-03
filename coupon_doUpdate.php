<?php
// 引入資料庫連線設定檔案
require_once("../db_project_connect.php");

// 檢查 POST 請求中是否包含 "code" 參數，如果沒有，則中止並顯示錯誤訊息
if (!isset($_POST["code"])) {
    exit("請循正常管道進入此頁");
}

// 接收從前端表單傳遞過來的資料
$id = $_POST["id"];                        // 優惠券的 ID，用於識別更新哪一條優惠券
$code = $_POST["code"];                    // 優惠券的代碼
$name = $_POST["name"];                    // 優惠券名稱
$product_id = $_POST["product_id"];        // 優惠券適用的產品 ID
$targetMembers = $_POST["targetMembers"];  // 優惠券的目標會員類型
$discountType = $_POST["discountType"];    // 折扣方式（如：百分比折扣、固定金額折扣）
$discountValue = $_POST["discountValue"];  // 優惠券的折扣值
$usageLimit = $_POST["usageLimit"];        // 優惠券的使用次數限制
$startDate = $_POST["startDate"];          // 優惠券的開始日期
$endDate = $_POST["endDate"];              // 優惠券的結束日期
$minPurchase= $_POST["minPurchase"];
$maxDiscountValue= $_POST["maxDiscountValue"];
$userLimit= $_POST["userLimit"];
$description= $_POST["description"];
$now = date('Y-m-d H:i:s');                // 獲取當前時間，這裡沒有被用到，但可以在更新時記錄更新時間

// 根據當前日期計算 status
$currentDate = date('Y-m-d');  // 獲取今天的日期

if ($currentDate < $startDate) {
    $status = 'inactive';  // 如果當前日期小於開始日期
} elseif ($currentDate >= $startDate && $currentDate <= $endDate) {
    $status = 'active';  // 如果當前日期在開始和結束日期之間
} else {
    $status = 'expired';  // 如果當前日期大於結束日期
}

// 構建 SQL 查詢語句來更新資料庫中的優惠券資料
$sql = "UPDATE coupon SET 
            name='$name', 
            product_id='$product_id', 
            targetMembers='$targetMembers', 
            discountType='$discountType', 
            discountValue='$discountValue', 
            usageLimit='$usageLimit', 
            startDate='$startDate', 
            endDate='$endDate', 
            minPurchase='$minPurchase', 
            maxDiscountValue='$maxDiscountValue', 
            userLimit='$userLimit', 
            description='$description', 
            status='$status'  
        WHERE id=$id";  // 根據優惠券 ID 查找並更新對應的資料

// 執行 SQL 查詢並檢查是否成功
if ($conn->query($sql) === TRUE) {
    // 如果更新成功，顯示提示訊息
    echo "更新成功";
} else {
    // 如果更新失敗，顯示錯誤訊息並且輸出錯誤細節
    echo "更新資料錯誤: " . $conn->error;
}

// 關閉資料庫連線
$conn->close();

// 重定向到優惠券查看頁面，並附帶 ID 參數
header("location: coupon_view.php?id=$id");
?>
