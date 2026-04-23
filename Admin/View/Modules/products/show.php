<?php
/** @var array $product */
/** @var array $variants */

$base_url = "../public/assets/images/";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0">
        Chi tiết sản phẩm: <span class="text-primary"><?= htmlspecialchars($product['name']) ?></span>
    </h4>
    <div>
        <a href="index.php?act=edit-product&id=<?= $product['id'] ?>" class="btn btn-warning btn-sm me-1">
            <i class="bx bx-edit"></i> Sửa
        </a>
        <a href="index.php?act=products" class="btn btn-secondary btn-sm">
            <i class="bx bx-arrow-back"></i> Quay lại
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <div class="row">

            <div class="col-md-3 text-center border-end">
                <?php if (!empty($product['images'])): ?>
                    <img src="<?= $base_url . htmlspecialchars($product['images']) ?>"
                         class="img-fluid rounded" style="max-height:200px; object-fit:cover">
                <?php else: ?>
                    <div class="text-muted py-5">Chưa có ảnh</div>
                <?php endif; ?>
            </div>

            <div class="col-md-9">
                <table class="table table-borderless">
                    <tr>
                        <th style="width:140px" class="text-muted">ID</th>
                        <td>#<?= $product['id'] ?></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Tên</th>
                        <td><strong><?= htmlspecialchars($product['name']) ?></strong></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Tiêu đề</th>
                        <td><?= htmlspecialchars($product['title']) ?></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Giá cơ bản</th>
                        <td class="text-danger fw-bold">
                            <?= number_format($product['base_price'], 0, ',', '.') ?> đ
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">Danh mục ID</th>
                        <td><?= $product['category_id'] ?? '—' ?></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Mô tả</th>
                        <td><?= nl2br(htmlspecialchars($product['description'] ?? '')) ?></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Ngày tạo</th>
                        <td><?= !empty($product['created_at']) ? date('d/m/Y H:i', strtotime($product['created_at'])) : '—' ?></td>
                    </tr>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- Biến thể -->
<div class="card">
    <div class="card-header"><strong>Danh sách biến thể (<?= count($variants ?? []) ?>)</strong></div>
    <div class="table-responsive">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>SKU</th>
                    <th>Giá</th>
                    <th>Tồn kho</th>
                    <th>Ngày tạo</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($variants)): ?>
                    <?php foreach ($variants as $v): ?>
                        <tr>
                            <td>
                                <?php if (!empty($v['image'])): ?>
                                    <img src="<?= $base_url . htmlspecialchars($v['image']) ?>"
                                         width="45" height="45" style="object-fit:cover" class="rounded">
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($v['sku']) ?></td>
                            <td><?= number_format($v['price'], 0, ',', '.') ?> đ</td>
                            <td>
                                <span class="badge <?= $v['stock'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $v['stock'] ?>
                                </span>
                            </td>
                            <td><?= !empty($v['created_at']) ? date('d/m/Y', strtotime($v['created_at'])) : '—' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">Chưa có biến thể</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>