<div class="card">
    <h5 class="card-header">Thêm danh mục</h5>

    <div class="card-body">
        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Tên danh mục</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="content" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Thêm</button>
            <a href="index.php?act=category" class="btn btn-secondary">Quay lại</a>

        </form>
    </div>
</div>