<?php
/** @var array $product */
/** @var array $variants */
/** @var array $categories */

// URL ảnh upload — dùng đường dẫn web tương đối từ Admin/index.php
$base_url = "../public/assets/images/";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0">
        <span class="text-muted fw-light">Sản phẩm /</span> Chỉnh sửa sản phẩm
    </h4>
    <a href="index.php?act=products" class="btn btn-secondary btn-sm">
        <i class="bx bx-arrow-back"></i> Quay lại
    </a>
</div>

<form method="post" enctype="multipart/form-data" action="index.php?act=edit-product&id=<?= $product['id'] ?>">

    <div class="row">

        <!-- Cột trái: thông tin chính + biến thể -->
        <div class="col-md-8">

            <div class="card mb-4">
                <div class="card-header"><strong>Thông tin sản phẩm</strong></div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control"
                               value="<?= htmlspecialchars($product['name']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" name="title" class="form-control"
                               value="<?= htmlspecialchars($product['title']) ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea name="description" class="form-control" rows="5"><?= htmlspecialchars($product['description']) ?></textarea>
                    </div>

                </div>
            </div>

            <!-- Biến thể -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Biến thể sản phẩm</strong>
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="addVariant()">
                        + Thêm biến thể
                    </button>
                </div>
                <div class="card-body">
                    <div id="variant-container">

                        <?php if (!empty($variants)): ?>
                            <?php foreach ($variants as $i => $v): ?>
                                <div class="variant-item border rounded p-3 mb-3">
                                    <div class="row g-2 align-items-end">

                                        <!-- hidden id biến thể để update đúng -->
                                        <input type="hidden" name="variants[<?= $i ?>][id]" value="<?= $v['id'] ?>">

                                        <div class="col-md-3">
                                            <label class="form-label">SKU</label>
                                            <input type="text" name="variants[<?= $i ?>][sku]"
                                                   class="form-control" value="<?= htmlspecialchars($v['sku']) ?>">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Giá</label>
                                            <input type="number" name="variants[<?= $i ?>][price]"
                                                   class="form-control" value="<?= $v['price'] ?>">
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Kho</label>
                                            <input type="number" name="variants[<?= $i ?>][stock]"
                                                   class="form-control" value="<?= $v['stock'] ?>">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Ảnh</label>
                                            <input type="file" name="variant_images[]"
                                                   class="form-control" accept="image/*">
                                            <input type="hidden" name="old_variant_images[<?= $i ?>]"
                                                   value="<?= htmlspecialchars($v['image'] ?? '') ?>">
                                            <?php if (!empty($v['image'])): ?>
                                                <img src="<?= $base_url . htmlspecialchars($v['image']) ?>"
                                                     width="40" class="mt-1 rounded">
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        </div>

        <!-- Cột phải: danh mục, giá, ảnh, nút lưu -->
        <div class="col-md-4">

            <div class="card mb-4">
                <div class="card-header"><strong>Tuỳ chọn</strong></div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Danh mục</label>
                        <select name="category_id" class="form-select">
                            <option value="">-- Chọn danh mục --</option>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $c): ?>
                                    <option value="<?= $c['id'] ?>"
                                        <?= $c['id'] == $product['category_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($c['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Giá cơ bản</label>
                        <input type="number" name="base_price" class="form-control"
                               value="<?= $product['base_price'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ảnh chính</label>
                        <?php if (!empty($product['images'])): ?>
                            <div class="mb-2">
                                <img src="<?= $base_url . htmlspecialchars($product['images']) ?>"
                                     width="100" class="rounded border">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="images" class="form-control" accept="image/*">
                        <small class="text-muted">Để trống nếu không muốn đổi ảnh</small>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bx bx-save"></i> Cập nhật
                    </button>

                </div>
            </div>

        </div>

    </div>

</form>

<script>
let variantCount = <?= count($variants ?? []) ?>;

function addVariant() {
    const container = document.getElementById('variant-container');
    const i = variantCount;
    container.insertAdjacentHTML('beforeend', `
        <div class="variant-item border rounded p-3 mb-3">
            <div class="row g-2 align-items-end">
                <input type="hidden" name="variants[${i}][id]" value="0">
                <div class="col-md-3">
                    <label class="form-label">SKU</label>
                    <input type="text" name="variants[${i}][sku]" class="form-control" placeholder="SKU">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Giá</label>
                    <input type="number" name="variants[${i}][price]" class="form-control" placeholder="0">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Kho</label>
                    <input type="number" name="variants[${i}][stock]" class="form-control" placeholder="0">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Ảnh</label>
                    <input type="file" name="variant_images[]" class="form-control" accept="image/*">
                    <input type="hidden" name="old_variant_images[${i}]" value="">
                </div>
            </div>
        </div>`);
    variantCount++;
}
</script>