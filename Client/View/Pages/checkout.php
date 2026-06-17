<?php
// ===== LẤY GIỎ HÀNG TỪ SESSION =====
$cart = $_SESSION['cart'] ?? [];

// ===== TÍNH TỔNG TIỀN =====
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}

// ===== XỬ LÝ KHI SUBMIT FORM =====
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // thông báo đặt hàng thành công
    echo "<script>alert('Đặt hàng thành công!');</script>";

    // xóa giỏ hàng sau khi đặt
    unset($_SESSION['cart']);

    // chuyển về trang chủ
    echo "<script>window.location.href='index.php?page=home'</script>";
    exit;
}
?>

<div class="site-section">
    <div class="container">
        <div class="row">

            <!-- ===== FORM NHẬP THÔNG TIN ===== -->
            <div class="col-md-8">
                <h3>Thông tin khách hàng</h3>

                <!-- form POST gửi về chính trang này -->
                <form method="POST">
                    <div class="p-3 border">

                        <!-- HỌ + TÊN -->
                        <div class="row">
                            <div class="col-md-6">
                                <input name="fname" class="form-control mb-3" placeholder="Họ" required>
                            </div>
                            <div class="col-md-6">
                                <input name="lname" class="form-control mb-3" placeholder="Tên" required>
                            </div>
                        </div>

                        <!-- ĐỊA CHỈ -->
                        <input name="address" class="form-control mb-3" placeholder="Địa chỉ" required>

                        <!-- EMAIL + SĐT -->
                        <div class="row">
                            <div class="col-md-6">
                                <input name="email" class="form-control mb-3" placeholder="Email" required>
                            </div>
                            <div class="col-md-6">
                                <input name="phone" class="form-control mb-3" placeholder="Số điện thoại" required>
                            </div>
                        </div>

                        <!-- GHI CHÚ -->
                        <textarea name="note" class="form-control mb-3" placeholder="Ghi chú"></textarea>

                        <!-- NÚT ĐẶT HÀNG -->
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

                        <!-- HEADER -->
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>

                        <tbody>

                        <!-- KIỂM TRA GIỎ CÓ SẢN PHẨM -->
                        <?php if (!empty($cart)): ?>

                            <!-- LẶP QUA TỪNG SẢN PHẨM -->
                            <?php foreach ($cart as $item): ?>
                                <tr>
                                    <td>
                                        <!-- TÊN + SỐ LƯỢNG -->
                                        <?= $item['name'] ?> 
                                        <strong>x<?= $item['quantity'] ?></strong>
                                    </td>

                                    <td>
                                        <!-- TÍNH TIỀN TỪNG SẢN PHẨM -->
                                        <?= number_format($item['price'] * $item['quantity']) ?> đ
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <!-- TỔNG TIỀN -->
                            <tr class="font-weight-bold">
                                <td>Tổng cộng</td>
                                <td><?= number_format($total) ?> đ</td>
                            </tr>

                        <?php else: ?>

                            <!-- NẾU GIỎ TRỐNG -->
                            <tr>
                                <td colspan="2">Giỏ hàng trống</td>
                            </tr>

                        <?php endif; ?>

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>