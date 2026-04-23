<?php
$act = $_GET['act'] ?? 'dashboard';
$admin_url = "/Admin/index.php";
?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <div class="app-brand demo">
        <a href="<?= $admin_url ?>?act=dashboard" class="app-brand-link">
            <span class="app-brand-text menu-text fw-bolder ms-2">Admin</span>
        </a>
    </div>

    <ul class="menu-inner py-1">

        <!-- dashboard -->
        <li class="menu-item <?= $act == 'dashboard' ? 'active' : '' ?>">
            <a href="<?= $admin_url ?>?act=dashboard" class="menu-link">
                <i class="bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li class="menu-header">Cửa hàng</li>

        <!-- sản phẩm -->
        <li class="menu-item <?= in_array($act, ['products', 'add-product', 'edit-product']) ? 'active open' : '' ?>">
            <a href="#" class="menu-link menu-toggle">
                <i class="bx bx-box"></i>
                <div>Sản phẩm</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= $admin_url ?>?act=products" class="menu-link">Xem sản phẩm</a>
                </li>
                <li class="menu-item">
                    <a href="<?= $admin_url ?>?act=add-product" class="menu-link">Thêm sản phẩm</a>
                </li>
            </ul>
        </li>

        <!-- danh mục -->
        <li
            class="menu-item <?= in_array($act, ['category', 'category-create', 'category-update']) ? 'active open' : '' ?>">
            <a href="#" class="menu-link menu-toggle">
                <i class="bx bx-category"></i>
                <div>Danh mục</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= $admin_url ?>?act=category" class="menu-link">Xem danh mục</a>
                </li>
                <li class="menu-item">
                    <a href="<?= $admin_url ?>?act=category-create" class="menu-link">Thêm danh mục</a>
                </li>
            </ul>
        </li>

        <!-- đơn hàng -->
        <li class="menu-item <?= in_array($act, ['orders', 'order-detail']) ? 'active open' : '' ?>">
            <a href="#" class="menu-link menu-toggle">
                <i class="bx bx-cart"></i>
                <div>Đơn hàng</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= $admin_url ?>?act=orders" class="menu-link">Xem đơn hàng</a>
                </li>
            </ul>
        </li>
        <!-- người dùng -->
        <li class="menu-item <?= in_array($act, ['users']) ? 'active open' : '' ?>">
            <a href="#" class="menu-link menu-toggle">
                <i class="bx bx-user"></i>
                <div>Người dùng</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= $admin_url ?>?act=users" class="menu-link">Danh sách người dùng</a>
                </li>
            </ul>
        </li>

    </ul>
</aside>