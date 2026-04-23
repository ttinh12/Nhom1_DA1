<?php
$statusLabel = [
    0 => ['text' => 'Chờ xác nhận', 'badge' => 'bg-warning'],
    1 => ['text' => 'Đang giao',    'badge' => 'bg-info'],
    2 => ['text' => 'Hoàn thành',   'badge' => 'bg-success'],
    3 => ['text' => 'Đã huỷ',       'badge' => 'bg-danger'],
];
?>

<div class="card">
    <div class="d-flex align-items-center justify-content-between">
        <h5 class="card-header">Danh sách đơn hàng</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Khách hàng</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Tổng tiền</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $item): ?>
                            <tr>
                                <td><strong>#<?= $item['id'] ?></strong></td>

                                <td>
                                    <?= htmlspecialchars($item['name']) ?>
                                    <?php if (!empty($item['user_name']) && $item['user_name'] !== $item['name']): ?>
                                        <!-- <small class="text-muted">(<?= htmlspecialchars($item['user_name']) ?>)</small> -->
                                    <?php endif; ?>
                                </td>

                                <td><?= htmlspecialchars($item['phone']) ?></td>

                                <td>
                                    <span title="<?= htmlspecialchars($item['address']) ?>">
                                        <?= mb_strimwidth(htmlspecialchars($item['address']), 0, 20, '...') ?>
                                    </span>
                                </td>

                                <td class="fw-bold text-primary">
                                    <?= number_format($item['total'], 0, ',', '.') ?> đ
                                </td>

                                <td>
                                    <?= date('d/m/Y H:i', strtotime($item['date'])) ?>
                                </td>

                                <td>
                                    <?php
                                    $s = $statusLabel[$item['status']] ?? ['text' => 'Không rõ', 'badge' => 'bg-secondary'];
                                    ?>
                                    <span class="badge <?= $s['badge'] ?>"><?= $s['text'] ?></span>
                                </td>

                                <td>
                                    <a href="index.php?act=order-detail&id=<?= $item['id'] ?>"
                                       class="btn btn-sm btn-info">
                                        <i class="bx bx-show"></i> Xem
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                Chưa có đơn hàng nào
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>