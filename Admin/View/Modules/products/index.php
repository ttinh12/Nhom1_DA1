<?php
$base_url = "/duan1/Admin/public/assets/uploads/";
?>

<div class="card">
    <div class="d-flex align-items-center justify-content-between">
        <h5 class="card-header">Danh sách sản phẩm</h5>

        <div class="px-4">
            <a href="index.php?act=add-product" class="btn btn-primary">
                thêm sản phẩm
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>id</th>
                        <th>ảnh</th>
                        <th>tên sản phẩm</th>
                        <th>danh mục</th>
                        <th>giá</th>
                        <th>ngày tạo</th>
                        <th>hành động</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $item): ?>

                            <tr>

                                <td><strong>#<?= $item['id'] ?></strong></td>

                                <td>
                                    <?php if (!empty($item['images'])): ?>
                                        <img src="<?= $base_url . $item['images'] ?>"
                                             width="50" height="50"
                                             style="object-fit:cover">
                                    <?php else: ?>
                                        <img src="<?= $base_url ?>default.png"
                                             width="50" height="50"
                                             style="object-fit:cover">
                                    <?php endif; ?>
                                </td>

                                <td><?= htmlspecialchars($item['name']) ?></td>

                                <td>
                                    <?= $item['category_name'] ?? 'chưa có' ?>
                                </td>

                                <td>
                                    <?= number_format($item['base_price'], 0, ',', '.') ?> đ
                                </td>

                                <td>
                                    <?= !empty($item['created_at']) ? date('d/m/Y', strtotime($item['created_at'])) : '' ?>
                                </td>

                                <td>
                                    <a href="index.php?act=show-product&id=<?= $item['id'] ?>" class="btn btn-sm btn-info">xem</a>

                                    <a href="index.php?act=edit-product&id=<?= $item['id'] ?>" class="btn btn-sm btn-warning">sửa</a>

                                    <a href="index.php?act=delete-product&id=<?= $item['id'] ?>"
                                        onclick="return confirm('xóa sản phẩm?')"
                                        class="btn btn-sm btn-danger">xóa</a>
                                </td>

                            </tr>

                        <?php endforeach; ?>
                    <?php else: ?>

                        <tr>
                            <td colspan="7" class="text-center">
                                chưa có sản phẩm
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>
        </div>
    </div>
</div>