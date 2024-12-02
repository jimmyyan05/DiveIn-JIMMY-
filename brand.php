<?php
require_once("../db_project_connect.php");

// 獲取品牌列表
$sql = "SELECT 
    brand.*,
    COUNT(DISTINCT product_specification.product_id) as product_count,
    COUNT(DISTINCT CASE WHEN p.status = '上架中' THEN product_specification.product_id END) as active_products,
    GROUP_CONCAT(DISTINCT pcb.name) as categories
FROM brand
LEFT JOIN product_specification ON brand.id = product_specification.brand_id AND product_specification.isDeleted = 0
LEFT JOIN product p ON product_specification.product_id = p.id
LEFT JOIN product_category_small pcs ON p.product_category_small_id = pcs.id
LEFT JOIN product_category_big pcb ON pcs.product_category_big_id = pcb.id
GROUP BY brand.id";

// 如果有選擇字母過濾
$selectedLetter = isset($_GET['letter']) ? $_GET['letter'] : '';

if ($selectedLetter) {
    $sql = "SELECT 
        brand.*,
        COUNT(DISTINCT product_specification.product_id) as product_count
    FROM brand
    LEFT JOIN product_specification ON brand.id = product_specification.brand_id AND product_specification.isDeleted = 0
    WHERE brand.name LIKE ?
    GROUP BY brand.id
    ORDER BY brand.name ASC";

    $stmt = $conn->prepare($sql);
    $searchPattern = $selectedLetter . '%';
    $stmt->bind_param('s', $searchPattern);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($sql);
}

$brands = $result->fetch_all(MYSQLI_ASSOC);

// 獲取字母分類
$letters = range('A', 'Z');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>品牌管理</title>
    <?php include("./css.php") ?>
    <style>
        [data-bs-toggle="popover"] {
            cursor: pointer;
        }

        .popover {
            max-width: 300px;
        }

        .popover-info p {
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include("./sidebar.php") ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include("./topbar.php") ?>
                <!-- 麵包屑 -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb rounded-0 p-3">
                        <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                        <li class="breadcrumb-item active" aria-current="page">品牌</li>
                    </ol>
                </nav>
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>品牌管理</h2>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBrandModal">
                            <i class="fas fa-plus me-1"></i>新增品牌
                        </button>
                    </div>

                    <!-- 字母篩選 -->
                    <div class="mb-4">
                        <div class="btn-group">
                            <a href="brand.php" class="btn btn-outline-primary <?= empty($selectedLetter) ? 'active' : '' ?>">All</a>
                            <?php foreach ($letters as $letter): ?>
                                <a href="?letter=<?= $letter ?>"
                                    class="btn btn-outline-primary <?= $selectedLetter === $letter ? 'active' : '' ?>">
                                    <?= $letter ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- 品牌列表 -->
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>品牌名稱</th>
                                            <th>描述</th>
                                            <th>商品數量</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($brands as $brand): ?>
                                            <tr>
                                                <td>
                                                    <span data-bs-toggle="popover"
                                                        data-bs-content="
          <div class='popover-info'>
            <p>在售商品：<?= $brand['active_products'] ?> / <?= $brand['product_count'] ?></p>
            <?php if ($brand['categories']): ?>
            <p>商品類別：<?= $brand['categories'] ?></p>
            <?php endif; ?>
          </div>
          ">
                                                        <?= $brand["name"] ?>
                                                    </span>
                                                </td>
                                                <td><?= $brand["description"] ?></td>
                                                <td><?= $brand["product_count"] ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-outline-primary me-2"
                                                        onclick="editBrand(<?= $brand['id'] ?>)">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
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
        </div>
    </div>

    <!-- 新增品牌 Modal -->
    <div class="modal fade" id="addBrandModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">新增品牌</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="brandForm">
                        <div class="mb-3">
                            <label class="form-label">品牌名稱</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">描述</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" onclick="saveBrand()">儲存</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 編輯品牌 Modal -->
    <div class="modal fade" id="editBrandModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">編輯品牌</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editBrandForm">
                        <div class="mb-3">
                            <label class="form-label">品牌名稱</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">描述</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" onclick="updateBrand()">更新</button>
                </div>
            </div>
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

    <script>
        // 表單重置函數
        function resetForm(formId) {
            document.getElementById(formId).reset();
        }

        // 表單驗證函數
        function validateForm(formId) {
            const form = document.getElementById(formId);
            if (!form.checkValidity()) {
                form.reportValidity();
                return false;
            }
            return true;
        }

        // 儲存新品牌
        function saveBrand() {
            if (!validateForm('brandForm')) return;

            const form = document.getElementById('brandForm');
            const formData = new FormData(form);

            fetch('add_brand.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('品牌新增成功！');
                        resetForm('brandForm');
                        $('#addBrandModal').modal('hide');
                        location.reload();
                    } else {
                        alert('錯誤：' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('發生錯誤，請稍後再試');
                });
        }

        // 編輯品牌 ??? 明天修改幹好煩弄不好
        function editBrand(id) {
            fetch(`get_brand.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success === false) {
                        alert(data.message);
                        return;
                    }
                    document.querySelector('#editBrandModal [name="name"]').value = data.name || '';
                    document.querySelector('#editBrandModal [name="description"]').value = data.description || '';
                    document.querySelector('#editBrandModal form').dataset.id = id;
                    const modal = new bootstrap.Modal(document.getElementById('editBrandModal'));
                    modal.show();
                });
        }

        // 更新品牌
        function updateBrand() {
            if (!validateForm('editBrandForm')) return;

            const form = document.querySelector('#editBrandModal form');
            const formData = new FormData(form);
            formData.append('id', form.dataset.id);

            fetch('update_brand.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('品牌更新成功！');
                        $('#editBrandModal').modal('hide');
                        location.reload();
                    } else {
                        alert('錯誤：' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('更新時發生錯誤，請稍後再試');
                });
        }

        // Modal關閉時重置表單
        $('#addBrandModal, #editBrandModal').on('hidden.bs.modal', function() {
            resetForm(this.querySelector('form').id);
        });

        // 在你原本的 script 區塊加入
        $(document).ready(function() {
            $('[data-bs-toggle="popover"]').popover({
                trigger: 'hover',
                html: true,
                placement: 'right'
            });
        });
    </script>
</body>

</html>