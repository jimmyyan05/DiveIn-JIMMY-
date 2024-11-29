<?php
// 開啟 session
session_start();

// 清除 session 變數
session_unset();

// 銷毀 session
session_destroy();

// 導向到登入頁面
header("Location: back_login.php");
exit;
?>