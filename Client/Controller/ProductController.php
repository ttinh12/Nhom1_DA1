<?php

class ProductController
{
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