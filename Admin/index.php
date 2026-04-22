<?php
session_start();

require_once "../model/database.php";
require_once "controller/productcontroller.php";
require_once "controller/categorycontroller.php";

$db = new database();
$connect = $db->connect();

$productctrl = new productcontroller($connect);
$categoryctrl = new categorycontroller($connect);

$act = $_GET['act'] ?? 'dashboard';

switch ($act) {

    case 'add-product':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productctrl->addproduct();
        }
        break;

    case 'edit-product':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productctrl->editproduct($_GET['id'] ?? 0);
        }
        break;

    case 'delete-product':
        $productctrl->deleteproduct($_GET['id'] ?? 0);
        break;

    case 'category-create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryctrl->create();
        }
        break;

    case 'category-update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryctrl->update();
        }
        break;

    case 'category-delete':
        $categoryctrl->delete();
        break;
}

include "view/layouts/header.php";
?>

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    <?php include "view/layouts/sidebar.php"; ?>

    <div class="layout-page">

      <?php include "view/layouts/navbar.php"; ?>

      <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

          <?php
          switch ($act) {

            case 'dashboard':
              include "view/dashboard.php";
              break;

            case 'products':
              $productctrl->listproduct();
              break;

            case 'add-product':
              $productctrl->addproduct(); // sửa tại đây
              break;

            case 'edit-product':
              $productctrl->editproduct($_GET['id'] ?? 0);
              break;

            case 'show-product':
              $productctrl->showproduct($_GET['id'] ?? 0);
              break;

            case 'category':
              $categories = $categoryctrl->index();
              include "view/modules/categories/index.php";
              break;

            case 'category-create':
              include "view/modules/categories/create.php";
              break;

            case 'category-update':
              $category = $categoryctrl->getbyid($_GET['id'] ?? 0);
              include "view/modules/categories/update.php";
              break;

            default:
              include "view/dashboard.php";
              break;
          }
          ?>

        </div>

        <?php include "view/layouts/footer.php"; ?>

      </div>
    </div>

  </div>
</div>