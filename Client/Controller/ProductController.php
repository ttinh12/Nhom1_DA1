<?php

class ProductController
{

    private $productModel; // 👉 khai báo

    public function __construct()
    {
        require_once __DIR__ . "/../../Model/Database.php";
        require_once __DIR__ . "/../../Model/Product.php";

        $db = new Database();
        $connect = $db->connect();

        // 👉 khởi tạo
        $this->productModel = new Product($connect);
    }

    public function detail()
    {
        $id = $_GET['id'] ?? 0;

        $product = $this->productModel->getById($id);
        $variants = $this->productModel->getVariantsByProductId($id);
        $product = $this->productModel->getByIdWithCategory($id);
        $relatedProducts = $this->productModel ->getRelatedProducts($product['category_id'], $id);

        if (!$product) {
            echo "Không tìm thấy sản phẩm";
            return;
        }

        include "Client/View/Pages/Product/ProductDetail.php";
    }

    public function addToCart()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        require_once __DIR__ . "/../../Model/Database.php";
        require_once __DIR__ . "/../../Model/Product.php";

        $db = new Database();
        $connect = $db->connect();

        $productModel = new Product($connect);

        // FIX CHÍNH Ở ĐÂY
        $id = $_POST['product_id'] ?? 0;

        if (!$id) {
            echo "Thiếu id sản phẩm";
            return;
        }

        $product = $productModel->getById($id);

        if (!$product) {
            echo "Không tìm thấy sản phẩm";
            return;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            $_SESSION['cart'][$id] = [
                'id' => $id,
                'name' => $product['name'],
                'price' => $product['base_price'],
                'image' => $product['images'],
                'quantity' => 1
            ];
        }

        header("Location: index.php?page=cart");
        exit;
    }
}