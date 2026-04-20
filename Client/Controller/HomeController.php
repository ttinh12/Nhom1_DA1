<?php
require_once "Model/Product.php";

class HomeController {

    private $product;

    public function __construct($connect)
    {
        $this->product = new Product($connect);
    }

    public function index()
    {
        $products = $this->product->getAll();

        // debug thử nếu chưa ra
        // var_dump($products); die;

        include "View/home.php";
    }
}