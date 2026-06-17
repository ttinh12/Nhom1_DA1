<?php
// Admin/Controller/ProductController.php
require_once 'Model/Product.php';

class ProductController
{
    private $productModel;
    private $db;

    public function __construct($connect)
    {
        $this->db = $connect;
        $this->productModel = new Product($connect);
    }

    // Hàm hiển thị danh sách - Đảm bảo tên này khớp với index.php
    public function listProduct()
    {
        $products = $this->productModel->getAllWithCategory();

        include 'Admin/View/Modules/products/index.php';
    }
    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $category_id = $_POST['category_id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $base_price = $_POST['base_price'];

            // 1. Định nghĩa đường dẫn tuyệt đối (Giống đoạn code cũ của bạn để không lỗi ảnh)
            $targetDir = __DIR__ . "/../../public/assets/images/";

            // 2. Xử lý ảnh chính của sản phẩm
            $images = "";
            if (!empty($_FILES['images']['name'])) {
                $images = time() . "_" . $_FILES['images']['name'];
                move_uploaded_file($_FILES['images']['tmp_name'], $targetDir . $images);
            }

            // 3. Lưu sản phẩm chính vào bảng `product`
            $check = $this->productModel->insert($name, $category_id, $title, $description, $base_price, $images);

            if ($check) {
                // Lấy ID sản phẩm vừa tạo để làm khóa ngoại cho biến thể
                $product_id = $this->db->lastInsertId();

                // 4. Xử lý lưu các biến thể
                if (isset($_POST['variants']) && is_array($_POST['variants'])) {
                    foreach ($_POST['variants'] as $index => $variant) {
                        $sku = $variant['sku'];
                        $price = $variant['price'];
                        $stock = $variant['stock'];

                        // Xử lý ảnh cho từng biến thể (Dùng mảng $_FILES)
                        $v_image = "";
                        if (!empty($_FILES['variant_images']['name'][$index])) {
                            $v_image = time() . "_" . $_FILES['variant_images']['name'][$index];
                            move_uploaded_file($_FILES['variant_images']['tmp_name'][$index], $targetDir . $v_image);
                        }

                        // QUAN TRỌNG: Chỉ insert nếu có nhập SKU và SKU này không được trùng với cái cũ
                        if (!empty($sku)) {
                            $this->productModel->insertVariant($product_id, $sku, $price, $stock, $v_image);
                        }
                    }
                }

                $_SESSION['success'] = "Thêm sản phẩm và biến thể thành công!";
                header("Location: index.php?act=products");
                exit();
            }
        }
        include 'Admin/View/Modules/products/create.php';
    }
    public function deleteProduct($id)
    {
        $this->productModel->deleteAllVariants($id);
        $this->productModel->delete($id);
        header("Location: index.php?act=products");
        exit();
    }
    public function showProduct($id)
    {
        // 1. Lấy thông tin cơ bản của sản phẩm
        $product = $this->productModel->getById($id);

        if (!$product) {
            echo "<script>alert('Sản phẩm không tồn tại!'); 
            window.location.href='index.php?act=products';</script>";
            exit();
        }

        // 2. Lấy danh sách các biến thể của sản phẩm đó
        $variants = $this->productModel->getVariantsByProductId($id);

        // 3. Nạp file giao diện hiển thị
        include 'Admin/View/Modules/products/show.php';
    }
    public function editProduct($id)
    {
        // 1. Lấy dữ liệu hiện tại
        $product = $this->productModel->getById($id);

        // KIỂM TRA: Nếu ID không tồn tại trong DB, $product sẽ là false
        if (!$product) {
            $_SESSION['error'] = "Không tìm thấy sản phẩm!";
            header("Location: index.php?act=products");
            exit();
        }

        $variants = $this->productModel->getVariantsByProductId($id);
        $targetDir = __DIR__ . "/../../public/assets/images/";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $category_id = $_POST['category_id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $base_price = $_POST['base_price'];

            // Xử lý ảnh chính: Lúc này $product chắc chắn là mảng nên không lo lỗi "offset on false"
            $imageName = $product['images'];
            if (!empty($_FILES['images']['name'])) {
                $imageName = time() . "_" . $_FILES['images']['name'];
                move_uploaded_file($_FILES['images']['tmp_name'], $targetDir . $imageName);
            }

            // 2. Cập nhật thông tin sản phẩm chính
            $check = $this->productModel->update($id, $name, $title, $description, $imageName);

            if ($check) {
                // 3. Xử lý biến thể
                // Xóa hết biến thể cũ của sản phẩm này
                $this->productModel->deleteAllVariants($id);

                if (isset($_POST['variants']) && is_array($_POST['variants'])) {
                    foreach ($_POST['variants'] as $index => $v) {
                        $sku = $v['sku'];
                        $price = $v['price'];
                        $stock = $v['stock'];

                        // Lấy lại ảnh cũ từ input hidden trong form
                        $v_image = $_POST['old_variant_images'][$index] ?? "";

                        // Nếu người dùng chọn ảnh mới cho biến thể
                        if (!empty($_FILES['variant_images']['name'][$index])) {
                            $v_image = time() . "_" . $_FILES['variant_images']['name'][$index];
                            move_uploaded_file($_FILES['variant_images']['tmp_name'][$index], $targetDir . $v_image);
                        }

                        // Chỉ insert nếu SKU không để trống
                        if (!empty($sku)) {
                            $this->productModel->insertVariant($id, $sku, $price, $stock, $v_image);
                        }
                    }
                }

                $_SESSION['success'] = "Cập nhật thành công!";
                header("Location: index.php?act=products");
                exit();
            }
        }
        // Nạp file giao diện sửa
        include 'Admin/View/Modules/products/update.php';
    }
}