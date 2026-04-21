<?php
/** @var array $product */
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sản phẩm /</span> Chỉnh sửa sản phẩm</h4>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $product['name']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tiêu đề (Title)</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $product['title']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea name="description" class="form-control" rows="5"><?php echo $product['description']; ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <h5 class="card-header">Biến thể sản phẩm</h5>
                    <div class="card-body">
                        <div id="variant-container">
                            <?php if (!empty($variants)): ?>
                                <?php foreach ($variants as $index => $v): ?>
                                    <div class="variant-item border p-3 mb-3 rounded">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label class="form-label">Mã SKU</label>
                                                <input type="text" name="variants[<?php echo $index; ?>][sku]" class="form-control" value="<?php echo $v['sku']; ?>" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Giá riêng</label>
                                                <input type="number" name="variants[<?php echo $index; ?>][price]" class="form-control" value="<?php echo $v['price']; ?>">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Kho</label>
                                                <input type="number" name="variants[<?php echo $index; ?>][stock]" class="form-control" value="<?php echo $v['stock']; ?>">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Ảnh</label>
                                                <input type="file" name="variant_images[<?php echo $index; ?>]" class="form-control">
                                                <input type="hidden" name="old_variant_images[<?php echo $index; ?>]" value="<?php echo $v['image']; ?>">
                                                <?php if($v['image']): ?>
                                                    <img src="../public/assets/images/<?php echo $v['image']; ?>" width="40" class="mt-1 rounded">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted">Sản phẩm này chưa có biến thể.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Danh mục</label>
                            <select name="category_id" class="form-select">
                                <option value="<?php echo $product['category_id']; ?>">Giữ nguyên danh mục hiện tại</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá cơ bản</label>
                            <input type="number" name="base_price" class="form-control" value="<?php echo $product['base_price']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ảnh đại diện</label>
                            <div class="mb-2">
                                <img src="../public/assets/images/<?php echo $product['images']; ?>" class="img-fluid rounded border" id="preview-img">
                            </div>
                            <input type="file" name="images" class="form-control">
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary w-100">Cập nhật sản phẩm</button>
                        <a href="index.php?act=products" class="btn btn-outline-secondary w-100 mt-2">Hủy bỏ</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>