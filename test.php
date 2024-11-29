<?php
// categories.php
// header('Content-Type: application/json');
require_once("../db_project_connect.php"); // 使用你的資料庫連線檔

// 查詢大分類和小分類
$sql = "SELECT 
            product_category_big.id as big_id,
            product_category_big.name as big_name,
            product_category_big.description as big_description,
            product_category_small.id as small_id,
            product_category_small.name as small_name,
            product_category_small.description as small_description
        FROM product_category_big product_category_big
        LEFT JOIN product_category_small product_category_small ON product_category_big.id = product_category_small.product_category_big_id
        ORDER BY product_category_big.id, product_category_small.id";

$result = $conn->query($sql);

// 準備資料結構
$categories = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // 如果這個大分類還沒有被加入到陣列中
        if (!isset($categories[$row['big_id']])) {
            $categories[$row['big_id']] = [
                'id' => $row['big_id'],
                'name' => $row['big_name'],
                'description' => $row['big_description'],
                'subcategories' => []
            ];
        }

        // 如果有小分類，則加入到對應的大分類中
        if ($row['small_id']) {
            $categories[$row['big_id']]['subcategories'][] = [
                'id' => $row['small_id'],
                'name' => $row['small_name'],
                'description' => $row['small_description']
            ];
        }
    }
}

// 轉換關聯陣列為索引陣列
$categoryArray = array_values($categories);

// 回傳 JSON 格式的資料
echo json_encode([
    'success' => true,
    'data' => $categoryArray
], JSON_UNESCAPED_UNICODE);

// 關閉資料庫連線
$conn->close();
?>

<!-- index.html -->
<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>分類管理</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f5f5;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .category-card {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .category-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .subcategories {
            margin-top: 10px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        .subcategory-item {
            padding: 5px;
            border-bottom: 1px solid #eee;
        }

        .controls button {
            border: none;
            padding: 5px;
            margin: 2px;
            border-radius: 4px;
        }

        .add-category-card {
            border: 2px dashed #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .add-category-card h5 {
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>分類管理</h2>
            <button class="btn btn-primary" onclick="showAddCategoryModal()">+ 新增分類</button>
        </div>
        <div id="categoriesContainer" class="grid-container">
            <!-- Categories will be dynamically inserted here -->
        </div>
    </div>

    <?php
    // categories.php
    header('Content-Type: application/json');
    require_once("../db_project_connect.php"); // 使用你的資料庫連線檔

    // 查詢大分類和小分類
    $sql = "SELECT 
            product_category_big.id as big_id,
            product_category_big.name as big_name,
            product_category_big.description as big_description,
            product_category_small.id as small_id,
            product_category_small.name as small_name,
            product_category_small.description as small_description
        FROM product_category_big product_category_big
        LEFT JOIN product_category_small product_category_small ON product_category_big.id = product_category_small.product_category_big_id
        ORDER BY product_category_big.id, product_category_small.id";

    $result = $conn->query($sql);

    // 準備資料結構
    $categories = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // 如果這個大分類還沒有被加入到陣列中
            if (!isset($categories[$row['big_id']])) {
                $categories[$row['big_id']] = [
                    'id' => $row['big_id'],
                    'name' => $row['big_name'],
                    'description' => $row['big_description'],
                    'subcategories' => []
                ];
            }

            // 如果有小分類，則加入到對應的大分類中
            if ($row['small_id']) {
                $categories[$row['big_id']]['subcategories'][] = [
                    'id' => $row['small_id'],
                    'name' => $row['small_name'],
                    'description' => $row['small_description']
                ];
            }
        }
    }

    // 轉換關聯陣列為索引陣列
    $categoryArray = array_values($categories);

    // 回傳 JSON 格式的資料
    echo json_encode([
        'success' => true,
        'data' => $categoryArray
    ], JSON_UNESCAPED_UNICODE);

    // 關閉資料庫連線
    $conn->close();
    ?>
</body>

</html>