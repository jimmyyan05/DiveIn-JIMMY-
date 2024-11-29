<?php
session_start();
if(isset($_SESSION["user"])){
    header("location: index.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>


    <?php include("./css.php") ?>
</head>

<body class="bg-info-subtle">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-4 d-none bg-login-image"></div>
                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="text-gray-900 mb-4">Dive In 後台</h1>
                                    </div>
                                    <?php if(isset($_SESSION["error"]["times"]) && $_SESSION["error"]["times"]>6): ?>
                                    <h3 class="text-danger">輸入錯誤次數太多, 請稍後再來</h3>
                                    <?php else: ?>
                                    <form action="doBack_login.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="account"
                                                id="exampleInputAccount" aria-describedby="accountHelp"
                                                placeholder="帳號(Account)">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password"
                                                id="exampleInputPassword" placeholder="密碼(Password)">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="form-check-input" id="customCheck">
                                                <label class="form-check-label" for="remember">記住我</label>
                                            </div>
                                        </div>
                                        <?php if (isset($_SESSION["error"]["message"])): ?>
                                            <div class="p-1 mb-2 text-danger bg-info bg-gradient"><?= htmlspecialchars($_SESSION["error"]["message"]) ?></div>
                                        <?php unset($_SESSION["error"]["message"]); endif; ?>
                                        <div class="d-grid">
                                        <button class="btn btn-info btn-user btn-block" type="submit">登入</button>
                                        </div>
                                    </form>
                                    <?php endif; ?>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">忘記密碼?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">註冊帳號！</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php include("./js.php") ?>
</body>

</html>