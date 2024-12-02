<style>
    .sidebar {
        position: sticky;
        top: 0;
        /* 保證當滾動時，側邊欄固定 */
        height: 100vh;
        /* 設定高度為視窗高度 */
        /* overflow-y: auto; */
        /* 使側邊欄內容可滾動 */
    }
</style>
<!-- Sidebar -->
<ul class="navbar-nav bg-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->

    <li class="nav-item active">
        <div class="sidebar-brand-icon">
            <img src="./img/icon-3.png" class="img-fit">
        </div>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>首頁</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        DiveIn後台管理
    </div>

    <!-- Nav Item - 會員管理 -->
    <li class="nav-item">
        <a class="nav-link collapsed " href="userlist.php">
            <i class="fa-solid fa-user fa-fw"></i>
            <span>會員管理</span>
        </a>
        <!-- <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">暫定</h6>
                <a class="collapse-item" href="buttons.html">暫定</a>
                <a class="collapse-item" href="cards.html">暫定</a>
            </div>
        </div> -->
    </li>

    <!-- Nav Item -訂單管理-->
    <li class="nav-item">
        <a class="nav-link" href="order.php">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>訂單管理</span></a>
    </li>

    <!-- Nav Item - 商品管理 -->
    <li class="nav-item">
        <a class="nav-link" href="product.php">
            <i class="fa-solid fa-anchor"></i>
            <span>商品管理</span></a>
    </li>

    <!-- Nav Item - 分類管理 -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsefour"
            aria-expanded="true" aria-controls="collapsefour">
            <i class="fa-solid fa-layer-group"></i>
            <span>分類管理</span>
        </a>
        <div id="collapsefour" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">所有分類</h6>
                <a class="collapse-item" href="category.php">商品分類</a>
                <a class="collapse-item" href="">租賃分類</a>
                <a class="collapse-item" href="activityCategory.php">課程分類</a>
                <a class="collapse-item" href="brand.php">品牌</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - 租賃管理 -->
    <li class="nav-item">
        <a class="nav-link" href="rent_items.php">
            <i class="fa-solid fa-people-carry-box"></i>
            <span>租賃管理</span></a>
    </li>

    <!-- Nav Item - 課程管理 -->
    <li class="nav-item">
        <a class="nav-link" href="activity.php">
            <i class="fa-brands fa-readme"></i>
            <span>課程管理</span></a>
    </li>

    <!-- Nav Item - 教練管理 -->
    <li class="nav-item">
        <a class="nav-link" href="teacher.php">
            <i class="fa-solid fa-person-chalkboard"></i>
            <span>教練管理</span></a>
    </li>

    <!-- Nav Item - 優惠券管理 -->
    <li class="nav-item">
        <a class="nav-link" href="coupon_list.php">
            <i class="fa-solid fa-ticket"></i>
            <span>優惠券管理</span></a>
    </li>

    <!-- Nav Item - 文章管理 -->
    <li class="nav-item">
        <a class="nav-link" href="articleList.php">
            <i class="fa-solid fa-newspaper"></i>
            <span>文章管理</span></a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <!-- <div class="sidebar-heading">
        others
    </div> -->

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li> -->



    <!-- Nav Item - Tables -->
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Copyright -->
    <div class="sidebar-footer text-center mt-auto">
        <small class="text-white">&copy; DiveIn 2024 </small>
    </div>
</ul>


<!-- End of Sidebar -->

<head>
    <style>
        .sidebar-brand-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .sidebar-brand-icon .img-fit {
            max-width: 100%;
            height: auto;
            display: block;
        }
    </style>
</head>