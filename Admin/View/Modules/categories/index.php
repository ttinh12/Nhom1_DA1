<h3>Danh sách danh mục</h3>

<a href="index.php?page=category-create" class="btn btn-primary mb-3">Thêm danh mục</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $item): ?>
            <tr>
                <td><?= $item['id'] ?></td>
                <td><?= $item['name'] ?></td>
                <td>
                    <a href="index.php?page=category-update&id=<?= $item['id'] ?>" class="btn btn-warning">Sửa</a>
                    <a href="index.php?page=category-delete&id=<?= $item['id'] ?>"
                       onclick="return confirm('Xóa?')"
                       class="btn btn-danger">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>