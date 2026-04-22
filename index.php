<?php
ob_start();
session_start();
require_once __DIR__ . "/Model/Database.php";
$page = $_GET['page']??'';

$db = new Database();
$connect = $db->connect();

include "Client/View/Layouts/header.php";

if ($page == 'home' || $page == 'product') {
    require_once __DIR__ . "/Model/Product.php";

    $product = new Product($connect);
    $products = $product->getAll();
}

require_once "Client/Controller/AuthController.php";
$auth = new AuthController($connect);


// ===== ROUTE =====
switch ($page) {
 
    case 'home':
        include "Client/View/Pages/home.php";
        break;

    case 'product':
        include "Client/View/Pages/product.php";
        break;

    case 'product_detail':
        require_once __DIR__ . "/Client/Controller/ProductController.php";
        $productController = new ProductController();
        $productController->detail();
        break;

    case 'cart':
        include "Client/View/Pages/cart.php";
        break;

    case 'checkout':
        include "Client/View/Pages/checkout.php";
        break;

    case 'addtocart':
        require_once __DIR__ . "/Client/Controller/ProductController.php";
        $controller = new ProductController();
        $controller->addToCart();
        break;
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
        include "Client/View/Pages/home.php";
        break;
}

include "Client/View/Layouts/footer.php";
