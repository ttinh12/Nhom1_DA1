<?php
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'Model/Database.php';
require_once 'Controller/ProductController.php';
$db = new Database();
$connect = $db->connect();
$productCtrl = new ProductController($connect);
$act = $_GET['act'] ?? 'dashboard';

include 'View/layouts/header.php';

// 2. Sidebar: <aside>...</aside>
include 'View/layouts/sidebar.php';
?>

<!-- Layout page -->
<div class="layout-page">

  <?php
  // 3. Navbar: thanh trên cùng
  include 'View/layouts/navbar.php';
  ?>

  <!-- Content wrapper -->
  <div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

      <?php
      switch ($act) {
        case 'products':
          $productCtrl->listProduct();
          break;

        case 'add-product':
          $productCtrl->addProduct(); // Hàm này đã bao gồm cả xử lý POST và include VIEW bên trong
          break;

        case 'delete-product':
          $id = $_GET['id'] ?? null;
          if ($id) {
            $productCtrl->deleteProduct($id);
          }
          break;
        case 'show-product':
          $id = $_GET['id'] ?? null;
          if ($id) {
            $productCtrl->showProduct($id);
          } else {
            header("Location: index.php?act=products");
          }
          break;
        case 'edit-product':
          $id = $_GET['id'] ?? null;
          if ($id) {
            $productCtrl->editProduct($id);
          }
          break;

        default:
          include 'View/dashboard.php';
          break;
      }
      ?>

    </div>
    <?php
    // 4. Footer: đóng content-wrapper, layout-page, layout-container, layout-wrapper, </body>, </html>
    include 'View/layouts/footer.php';
    ?>