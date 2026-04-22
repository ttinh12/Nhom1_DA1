<?php
session_start();

require_once "../Model/Database.php";

$db = new Database();
$connect = $db->connect();

require_once "Controller/ProductController.php";
require_once "Controller/CategoryController.php";

$productCtrl = new ProductController($connect);
$categoryCtrl = new CategoryController($connect);

$act = $_GET['act'] ?? 'dashboard';

// xử lý trước (chỉ xử lý logic, KHÔNG render view)
switch ($act) {

    // product
    case 'add-product':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productCtrl->addProduct();
        }
        break;

    case 'edit-product':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productCtrl->editProduct($_GET['id'] ?? 0);
        }
        break;

    case 'delete-product':
        $productCtrl->deleteProduct($_GET['id'] ?? 0);
        break;

    // category
    case 'category-create':
        $categoryCtrl->create();
        break;

    case 'category-update':
        $categoryCtrl->update();
        break;

    case 'category-delete':
        $categoryCtrl->delete();
        break;
}

include "View/layouts/header.php";
?>

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    <?php include "View/layouts/sidebar.php"; ?>

    <div class="layout-page">

      <?php include "View/layouts/navbar.php"; ?>

      <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

          <?php
          switch ($act) {

            case 'dashboard':
              include "View/dashboard.php";
              break;

            // product
            case 'products':
              $productCtrl->listProduct();
              break;

            case 'add-product':
              include "View/Modules/products/create.php";
              break;

            case 'edit-product':
              $product = $productCtrl->getById($_GET['id'] ?? 0);
              $variants = $productCtrl->getVariants($_GET['id'] ?? 0);
              include "View/Modules/products/update.php";
              break;

            case 'show-product':
              $productCtrl->showProduct($_GET['id'] ?? 0);
              break;

            // category
            case 'category':
              $categories = $categoryCtrl->index();
              include "View/Modules/categories/index.php";
              break;

            case 'category-create':
              include "View/Modules/categories/create.php";
              break;

            case 'category-update':
              $category = $categoryCtrl->getById($_GET['id'] ?? 0);
              include "View/Modules/categories/update.php";
              break;

            default:
              include "View/dashboard.php";
              break;
          }
          ?>

        </div>

        <?php include "View/layouts/footer.php"; ?>

      </div>
    </div>

  </div>
</div>