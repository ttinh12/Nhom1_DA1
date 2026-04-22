<div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header">Danh sách danh mục</h5>

        <div class="px-3">
            <a href="index.php?act=category-create" class="btn btn-primary">
                Thêm danh mục
            </a>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $item): ?>
                        <tr>

                            <td><?= $item['id'] ?></td>

                            <td><?= htmlspecialchars($item['name']) ?></td>

                            <td>
                                <?= $item['status'] ? 
                                    '<span class="badge bg-success">Hiển thị</span>' : 
                                    '<span class="badge bg-secondary">Ẩn</span>' ?>
                            </td>

                            <td>
                                <a href="index.php?act=category-update&id=<?= $item['id'] ?>"
                                   class="btn btn-warning btn-sm">Sửa</a>

                                <a href="index.php?act=category-delete&id=<?= $item['id'] ?>"
                                   onclick="return confirm('Xóa danh mục?')"
                                   class="btn btn-danger btn-sm">Xóa</a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Chưa có danh mục</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>