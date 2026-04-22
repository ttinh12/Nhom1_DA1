<div class="card">
    <h5 class="card-header">Cập nhật danh mục</h5>

    <div class="card-body">
        <form method="POST">

            <div class="mb-3">
                <label>Tên danh mục</label>
                <input type="text" name="name"
                       value="<?= $category['name'] ?>"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="1" <?= $category['status']==1?'selected':'' ?>>Hiển thị</option>
                    <option value="0" <?= $category['status']==0?'selected':'' ?>>Ẩn</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Mô tả</label>
                <textarea name="content" class="form-control"><?= $category['content'] ?></textarea>
            </div>

            <button class="btn btn-primary">Cập nhật</button>
            <a href="index.php?act=category" class="btn btn-secondary">Quay lại</a>

        </form>
    </div>
</div>