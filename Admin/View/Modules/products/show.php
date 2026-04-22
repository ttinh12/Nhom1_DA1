<?php 
/** @var array $product */ 
/** @var array $variants */
?>

<div class="card mb-4">
    <h5 class="card-header">
        Chi tiết sản phẩm: 
        <span class="text-primary"><?= $product['name'] ?></span>
    </h5>

    <div class="card-body">
        <div class="row">

            <div class="col-md-4 text-center border-end">

                <?php if (!empty($product['images'])): ?>
                    <img src="../public/uploads/<?= $product['images'] ?>"
                        class="img-fluid rounded">
                <?php else: ?>
                    <img src="../public/uploads/default.png"
                        class="img-fluid rounded">
                <?php endif; ?>

            </div>

            <div class="col-md-8">

                <table class="table table-borderless">

                    <tr>
                        <th style="width:150px;">Tiêu đề</th>
                        <td><?= $product['title'] ?></td>
                    </tr>

                    <tr>
                        <th>Giá</th>
                        <td class="text-danger">
                            <?= number_format($product['base_price'],0,',','.') ?> đ
                        </td>
                    </tr>

                    <tr>
                        <th>Mô tả</th>
                        <td><?= nl2br($product['description']) ?></td>
                    </tr>

                    <tr>
                        <th>Ngày tạo</th>
                        <td><?= date('d/m/Y H:i', strtotime($product['created_at'])) ?></td>
                    </tr>

                </table>

            </div>

        </div>
    </div>
</div>

<div class="card">
    <h5 class="card-header">Danh sách biến thể</h5>

    <div class="table-responsive">
        <table class="table">

            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>SKU</th>
                    <th>Giá</th>
                    <th>Kho</th>
                    <th>Ngày tạo</th>
                </tr>
            </thead>

            <tbody>

                <?php if (!empty($variants)): ?>
                    <?php foreach ($variants as $v): ?>

                        <tr>

                            <td>
                                <?php if (!empty($v['image'])): ?>
                                    <img src="../public/uploads/<?= $v['image'] ?>" width="45">
                                <?php else: ?>
                                    <span>Không có</span>
                                <?php endif; ?>
                            </td>

                            <td><?= $v['sku'] ?></td>

                            <td>
                                <?= number_format($v['price'],0,',','.') ?> đ
                            </td>

                            <td><?= $v['stock'] ?></td>

                            <td>
                                <?= isset($v['created_at']) ? date('d/m/Y', strtotime($v['created_at'])) : '' ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>
                <?php else: ?>

                    <tr>
                        <td colspan="5" class="text-center">
                            Chưa có biến thể
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>
    </div>
</div>

<div class="mt-4">
    <a href="index.php?act=products" class="btn btn-secondary">
        Quay lại
    </a>
</div>