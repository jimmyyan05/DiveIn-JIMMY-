<?php
require_once("../db_project_connect.php");

$sql = "SELECT 
    orders.*, 
    users.name AS user_name,
    users.email AS user_email,
    product_orders.product_status,
    rental_orders.rental_status,
    activity_orders.activity_status
FROM orders
LEFT JOIN users ON orders.member_id = users.id
LEFT JOIN product_orders ON orders.product_order_id = product_orders.id
LEFT JOIN rental_orders ON orders.rental_order_id = rental_orders.id
LEFT JOIN activity_orders ON orders.activity_order_id = activity_orders.id
ORDER BY orders.created_at DESC";

$result = $conn->query($sql);
$orderCount = $result->num_rows;
$orders = $result->fetch_all(MYSQLI_ASSOC);
$status_text = [
    'processing' => '處理中',
    'completed' => '已完成',
    'cancelled' => '已取消',
    'pending' => '待處理'
];

function getStatusClass($status)
{
    switch ($status) {
        case 'processing':
            return 'bg-info';
        case 'completed':
            return 'bg-success';
        case 'cancelled':
            return 'bg-danger';
        case 'pending':
            return 'bg-warning';
        default:
            return 'bg-secondary';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>訂單管理</title>
    <?php include("./css.php") ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include("sidebar.php") ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include("./topbar.php") ?>
                <!-- 麵包屑 -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb rounded-0 p-3">
                        <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">訂單列表</li>
                    </ol>
                </nav>
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2>訂單列表</h2>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">共計<?= $orderCount ?>樣訂單</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>訂單編號</th>
                                            <th>會員資訊</th>
                                            <th>訂單類型</th>
                                            <th>訂單日期</th>
                                            <th>總金額</th>
                                            <th>付款狀態</th>
                                            <th>訂單狀態</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orders as $order): ?>
                                            <tr>
                                                <td>#<?= $order["id"] ?></td>
                                                <td>
                                                    <div><?= $order["user_name"] ?></div>
                                                    <small class="text-muted"><?= $order["user_email"] ?></small>
                                                </td>
                                                <td>
                                                    <?php
                                                    $orderTypes = [];
                                                    if ($order['product_order_id']) {
                                                        $orderTypes[] = ['text' => '商品', 'class' => 'bg-primary'];
                                                    }
                                                    if ($order['rental_order_id']) {
                                                        $orderTypes[] = ['text' => '租借', 'class' => 'bg-info'];
                                                    }
                                                    if ($order['activity_order_id']) {
                                                        $orderTypes[] = ['text' => '活動', 'class' => 'bg-success'];
                                                    }
                                                    foreach ($orderTypes as $type):
                                                    ?>
                                                        <span class="badge <?= $type['class'] ?>"><?= $type['text'] ?></span>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td><?= date('Y/m/d H:i', strtotime($order["created_at"])) ?></td>
                                                <td>NT$ <?= number_format($order["total_amount"]) ?></td>
                                                <td>
                                                    <span class="badge <?= getStatusClass($order["payment_status"]) ?>">
                                                        <?= $status_text[$order["payment_status"]] ?? $order["payment_status"] ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php if ($order["product_status"]): ?>
                                                        <span class="badge <?= getStatusClass($order["product_status"]) ?>">
                                                            <?= $status_text[$order["product_status"]] ?? $order["product_status"] ?>
                                                        </span>
                                                    <?php endif; ?>
                                                    <?php if ($order["rental_status"]): ?>
                                                        <span class="badge <?= getStatusClass($order["rental_status"]) ?>">
                                                            <?= $status_text[$order["rental_status"]] ?? $order["rental_status"] ?>
                                                        </span>
                                                    <?php endif; ?>
                                                    <?php if ($order["activity_status"]): ?>
                                                        <span class="badge <?= getStatusClass($order["activity_status"]) ?>">
                                                            <?= $status_text[$order["activity_status"]] ?? $order["activity_status"] ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="order-detail.php?id=<?= $order["id"] ?>" class="btn btn-sm btn-outline-primary">查看詳情</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("./footer.php") ?>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
</body>

</html>