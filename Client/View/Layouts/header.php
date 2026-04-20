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
                            <a href="index.html" class="js-logo-clone">ShopMax</a>
                        </div>
                    </div>

                    <!-- MENU -->
                    <div class="main-nav d-none d-lg-block">
                        <nav class="site-navigation text-right text-md-center" role="navigation">
                            <ul class="site-menu js-clone-nav d-none d-lg-block">

                                <li class="has-children active">
                                    <a href="<?= '?page=home' ?>">Trang chủ</a>
                                </li>

                                <li><a href="<?= '?page=product' ?>">Cửa hàng</a></li>
                                <li><a href="#">Danh mục</a></li>
                                <li><a href="index.php?page=about">Giới thiệu</a></li>
                                <li><a href="<?= '?page=contact' ?>">Liên hệ</a></li>

                            </ul>
                        </nav>
                    </div>

                    <!-- ICON -->
                    <div class="icons">

                        <a href="#" class="icons-btn d-inline-block js-search-open">
                            <span class="icon-search"></span>
                        </a>

                        <a href="#" class="icons-btn d-inline-block">
                            <span class="icon-heart-o"></span>
                        </a>

                        <a href="cart.html" class="icons-btn d-inline-block bag">
                            <span class="icon-shopping-bag"></span>
                            <span class="number">2</span>
                        </a>

                        <!-- LOGIN -->
                        <a href="index.php?page=login">
                            <span class="icon-user"></span> Đăng nhập
                        </a>

                        <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none">
                            <span class="icon-menu"></span>
                        </a>

                    </div>
                </div>
            </div>
        </div>