<div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header">Danh sách người dùng</h5>

        <div class="px-3">
            <!-- nếu chưa làm create thì có thể comment lại -->
            <!-- <a href="index.php?act=user-create" class="btn btn-primary">
                Thêm người dùng
            </a> -->
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $index => $item): ?>
                        <tr>

                            <td><?= $index + 1 ?></td>

                            <td><?= htmlspecialchars($item['name']) ?></td>

                            <td><?= htmlspecialchars($item['email']) ?></td>

                            <td>
                                <?= ($item['role'] ?? 'user') === 'admin'
                                    ? '<span class="badge bg-danger">Admin</span>'
                                    : '<span class="badge bg-secondary">User</span>' ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Chưa có người dùng</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>