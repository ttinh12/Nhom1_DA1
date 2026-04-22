<?php
session_start();

// load model
require_once "Model/Database.php";
require_once "Model/Product.php";

// connect
$db = new Database();
$connect = $db->connect();

// load controller
require_once "Client/Controller/AuthController.php";
require_once "Client/Controller/ProductController.php";

// init
$productModel = new Product($connect);
$auth = new AuthController($connect);
$productCtrl = new ProductController();

// router
$page = $_GET['page'] ?? 'home';

// header
include "Client/View/Layouts/header.php";

// xử lý action trước (POST)
switch ($page) {

    case 'addtocart':
        $productCtrl->addToCart();
        exit;

    case 'login':
        $auth->login();
        break;

    case 'register':
        $auth->register();
        break;

    case 'logout':
        $auth->logout();
        break;
}

// hiển thị view
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
        $productCtrl->detail();
        break;

    case 'cart':
        include "Client/View/Pages/cart.php";
        break;

    case 'checkout':
        include "Client/View/Pages/checkout.php";
        break;

    case 'about':
        include "Client/View/Pages/about.php";
        break;

    case 'contact':
        include "Client/View/Pages/contact.php";
        break;

    case 'blog':
        include "Client/View/Pages/Blog/blog.php";
        break;

    case 'blog-detail':
        include "Client/View/Pages/blog-detail.php";
        break;

    
    case 'deletecart':
        $key = $_GET['key'] ?? '';

        if (isset($_SESSION['cart'][$key])) {
            unset($_SESSION['cart'][$key]);
        }

        header("Location: index.php?page=cart");
        exit;

    default:
        $products = $productModel->getAll();
        include "Client/View/Pages/home.php";
        break;
}

// footer
include "Client/View/Layouts/footer.php";