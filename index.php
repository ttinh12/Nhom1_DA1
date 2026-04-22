<?php
ob_start();
session_start();

// ===== LOAD MODEL =====
require_once "Model/Database.php";
require_once "Model/Product.php";

// ===== CONNECT DB =====
$db = new Database();
$connect = $db->connect();

// ===== LOAD CONTROLLER =====
require_once "Client/Controller/AuthController.php";
require_once "Client/Controller/ProductController.php";

// ===== INIT =====
$productModel = new Product($connect);
$auth = new AuthController($connect);

// ===== ROUTER =====
$page = $_GET['page'] ?? 'home';

// ===== HEADER =====
include "Client/View/Layouts/header.php";

// ===== XỬ LÝ =====
switch ($page) {

    case 'home':
        $products = $productModel->getAll();
        include "Client/View/Pages/home.php";
        break;

    case 'product':
        $products = $productModel->getAll();
        include "Client/View/Pages/product.php";
        break;

    case 'product_detail':
        $controller = new ProductController($connect);
        $controller->detail();
        break;

    case 'cart':
        include "Client/View/Pages/cart.php";
        break;

    case 'checkout':
        include "Client/View/Pages/checkout.php";
        break;

    case 'addtocart':
        $controller = new ProductController($connect);
        $controller->addToCart();
        exit;

    // ===== AUTH =====
    case 'login':
        $auth->login();
        break;

    case 'register':
        $auth->register();
        break;

    case 'logout':
        $auth->logout();
        break;

    case 'deletecart':
        $id = $_GET['id'] ?? 0;
        if ($id && isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        header("Location: index.php?page=cart");
        exit;

    default:
        $products = $productModel->getAll();
        include "Client/View/Pages/home.php";
        break;
}

// ===== FOOTER =====
include "Client/View/Layouts/footer.php";