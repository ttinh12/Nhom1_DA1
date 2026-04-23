<?php
session_start();

require_once "Model/Database.php";
require_once "Model/Product.php";
require_once "Client/Controller/AuthController.php";
require_once "Client/Controller/ProductController.php";

$db = new Database();
$connect = $db->connect();

$productModel = new Product($connect);
$auth = new AuthController($connect);
$productCtrl = new ProductController($connect);

$page = $_GET['page'] ?? 'home';

// xu ly action khong load layout
switch ($page) {

    case 'addtocart':
        $productCtrl->addToCart();
        exit;

    case 'logout':
        $auth->logout();
        exit;

    case 'deletecart':
        $key = $_GET['key'] ?? '';
        if ($key && isset($_SESSION['cart'][$key])) {
            unset($_SESSION['cart'][$key]);
        }
        header("Location: index.php?page=cart");
        exit;

    case 'updatecart':
        $key = $_GET['key'] ?? '';
        $action = $_GET['action'] ?? '';

        if ($key && isset($_SESSION['cart'][$key])) {

            if ($action == 'plus') {
                $_SESSION['cart'][$key]['quantity']++;
            }

            if ($action == 'minus') {
                if ($_SESSION['cart'][$key]['quantity'] > 1) {
                    $_SESSION['cart'][$key]['quantity']--;
                } else {
                    unset($_SESSION['cart'][$key]);
                }
            }
        }

        header("Location: index.php?page=cart");
        exit;
}

// load header
include "Client/View/Layouts/header.php";

// load page
switch ($page) {

    case 'login':
        $auth->login();
        break;

    case 'register':
        $auth->register();
        break;

    case 'home':
        $products = $productModel->getAll();
        include "Client/View/Pages/home.php";
        break;

    case 'product':
        $category_id = $_GET['category'] ?? 0;

        if ($category_id) {
            $products = $productModel->getByCategory($category_id);
        } else {
            $products = $productModel->getAll();
        }

        $categories = $productModel->getCategories();
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
        include "Client/View/Pages/Contact.php";
        break;

    case 'blog':
        include "Client/View/Pages/Blog/blog.php";
        break;

    case 'blog-detail':
        include "Client/View/Pages/Blog/blog_detail.php";
        break;

    default:
        $products = $productModel->getAll();
        include "Client/View/Pages/home.php";
        break;
}

// load footer
include "Client/View/Layouts/footer.php";