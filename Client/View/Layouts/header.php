<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <title>ShopMax</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/css/style.css">
    <link rel="stylesheet" href="public/assets/fonts/icomoon/style.css">
</head>

<body>
    <div class="site-wrap">
        <div class="site-navbar bg-white py-2">

            <div class="search-wrap">
                <div class="container">
                    <a href="#" class="search-close js-search-close">
                        <span class="icon-close2"></span>
                    </a>
                    <form action="#" method="post">
                        <input type="text" class="form-control" placeholder="Nhập từ khóa và nhấn Enter...">
                    </form>
                </div>
            </div>

            <div class="container">
                <div class="d-flex align-items-center justify-content-between">

                    <!-- LOGO -->
                    <div class="logo">
                        <div class="site-logo">
                            <a href="index.php?page=home" class="js-logo-clone">ShopMax</a>
                        </div>
                    </div>

                    <!-- MENU -->
                    <div class="main-nav d-none d-lg-block">
                        <nav class="site-navigation text-right text-md-center" role="navigation">
                            <ul class="site-menu js-clone-nav d-none d-lg-block">

                                <li class="active">
                                    <a href="index.php?page=home">Trang chủ</a>
                                </li>

                                <li><a href="index.php?page=product">Cửa hàng</a></li>
                                <li><a href="#">Danh mục</a></li>
                                <li><a href="index.php?page=about">Giới thiệu</a></li>
                                <li><a href="index.php?page=contact">Liên hệ</a></li>

                            </ul>
                        </nav>
                    </div>

                    <!-- ICON -->
                    <div class="icons d-flex align-items-center gap-3">

                        <!-- SEARCH -->
                        <a href="#" class="icons-btn d-inline-block js-search-open">
                            <span class="icon-search"></span>
                        </a>

                        <!-- HEART -->
                        <a href="#" class="icons-btn d-inline-block">
                            <span class="icon-heart-o"></span>
                        </a>

                        <!-- CART -->
                        <a href="index.php?page=cart" class="icons-btn d-inline-block bag">
                            <span class="icon-shopping-bag"></span>
                            <span class="number">2</span>
                        </a>

                        <!-- USER -->
                        <?php if (isset($_SESSION['user'])): ?>

                            <a href="#" class="icons-btn d-inline-block">
                                <span class="icon-user"></span>
                                <?= htmlspecialchars($_SESSION['user']['name']) ?>
                            </a>

                            <a href="index.php?page=logout" class="icons-btn d-inline-block">
                                Đăng xuất
                            </a>

                        <?php else: ?>

                            <a href="index.php?page=login" class="icons-btn d-inline-block">
                                <span class="icon-user"></span> Đăng nhập
                            </a>

                        <?php endif; ?>

                        <!-- MOBILE MENU -->
                        <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none">
                            <span class="icon-menu"></span>
                        </a>

                    </div>
                </div>
            </div>
        </div>