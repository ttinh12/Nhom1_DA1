<?php
$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>

<div class="site-wrap">

    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="index.php?page=home">Trang chủ</a>
                    <span class="mx-2">/</span>
                    <strong class="text-black">Giỏ hàng</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-12">

                    <?php if (empty($cart)): ?>
                        <p>Chưa có sản phẩm trong giỏ</p>
                    <?php else: ?>

                        <table class="table table-bordered">

                            <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên</th>
                                    <th>Giá</th>
                                    <th>SL</th>
                                    <th>Tổng</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach ($cart as $key => $item): ?>

                                    <?php
                                    $sum = $item['price'] * $item['quantity'];
                                    $total += $sum;
                                    ?>

                                    <tr>

                                        <td>
                                            <img src="public/assets/images/<?= $item['image'] ?>" width="80">
                                        </td>

                                        <td><?= $item['name'] ?></td>

                                        <td><?= number_format($item['price']) ?> đ</td>

                                        <td><?= $item['quantity'] ?></td>

                                        <td><?= number_format($sum) ?> đ</td>

                                        <td>
                                            <!-- NÚT XÓA ĐÃ SỬA -->
                                            <a href="index.php?page=deletecart&key=<?= $key ?>"
                                                onclick="return confirm('Bạn có chắc muốn xóa?')" 
                                                class="btn-delete">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>
                        </table>

                    <?php endif; ?>

                </div>
            </div>

            <div class="row">

                <div class="col-md-6">
                    <a href="index.php?page=product" class="btn btn-outline-primary btn-sm">
                        Tiếp tục mua hàng
                    </a>
                </div>

                <div class="col-md-6 text-right">
                    <?php if (!empty($cart)): ?>

                        <h4>Tổng tiền: <strong><?= number_format($total) ?> đ</strong></h4>

                        <a href="index.php?page=checkout" class="btn btn-primary">
                            Thanh toán
                        </a>

                    <?php endif; ?>
                </div>

            </div>

        </div>
    </div>

</div>