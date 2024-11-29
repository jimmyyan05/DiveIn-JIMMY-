<?php
require_once("../db_project_connect.php");

$sql = "SELECT order_list.*, 
    GROUP_CONCAT(DISTINCT product_order.id) AS product_ids, 
    GROUP_CONCAT(DISTINCT rent_order.id) AS rent_ids, 
    GROUP_CONCAT(DISTINCT activity_order.id) AS activity_ids 
FROM order_list 
LEFT JOIN product_order ON order_list.product_order_id = product_order.id
LEFT JOIN rent_order ON order_list.rent_order_id = rent_order.id 
LEFT JOIN activity_order ON order_list.activity_order_id = activity_order.id
GROUP BY order_list.id";


$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>訂單列表</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <h2>訂單列表</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>訂單編號</th>
                            <th>訂單類型</th>
                            <th>訂單日期</th>
                            <th>總金額</th>
                            <th>付款狀態</th>
                            <th>訂單狀態</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row):
                            $orderTypes = [];
                            if ($row["product_order_id"]) $orderTypes[] = "商品";
                            if ($row["rent_order_id"]) $orderTypes[] = "租借";
                            if ($row["activity_order_id"]) $orderTypes[] = "課程";
                        ?>
                            <tr>
                                <td><?= $row["id"] ?></td>
                                <td>
                                    <?php foreach ($orderTypes as $type): ?>
                                        <span class="badge bg-primary"><?= $type ?></span>
                                    <?php endforeach; ?>
                                </td>
                                <td><?= $row["orderDate"] ?></td>
                                <td>NT$ <?= number_format($row["totalAmount"]) ?></td>
                                <td>
                                    <span class="badge <?= $row["payment_status"] == "paid" ? "bg-success" : "bg-warning" ?>">
                                        <?= $row["payment_status"] == "paid" ? "已付款" : "未付款" ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge <?= $row["status"] == "processing" ? "bg-info" : "bg-secondary" ?>">
                                        <?= $row["status"] ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="order-detail.php?id=<?= $row["id"] ?>" class="btn btn-sm btn-outline-primary">查看詳情</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>