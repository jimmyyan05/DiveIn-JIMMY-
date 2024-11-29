<?php
require_once("../db_project_connect.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_GET["id"])) {
    die("錯誤：未指定商品 ID");
}

// 接收
$id = $_GET["id"];

// 查詢商品和分類資訊
$sql = "SELECT 
    product.*,
    product_image.imgUrl as main_image_url,  
    product_image.name AS main_image_name,  
    product_category_small.name AS category_name,
    product_category_small.id AS category_small_id,
    product_category_small.product_category_big_id,
    product_category_big.name AS big_category_name,
    product_category_big.id AS category_big_id,
    product_specification.id AS spec_id,
    product_specification.size_id,
    product_specification.color_id,
    product_specification.brand_id,
    size.name AS size_name,
    color.name AS color_name,
    brand.name AS brand_name
FROM product 
LEFT JOIN product_image ON product_image.product_id = product.id AND product_image.isMain = 1 AND product_image.isDeleted = 0
LEFT JOIN product_category_small ON product.product_category_small_id = product_category_small.id
LEFT JOIN product_category_big ON product_category_big.id = product_category_small.product_category_big_id
LEFT JOIN product_specification ON product_specification.product_id = product.id
LEFT JOIN size ON size.id = product_specification.size_id
LEFT JOIN color ON color.id = product_specification.color_id
LEFT JOIN brand ON brand.id = product_specification.brand_id
WHERE product.id = ? AND product.isDeleted = 0";

