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
    public function detail($id)
    {
        require_once "Model/Database.php";
        require_once "Model/Product.php";

        $db = new Database();
        $connection = $db->connect();

        $product = new Product($connection); // dùng để test

        $chiTiet = $product->getById($id);

        echo "<pre>";
        print_r($chiTiet);
        echo "</pre>";
    }
    public function insert()
    {
        require_once "Model/Database.php";
        require_once "Model/Product.php";

        $db = new Database();
        $connection = $db->connect();

        $product = new Product($connection); // dùng để test

        $result = $product->insert("Sản phẩm mới", 1, "Tiêu đề sản phẩm mới", "Mô tả sản phẩm mới", 100000, "images/product.jpg");

        if ($result) {
            echo "Thêm sản phẩm thành công!";
        } else {
            echo "Thêm sản phẩm thất bại!";
        }
    }
    public function delete($id)
    {
        require_once "Model/Database.php";
        require_once "Model/Product.php";

        $db = new Database();
        $connection = $db->connect();

        $product = new Product($connection); // dùng để test

        $result = $product->delete($id);

        if ($result) {
            echo "Xóa sản phẩm thành công!";
        } else {
            echo "Xóa sản phẩm thất bại!";
        }
    }
    
}