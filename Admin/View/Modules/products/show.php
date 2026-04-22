<?php 
/** @var array $product */ 
/** @var array $variants */
?>

<div class="card mb-4">
    <h5 class="card-header">
        chi tiết sản phẩm: 
        <span class="text-primary"><?= $product['name'] ?></span>
    </h5>

    <div class="card-body">
        <div class="row">

            <div class="col-md-4 text-center border-end">

                <?php
                $imagePath = "../public/uploads/" . $product['images'];
                $imageFile = __DIR__ . "/../../../public/uploads/" . $product['images'];
                ?>

                <?php if (!empty($product['images']) && file_exists($imageFile)): ?>
                    <img src="<?= $imagePath ?>" class="img-fluid rounded">
                <?php else: ?>
                    <img src="../public/uploads/default.png" class="img-fluid rounded">
                <?php endif; ?>

            </div>

            <div class="col-md-8">

                <table class="table table-borderless">

                    <tr>
                        <th style="width:150px;">tiêu đề</th>
                        <td><?= $product['title'] ?></td>
                    </tr>

                    <tr>
                        <th>giá</th>
                        <td class="text-danger">
                            <?= number_format($product['base_price'],0,',','.') ?> đ
                        </td>
                    </tr>

                    <tr>
                        <th>mô tả</th>
                        <td><?= nl2br($product['description']) ?></td>
                    </tr>

                    <tr>
                        <th>ngày tạo</th>
                        <td><?= !empty($product['created_at']) ? date('d/m/Y H:i', strtotime($product['created_at'])) : '' ?></td>
                    </tr>

                </table>

            </div>

        </div>
    </div>
</div>

<div class="card">
    <h5 class="card-header">danh sách biến thể</h5>

    <div class="table-responsive">
        <table class="table">

            <thead>
                <tr>
                    <th>ảnh</th>
                    <th>sku</th>
                    <th>giá</th>
                    <th>kho</th>
                    <th>ngày tạo</th>
                </tr>
            </thead>

            <tbody>

                <?php if (!empty($variants)): ?>
                    <?php foreach ($variants as $v): ?>

                        <?php
                        $vImagePath = "../public/uploads/" . $v['image'];
                        $vImageFile = __DIR__ . "/../../../public/uploads/" . $v['image'];
                        ?>

                        <tr>

                            <td>
                                <?php if (!empty($v['image']) && file_exists($vImageFile)): ?>
                                    <img src="<?= $vImagePath ?>" width="45" height="45" style="object-fit:cover">
                                <?php else: ?>
                                    <img src="../public/uploads/default.png" width="45" height="45">
                                <?php endif; ?>
                            </td>

                            <td><?= $v['sku'] ?></td>

                            <td>
                                <?= number_format($v['price'],0,',','.') ?> đ
                            </td>

                            <td><?= $v['stock'] ?></td>

                            <td>
                                <?= !empty($v['created_at']) ? date('d/m/Y', strtotime($v['created_at'])) : '' ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>
                <?php else: ?>

                    <tr>
                        <td colspan="5" class="text-center">
                            chưa có biến thể
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>
    </div>
</div>

<div class="mt-4">
    <a href="index.php?act=products" class="btn btn-secondary">
        quay lại
    </a>
</div>