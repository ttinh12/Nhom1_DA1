<div class="card">
    <div class="d-flex align-items-center justify-content-between">
        <h5 class="card-header">Danh sách sản phẩm</h5>
        <div class="px-4">
            <a href="admin?act=add-product" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Thêm sản phẩm
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giá gốc</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $item): ?>
                            <tr>
                                <td><strong>#<?php echo $item['id']; ?></strong></td>
                                <td>
                                    <img src="../public/assets/images/<?php echo $item['images']; ?>" alt="Product Image"
                                        class="rounded" width="50" height="50" style="object-fit: cover;"
                                        onerror="this.onerror=null;this.src='../public/assets/images/default.png';">
                                </td>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td>
                                    <span class="badge bg-label-primary me-1">
                                        <?php echo $item['category_name'] ?? 'Chưa phân loại'; ?>
                                    </span>
                                </td>
                                <td><?php echo number_format($item['base_price'], 0, ',', '.'); ?>đ</td>
                                <td><?php echo date('d/m/Y', strtotime($item['created_at'])); ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="index.php?act=show-product&id=<?php echo $item['id']; ?>">
                                                <i class="bx bx-show-alt me-1"></i> Xem
                                            </a>
                                            <a class="dropdown-item"
                                                href="index.php?act=edit-product&id=<?php echo $item['id']; ?>">
                                                <i class="bx bx-edit-alt me-1"></i> Sửa
                                            </a>
                                            <a class="dropdown-item"
                                                href="index.php?act=delete-product&id=<?php echo $item['id']; ?>"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này và tất cả biến thể của nó?')">
                                                <i class="bx bx-trash me-1"></i> Xóa
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Chưa có sản phẩm nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>