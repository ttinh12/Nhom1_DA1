<?php
session_start();

// connect database
require_once "../Model/Database.php";

$db = new Database();
$connect = $db->connect();

// load controller
require_once "Controller/ProductController.php";
require_once "Controller/CategoryController.php";
require_once "Controller/OrderController.php";

// khởi tạo
$productCtrl = new ProductController($connect);
// $categoryCtrl = new CategoryController($connect);
// $orderCtrl = new OrderController($connect);

// router
$act = $_GET['act'] ?? 'dashboard';

// header
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

            // dashboard
            case 'dashboard':
              include "View/dashboard.php";
              break;

            // product
            case 'products':
              $productCtrl->listProduct();
              break;

            case 'add-product':
              $productCtrl->addProduct();
              break;

            case 'edit-product':
              $productCtrl->editProduct($_GET['id'] ?? 0);
              break;

            case 'delete-product':
              $productCtrl->deleteProduct($_GET['id'] ?? 0);
              break;

            case 'show-product':
              $productCtrl->showProduct($_GET['id'] ?? 0);
              break;

            // category
            // case 'category':
            //   $categoryCtrl->index();
            //   break;

            // case 'category-create':
            //   $categoryCtrl->create();
            //   break;

            // case 'category-update':
            //   $categoryCtrl->update();
            //   break;

            // case 'category-delete':
            //   $categoryCtrl->delete();
            //   break;

            // order
            // case 'orders':
            //   $orderCtrl->index();
            //   break;

            // case 'order-detail':
            //   $orderCtrl->show($_GET['id'] ?? 0);
            //   break;

            // mặc định
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