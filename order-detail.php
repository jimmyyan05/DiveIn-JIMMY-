<?php
require_once("../db_project_connect.php");

$id = $_GET["id"] ?? null;
if (!$id) {
    header("Location: orders.php");
    exit;
}

// 獲取主訂單信息
$sql = "SELECT 
    orders.*,
    users.name AS user_name,
    users.email AS user_email,
    users.phone AS user_phone,
    product_orders.product_status,
    product_orders.shipping_address,
    rental_orders.rental_status,
    rental_orders.deposit_total,
    activity_orders.activity_status,
    activity_orders.participant_count
FROM orders
LEFT JOIN users ON orders.member_id = users.id
LEFT JOIN product_orders ON orders.product_order_id = product_orders.id
LEFT JOIN rental_orders ON orders.rental_order_id = rental_orders.id
LEFT JOIN activity_orders ON orders.activity_order_id = activity_orders.id
WHERE orders.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

if (!$order) {
    header("Location: orders.php");
    exit;
}

// 獲取商品訂單項目
$productItems = [];
if ($order['product_order_id']) {
    $sql = "SELECT 
        product_order_items.*,
        product.name AS product_name,
        product.price AS unit_price
    FROM product_order_items
    JOIN product ON product_order_items.product_id = product.id
    WHERE product_order_items.product_order_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order['product_order_id']);
    $stmt->execute();
    $productItems = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// 獲取租借訂單項目
$rentalItems = [];
if ($order['rental_order_id']) {
    $sql = "SELECT 
        rental_order_items.*,
        rent_item.name AS rent_item_name,
        rent_item.price AS daily_rate
    FROM rental_order_items
    JOIN rent_item ON rental_order_items.rent_item_id = rent_item.id
    WHERE rental_order_items.rental_order_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order['rental_order_id']);
    $stmt->execute();
    $rentalItems = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// 獲取活動訂單項目
$activityItems = [];
if ($order['activity_order_id']) {
    $sql = "SELECT 
        order_items.*,
        activity.name AS activity_name,
        activity.price AS activity_price
    FROM order_items
    JOIN activity ON order_items.item_id = activity.id
    WHERE order_items.order_id = ? AND order_items.item_type = 'activity'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $activityItems = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

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
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>訂單詳情 #<?= $order["id"] ?></title>
    <?php include("./css.php") ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include("./sidebar.php") ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include("./topbar.php") ?>

                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <a href="order.php" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> 返回
                        </a>
                        <h2 class="mb-0">訂單詳情 #<?= $order["id"] ?></h2>
                    </div>

                    <!-- 訂單基本信息 -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6>訂單資訊</h6>
                                    <div class="mb-2">
                                        <small class="text-muted">訂單編號:</small>
                                        <div>#<?= $order["id"] ?></div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">訂單日期:</small>
                                        <div><?= date('Y/m/d H:i', strtotime($order["created_at"])) ?></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h6>會員資訊</h6>
                                    <div class="mb-2">
                                        <small class="text-muted">姓名:</small>
                                        <div><?= $order["user_name"] ?></div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Email:</small>
                                        <div><?= $order["user_email"] ?></div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">電話:</small>
                                        <div><?= $order["user_phone"] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h6>付款資訊</h6>
                                    <div class="mb-2">
                                        <small class="text-muted">總金額:</small>
                                        <div class="h5">NT$ <?= number_format($order["total_amount"]) ?></div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">付款狀態:</small>
                                        <div>
                                            <span class="badge <?= getStatusClass($order["payment_status"]) ?>">
                                                <?= $order["payment_status"] ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">付款方式:</small>
                                        <div><?= $order["payment_method"] ?></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h6>訂單狀態</h6>
                                    <?php if ($order["product_order_id"]): ?>
                                        <div class="mb-2">
                                            <small class="text-muted">商品訂單:</small>
                                            <div>
                                                <span class="badge <?= getStatusClass($order["product_status"]) ?>">
                                                    <?= $order["product_status"] ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($order["rental_order_id"]): ?>
                                        <div class="mb-2">
                                            <small class="text-muted">租借訂單:</small>
                                            <div>
                                                <span class="badge <?= getStatusClass($order["rental_status"]) ?>">
                                                    <?= $order["rental_status"] ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($order["activity_order_id"]): ?>
                                        <div class="mb-2">
                                            <small class="text-muted">活動訂單:</small>
                                            <div>
                                                <span class="badge <?= getStatusClass($order["activity_status"]) ?>">
                                                    <?= $order["activity_status"] ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 商品訂單明細 -->
                    <?php if ($productItems): ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">商品訂單明細</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>商品名稱</th>
                                                <th>單價</th>
                                                <th>數量</th>
                                                <th class="text-end">小計</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($productItems as $item): ?>
                                                <tr>
                                                    <td><?= $item["product_name"] ?></td>
                                                    <td>NT$ <?= number_format($item["unit_price"]) ?></td>
                                                    <td><?= $item["quantity"] ?></td>
                                                    <td class="text-end">NT$ <?= number_format($item["unit_price"] * $item["quantity"]) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="text-end">商品總計：</td>
                                                <td class="text-end">NT$ <?= number_format(array_sum(array_map(function ($item) {
                                                                                return $item["unit_price"] * $item["quantity"];
                                                                            }, $productItems))) ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- 租借訂單明細 -->
                    <?php if ($rentalItems): ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">租借訂單明細</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>租賃品項</th>
                                                <th>租賃期間</th>
                                                <th>日租金</th>
                                                <th>押金</th>
                                                <th class="text-end">小計</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($rentalItems as $item):
                                                $days = ceil((strtotime($item["end_date"]) - strtotime($item["start_date"])) / 86400);
                                            ?>
                                                <tr>
                                                    <td><?= $item["rent_item_name"] ?></td>
                                                    <td>
                                                        <?= date('Y/m/d', strtotime($item["start_date"])) ?> ~
                                                        <?= date('Y/m/d', strtotime($item["end_date"])) ?>
                                                        (<?= $days ?>天)
                                                    </td>
                                                    <td>NT$ <?= number_format($item["daily_rate"]) ?></td>
                                                    <td>NT$ <?= number_format($item["deposit"]) ?></td>
                                                    <td class="text-end">NT$ <?= number_format($item["daily_rate"] * $days) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" class="text-end">租賃總計：</td>
                                                <td class="text-end">NT$ <?= number_format($order["rental_subtotal"] ?? 0) ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end">押金總計：</td>
                                                <td class="text-end">NT$ <?= number_format($order["deposit_total"] ?? 0) ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- 活動訂單明細 -->
                    <?php if ($activityItems): ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">活動訂單明細</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>活動名稱</th>
                                                <th>參加人數</th>
                                                <th class="text-end">單價</th>
                                                <th class="text-end">小計</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($activityItems as $item): ?>
                                                <tr>
                                                    <td><?= $item["activity_name"] ?></td>
                                                    <td><?= $item["quantity"] ?></td>
                                                    <td class="text-end">NT$ <?= number_format($item["activity_price"]) ?></td>
                                                    <td class="text-end">NT$ <?= number_format($item["activity_price"] * $item["quantity"]) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="text-end">活動總計：</td>
                                                <td class="text-end">NT$ <?= number_format(array_sum(array_map(function ($item) {
                                                                                return $item["activity_price"] * $item["quantity"];
                                                                            }, $activityItems))) ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>