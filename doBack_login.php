<?php
require_once("../pj_connect.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_POST["account"])) {
    exit("請循正常管道進入此頁");
}

$account = $_POST["account"];
$password = $_POST["password"];
$hashedpassword = md5($password);

if (empty($account)) {
    $_SESSION["error"]["message"] = "請輸入帳號";
    header("location: back_login.php");
    exit;
}
if (empty($password)) {
    $_SESSION["error"]["message"] = "請輸入密碼";
    header("location: back_login.php");
    exit;
}

$sql = "SELECT * FROM users WHERE account = '$account' AND password = '$hashedpassword'";
$result=$conn->query($sql);
$userCount=$result->num_rows;

if ($userCount == 0) {
    if (!isset($_SESSION["error"]["times"])) {
        $_SESSION["error"]["times"] = 1;
    } else {
        $_SESSION["error"]["times"]++;
    }

    $_SESSION["error"]["message"] = "使用者帳號或密碼錯誤";
    header("location: back_login.php");
    exit;
}

$user = $result->fetch_assoc();
$_SESSION["user"] = $user;

// 根據 manager 權限導向不同頁面
if (isset($user["manager"])) {
    if ($user["manager"] == 1) {
        // manager 權限
        unset($_SESSION["error"]["times"]);
        $conn->close();
        header("location: index.php"); // 導向後台管理頁
        exit;
    } elseif ($user["manager"] == 0) {
        // 非 manager 權限
        unset($_SESSION["error"]["times"]);
        $conn->close();
        header("location: 404.html"); // 導向使用者頁面
        exit;
    }
}