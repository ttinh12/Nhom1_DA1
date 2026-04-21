<?php 
/** @var array $product */ 
/** @var array $variants */
?>
<div class="card mb-4">
    <h5 class="card-header">Chi tiết sản phẩm: <span class="text-primary"><?php echo $product['name']; ?></span></h5>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 text-center border-end">
                <img src="../public/assets/images/<?php echo $product['images']; ?>" 
                     alt="Product Image" class="img-fluid rounded shadow-sm" style="max-width: 100%;">
            </div>
            
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 150px;">Tiêu đề:</th>
                        <td><?php echo $product['title']; ?></td>
                    </tr>
                    <tr>
                        <th>Giá cơ bản:</th>
                        <td class="text-danger fw-bold"><?php echo number_format($product['base_price'], 0, ',', '.'); ?>đ</td>
                    </tr>
                    <tr>
                        <th>Mô tả:</th>
                        <td><?php echo nl2br($product['description']); ?></td>
                    </tr>
                    <tr>
                        <th>Ngày tạo:</th>
                        <td><?php echo date('d/m/Y H:i', strtotime($product['created_at'])); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <h5 class="card-header">Danh sách biến thể sản phẩm</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr class="table-light">
                    <th>Ảnh</th>
                    <th>Mã SKU</th>
                    <th>Giá riêng</th>
                    <th>Số lượng kho</th>
                    <th>Ngày cập nhật</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php if (!empty($variants)): ?>
                    <?php foreach ($variants as $v): ?>
                        <tr>
                            <td>
                                <?php if($v['image']): ?>
                                    <img src="../public/assets/images/<?php echo $v['image']; ?>" width="45" class="rounded">
                                <?php else: ?>
                                    <span class="badge bg-label-secondary">Không có ảnh</span>
                                <?php endif; ?>
                            </td>
                            <td><span class="badge bg-label-primary"><?php echo $v['sku']; ?></span></td>
                            <td class="fw-semibold"><?php echo number_format($v['price'], 0, ',', '.'); ?>đ</td>
                            <td><?php echo $v['stock']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($v['created_at'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Sản phẩm này chưa có biến thể nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    <a href="index.php?act=products" class="btn btn-secondary">Quay lại danh sách</a>
</div>