<?php
require_once __DIR__ . '/../../Model/Product.php';

class ProductController
{
    private $productModel;
    private $db;

    // thư mục lưu ảnh upload
    private $uploadDir;

    public function __construct($connect)
    {
        $this->db = $connect;
        $this->productModel = new Product($connect);
        // đường dẫn tuyệt đối tới thư mục uploads
        $this->uploadDir = __DIR__ . '/../../public/assets/images/';
    }

    // ----------------------------------------------------------------
    // Danh sách sản phẩm
    // ----------------------------------------------------------------
    public function listProduct()
    {
        $products = $this->productModel->getAll();
        include __DIR__ . '/../View/modules/products/index.php';
    }

    // ----------------------------------------------------------------
    // Thêm sản phẩm
    // ----------------------------------------------------------------
    public function addProduct()
    {
        $categories = $this->productModel->getCategories();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name        = trim($_POST['name']        ?? '');
            $category_id = $_POST['category_id']      ?? 0;
            $title       = trim($_POST['title']       ?? '');
            $description = trim($_POST['description'] ?? '');
            $base_price  = $_POST['base_price']       ?? 0;

            // upload ảnh chính
            $images = $this->uploadImage('images');

            // lưu sản phẩm
            $productId = $this->productModel->insert($name, $category_id, $title, $description, $base_price, $images);

            if ($productId) {
                // lưu các biến thể
                if (!empty($_POST['variants'])) {
                    $variantFiles = $_FILES['variant_images'] ?? [];

                    foreach ($_POST['variants'] as $i => $v) {
                        $sku   = trim($v['sku']   ?? '');
                        $price = $v['price']       ?? 0;
                        $stock = $v['stock']       ?? 0;

                        // upload ảnh biến thể — cấu trúc name="variant_images[]"
                        $vImage = '';
                        if (!empty($variantFiles['name'][$i]) && $variantFiles['error'][$i] === UPLOAD_ERR_OK) {
                            $tmpFile = [
                                'name'     => $variantFiles['name'][$i],
                                'tmp_name' => $variantFiles['tmp_name'][$i],
                                'error'    => $variantFiles['error'][$i],
                            ];
                            $vImage = $this->uploadImageRaw($tmpFile);
                        }

                        if ($sku !== '') {
                            $this->productModel->insertVariant($productId, $sku, $price, $stock, $vImage);
                        }
                    }
                }

                header("Location: index.php?act=products");
                exit;
            }
        }

        include __DIR__ . '/../View/modules/products/create.php';
    }

    // ----------------------------------------------------------------
    // Xoá sản phẩm
    // ----------------------------------------------------------------
    public function deleteProduct($id)
    {
        $this->productModel->deleteAllVariants($id);
        $this->productModel->delete($id);

        header("Location: index.php?act=products");
        exit;
    }

    // ----------------------------------------------------------------
    // Xem chi tiết sản phẩm
    // ----------------------------------------------------------------
    public function showProduct($id)
    {
        $product = $this->productModel->getById($id);

        if (!$product) {
            header("Location: index.php?act=products");
            exit;
        }

        $variants = $this->productModel->getVariantsByProductId($id);

        include __DIR__ . '/../View/modules/products/show.php';
    }

    // ----------------------------------------------------------------
    // Sửa sản phẩm
    // ----------------------------------------------------------------
    public function editProduct($id)
    {
        $product = $this->productModel->getById($id);

        if (!$product) {
            header("Location: index.php?act=products");
            exit;
        }

        $variants   = $this->productModel->getVariantsByProductId($id);
        $categories = $this->productModel->getCategories();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name        = trim($_POST['name']        ?? '');
            $category_id = $_POST['category_id']      ?? $product['category_id'];
            $title       = trim($_POST['title']       ?? '');
            $description = trim($_POST['description'] ?? '');
            $base_price  = $_POST['base_price']       ?? $product['base_price'];

            // ảnh chính: nếu upload mới thì dùng mới, không thì giữ cũ
            $imageName = $product['images'];
            $newImage  = $this->uploadImage('images');
            if ($newImage !== '') {
                $imageName = $newImage;
            }

            $this->productModel->update($id, $name, $category_id, $title, $description, $base_price, $imageName);

            if (!empty($_POST['variants'])) {
                $variantFiles     = $_FILES['variant_images']    ?? [];
                $oldVariantImages = $_POST['old_variant_images'] ?? [];

                foreach ($_POST['variants'] as $i => $v) {
                    $variantId = $v['id']    ?? 0;
                    $sku       = trim($v['sku']   ?? '');
                    $price     = $v['price']       ?? 0;
                    $stock     = $v['stock']       ?? 0;

                    // ảnh biến thể — giữ ảnh cũ, thay nếu upload mới
                    $vImage = $oldVariantImages[$i] ?? '';
                    if (!empty($variantFiles['name'][$i]) && $variantFiles['error'][$i] === UPLOAD_ERR_OK) {
                        $tmpFile = [
                            'name'     => $variantFiles['name'][$i],
                            'tmp_name' => $variantFiles['tmp_name'][$i],
                            'error'    => $variantFiles['error'][$i],
                        ];
                        $uploaded = $this->uploadImageRaw($tmpFile);
                        if ($uploaded !== '') $vImage = $uploaded;
                    }

                    if ($variantId > 0) {
                        $this->productModel->updateVariant($variantId, $sku, $price, $stock, $vImage);
                    } else {
                        if ($sku !== '') {
                            $this->productModel->insertVariant($id, $sku, $price, $stock, $vImage);
                        }
                    }
                }
            }

            header("Location: index.php?act=products");
            exit;
        }

        include __DIR__ . '/../View/modules/products/update.php';
    }

    // ----------------------------------------------------------------
    // Helper: upload ảnh từ $_FILES[$key]
    // ----------------------------------------------------------------
    private function uploadImage(string $key): string
    {
        if (empty($_FILES[$key]['name'])) return '';
        return $this->uploadImageRaw($_FILES[$key]);
    }

    private function uploadImageRaw(array $file): string
    {
        if ($file['error'] !== UPLOAD_ERR_OK || empty($file['name'])) return '';

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }

        $filename = uniqid() . '_' . basename($file['name']);
        move_uploaded_file($file['tmp_name'], $this->uploadDir . $filename);
        return $filename;
    }
}