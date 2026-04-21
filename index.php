<?php
session_start();

$page = $_GET['page'] ?? 'home';

require_once __DIR__ . "/Model/Database.php";

$db = new Database();
$connect = $db->connect();


include "Client/View/Layouts/header.php";

if ($page == 'home' || $page == 'product') {
    require_once __DIR__ . "/Model/Product.php";

    $product = new Product($connect);
    $products = $product->getAll();
}


require_once __DIR__ . "/Client/Controller/AuthController.php";
$auth = new AuthController($connect);

// ===== ROUTE =====
switch ($page) {

    case 'home':
        include "Client/View/Pages/home.php";
        break;

    case 'product':
        include "Client/View/Pages/product.php";
        break;

    case 'contact':
        include "Client/View/Pages/contact.php";
        break;

    case 'about':
        include "Client/View/Pages/about.php";
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

    default:
        include "Client/View/Pages/home.php";
        break;
}

include "Client/View/Layouts/footer.php";
