<?php
require_once __DIR__ . '/../../model/product.php';

class productcontroller
{
    private $productmodel;
    private $db;

    public function __construct($connect)
    {
        $this->db = $connect;
        $this->productmodel = new product($connect);
    }

    public function listproduct()
    {
        $products = $this->productmodel->getall();
        include __DIR__ . '/../view/modules/products/index.php';
    }

    public function addproduct()
    {
        $categories = $this->productmodel->getcategories();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'] ?? '';
            $category_id = $_POST['category_id'] ?? 0;
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $base_price = $_POST['base_price'] ?? 0;

            // sửa tại đây
            $targetdir = __DIR__ . "/../../public/assets/uploads/";

            $images = "";
            if (!empty($_FILES['images']['name'])) {
                $images = uniqid() . "_" . $_FILES['images']['name'];

                move_uploaded_file(
                    $_FILES['images']['tmp_name'],
                    $targetdir . $images
                );
            }

            $check = $this->productmodel->insert($name, $category_id, $title, $description, $base_price, $images);

            if ($check) {
                header("location: index.php?act=products");
                exit;
            }
        }

        include __DIR__ . '/../view/modules/products/create.php';
    }

    public function deleteproduct($id)
    {
        $this->productmodel->deleteallvariants($id);
        $this->productmodel->delete($id);

        header("location: index.php?act=products");
        exit;
    }

    public function showproduct($id)
    {
        $product = $this->productmodel->getbyid($id);

        if (!$product) {
            header("location: index.php?act=products");
            exit;
        }

        $variants = $this->productmodel->getvariantsbyproductid($id);

        include __DIR__ . '/../view/modules/products/show.php';
    }

    public function editproduct($id)
    {
        $product = $this->productmodel->getbyid($id);

        if (!$product) {
            header("location: index.php?act=products");
            exit;
        }

        $variants = $this->productmodel->getvariantsbyproductid($id);

        $categories = $this->productmodel->getcategories();

        // sửa tại đây
        $targetdir = __DIR__ . "/../../public/assets/uploads/";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'] ?? '';
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';

            $imagename = $product['images'];

            if (!empty($_FILES['images']['name'])) {
                $imagename = uniqid() . "_" . $_FILES['images']['name'];

                move_uploaded_file(
                    $_FILES['images']['tmp_name'],
                    $targetdir . $imagename
                );
            }

            $check = $this->productmodel->update($id, $name, $title, $description, $imagename);

            if ($check) {
                header("location: index.php?act=products");
                exit;
            }
        }

        include __DIR__ . '/../view/modules/products/update.php';
    }
}