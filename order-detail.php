<?php
require_once("../db_project_connect.php");
// var_dump($row);
// echo $conn->error;

$id = $_GET["id"];

$sql = "SELECT order_list.*, product_order.*, product_order_detail.*, product.name as product_name
FROM order_list 
LEFT JOIN product_order ON order_list.product_order_id = product_order.id 
LEFT JOIN product_order_detail ON product_order.id = product_order_detail.order_id
LEFT JOIN product ON product_order_detail.product_id = product.id
WHERE order_list.id = 1;";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
    <title>訂單詳情</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <div class="d-flex align-items-center mb-4">
            <a href="order-list.php" class="btn btn-outline-secondary me-3">
                <i class="bi bi-arrow-left"></i> 返回
            </a>
            <h2 class="mb-0">訂單詳情 #<?= $row["id"] ?></h2>
        </div>

        <!-- 訂單摘要卡片 -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <small class="text-muted">訂單類型</small>
                        <div class="mt-1">
                            <?php if ($row["product_order_id"]): ?>
                                <span class="badge bg-primary me-1">商品</span>
                            <?php endif; ?>
                            <?php if ($row["rent_order_id"]): ?>
                                <span class="badge bg-info me-1">租借</span>
                            <?php endif; ?>
                            <?php if ($row["activity_order_id"]): ?>
                                <span class="badge bg-success">課程</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted">訂單日期</small>
                        <p class="mt-1 mb-0"><?= $row["orderDate"] ?></p>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted">總金額</small>
                        <p class="mt-1 mb-0">NT$ <?= number_format($row["totalAmount"]) ?></p>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted">訂單狀態</small>
                        <div class="mt-1">
                            <span class="badge bg-warning"><?= $row["status"] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 訂單詳情標籤 -->
        <ul class="nav nav-tabs mb-4">
            <?php if ($row["product_order_id"]): ?>
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#product">
                        商品訂單明細
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($row["rent_order_id"]): ?>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#rental">
                        租借訂單明細
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($row["activity_order_id"]): ?>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#activity">
                        課程訂單明細
                    </a>
                </li>
            <?php endif; ?>
        </ul>

        <!-- 標籤內容 -->
        <div class="tab-content">
            <?php if ($row["product_order_id"]): ?>
                <div class="tab-pane fade show active" id="product">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>商品名稱</th>
                                <th>單價</th>
                                <th>數量</th>
                                <th>小計</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $row["product_name"] ?></td>
                                <td>NT$ <?= number_format($row["price"]) ?></td>
                                <td><?= $row["quantity"] ?></td>
                                <td>NT$ <?= number_format($row["price"] * $row["quantity"]) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <?php if ($row["rent_order_id"]): ?>
                <div class="tab-pane fade" id="rental">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>租借品項</th>
                                <th>租借日期</th>
                                <th>歸還日期</th>
                                <th>租金</th>
                                <th>狀態</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $row["rentitem_name"] ?></td>
                                <td><?= $row["startDate"] ?></td>
                                <td><?= $row["endDate"] ?></td>
                                <td>NT$ <?= number_format($row["price"]) ?></td>
                                <td>
                                    <span class="badge bg-info"><?= $row["status"] ?></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <?php if ($row["activity_order_id"]): ?>
                <div class="tab-pane fade" id="activity">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>課程名稱</th>
                                <th>上課日期</th>
                                <th>費用</th>
                                <th>狀態</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $row["activity_name"] ?></td>
                                <td><?= $row["courseDate"] ?></td>
                                <td>NT$ <?= number_format($row["price"]) ?></td>
                                <td>
                                    <span class="badge bg-success"><?= $row["status"] ?></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>