<div class="card">
    <div class="d-flex align-items-center justify-content-between">
        <h5 class="card-header">Danh sách sản phẩm</h5>

        <div class="px-4">
            <a href="index.php?act=add-product" class="btn btn-primary">
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
                        <th>Giá</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $item): ?>

                            <tr>

                                <td><strong>#<?= $item['id'] ?></strong></td>

                                <td>
                                    <?php if (!empty($item['images'])): ?>
                                        <img src="../public/uploads/<?= $item['images'] ?>"
                                            width="50" height="50"
                                            style="object-fit:cover">
                                    <?php else: ?>
                                        <img src="../public/uploads/default.png"
                                            width="50" height="50">
                                    <?php endif; ?>
                                </td>

                                <td><?= htmlspecialchars($item['name']) ?></td>

                                <td>
                                    <?= $item['category_name'] ?? 'Chưa có' ?>
                                </td>

                                <td>
                                    <?= number_format($item['base_price'], 0, ',', '.') ?> đ
                                </td>

                                <td>
                                    <?= date('d/m/Y', strtotime($item['created_at'])) ?>
                                </td>

                                <td>
                                    <a href="index.php?act=show-product&id=<?= $item['id'] ?>" class="btn btn-sm btn-info">Xem</a>

                                    <a href="index.php?act=edit-product&id=<?= $item['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>

                                    <a href="index.php?act=delete-product&id=<?= $item['id'] ?>"
                                        onclick="return confirm('Xóa sản phẩm?')"
                                        class="btn btn-sm btn-danger">Xóa</a>
                                </td>

                            </tr>

                        <?php endforeach; ?>
                    <?php else: ?>

                        <tr>
                            <td colspan="7" class="text-center">
                                Chưa có sản phẩm
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>
        </div>
    </div>
</div>