try {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("找不到該商品");
    }

    $product = $result->fetch_assoc();

    // 取得所有大分類
    $sql_big = "SELECT * FROM product_category_big ORDER BY id";
    $result_big = $conn->query($sql_big);
    $big_categories = $result_big->fetch_all(MYSQLI_ASSOC);

    // 取得所有小分類
    $sql_small = "SELECT * FROM product_category_small ORDER BY product_category_big_id, id";
    $result_small = $conn->query($sql_small);
    $small_categories = $result_small->fetch_all(MYSQLI_ASSOC);
    // 在這裡加入查詢商品圖片的程式碼
    $img_sql = "SELECT * FROM product_image WHERE product_id = ? AND isDeleted = 0 ";
    $img_stmt = $conn->prepare($img_sql);
    $img_stmt->bind_param("i", $id);
    $img_stmt->execute();
    $img_result = $img_stmt->get_result();
    $images = $img_result->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    die("發生錯誤: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="zh-TW">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改商品 - <?= htmlspecialchars($product["name"]) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .info-label {
            color: #666;
            font-size: 0.9em;
        }

        .image-preview {
            max-width: 200px;
            max-height: 200px;
            object-fit: contain;
        }

        .preview-container {
            border: 1px solid #dee2e6;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        /* 自定義下拉選單選項樣式 */
        select option[selected] {
            background-color: #e3f2fd !important;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="card-title mb-0">修改商品資料</h2>
                        <a href="product.php" class="btn btn-secondary">返回列表</a>
                    </div>
                    <div class="card-body">
                        <form action="update_product.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $product["id"] ?>">

                            <!-- 主要內容區域 -->
                            <div class="row">
                                <!-- 左側：基本資訊 -->
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">商品名稱</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="<?= htmlspecialchars($product["name"]) ?>" required>
                                    </div>

                                    <!-- 分類選擇 -->
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="category_big" class="form-label">主分類</label>
                                            <select class="form-select" id="category_big" name="category_big">
                                                <option value="">請選擇主分類</option>
                                                <?php foreach ($big_categories as $big): ?>
                                                    <?php
                                                    $selected = ($big["id"] == $product["product_category_big_id"]) ? 'selected' : '';
                                                    if ($selected) {
                                                        echo "<option value='{$big["id"]}' {$selected} style='background-color: #e3f2fd;'>🔹 " . htmlspecialchars($big["name"]) . " (目前)</option>";
                                                    } else {
                                                        echo "<option value='{$big["id"]}' {$selected}>" . htmlspecialchars($big["name"]) . "</option>";
                                                    }
                                                    ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="category_small" class="form-label">子分類</label>
                                            <select class="form-select" id="category_small" name="category_small">
                                                <option value="">請選擇子分類</option>
                                                <?php foreach ($small_categories as $small): ?>
                                                    <?php
                                                    $selected = ($small["id"] == $product["product_category_small_id"]) ? 'selected' : '';
                                                    if ($selected) {
                                                        echo "<option value='{$small["id"]}' data-big-id='{$small["product_category_big_id"]}' {$selected} style='background-color: #e3f2fd;'>🔹 " .
                                                            htmlspecialchars($small["name"]) .
                                                            " (目前)</option>";
                                                    } else {
                                                        echo "<option value='{$small["id"]}' data-big-id='{$small["product_category_big_id"]}' {$selected}>" .
                                                            htmlspecialchars($small["name"]) .
                                                            "</option>";
                                                    }
                                                    ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="price" class="form-label">價格</label>
                                            <div class="input-group">
                                                <span class="input-group-text">NT$</span>
                                                <input type="number" class="form-control" id="price" name="price"
                                                    value="<?= $product["price"] ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="stock" class="form-label">庫存</label>
                                            <input type="number" class="form-control" id="stock" name="stock"
                                                value="<?= $product["stock"] ?>" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="status" class="form-label">商品狀態</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="上架中" <?= ($product["status"] == "上架中") ? 'selected' : '' ?>>上架中</option>
                                                <option value="下架中" <?= ($product["status"] == "下架中") ? 'selected' : '' ?>>下架中</option>
                                                <option value="待上架" <?= ($product["status"] == "待上架") ? 'selected' : '' ?>>待上架</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- 右側：商品規格 -->
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">商品規格</h5>
                                        </div>
                                        <div class="card-body">
                                            <!-- 尺寸 -->
                                            <div class="mb-3">
                                                <label for="size" class="form-label">尺寸</label>
                                                <select class="form-select" id="size" name="size_id" required>
                                                    <option value="">請選擇尺寸</option>
                                                    <?php
                                                    $sql_size = "SELECT * FROM size ORDER BY id";
                                                    $result_size = $conn->query($sql_size);
                                                    while ($size = $result_size->fetch_assoc()) {
                                                        $selected = (!empty($product["size_id"]) && $size["id"] == $product["size_id"]) ? 'selected' : '';
                                                        $currentClass = $selected ? 'style="background-color: #e3f2fd;"' : '';
                                                        $currentMark = $selected ? '🔹 ' : '';
                                                        echo "<option value='{$size['id']}' {$selected} {$currentClass}>{$currentMark}{$size['name']}" . ($selected ? ' (目前)' : '') . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <!-- 顏色 -->
                                            <div class="mb-3">
                                                <label for="color" class="form-label">顏色</label>
                                                <select class="form-select" id="color" name="color_id" required>
                                                    <option value="">請選擇顏色</option>
                                                    <?php
                                                    $sql_color = "SELECT * FROM color ORDER BY id";
                                                    $result_color = $conn->query($sql_color);
                                                    while ($color = $result_color->fetch_assoc()) {
                                                        $selected = (!empty($product["color_id"]) && $color["id"] == $product["color_id"]) ? 'selected' : '';
                                                        $currentClass = $selected ? 'style="background-color: #e3f2fd;"' : '';
                                                        $currentMark = $selected ? '🔹 ' : '';
                                                        echo "<option value='{$color['id']}' {$selected} {$currentClass}>{$currentMark}{$color['name']}" . ($selected ? ' (目前)' : '') . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <!-- 品牌 -->
                                            <div class="mb-3">
                                                <label for="brand" class="form-label">品牌</label>
                                                <select class="form-select" id="brand" name="brand_id" required>
                                                    <option value="">請選擇品牌</option>
                                                    <?php
                                                    $sql_brand = "SELECT * FROM brand ORDER BY id";
                                                    $result_brand = $conn->query($sql_brand);
                                                    while ($brand = $result_brand->fetch_assoc()) {
                                                        $selected = (!empty($product["brand_id"]) && $brand["id"] == $product["brand_id"]) ? 'selected' : '';
                                                        $currentClass = $selected ? 'style="background-color: #e3f2fd;"' : '';
                                                        $currentMark = $selected ? '🔹 ' : '';
                                                        echo "<option value='{$brand['id']}' {$selected} {$currentClass}>{$currentMark}{$brand['name']}" . ($selected ? ' (目前)' : '') . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 圖片管理區塊 -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">商品圖片管理</h5>
                                        </div>
                                        <div class="card-body">
                                            <!-- 現有圖片顯示區 -->
                                            <div class="mb-4">
                                                <label class="form-label">現有圖片</label>
                                                <div class="row g-2" id="existingImages">
                                                    <?php if (!empty($images)): ?>
                                                        <?php foreach ($images as $img): ?>
                                                            <div class="col-md-3 mb-2">
                                                                <div class="card h-100" data-image-id="<?= $img['id'] ?>">
                                                                    <img src="img/<?= htmlspecialchars($img['imgUrl']) ?>"
                                                                        class="card-img-top"
                                                                        style="height: 150px; object-fit: cover;"
                                                                        alt="<?= htmlspecialchars($img['name']) ?>">
                                                                    <div class="card-body p-2">
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <div class="form-check">
                                                                                <input type="radio"
                                                                                    class="form-check-input"
                                                                                    name="mainImage"
                                                                                    value="<?= $img['id'] ?>"
                                                                                    <?= $img['isMain'] ? 'checked' : '' ?>>
                                                                                <label class="form-check-label small">主圖</label>
                                                                            </div>
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm"
                                                                                onclick="deleteImage(<?= $img['id'] ?>)"
                                                                                data-image-id="<?= $img['id'] ?>">
                                                                                刪除
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <div class="col-12">
                                                            <div class="alert alert-info mb-0">
                                                                目前沒有商品圖片
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <!-- 新增圖片區域 -->
                                            <div>
                                                <label for="photos" class="form-label">新增圖片</label>
                                                <input type="file" class="form-control" id="photos" name="photos[]" accept="image/*" multiple>
                                                <div id="imagePreview" class="row mt-2 g-2">
                                                    <!-- 新圖片的預覽會顯示在這裡 -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 時間資訊 -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="info-label mb-1">
                                                        建立時間：<?= date('Y/m/d H:i:s', strtotime($product["created_at"])) ?>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="info-label mb-1">
                                                        最後更新：<?= date('Y/m/d H:i:s', strtotime($product["updated_at"])) ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 按鈕區 -->
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary">儲存修改</button>
                            </div>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

                    <!-- 圖片預覽 -->
                    <script>
                        // 分類連動
                        document.getElementById('category_big').addEventListener('change', function() {
                            updateSmallCategories();
                        });

                        // 更新小分類的函數
                        function updateSmallCategories() {
                            const bigCategoryId = document.getElementById('category_big').value;
                            const smallSelect = document.getElementById('category_small');
                            const smallOptions = smallSelect.getElementsByTagName('option');
                            const currentSmallCategoryId = '<?= $product["product_category_small_id"] ?>'; // 獲取當前產品的小分類 ID

                            // 重置小分類選單，但不清空選擇的值
                            // 先隱藏所有選項
                            for (let option of smallOptions) {
                                if (option.value === '') {
                                    option.style.display = 'block'; // 永遠顯示預設選項
                                    continue;
                                }

                                const optionBigId = option.getAttribute('data-big-id');
                                if (optionBigId === bigCategoryId) {
                                    option.style.display = 'block';
                                } else {
                                    option.style.display = 'none';
                                }
                            }

                            // 檢查當前選擇的小分類是否屬於所選的大分類
                            let hasValidSelection = false;
                            for (let option of smallOptions) {
                                if (option.value === currentSmallCategoryId && option.getAttribute('data-big-id') === bigCategoryId) {
                                    hasValidSelection = true;
                                    break;
                                }
                            }

                            // 如果當前選擇的小分類不屬於所選的大分類，則清空選擇
                            if (!hasValidSelection) {
                                smallSelect.value = '';
                            }
                        }

                        // 頁面載入時觸發一次分類連動
                        document.addEventListener('DOMContentLoaded', function() {
                            updateSmallCategories();
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
                        document.querySelector('form').addEventListener('submit', function(e) {
                            const size = document.getElementById('size').value;
                            const color = document.getElementById('color').value;
                            const brand = document.getElementById('brand').value;

                            if (!size || !color || !brand) {
                                e.preventDefault();
                                alert('請選擇完整的商品規格！');
                            }
                        });


                        // 新增圖片預覽功能
                        // 新增圖片預覽功能
                        const input_file = document.getElementById('photos');
                        const preview = document.getElementById('imagePreview');

                        input_file.addEventListener("change", (e) => {
                            preview.innerHTML = ''; // 每次選擇圖片時先清空預覽
                            for (let i = 0; i < e.target.files.length; i++) {
                                const file = e.target.files[i];
                                const src = URL.createObjectURL(file); // 使用這個方法建立預覽
                                const div = document.createElement('div');
                                div.className = 'col-md-3 mb-3';

                                div.innerHTML = `
            <div class="card h-100">
                <img src="${src}" 
                    class="card-img-top" 
                    style="height: 150px; object-fit: cover;"
                    alt="預覽圖片">
                <div class="card-footer p-2 bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted text-truncate" style="max-width: 120px;" title="${file.name}">
                            ${file.name}
                        </small>
                        <button type="button" class="btn btn-outline-danger btn-sm" 
                                onclick="removePreview(this)">
                            刪除
                        </button>
                    </div>
                </div>
            </div>
        `;
                                preview.appendChild(div);
                            }
                        });

                        // 改為刪除預覽圖片的功能
                        function removePreview(button) {
                            const previewCard = button.closest('.col-md-3');
                            previewCard.remove();

                            // 檢查是否還有預覽圖片
                            const preview = document.getElementById('imagePreview');
                            if (preview.querySelectorAll('.col-md-3').length === 0) {
                                preview.innerHTML = ''; // 如果沒有預覽圖片了，清空預覽區
                            }
                        }



                        // 重置檔案輸入
                        const fileInput = document.getElementById('photos');
                        fileInput.value = '';



                        // 刪除現有圖片功能
                        function deleteImage(imageId) {
                            if (!confirm('確定要刪除這張圖片嗎？')) return;

                            fetch(`delete_image.php?id=${imageId}`, {
                                    method: 'POST'
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        // 從 DOM 中移除圖片卡片
                                        const imageCard = document.querySelector(`[data-image-id="${imageId}"]`);
                                        if (imageCard) {
                                            imageCard.remove();
                                        }
                                    } else {
                                        alert('刪除圖片失敗：' + data.message);
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('刪除圖片時發生錯誤');
                                });
                        }
                        // 將原本的程式碼包在 DOMContentLoaded 事件中
                        document.addEventListener('DOMContentLoaded', function() {
                            const mainImageRadios = document.querySelectorAll('input[name="mainImage"]');

                            mainImageRadios.forEach(radio => {
                                radio.addEventListener('change', function() {
                                    const imageId = this.value;
                                    const productId = document.querySelector('input[name="id"]').value;

                                    fetch('set_main_image.php', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/x-www-form-urlencoded',
                                            },
                                            body: `image_id=${imageId}&product_id=${productId}`
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                // 更新所有 radio buttons 的狀態
                                                mainImageRadios.forEach(otherRadio => {
                                                    otherRadio.checked = (otherRadio.value === imageId);
                                                });
                                                alert(data.message);
                                            } else {
                                                alert('設定主圖失敗：' + data.message);
                                                this.checked = false;
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            alert('設定主圖時發生錯誤');
                                            this.checked = false;
                                        });
                                });
                            });
                        });
                    </script>
</body>

</html>