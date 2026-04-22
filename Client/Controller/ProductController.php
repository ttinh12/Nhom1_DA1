<?php

class ProductController
{
    private $productModel;

    public function __construct()
    {
        require_once __DIR__ . "/../../Model/Database.php";
        require_once __DIR__ . "/../../Model/Product.php";

        $db = new Database();
        $connect = $db->connect();

        $this->productModel = new Product($connect);
    }

    public function detail()
    {
        $id = $_GET['id'] ?? 0;

        $product = $this->productModel->getByIdWithCategory($id);
        $variants = $this->productModel->getVariantsByProductId($id);
        $relatedProducts = $this->productModel->getRelatedProducts($product['category_id'], $id);

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

        $product_id = $_POST['product_id'] ?? 0;
        $variant_id = $_POST['variant_id'] ?? 0;
        $qty = $_POST['qty'] ?? 1;

        if (!$product_id || !$variant_id) {
            echo "Thiếu dữ liệu";
            return;
        }

        $product = $this->productModel->getById($product_id);
        $variants = $this->productModel->getVariantsByProductId($product_id);

        $variant = null;
        foreach ($variants as $v) {
            if ($v['id'] == $variant_id) {
                $variant = $v;
                break;
            }
        }

        if (!$product || !$variant) {
            echo "Không tìm thấy sản phẩm";
            return;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $key = $product_id . '_' . $variant_id;

        if (isset($_SESSION['cart'][$key])) {
            $_SESSION['cart'][$key]['quantity'] += $qty;
        } else {
            $_SESSION['cart'][$key] = [
                'id' => $product_id,
                'variant_id' => $variant_id,
                'name' => $product['name'],
                'sku' => $variant['sku'],
                'price' => $variant['price'],
                'image' => $variant['image'] ? $variant['image'] : $product['images'],
                'quantity' => $qty
            ];
        }

        header("Location: index.php?page=cart");
        exit;
    }
}