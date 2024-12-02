<?php
require_once("../db_project_connect.php");

$sql = "SELECT 
            product.*,
            GROUP_CONCAT(DISTINCT CONCAT(
                'Size:', size.name, 
                ' Material:', material.name,
                ' Color:', color.name,
                ' Brand:', brand.name
            )) as specifications,
            GROUP_CONCAT(DISTINCT product_image.imgUrl) as imgUrl  -- 改用 imgUrl
        FROM product 
        LEFT JOIN product_specification 
            ON product.id = product_specification.product_id 
            AND product_specification.isDeleted = 1
        LEFT JOIN size 
            ON product_specification.size_id = size.id
        LEFT JOIN material 
            ON product_specification.material_id = material.id
        LEFT JOIN color 
            ON product_specification.color_id = color.id
        LEFT JOIN brand 
            ON product_specification.brand_id = brand.id
        LEFT JOIN product_image 
            ON product.id = product_image.product_id 
        WHERE product.isDeleted = 1
        GROUP BY product.id
        ORDER BY product.deleted_at DESC";

try {
    if (!$result = $conn->query($sql)) {
        throw new Exception("查詢失敗: " . $conn->error);
    }
} catch (Exception $e) {
    echo "錯誤: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品垃圾桶</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">商品垃圾桶</h1>
            <a href="product.php" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> 返回商品列表
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>編號</th>
                                <th>商品名稱</th>
                                <th>價格</th>
                                <th>規格</th>
                                <th>圖片</th>
                                <th>刪除時間</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $row["id"] ?></td>
                                        <td><?= $row["name"] ?></td>
                                        <td>$<?= number_format($row["price"]) ?></td>
                                        <td>
                                            <?php
                                            if ($row["specifications"]) {
                                                echo str_replace(",", "<br>", $row["specifications"]);
                                            } else {
                                                echo "無規格";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row["imgUrl"]) {
                                                $images = explode(",", $row["imgUrl"]);
                                                foreach ($images as $image): ?>
                                                    <img src="img/product/<?= $image ?>" style="width: 50px; height: 50px; object-fit: cover;" class="me-1">
                                            <?php endforeach;
                                            } else {
                                                echo "無圖片";
                                            }
                                            ?>
                                        </td>
                                        <td><?= date('Y-m-d H:i:s', strtotime($row["deleted_at"])) ?></td>
                                        <td>
                                            <button onclick="restoreProduct(<?= $row['id'] ?>)" class="btn btn-success btn-sm">
                                                <i class="fas fa-trash-restore"></i> 復原
                                            </button>
                                            <button onclick="permanentDelete(<?= $row['id'] ?>)" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i> 永久刪除
                                            </button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">垃圾桶中沒有商品</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        function restoreProduct(id) {
            if (confirm('確定要復原此商品嗎？')) {
                fetch('restore.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id: id
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.status === 'success') {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert(data.message || '操作失敗');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('操作失敗，請稍後再試');
                    });
            }
        }

        function permanentDelete(id) {
            if (confirm('確定要永久刪除此商品嗎？此操作無法復原！')) {
                fetch('permanent_delete_product.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id: id
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.status === 'success') {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert(data.message || '操作失敗');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('操作失敗，請稍後再試');
                    });
            }
        }
    </script>
</body>

</html>