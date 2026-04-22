<?php
require_once __DIR__ . '/../../Model/Product.php';

class ProductController
{
    private $productModel;
    private $db;

    public function __construct($connect)
    {
        $this->db = $connect;
        $this->productModel = new Product($connect);
    }

    // hiển thị danh sách sản phẩm
    public function listProduct()
    {
        $products = $this->productModel->getAll();

        include __DIR__ . '/../View/Modules/products/index.php';
    }

    // thêm sản phẩm mới
    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'] ?? '';
            $category_id = $_POST['category_id'] ?? 0;
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $base_price = $_POST['base_price'] ?? 0;

            $targetDir = __DIR__ . "/../../public/uploads/";

            // xử lý ảnh chính
            $images = "";
            if (!empty($_FILES['images']['name'])) {
                $images = time() . "_" . $_FILES['images']['name'];
                move_uploaded_file($_FILES['images']['tmp_name'], $targetDir . $images);
            }

            // lưu sản phẩm
            $check = $this->productModel->insert($name, $category_id, $title, $description, $base_price, $images);

            if ($check) {

                $product_id = $this->db->lastInsertId();

                // xử lý biến thể
                if (!empty($_POST['variants']) && is_array($_POST['variants'])) {

                    foreach ($_POST['variants'] as $index => $variant) {

                        $sku = $variant['sku'] ?? '';
                        $price = $variant['price'] ?? 0;
                        $stock = $variant['stock'] ?? 0;

                        $v_image = "";

                        if (!empty($_FILES['variant_images']['name'][$index])) {
                            $v_image = time() . "_" . $_FILES['variant_images']['name'][$index];
                            move_uploaded_file(
                                $_FILES['variant_images']['tmp_name'][$index],
                                $targetDir . $v_image
                            );
                        }

                        // chỉ lưu khi có sku
                        if (!empty($sku)) {
                            $this->productModel->insertVariant($product_id, $sku, $price, $stock, $v_image);
                        }
                    }
                }

                header("Location: index.php?act=products");
                exit;
            }
        }

        include __DIR__ . '/../View/Modules/products/create.php';
    }

    // xóa sản phẩm
    public function deleteProduct($id)
    {
        $this->productModel->deleteAllVariants($id);
        $this->productModel->delete($id);

        header("Location: index.php?act=products");
        exit;
    }

    // xem chi tiết sản phẩm
    public function showProduct($id)
    {
        $product = $this->productModel->getById($id);

        if (!$product) {
            header("Location: index.php?act=products");
            exit;
        }

        $variants = $this->productModel->getVariantsByProductId($id);

        include __DIR__ . '/../View/Modules/products/show.php';
    }

    // cập nhật sản phẩm
    public function editProduct($id)
    {
        $product = $this->productModel->getById($id);

        if (!$product) {
            header("Location: index.php?act=products");
            exit;
        }

        $variants = $this->productModel->getVariantsByProductId($id);

        $targetDir = __DIR__ . "/../../public/uploads/";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'] ?? '';
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';

            // giữ ảnh cũ nếu không upload mới
            $imageName = $product['images'];

            if (!empty($_FILES['images']['name'])) {
                $imageName = time() . "_" . $_FILES['images']['name'];
                move_uploaded_file($_FILES['images']['tmp_name'], $targetDir . $imageName);
            }

            // cập nhật sản phẩm
            $check = $this->productModel->update($id, $name, $title, $description, $imageName);

            if ($check) {

                // xóa toàn bộ biến thể cũ
                $this->productModel->deleteAllVariants($id);

                // thêm lại biến thể mới
                if (!empty($_POST['variants']) && is_array($_POST['variants'])) {

                    foreach ($_POST['variants'] as $index => $v) {

                        $sku = $v['sku'] ?? '';
                        $price = $v['price'] ?? 0;
                        $stock = $v['stock'] ?? 0;

                        $v_image = $_POST['old_variant_images'][$index] ?? "";

                        if (!empty($_FILES['variant_images']['name'][$index])) {
                            $v_image = time() . "_" . $_FILES['variant_images']['name'][$index];
                            move_uploaded_file(
                                $_FILES['variant_images']['tmp_name'][$index],
                                $targetDir . $v_image
                            );
                        }

                        if (!empty($sku)) {
                            $this->productModel->insertVariant($id, $sku, $price, $stock, $v_image);
                        }
                    }
                }

                header("Location: index.php?act=products");
                exit;
            }
        }

        include __DIR__ . '/../View/Modules/products/update.php';
    }
}