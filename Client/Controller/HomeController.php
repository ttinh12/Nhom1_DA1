<?php
require_once "Model/Product.php";

class HomeController
{

    private $product;

    public function __construct($connect)
    {
        $this->product = new Product($connect);
    }

    public function index()
    {
        $products = $this->product->getAll();
        include "Client/View/Pages/home.php";
    }

    public function product()
    {
        $products = $this->product->getAll();

        require "Client/View/Pages/product.php";
    }
}
