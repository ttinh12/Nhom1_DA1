<?php

class ProductController
{
    public function index()
    {
        require_once "Model/Database.php";
        require_once "Model/Product.php";

        $db = new Database();
        $connection = $db->connect();

        $product = new Product($connection); // dùng để test

        $danhSach = $product->getAll();

        foreach ($danhSach as $value) {
            echo $value['title'] . "<hr>";
        }
    }
}