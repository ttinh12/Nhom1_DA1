<?php
/** @var array $products */
$base_url = "../public/assets/images/";
?>

<div class="card">
    <div class="d-flex align-items-center justify-content-between">
        <h5 class="card-header">Danh sách sản phẩm</h5>
        <div class="px-4">
            <a href="index.php?act=add-product" class="btn btn-primary">
                <i class="bx bx-plus"></i> Thêm sản phẩm
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
                                        <img src="<?= $base_url . htmlspecialchars($item['images']) ?>"
                                             width="50" height="50" style="object-fit:cover" class="rounded">
                                    <?php else: ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?>
                                </td>

                                <td><?= htmlspecialchars($item['name']) ?></td>

                                <td><?= htmlspecialchars($item['category_name'] ?? 'Chưa có') ?></td>

                                <td><?= number_format($item['base_price'], 0, ',', '.') ?> đ</td>

                                <td>
                                    <?= !empty($item['created_at'])
                                        ? date('d/m/Y', strtotime($item['created_at']))
                                        : '—' ?>
                                </td>

                                <td>
                                    <a href="index.php?act=show-product&id=<?= $item['id'] ?>"
                                       class="btn btn-sm btn-info">Xem</a>

                                    <a href="index.php?act=edit-product&id=<?= $item['id'] ?>"
                                       class="btn btn-sm btn-warning">Sửa</a>

                                    <a href="index.php?act=delete-product&id=<?= $item['id'] ?>"
                                       onclick="return confirm('Xoá sản phẩm này?')"
                                       class="btn btn-sm btn-danger">Xoá</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Chưa có sản phẩm</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>