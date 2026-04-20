<?php
// 1. Header: Chứa các thẻ <head>, CSS và mở các thẻ div layout chính
include 'View/layouts/header.php';

// 2. Sidebar: Menu bên trái
include 'View/layouts/sidebar.php';
?>

<div class="layout-page">

    <?php
    // 4. Navbar: Thanh tìm kiếm và User profile nằm trên cùng của layout-page
    include 'View/layouts/navbar.php';
    ?>

    <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">

            <?php
            // ĐÂY LÀ NƠI BẠN GẮN FILE DASHBOARD
            include 'View/dashboard.php';
            ?>

        </div>
        <?php
        // 7. Footer: Chứa thông tin bản quyền và đóng toàn bộ các thẻ div đã mở
        include 'View/layouts/footer.php';
        ?>