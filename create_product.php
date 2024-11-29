<?php
require_once("../db_project_connect.php");

// 查詢主分類
$sql_big = "SELECT * FROM product_category_big ORDER BY id";
$result_big = $conn->query($sql_big);
$big_categories = $result_big->fetch_all(MYSQLI_ASSOC);

// 查詢所有子分類
$sql_small = "SELECT * FROM product_category_small ORDER BY product_category_big_id, id";
$result_small = $conn->query($sql_small);
$small_categories = $result_small->fetch_all(MYSQLI_ASSOC);

// 查詢尺寸
$sql_size = "SELECT * FROM size ORDER BY id";
$result_size = $conn->query($sql_size);

// 查詢顏色
$sql_color = "SELECT * FROM color ORDER BY id";
$result_color = $conn->query($sql_color);

// 查詢品牌
$sql_brand = "SELECT * FROM brand ORDER BY id";
$result_brand = $conn->query($sql_brand);
?>

<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增商品</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <?php if (isset($_GET["error"])): ?>
            <div class="alert alert-danger">
                <?= $_GET["error"] ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="card-title mb-0">新增商品</h2>
                <a href="product.php" class="btn btn-secondary">返回列表</a>
            </div>
            <div class="card-body">
                <form action="docreate_product.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <!-- 左側表單內容 -->
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="name" class="form-label">商品名稱</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <!-- 分類選擇 -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="category_big" class="form-label">主分類</label>
                                    <select class="form-select" id="category_big" name="category_big" required>
                                        <option value="">請選擇主分類</option>
                                        <?php foreach ($big_categories as $big): ?>
                                            <option value="<?= $big["id"] ?>">
                                                <?= htmlspecialchars($big["name"]) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="category_small" class="form-label">子分類</label>
                                    <select class="form-select" id="category_small" name="category_small" required>
                                        <option value="">請選擇子分類</option>
                                        <?php foreach ($small_categories as $small): ?>
                                            <option value="<?= $small["id"] ?>"
                                                data-big-id="<?= $small["product_category_big_id"] ?>"
                                                style="display: none;">
                                                <?= htmlspecialchars($small["name"]) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- 價格與庫存 -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="price" class="form-label">價格</label>
                                    <div class="input-group">
                                        <span class="input-group-text">NT$</span>
                                        <input type="number" class="form-control" id="price" name="price" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="stock" class="form-label">庫存</label>
                                    <input type="number" class="form-control" id="stock" name="stock" required>
                                </div>
                            </div>

                            <!-- 商品規格 -->
                            <div class="row mb-3">
                                <h4 class="mt-4 mb-3">商品規格</h4>
                                <div class="col-md-4">
                                    <label for="size" class="form-label">尺寸</label>
                                    <select class="form-select" id="size" name="size_id">
                                        <option value="">請選擇尺寸</option>
                                        <?php while ($size = $result_size->fetch_assoc()): ?>
                                            <option value="<?= $size["id"] ?>"><?= htmlspecialchars($size["name"]) ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="color" class="form-label">顏色</label>
                                    <select class="form-select" id="color" name="color_id">
                                        <option value="">請選擇顏色</option>
                                        <?php while ($color = $result_color->fetch_assoc()): ?>
                                            <option value="<?= $color["id"] ?>"><?= htmlspecialchars($color["name"]) ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="brand" class="form-label">品牌</label>
                                    <select class="form-select" id="brand" name="brand_id">
                                        <option value="">請選擇品牌</option>
                                        <?php while ($brand = $result_brand->fetch_assoc()): ?>
                                            <option value="<?= $brand["id"] ?>"><?= htmlspecialchars($brand["name"]) ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- 商品圖片 -->
                            <div class="mb-3">
                                <label for="photo" class="form-label">商品圖片</label>
                                <input type="file" class="form-control" id="photo" name="photo[]" accept="image/*" multiple required>
                            </div>

                            <button type="submit" class="btn btn-primary">新增商品</button>
                        </div>

                        <!-- 右側圖片預覽 -->
                        <div class="col-md-4">
                            <h5 class="mb-3">圖片預覽</h5>
                            <div class="content border rounded p-2" style="min-height: 200px;">
                                <!-- 預覽圖片將動態生成並插入這裡 -->
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('category_big').addEventListener('change', function() {
            const bigCategoryId = this.value;
            const smallSelect = document.getElementById('category_small');
            const smallOptions = smallSelect.getElementsByTagName('option');

            // 重置小分類選單
            smallSelect.value = '';

            // 顯示/隱藏對應的小分類選項
            for (let option of smallOptions) {
                if (option.value === '') {
                    option.style.display = 'block'; // 永遠顯示預設選項
                    continue;
                }

                // 將兩個值都轉為字串進行比較
                const optionBigId = option.getAttribute('data-big-id');
                if (optionBigId === bigCategoryId) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            }
        });

        // 頁面載入時觸發一次分類連動
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('category_big').dispatchEvent(new Event('change'));
        });

        //圖片預覽  
        const input_file = document.querySelector("#photo");
        const content = document.querySelector(".content");

        input_file.addEventListener("change", (e) => {
            // 清空舊的預覽
            content.innerHTML = '';

            for (let i = 0; i < e.currentTarget.files.length; i++) {
                const file = e.currentTarget.files[i];
                const src = URL.createObjectURL(file);
                const node = document.createElement("img");
                node.src = src;
                node.style.width = "100%";
                node.style.marginBottom = "10px";
                node.style.objectFit = "cover";
                node.style.borderRadius = "5px";
                content.append(node);
            }
        });

        // 表單提交前檢查
        document.querySelector('form').addEventListener('submit', function(e) {
            const smallSelect = document.getElementById('category_small');
            if (!smallSelect.value) {
                e.preventDefault();
                alert('請選擇子分類！');
                smallSelect.focus();
            }
        });
    </script>
</body>

</html>