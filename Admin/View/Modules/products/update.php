<?php
/** @var array $product */
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Sản phẩm /</span> Chỉnh sửa sản phẩm
    </h4>

    <form method="POST" enctype="multipart/form-data">
        <div class="row">

            <div class="col-md-8">

                <!-- thông tin cơ bản -->
                <div class="card mb-4">
                    <div class="card-body">

                        <div class="mb-3">
                            <label>Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control"
                                value="<?= $product['name'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Tiêu đề</label>
                            <input type="text" name="title" class="form-control"
                                value="<?= $product['title'] ?>">
                        </div>

                        <div class="mb-3">
                            <label>Mô tả</label>
                            <textarea name="description" class="form-control" rows="5"><?= $product['description'] ?></textarea>
                        </div>

                    </div>
                </div>

                <!-- biến thể -->
                <div class="card mb-4">
                    <h5 class="card-header">Biến thể sản phẩm</h5>

                    <div class="card-body">
                        <div id="variant-container">

                            <?php if (!empty($variants)): ?>
                                <?php foreach ($variants as $index => $v): ?>
                                    <div class="variant-item border p-3 mb-3">

                                        <div class="row">

                                            <div class="col-md-3">
                                                <label>SKU</label>
                                                <input type="text"
                                                    name="variants[<?= $index ?>][sku]"
                                                    class="form-control"
                                                    value="<?= $v['sku'] ?>">
                                            </div>

                                            <div class="col-md-3">
                                                <label>Giá</label>
                                                <input type="number"
                                                    name="variants[<?= $index ?>][price]"
                                                    class="form-control"
                                                    value="<?= $v['price'] ?>">
                                            </div>

                                            <div class="col-md-3">
                                                <label>Kho</label>
                                                <input type="number"
                                                    name="variants[<?= $index ?>][stock]"
                                                    class="form-control"
                                                    value="<?= $v['stock'] ?>">
                                            </div>

                                            <div class="col-md-3">
                                                <label>Ảnh</label>
                                                <input type="file"
                                                    name="variant_images[]"
                                                    class="form-control">

                                                <input type="hidden"
                                                    name="old_variant_images[<?= $index ?>]"
                                                    value="<?= $v['image'] ?>">

                                                <?php if (!empty($v['image'])): ?>
                                                    <img src="../public/uploads/<?= $v['image'] ?>"
                                                        width="40"
                                                        class="mt-1">
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Chưa có biến thể</p>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-4">

                <!-- thông tin phụ -->
                <div class="card mb-4">
                    <div class="card-body">

                        <div class="mb-3">
                            <label>Danh mục</label>
                            <select name="category_id" class="form-control">
                                <option value="<?= $product['category_id'] ?>">
                                    Giữ nguyên danh mục hiện tại
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Giá cơ bản</label>
                            <input type="number" name="base_price"
                                class="form-control"
                                value="<?= $product['base_price'] ?>">
                        </div>

                        <div class="mb-3">
                            <label>Ảnh chính</label>

                            <?php if (!empty($product['images'])): ?>
                                <img src="../public/uploads/<?= $product['images'] ?>"
                                    class="img-fluid mb-2">
                            <?php endif; ?>

                            <input type="file" name="images" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Cập nhật
                        </button>

                        <a href="index.php?act=products"
                            class="btn btn-secondary w-100 mt-2">
                            Quay lại
                        </a>

                    </div>
                </div>

            </div>

        </div>
    </form>
</div>