<?php
ob_start();
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Kết nối DB
require_once 'Model/Database.php';
$db = new Database();
$connect = $db->connect();

// Controllers
require_once 'Controller/ProductController.php';
require_once 'Controller/CategoryController.php';

$productCtrl = new ProductController($connect);
$categoryController = new CategoryController($connect);

// Router chung
$act = $_GET['act'] ?? 'dashboard';
?>

<?php include 'View/layouts/header.php'; ?>

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    <?php include 'View/layouts/sidebar.php'; ?>

    <div class="layout-page">

      <?php include 'View/layouts/navbar.php'; ?>

      <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

          <?php
          switch ($act) {

            // ===== DASHBOARD =====
            case 'dashboard':
              include 'View/dashboard.php';
              break;

            // ===== PRODUCT =====
            case 'products':
              $productCtrl->listProduct();
              break;

            case 'add-product':
              $productCtrl->addProduct();
              break;

            case 'edit-product':
              $id = $_GET['id'] ?? null;
              if ($id) $productCtrl->editProduct($id);
              break;

            case 'delete-product':
              $id = $_GET['id'] ?? null;
              if ($id) $productCtrl->deleteProduct($id);
              break;

            case 'show-product':
              $id = $_GET['id'] ?? null;
              if ($id) {
                $productCtrl->showProduct($id);
              } else {
                header("Location: index.php?act=products");
              }
              break;

            // ===== CATEGORY =====
            case 'category':
              $categoryController->index();
              break;

            case 'category-create':
              $categoryController->create();
              break;

            case 'category-update':
              $categoryController->update();
              break;

            case 'category-delete':
              $categoryController->delete();
              break;

            // ===== DEFAULT =====
            default:
              include 'View/dashboard.php';
              break;
          }
          ?>

        </div>

        <?php include 'View/layouts/footer.php'; ?>

      </div>
    </div>

  </div>
</div>