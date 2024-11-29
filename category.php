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

// 整理資料結構
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $big_id = $row['big_id'];

        // 如果這個大分類還沒有被加入陣列
        if (!isset($categories[$big_id])) {
            $categories[$big_id] = [
                'id' => $big_id,
                'name' => $row['big_name'],
                'description' => $row['big_description'],
                'subcategories' => []
            ];
        }

        // 如果有小分類資料，加入到對應的大分類中
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

        .subcategory-item:active {
            cursor: grabbing;
        }

        .subcategories {
            min-height: 50px;
            padding: 8px;
            margin: 8px;
            border: 1px dashed #ccc;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .drag-over {
            background-color: #e9ecef;
            border: 2px dashed #6c757d;
        }

        .subcategory-item {
            margin: 4px 0;
            padding: 8px 12px;
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            cursor: grab;
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
            /* 半透明背景，给用户提示 */
            padding: 10px;
            border-radius: 5px;
            display: none;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include("./sidebar.php") ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->

                    <h1 class="h3 mb-2 text-gray-800">分類管理系統</h1>


                    <div class="container">
                        <div class="header">
                            <div id="deleteZone" class="delete-zone" ondragover="allowDrop(event)" ondrop="dropToDelete(event)"
                                style="display: none; position: fixed; bottom: 0; left: 0; right: 0; background-color: rgba(255, 0, 0, 0.7); text-align: center; padding: 20px; z-index: 1000;">
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
                                    <div class="subcategories" ondrop="drop(event)" ondragover="allowDrop(event)">
                                        <?php foreach ($category['subcategories'] as $sub): ?>
                                            <div class="subcategory-item"
                                                draggable="true"
                                                ondragstart="drag(event)"
                                                data-id="<?php echo $sub['id']; ?>"
                                                data-parent="<?php echo $category['id']; ?>">
                                                <?php echo $sub['name']; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <!-- 新增分類卡片 -->
                            <div class="category-card" style="border: 2px dashed #ccc; display: flex; justify-content: center; align-items: center;"
                                data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                <h5 style="color: #666;">+ 新增分類</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal 修改版 -->
                <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCategoryModalLabel">新增分類</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addCategoryForm">
                                    <div class="mb-3">
                                        <label class="form-label">選擇新增類型</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="categoryType" id="typeBig" value="big" checked>
                                            <label class="form-check-label" for="typeBig">
                                                新增大分類
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="categoryType" id="typeSmall" value="small">
                                            <label class="form-check-label" for="typeSmall">
                                                新增小分類
                                            </label>
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

                <!-- 記得引入 Bootstrap CSS 和 JS -->

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // 處理分類類型選擇
                        document.querySelectorAll('input[name="categoryType"]').forEach(radio => {
                            radio.addEventListener('change', function() {
                                const parentCategoryDiv = document.getElementById('parentCategoryDiv');
                                parentCategoryDiv.style.display = this.value === 'small' ? 'block' : 'none';
                            });
                        });

                        // 處理取消按鈕和關閉按鈕
                        const modal = document.getElementById('addCategoryModal');
                        const modalInstance = new bootstrap.Modal(modal);

                        // 清空表單的函數
                        function resetForm() {
                            document.getElementById('addCategoryForm').reset();
                            document.getElementById('parentCategoryDiv').style.display = 'none';
                        }

                        // 當 modal 關閉時重置表單
                        modal.addEventListener('hidden.bs.modal', function() {
                            resetForm();
                        });

                        // 取消按鈕點擊事件
                        document.querySelector('[data-bs-dismiss="modal"]').addEventListener('click', function() {
                            modalInstance.hide();
                        });
                    });

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
                                    $('#addCategoryModal').modal('hide'); // 使用 jQuery 方式
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
                        // 暫時alert
                        alert('編輯分類 ID: ' + id);
                        // TODO: 打開編輯modal，載入分類資料
                    }




                    function allowDrop(event) {
                        event.preventDefault(); // 阻止默认行为
                        event.currentTarget.classList.add('drag-over'); // 可选：加样式来标识可以拖放的区域
                    }

                    function dropToDelete(event) {
                        event.preventDefault();
                        const data = JSON.parse(event.dataTransfer.getData("text/plain"));
                        console.log("Dropping data:", data); // 确认是否拿到了正确的 ID
                        deleteCategory(data.id, 'small', 'subcategory');
                    }

                    function deleteCategory(id, type = 'big', table = null) {
                        const message = type === 'big' ? '確定要刪除此分類嗎？' : '確定要刪除此子分類嗎？';

                        if (confirm(message)) {
                            const formData = new FormData();
                            formData.append('id', id);

                            // 根據傳遞的 type 決定 table 的值
                            if (type === 'small') {
                                formData.append('table', 'product_category_small'); // 子分類對應的表
                            } else {
                                formData.append('table', 'product_category_big'); // 大分類對應的表
                            }

                            console.log('Sending data:', {
                                id,
                                table
                            }); // 確認傳送的資料

                            fetch('delete_category.php', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.text())
                                .then(data => {
                                    console.log('Response:', data); // 輸出伺服器回應結果
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



                    function drag(ev) {
                        console.log('Drag started'); // 用于调试
                        const item = ev.target;
                        ev.dataTransfer.setData("text/plain", JSON.stringify({
                            id: item.dataset.id,
                            parentId: item.dataset.parent
                        }));
                    }


                    function drop(ev) {
                        ev.preventDefault();
                        console.log('Drop event triggered'); // 確認是否進入函數

                        const data = JSON.parse(ev.dataTransfer.getData("text/plain"));
                        console.log('Dropped data:', data); // 確認拖動的數據

                        if (data) {
                            // 在這裡處理 Dropped data
                            const target = ev.target.closest('.subcategory-item'); // 目標子項
                            const newContainer = ev.currentTarget.closest('.category-card'); // 新的父容器
                            const newParentId = newContainer.getAttribute('data-category-id'); // 新的父ID

                            if (!newContainer) return; // 如果沒有找到容器，停止執行

                            // 判断是同级排序还是跨分类移动
                            if (newParentId === data.parentId && target) {
                                const container = newContainer.querySelector('.subcategories');
                                const items = [...container.children]; // 获取容器中的所有子项
                                const targetIndex = items.indexOf(target); // 获取目标项的位置

                                if (targetIndex !== -1) {
                                    updateSubcategoryOrder(data.id, targetIndex); // 更新排序
                                }
                            } else {
                                updateSubcategoryParent(data.id, newParentId); // 更新父分類
                            }
                        } else {
                            console.log('No data received');
                        }
                    }



                    function updateSubcategoryParent(subcategoryId, newParentId) {
                        const formData = new FormData();
                        formData.append('subcategory_id', subcategoryId);
                        formData.append('new_parent_id', newParentId);

                        console.log('Sending data for parent update:', {
                            subcategoryId,
                            newParentId
                        }); // 打印请求数据

                        fetch('update_subcategory_parent.php', {
                                method: 'POST',
                                body: formData,
                            })
                            .then(response => {
                                console.log('Raw Response:', response); // 检查响应对象
                                return response.json();
                            })
                            .then(data => {
                                console.log('Response JSON:', data); // 检查解析后的 JSON 数据

                                if (data.success) {
                                    console.log('Parent update successful'); // 数据库更新成功
                                    // 动态更新 UI
                                    const item = document.querySelector(`[data-id="${subcategoryId}"]`);
                                    const newContainer = document.querySelector(`[data-category-id="${newParentId}"] .subcategories`);

                                    if (newContainer) {
                                        newContainer.appendChild(item);
                                    } else {
                                        console.error('New parent container not found');
                                    }
                                } else {
                                    console.error('Parent update failed:', data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Fetch error:', error); // 捕获网络或其他错误
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
                                    const items = [...container.children];
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
                    // 拖动开始时显示删除区域
                    document.addEventListener('dragstart', function(event) {
                        const deleteZone = document.getElementById('deleteZone');
                        if (deleteZone) {
                            deleteZone.style.display = 'block'; // 显示删除区域
                        }
                    });

                    // 拖动结束时隐藏删除区域
                    document.addEventListener('dragend', function(event) {
                        const deleteZone = document.getElementById('deleteZone');
                        if (deleteZone) {
                            deleteZone.style.display = 'none'; // 隐藏删除区域
                        }
                    });
                </script>


                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTableproduct_category_small.min.js"></script>
    <script src="vendor/datatables/dataTableproduct_category_small.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>