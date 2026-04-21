<?php
$page = $_GET['page'] ?? 'home';

// Các trang có layout riêng
$standalone_pages = ['blog', 'blog-detail', 'cart'];

if (!in_array($page, $standalone_pages)) {
    // gọi header
    include "Client/View/Layouts/header.php";
}

// load data cho cả home + product
if ($page == 'home' || $page == 'product') {
    require_once "Model/Database.php";
    require_once "Model/Product.php";

    $db = new Database();
    $connect = $db->connect();

    $product = new Product($connect);
    $products = $product->getAll();
}

// điều hướng
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
        include "Client/View/Pages/Auth/login.php";
        break;

    case 'register':
        include "Client/View/Pages/Auth/register.php";
        break;
}

if (!in_array($page, $standalone_pages)) {
    // gọi footer
    include "Client/View/Layouts/footer.php";
}





// require_once "Model/Database.php";
// require_once "Model/Product.php";

// $db = new Database();
// $connection = $db->connect();

// $product = new Product($connection); // dùng để test

// $danhSach = $product->getAll('auto');

// foreach ($danhSach as $value){
//     echo $value['title'] . "<hr>";
// }
