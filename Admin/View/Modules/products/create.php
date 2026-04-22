<div class="card">
    <h5 class="card-header">thêm sản phẩm mới</h5>
    <div class="card-body">

        <form action="index.php?act=add-product" method="post" enctype="multipart/form-data">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>danh mục</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">chọn danh mục</option>

                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $c): ?>
                                <option value="<?= $c['id'] ?>">
                                    <?= $c['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label>tiêu đề</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label>mô tả</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label>giá cơ bản</label>
                    <input type="number" name="base_price" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>ảnh chính</label>
                    <input type="file" name="images" class="form-control" accept="image/*">
                </div>

            </div>

            <hr>

            <h5>biến thể sản phẩm</h5>

            <div id="variant-container">
                <div class="variant-item border p-3 mb-3">
                    <div class="row">

                        <div class="col-md-3">
                            <input type="text" name="variants[0][sku]" class="form-control" placeholder="sku">
                        </div>

                        <div class="col-md-3">
                            <input type="number" name="variants[0][price]" class="form-control" placeholder="giá">
                        </div>

                        <div class="col-md-3">
                            <input type="number" name="variants[0][stock]" class="form-control" placeholder="kho">
                        </div>

                        <div class="col-md-3">
                            <input type="file" name="variant_images[]" class="form-control" accept="image/*">
                        </div>

                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-outline-primary mb-3" onclick="addvariant()">
                thêm biến thể
            </button>

            <br>

            <button type="submit" class="btn btn-primary">
                lưu sản phẩm
            </button>

        </form>

    </div>
</div>

<script>
let variantcount = 1;

function addvariant() {
    const container = document.getElementById('variant-container');

    const html = `
    <div class="variant-item border p-3 mb-3">
        <div class="row">

            <div class="col-md-3">
                <input type="text" name="variants[${variantcount}][sku]" class="form-control" placeholder="sku">
            </div>

            <div class="col-md-3">
                <input type="number" name="variants[${variantcount}][price]" class="form-control" placeholder="giá">
            </div>

            <div class="col-md-3">
                <input type="number" name="variants[${variantcount}][stock]" class="form-control" placeholder="kho">
            </div>

            <div class="col-md-3">
                <input type="file" name="variant_images[]" class="form-control" accept="image/*">
            </div>

        </div>
    </div>`;

    container.insertAdjacentHTML('beforeend', html);
    variantcount++;
}
</script>