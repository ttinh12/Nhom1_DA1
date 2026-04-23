<?php
// ===== KIỂM TRA ĐĂNG NHẬP =====
if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=login");
    exit;
}

// ===== LẤY GIỎ HÀNG =====
$cart = $_SESSION['cart'] ?? [];

// ===== KIỂM TRA GIỎ TRỐNG =====
if (empty($cart)) {
    header("Location: index.php?page=cart");
    exit;
}

// ===== TÍNH TỔNG TIỀN =====
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}

// ===== XỬ LÝ KHI SUBMIT FORM =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once "Model/Database.php";
    require_once "Model/Order.php";

    $db      = new Database();
    $connect = $db->connect();
    $orderModel = new Order($connect);

    $user    = $_SESSION['user'];
    $fname   = trim($_POST['fname']   ?? '');
    $lname   = trim($_POST['lname']   ?? '');
    $name    = $fname . ' ' . $lname;
    $email   = trim($_POST['email']   ?? $user['email'] ?? '');
    $phone   = trim($_POST['phone']   ?? '');
    $address = trim($_POST['address'] ?? '');
    $note    = trim($_POST['note']    ?? '');

    // Tạo đơn hàng
    $order_id = $orderModel->createOrder(
        (int)$user['id'], $name, $email, $phone, $address, $note, $total
    );

    if ($order_id) {
        // Lưu từng sản phẩm vào orders_details
        foreach ($cart as $item) {
            $orderModel->createOrderDetail(
                $order_id,
                (int)$item['id'],
                (int)$item['quantity'],
                $item['name'],
                (float)$item['price']
            );
        }

        // Xóa giỏ hàng
        unset($_SESSION['cart']);

        echo "<script>alert('Đặt hàng thành công! Mã đơn: #" . $order_id . "'); window.location.href='index.php?page=home';</script>";
        exit;
    } else {
        $error = "Có lỗi xảy ra, vui lòng thử lại.";
    }
}
?>

<div class="site-section">
    <div class="container">
        <div class="row">

            <!-- ===== FORM NHẬP THÔNG TIN ===== -->
            <div class="col-md-8">
                <h3>Thông tin khách hàng</h3>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="p-3 border">

                        <div class="row">
                            <div class="col-md-6">
                                <input name="fname" class="form-control mb-3" placeholder="Họ" required
                                    value="<?= htmlspecialchars($_SESSION['user']['name'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <input name="lname" class="form-control mb-3" placeholder="Tên" required>
                            </div>
                        </div>

                        <input name="address" class="form-control mb-3" placeholder="Địa chỉ" required
                            value="<?= htmlspecialchars($_SESSION['user']['address'] ?? '') ?>">

                        <div class="row">
                            <div class="col-md-6">
                                <input name="email" class="form-control mb-3" placeholder="Email" required
                                    value="<?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <input name="phone" class="form-control mb-3" placeholder="Số điện thoại" required
                                    value="<?= htmlspecialchars($_SESSION['user']['phone'] ?? '') ?>">
                            </div>
                        </div>

                        <textarea name="note" class="form-control mb-3" placeholder="Ghi chú"></textarea>

                        <button class="btn btn-black btn-lg w-100">
                            Đặt hàng
                        </button>

                    </div>
                </form>
            </div>

            <!-- ===== HIỂN THỊ ĐƠN HÀNG ===== -->
            <div class="col-md-4">
                <h3>Đơn hàng của bạn</h3>

                <div class="p-3 border">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart as $item): ?>
                                <tr>
                                    <td>
                                        <?= htmlspecialchars($item['name']) ?>
                                        <strong>x<?= $item['quantity'] ?></strong>
                                    </td>
                                    <td>
                                        <?= number_format($item['price'] * $item['quantity']) ?> đ
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="font-weight-bold">
                                <td>Tổng cộng</td>
                                <td><?= number_format($total) ?> đ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>