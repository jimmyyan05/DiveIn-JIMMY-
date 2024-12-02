<?php
require_once("../db_project_connect.php");

$sql = "SELECT 
    product_category_big.id as big_id,
    product_category_big.name as big_name,
    product_category_big.description as big_description,
    product_category_small.id as small_id,
    product_category_small.name as small_name,
    product_category_small.description as small_description
FROM product_category_big
LEFT JOIN product_category_small ON product_category_big.id = product_category_small.product_category_big_id
ORDER BY product_category_big.id, product_category_small.id";

$result = $conn->query($sql);
$categories = array();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $big_id = $row['big_id'];
        if (!isset($categories[$big_id])) {
            $categories[$big_id] = [
                'id' => $big_id,
                'name' => $row['big_name'],
                'description' => $row['big_description'],
                'subcategories' => []
            ];
        }
        if ($row['small_id']) {
            $categories[$big_id]['subcategories'][] = [
                'id' => $row['small_id'],
                'name' => $row['small_name'],
                'description' => $row['small_description']
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Tables</title>
    <?php include("./css.php") ?>
    <style>
        body {
            background: #f5f5f5;
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
        }

        .category-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .subcategories {
            position: relative;
            min-height: 50px;
            padding: 12px;
            margin: 8px;
            border: 1px dashed #ccc;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .subcategory-item {
            margin: 4px 0;
            padding: 8px 12px;
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            cursor: grab;
            transition: transform 0.2s ease;
            user-select: none;
            position: relative;
        }

        .subcategory-description {
            display: none;
            position: absolute;
            background: white;
            padding: 8px;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            z-index: 100;
            min-width: 200px;
        }

        .subcategory-item:hover .subcategory-description {
            display: block;
        }

        .subcategory-item.dragging {
            opacity: 0.5;
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .subcategory-item:active {
            cursor: grabbing;
        }

        .drag-over {
            background-color: #e9ecef;
            border: 2px dashed #6c757d;
        }

        .controls button {
            border: none;
            padding: 5px;
            margin: 2px;
            border-radius: 4px;
        }

        .delete-zone {
            padding: 20px;
            border: 2px dashed #dc3545;
            text-align: center;
            margin: 10px;
            transition: 0.3s;
        }

        .delete-zone.drag-over {
            background: #dc3545;
            color: white;
        }

        #deleteZone {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: rgba(255, 0, 0, 0.5);
            padding: 10px;
            border-radius: 5px;
            display: none;
            z-index: 1000;
        }

        .drop-indicator {
            position: absolute;
            height: 2px;
            background-color: #4e73df;
            left: 8px;
            right: 8px;
            pointer-events: none;
            display: none;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include("./sidebar.php") ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include("topbar.php") ?>
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">分類管理系統</h1>
                    <div class="container">
                        <div class="header">
                            <div id="deleteZone" class="delete-zone" ondragover="allowDrop(event)" ondrop="dropToDelete(event)">
                                <i class="fas fa-trash"></i> 拖曳至此刪除
                            </div>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">+ 新增分類</button>
                        </div>
                        <div class="grid-container">
                            <?php foreach ($categories as $category): ?>
                                <div class="category-card" data-category-id="<?php echo $category['id']; ?>">
                                    <div class="card-header">
                                        <h5 data-category-id="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></h5>
                                        <div class="controls">
                                            <button class="btn-sm btn-outline-primary" onclick="editCategory(<?php echo $category['id']; ?>)">編輯</button>
                                            <button class="btn-sm btn-outline-danger" onclick="deleteCategory(<?php echo $category['id']; ?>)">刪除</button>
                                        </div>
                                    </div>
                                    <div class="subcategories" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="dragLeave(event)">
                                        <div class="drop-indicator"></div>
                                        <?php foreach ($category['subcategories'] as $sub): ?>
                                            <div class="subcategory-item"
                                                draggable="true"
                                                ondragstart="drag(event)"
                                                ondragend="dragEnd(event)"
                                                data-id="<?php echo $sub['id']; ?>"
                                                data-parent="<?php echo $category['id']; ?>">
                                                <?php echo $sub['name']; ?>
                                                <?php if (!empty($sub['description'])): ?>
                                                    <div class="subcategory-description"><?php echo $sub['description']; ?></div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="category-card" style="border: 2px dashed #ccc; display: flex; justify-content: center; align-items: center;"
                                data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                <h5 style="color: #666;">+ 新增分類</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="addCategoryModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">新增分類</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addCategoryForm">
                                    <div class="mb-3">
                                        <label class="form-label">選擇新增類型</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="categoryType" id="typeBig" value="big" checked>
                                            <label class="form-check-label" for="typeBig">新增大分類</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="categoryType" id="typeSmall" value="small">
                                            <label class="form-check-label" for="typeSmall">新增小分類</label>
                                        </div>
                                    </div>
                                    <div class="mb-3" id="parentCategoryDiv" style="display: none;">
                                        <label for="parentCategory" class="form-label">選擇所屬大分類</label>
                                        <select class="form-select" id="parentCategory" name="parent_id">
                                            <?php
                                            $sql_parent = "SELECT * FROM product_category_big";
                                            $result_parent = $conn->query($sql_parent);
                                            if ($result_parent && $result_parent->num_rows > 0) {
                                                while ($row = $result_parent->fetch_assoc()) {
                                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="categoryName" class="form-label">分類名稱</label>
                                        <input type="text" class="form-control" id="categoryName" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="categoryDescription" class="form-label">分類描述</label>
                                        <textarea class="form-control" id="categoryDescription" name="description" rows="3"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                <button type="button" class="btn btn-primary" onclick="submitCategory()">新增</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 編輯 Modal -->
                <div class="modal fade" id="editCategoryModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">編輯分類</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editCategoryForm">
                                    <input type="hidden" id="editId" name="id">
                                    <div class="mb-3">
                                        <label class="form-label">名稱</label>
                                        <input type="text" class="form-control" id="editName" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">描述</label>
                                        <textarea class="form-control" id="editDescription" name="description" rows="3"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                <button type="button" class="btn btn-primary" onclick="submitEdit()">儲存</button>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.querySelectorAll('input[name="categoryType"]').forEach(radio => {
                            radio.addEventListener('change', function() {
                                const parentCategoryDiv = document.getElementById('parentCategoryDiv');
                                parentCategoryDiv.style.display = this.value === 'small' ? 'block' : 'none';
                            });
                        });
                        document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
                            button.addEventListener('click', function() {
                                const modal = this.closest('.modal');
                                const bsModal = bootstrap.Modal.getInstance(modal);
                                if (bsModal) {
                                    bsModal.hide();
                                }
                            });
                        });
                        const modal = document.getElementById('addCategoryModal');
                        const modalInstance = new bootstrap.Modal(modal);

                        function resetForm() {
                            document.getElementById('addCategoryForm').reset();
                            document.getElementById('parentCategoryDiv').style.display = 'none';
                        }

                        modal.addEventListener('hidden.bs.modal', function() {
                            resetForm();
                        });

                        document.querySelector('[data-bs-dismiss="modal"]').addEventListener('click', function() {
                            modalInstance.hide();
                        });
                    });

                    function getDropIndicator(container) {
                        let indicator = container.querySelector('.drop-indicator');
                        if (!indicator) {
                            indicator = document.createElement('div');
                            indicator.className = 'drop-indicator';
                            container.appendChild(indicator);
                        }
                        return indicator;
                    }

                    function updateDropIndicator(container, y) {
                        const indicator = getDropIndicator(container);
                        const items = [...container.querySelectorAll('.subcategory-item:not(.dragging)')];
                        const draggedItem = container.querySelector('.dragging');

                        if (!items.length && !draggedItem) {
                            indicator.style.display = 'none';
                            return null;
                        }

                        let closestItem = null;
                        let closestOffset = Number.NEGATIVE_INFINITY;

                        items.forEach(item => {
                            const box = item.getBoundingClientRect();
                            const offset = y - box.top - box.height / 2;

                            if (offset < 0 && offset > closestOffset) {
                                closestOffset = offset;
                                closestItem = item;
                            }
                        });

                        if (closestItem) {
                            const rect = closestItem.getBoundingClientRect();
                            indicator.style.top = `${rect.top - container.getBoundingClientRect().top}px`;
                        } else {
                            const lastItem = items[items.length - 1];
                            if (lastItem) {
                                const rect = lastItem.getBoundingClientRect();
                                indicator.style.top = `${rect.bottom - container.getBoundingClientRect().top}px`;
                            } else {
                                indicator.style.top = '0px';
                            }
                        }

                        indicator.style.display = 'block';
                        return closestItem;
                    }

                    function submitCategory() {
                        const form = document.getElementById('addCategoryForm');
                        const formData = new FormData(form);

                        fetch('add_category.php', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    $('#addCategoryModal').modal('hide');
                                    alert('分類新增成功！');
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 500);
                                } else {
                                    alert('錯誤：' + data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('發生錯誤，請稍後再試');
                            });
                    }

                    function editCategory(id) {
                        fetch(`get_category.php?id=${id}`)
                            .then(response => response.json())
                            .then(data => {
                                document.getElementById('editId').value = data.id;
                                document.getElementById('editName').value = data.name;
                                document.getElementById('editDescription').value = data.description;

                                // 初始化 Modal
                                const editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));

                                // 綁定關閉事件
                                const closeButtons = document.getElementById('editCategoryModal')
                                    .querySelectorAll('[data-bs-dismiss="modal"]');

                                closeButtons.forEach(button => {
                                    button.addEventListener('click', () => {
                                        editModal.hide();
                                    });
                                });

                                editModal.show();
                            });
                    }

                    function submitEdit() {
                        const form = document.getElementById('editCategoryForm');
                        const formData = new FormData(form);

                        fetch('edit_category.php', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    location.reload();
                                } else {
                                    alert('更新失敗：' + data.message);
                                }
                            });
                    }

                    function allowDrop(event) {
                        event.preventDefault();
                        const container = event.currentTarget;
                        container.classList.add('drag-over');
                        updateDropIndicator(container, event.clientY);
                    }

                    function dragLeave(event) {
                        event.currentTarget.classList.remove('drag-over');
                        const indicator = event.currentTarget.querySelector('.drop-indicator');
                        if (indicator) {
                            indicator.style.display = 'none';
                        }
                    }

                    function drag(event) {
                        const item = event.target;
                        item.classList.add('dragging');
                        event.dataTransfer.setData("text/plain", JSON.stringify({
                            id: item.dataset.id,
                            parentId: item.dataset.parent
                        }));
                        event.dataTransfer.effectAllowed = "move";
                    }

                    function dragEnd(event) {
                        event.target.classList.remove('dragging');
                        document.querySelectorAll('.drop-indicator').forEach(indicator => {
                            indicator.style.display = 'none';
                        });
                        document.querySelectorAll('.drag-over').forEach(element => {
                            element.classList.remove('drag-over');
                        });
                    }

                    function dropToDelete(event) {
                        event.preventDefault();
                        const data = JSON.parse(event.dataTransfer.getData("text/plain"));
                        deleteCategory(data.id, 'small', 'subcategory');
                    }

                    function deleteCategory(id, type = 'big', table = null) {
                        const message = type === 'big' ? '確定要刪除此分類嗎？' : '確定要刪除此子分類嗎？';
                        if (confirm(message)) {
                            const formData = new FormData();
                            formData.append('id', id);
                            if (type === 'small') {
                                formData.append('table', 'product_category_small');
                            } else {
                                formData.append('table', 'product_category_big');
                            }

                            fetch('delete_category.php', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.text())
                                .then(data => {
                                    if (data === '刪除成功') {
                                        window.location.reload();
                                    } else {
                                        alert('刪除失敗: ' + data);
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('發生錯誤，請稍後再試');
                                });
                        }
                    }

                    function drop(event) {
                        event.preventDefault();
                        event.currentTarget.classList.remove('drag-over');

                        const data = JSON.parse(event.dataTransfer.getData("text/plain"));
                        if (!data) return;

                        const container = event.currentTarget;
                        const newContainer = container.closest('.category-card');
                        const newParentId = newContainer.getAttribute('data-category-id');
                        const indicator = container.querySelector('.drop-indicator');
                        const draggingItem = document.querySelector(`[data-id="${data.id}"]`);

                        if (!newContainer || !draggingItem) return;

                        const closestItem = updateDropIndicator(container, event.clientY);
                        if (newParentId === data.parentId) {
                            const items = [...container.children].filter(child =>
                                child.classList.contains('subcategory-item')
                            );
                            const targetIndex = closestItem ? items.indexOf(closestItem) : items.length;
                            if (targetIndex !== -1) {
                                updateSubcategoryOrder(data.id, targetIndex);
                            }
                        } else {
                            updateSubcategoryParent(data.id, newParentId);
                        }

                        if (indicator) {
                            indicator.style.display = 'none';
                        }
                    }

                    function updateSubcategoryParent(subcategoryId, newParentId) {
                        const formData = new FormData();
                        formData.append('subcategory_id', subcategoryId);
                        formData.append('new_parent_id', newParentId);

                        fetch('update_subcategory_parent.php', {
                                method: 'POST',
                                body: formData,
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    const item = document.querySelector(`[data-id="${subcategoryId}"]`);
                                    const newContainer = document.querySelector(`[data-category-id="${newParentId}"] .subcategories`);
                                    if (newContainer) {
                                        newContainer.appendChild(item);
                                    }
                                } else {
                                    console.error('Parent update failed:', data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Fetch error:', error);
                            });
                    }

                    function updateSubcategoryOrder(subcategoryId, targetIndex) {
                        const formData = new FormData();
                        formData.append('subcategory_id', subcategoryId);
                        formData.append('target_index', targetIndex);

                        fetch('update_subcategory_order.php', {
                                method: 'POST',
                                body: formData,
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    const item = document.querySelector(`[data-id="${subcategoryId}"]`);
                                    const parentId = item.dataset.parent;
                                    const container = document.querySelector(`[data-category-id="${parentId}"] .subcategories`);
                                    const items = [...container.children].filter(child =>
                                        child.classList.contains('subcategory-item')
                                    );
                                    const targetItem = items[targetIndex];

                                    if (targetItem) {
                                        container.insertBefore(item, targetItem);
                                    } else {
                                        container.appendChild(item);
                                    }
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }

                    document.addEventListener('dragstart', function(event) {
                        const deleteZone = document.getElementById('deleteZone');
                        if (deleteZone) {
                            deleteZone.style.display = 'block';
                        }
                    });

                    document.addEventListener('dragend', function(event) {
                        const deleteZone = document.getElementById('deleteZone');
                        if (deleteZone) {
                            deleteZone.style.display = 'none';
                        }
                    });
                </script>

                <!-- Core JavaScript -->
                <script src="vendor/jquery/jquery.min.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
                <script src="js/sb-admin-2.min.js"></script>
            </div>
        </div>
    </div>
</body>

</html>