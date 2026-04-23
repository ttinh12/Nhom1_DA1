<?php
session_start();

require_once __DIR__ . "/../Model/Database.php";
require_once __DIR__ . "/Controller/ProductController.php";
require_once __DIR__ . "/Controller/CategoryController.php";
require_once __DIR__ . "/Controller/OrderController.php";

$db = new Database();
$connect = $db->connect();

$productctrl  = new ProductController($connect);
$categoryctrl = new CategoryController($connect);
$orderctrl    = new OrderController($connect);

$act = $_GET['act'] ?? 'dashboard';

// ============================================================
// BƯỚC 1: Xử lý các action chỉ redirect (chạy TRƯỚC header)
// ============================================================
switch ($act) {

    // --- Sản phẩm ---
    case 'delete-product':
        $productctrl->deleteProduct($_GET['id'] ?? 0);
        exit;

    case 'add-product':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productctrl->addProduct();
            exit;
        }
        break;

    case 'edit-product':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productctrl->editProduct($_GET['id'] ?? 0);
            exit;
        }
        break;

    // --- Danh mục ---
    case 'category-create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryctrl->create();
            exit;
        }
        break;

    case 'category-update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryctrl->update();
            exit;
        }
        break;

    case 'category-delete':
        $categoryctrl->delete();
        exit;

    // --- Đơn hàng ---
    case 'order-update-status':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderctrl->updateStatus();
            exit;
        }
        break;
}

// ============================================================
// BƯỚC 2: Render layout (header luôn xuất hiện từ đây)
// ============================================================
include __DIR__ . "/View/layouts/header.php";
?>

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    <?php include __DIR__ . "/View/layouts/sidebar.php"; ?>

    <div class="layout-page">

      <?php include __DIR__ . "/View/layouts/navbar.php"; ?>

      <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

          <?php
          // ============================================================
          // BƯỚC 3: Render view theo act (chỉ các case có giao diện)
          // ============================================================
          switch ($act) {

            case 'dashboard':
              include __DIR__ . "/View/dashboard.php";
              break;

            // --- Sản phẩm ---
            case 'products':
              $productctrl->listProduct();
              break;

            case 'add-product':
              $productctrl->addProduct();
              break;

            case 'edit-product':
              $productctrl->editProduct($_GET['id'] ?? 0);
              break;

            case 'show-product':
              $productctrl->showProduct($_GET['id'] ?? 0);
              break;

            // --- Danh mục ---
            case 'category':
              $categories = $categoryctrl->index();
              include __DIR__ . "/View/modules/categories/index.php";
              break;

            case 'category-create':
              include __DIR__ . "/View/modules/categories/create.php";
              break;

            case 'category-update':
              $category = $categoryctrl->getById($_GET['id'] ?? 0);
              include __DIR__ . "/View/modules/categories/update.php";
              break;

            // --- Đơn hàng ---
            case 'orders':
              $orderctrl->listOrder();
              break;

            case 'order-detail':
              $orderctrl->detail($_GET['id'] ?? 0);
              break;

            default:
              include __DIR__ . "/View/dashboard.php";
              break;
          }
          ?>

        </div>

        <?php include __DIR__ . "/View/layouts/footer.php"; ?>

      </div>
    </div>

  </div>
</div>