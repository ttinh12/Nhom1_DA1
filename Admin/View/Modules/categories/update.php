<div class="card">
    <div class="card-header">
        <h4>Cập nhật danh mục</h4>
    </div>

    <div class="card-body">
        <form method="POST">

            <!-- Tên -->
            <div class="mb-3">
                <label class="form-label">Tên danh mục</label>
                <input type="text" name="name" class="form-control"
                       value="<?= $category['name'] ?>">
            </div>

            <!-- Trạng thái -->
            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="1" <?= $category['status'] == 1 ? 'selected' : '' ?>>
                        Hiển thị
                    </option>
                    <option value="0" <?= $category['status'] == 0 ? 'selected' : '' ?>>
                        Ẩn
                    </option>
                </select>
            </div>

            <!-- Mô tả -->
            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="content" class="form-control" rows="4"><?= $category['content'] ?></textarea>
            </div>

            <!-- Button -->
            <div>
                <button class="btn btn-primary">Cập nhật</button>
                <a href="index.php?page=category" class="btn btn-secondary">Quay lại</a>
            </div>

        </form>
    </div>
</div>