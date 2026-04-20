<?php
// 1. Header: Chứa các thẻ <head>, CSS và mở các thẻ div layout chính
include 'View/layouts/header.php';

// 2. Sidebar: Menu bên trái
include 'View/layouts/sidebar.php';
?>

<div class="layout-page">

    <?php
    include 'View/layouts/navbar.php';
    ?>

    <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">

            <?php
            switch ($action) {
                case 'dashboard':
                    include 'View/dashboard.php';
                    break;
                case 'products':
                    include 'View/products.php';
                    break;
                case 'categories':
                    include 'View/categories.php';
                    break;
                case 'orders':
                    include 'View/orders.php';
                    break;
                case 'users':
                    include 'View/users.php';
                    break;
                default:
                    include 'View/dashboard.php';
            }
            ?>

        </div>
        <?php
        // 7. Footer: Chứa thông tin bản quyền và đóng toàn bộ các thẻ div đã mở
        include 'View/layouts/footer.php';
        ?>