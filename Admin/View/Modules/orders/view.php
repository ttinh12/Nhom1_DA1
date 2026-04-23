<?php
$statusList = [
    0 => ['text' => 'Chờ xác nhận', 'badge' => 'bg-warning'],
    1 => ['text' => 'Đang giao',    'badge' => 'bg-info'],
    2 => ['text' => 'Hoàn thành',   'badge' => 'bg-success'],
    3 => ['text' => 'Đã huỷ',       'badge' => 'bg-danger'],
];
$base_url = "../public/assets/images/";
?>

<!-- Breadcrumb -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0">
        Chi tiết đơn hàng <span class="text-muted">#<?= $order['id'] ?></span>
    </h4>
    <a href="index.php?act=orders" class="btn btn-secondary btn-sm">
        <i class="bx bx-arrow-back"></i> Quay lại
    </a>
</div>

<div class="row">

    <!-- Thông tin đơn hàng -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header"><strong>Thông tin khách hàng</strong></div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <td class="text-muted" width="40%">Tên người nhận</td>
                        <td><strong><?= htmlspecialchars($order['name']) ?></strong></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Email</td>
                        <td><?= htmlspecialchars($order['email']) ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Số điện thoại</td>
                        <td><?= htmlspecialchars($order['phone']) ?></td>
                    </tr>
                    <tr>
                        <td class="text-muted">Địa chỉ</td>
                        <td><?= htmlspecialchars($order['address']) ?></td>
                    </tr>
                    <?php if (!empty($order['note'])): ?>
                    <tr>
                        <td class="text-muted">Ghi chú</td>
                        <td><?= htmlspecialchars($order['note']) ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td class="text-muted">Ngày đặt</td>
                        <td><?= date('d/m/Y H:i', strtotime($order['date'])) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Trạng thái đơn hàng -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header"><strong>Trạng thái đơn hàng</strong></div>
            <div class="card-body">

                <!-- Hiển thị trạng thái hiện tại -->
                <?php
                $s = $statusList[$order['status']] ?? ['text' => 'Không rõ', 'badge' => 'bg-secondary'];
                ?>
                <p class="mb-3">
                    Trạng thái hiện tại:
                    <span class="badge <?= $s['badge'] ?> fs-6"><?= $s['text'] ?></span>
                </p>

                <!-- Form cập nhật trạng thái -->
                <form method="POST" action="index.php?act=order-update-status">
                    <input type="hidden" name="id" value="<?= $order['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Cập nhật trạng thái</label>
                        <select name="status" class="form-select">
                            <?php foreach ($statusList as $val => $info): ?>
                                <option value="<?= $val ?>"
                                    <?= $order['status'] == $val ? 'selected' : '' ?>>
                                    <?= $info['text'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Lưu trạng thái
                    </button>
                </form>

                <!-- Tổng tiền -->
                <hr>
                <p class="mb-0 fs-5">
                    Tổng tiền:
                    <strong class="text-primary">
                        <?= number_format($order['total'], 0, ',', '.') ?> đ
                    </strong>
                </p>
            </div>
        </div>
    </div>

</div>

<!-- Chi tiết sản phẩm -->
<div class="card">
    <div class="card-header"><strong>Sản phẩm trong đơn</strong></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orderDetails)): ?>
                        <?php $stt = 1; foreach ($orderDetails as $item): ?>
                            <tr>
                                <td><?= $stt++ ?></td>
                                <td>
                                    <?php if (!empty($item['images'])): ?>
                                        <img src="<?= $base_url . htmlspecialchars($item['images']) ?>"
                                             width="50" height="50" style="object-fit:cover; border-radius:4px">
                                    <?php else: ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($item['title']) ?></td>
                                <td><?= number_format($item['price'], 0, ',', '.') ?> đ</td>
                                <td><?= (int)$item['quantily'] ?></td>
                                <td class="fw-bold">
                                    <?= number_format($item['price'] * $item['quantily'], 0, ',', '.') ?> đ
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Không có sản phẩm</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">Tổng cộng:</td>
                        <td class="fw-bold text-primary fs-6">
                            <?= number_format($order['total'], 0, ',', '.') ?> đ
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>