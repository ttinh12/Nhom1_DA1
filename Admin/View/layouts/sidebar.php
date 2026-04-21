<?php
$page = $_GET['page'] ?? 'dashboard';
$admin_url = "/admin/index.php";
?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- LOGO -->
    <div class="app-brand demo">
        <a href="<?= $admin_url ?>?page=dashboard" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Admin</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <!-- DASHBOARD -->
        <li class="menu-item <?= $page == 'dashboard' ? 'active' : '' ?>">
            <a href="<?= $admin_url ?>?page=dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Cửa hàng</span>
        </li>

        <!-- SẢN PHẨM -->
        <li
            class="menu-item <?= in_array($page, ['product', 'product-create', 'product-update']) ? 'active open' : '' ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div>Sản phẩm</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?='?act=products' ?>" class="menu-link">
                        <div data-i18n="Account">Xem sản phẩm</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?='?act=product_create' ?>" class="menu-link">
                        <div data-i18n="Notifications">Thêm sản phẩm</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications">Danh mục</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="auth-login-basic.html" class="menu-link" target="_blank">
                        <div data-i18n="Basic">Xem danh mục</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="auth-register-basic.html" class="menu-link" target="_blank">
                        <div data-i18n="Basic">Thêm danh mục</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Đơn hàng</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="pages-misc-error.html" class="menu-link">
                        <div data-i18n="Error">Xem đơn hàng</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-misc-under-maintenance.html" class="menu-link">
                        <div data-i18n="Under Maintenance">Thêm đơn hàng</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Người dùng</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="pages-misc-error.html" class="menu-link">
                        <div data-i18n="Error">Xem người dùng</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="pages-misc-under-maintenance.html" class="menu-link">
                        <div data-i18n="Under Maintenance">Thêm người dùng</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- DANH MỤC -->
        <?php $page = $_GET['page'] ?? 'dashboard'; ?>

        <?php $admin_url = "/admin/index.php"; ?> <!-- FIX -->

        <!-- DANH MỤC -->
        <li
            class="menu-item <?= in_array($page, ['category', 'category-create', 'category-update']) ? 'active open' : '' ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div>Danh mục</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item <?= $page == 'category' ? 'active' : '' ?>">
                    <a href="<?= $admin_url ?>?page=category" class="menu-link">
                        <div>Xem danh mục</div>
                    </a>
                </li>

                <li class="menu-item <?= $page == 'category-create' ? 'active' : '' ?>">
                    <a href="<?= $admin_url ?>?page=category-create" class="menu-link">
                        <div>Thêm danh mục</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- ĐƠN HÀNG -->
        <li class="menu-item <?= in_array($page, ['order']) ? 'active open' : '' ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div>Đơn hàng</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item <?= $page == 'order' ? 'active' : '' ?>">
                    <a href="<?= $admin_url ?>?page=order" class="menu-link">
                        <div>Xem đơn hàng</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- NGƯỜI DÙNG -->
        <li class="menu-item <?= $page == 'user' ? 'active' : '' ?>">
            <a href="<?= $admin_url ?>?page=user" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>Người dùng</div>
            </a>
        </li>

    </ul>
</aside>