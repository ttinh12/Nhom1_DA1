<div class="card">
    <h5 class="card-header">Thêm Sản Phẩm Mới</h5>
    <div class="card-body">
        <form action="index.php?act=add-product" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Danh mục</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- chọn danh mục --</option>
                        <option value="1">Áo thun</option>
                        <option value="2">Áo sơ mi</option>
                        <option value="3">Quần jean</option>
                        <option value="4">Quần short</option>
                        <option value="5">Áo khoác</option>
                        <option value="6">Đầm váy</option>
                        <option value="7">Đồ thể thao</option>
                        <option value="8">Phụ kiện</option>
                        <option value="9">Đồ ngủ</option>
                        <option value="10">Đồ lót</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Tiêu đề sản phẩm</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Giá cơ bản</label>
                    <input type="number" name="base_price" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Ảnh chính</label>
                    <input type="file" name="images" class="form-control">
                </div>
            </div>

            <hr class="my-4">
            <h5>Biến thể sản phẩm</h5>

            <div id="variant-container">
                <div class="variant-item border p-3 mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <label>SKU</label>
                            <input type="text" name="variants[0][sku]" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Giá</label>
                            <input type="number" name="variants[0][price]" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Kho</label>
                            <input type="number" name="variants[0][stock]" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Ảnh</label>
                            <input type="file" name="variant_images[]" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-outline-primary mb-3" onclick="addVariant()">
                + Thêm biến thể
            </button>

            <br>

            <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
        </form>
    </div>
</div>

<script>
let variantCount = 1;

function addVariant() {
    const container = document.getElementById('variant-container');

    const html = `
    <div class="variant-item border p-3 mb-3">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="variants[${variantCount}][sku]" class="form-control" placeholder="SKU">
            </div>
            <div class="col-md-3">
                <input type="number" name="variants[${variantCount}][price]" class="form-control" placeholder="Giá">
            </div>
            <div class="col-md-3">
                <input type="number" name="variants[${variantCount}][stock]" class="form-control" placeholder="Kho">
            </div>
            <div class="col-md-3">
                <input type="file" name="variant_images[]" class="form-control">
            </div>
        </div>
    </div>`;

    container.insertAdjacentHTML('beforeend', html);
    variantCount++;
}
</script>