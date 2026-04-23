<?php
/** @var array $categories */
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0">
        <span class="text-muted fw-light">Sản phẩm /</span> Thêm sản phẩm mới
    </h4>
    <a href="index.php?act=products" class="btn btn-secondary btn-sm">
        <i class="bx bx-arrow-back"></i> Quay lại
    </a>
</div>

<form action="index.php?act=add-product" method="post" enctype="multipart/form-data">

    <div class="row">

        <!-- Cột trái -->
        <div class="col-md-8">

            <div class="card mb-4">
                <div class="card-header"><strong>Thông tin sản phẩm</strong></div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" name="title" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea name="description" class="form-control" rows="5"></textarea>
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
                        <div class="variant-item border rounded p-3 mb-3">
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <label class="form-label">SKU</label>
                                    <input type="text" name="variants[0][sku]" class="form-control" placeholder="VD: SKU001">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Giá</label>
                                    <input type="number" name="variants[0][price]" class="form-control" placeholder="0">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Tồn kho</label>
                                    <input type="number" name="variants[0][stock]" class="form-control" placeholder="0">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Ảnh biến thể</label>
                                    <input type="file" name="variant_images[]" class="form-control" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Cột phải -->
        <div class="col-md-4">

            <div class="card mb-4">
                <div class="card-header"><strong>Tuỳ chọn</strong></div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Chọn danh mục --</option>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $c): ?>
                                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Giá cơ bản <span class="text-danger">*</span></label>
                        <input type="number" name="base_price" class="form-control" required placeholder="0">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ảnh chính</label>
                        <input type="file" name="images" class="form-control" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bx bx-save"></i> Lưu sản phẩm
                    </button>

                </div>
            </div>

        </div>

    </div>

</form>

<script>
let variantCount = 1;
function addVariant() {
    const i = variantCount;
    document.getElementById('variant-container').insertAdjacentHTML('beforeend', `
        <div class="variant-item border rounded p-3 mb-3">
            <div class="row g-2">
                <div class="col-md-3">
                    <label class="form-label">SKU</label>
                    <input type="text" name="variants[${i}][sku]" class="form-control" placeholder="VD: SKU00${i+1}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Giá</label>
                    <input type="number" name="variants[${i}][price]" class="form-control" placeholder="0">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tồn kho</label>
                    <input type="number" name="variants[${i}][stock]" class="form-control" placeholder="0">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Ảnh biến thể</label>
                    <input type="file" name="variant_images[]" class="form-control" accept="image/*">
                </div>
            </div>
        </div>`);
    variantCount++;
}
</script>