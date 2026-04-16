<?php
$page = $_GET['page'] ?? 'home';

// gọi header
include "Client/View/Layouts/header.php";

// điều hướng trang
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
}

// gọi footer
include "Client/View/Layouts/footer.php";





// require_once "Model/Database.php";
// require_once "Model/Product.php";

// $db = new Database();
// $connection = $db->connect();

// $product = new Product($connection); // dùng để test

// $danhSach = $product->getAll('auto');

// foreach ($danhSach as $value){
//     echo $value['title'] . "<hr>";
// }
