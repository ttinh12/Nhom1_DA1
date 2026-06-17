<?php
require_once __DIR__ . "/../../Model/Category.php";

class CategoryController
{
    private $category;

    public function __construct($connect)
    {
        $this->category = new Category($connect);
    }

    public function index()
    {
        $categories = $this->category->getAll();
        include __DIR__ . "/../View/Modules/categories/index.php";
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = $_POST['name'] ?? '';
            $status = $_POST['status'] ?? 0;
            $image = $_POST['image'] ?? '';
            $content = $_POST['content'] ?? '';

            $this->category->insert($name, $status, $image, $content);

            echo "<script>window.location.href='index.php?page=category'</script>";
            exit;
        }

        include __DIR__ . "/../View/Modules/categories/create.php";
    }

    public function update()
    {
        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = $_POST['name'] ?? '';
            $status = $_POST['status'] ?? 0;
            $image = $_POST['image'] ?? '';
            $content = $_POST['content'] ?? '';

            $this->category->update($id, $name, $status, $image, $content);

            echo "<script>window.location.href='index.php?page=category'</script>";
            exit;
        }

        $category = $this->category->getById($id);

        include __DIR__ . "/../View/Modules/categories/update.php";
    }
    public function delete()
    {
        $id = $_GET['id'];
        $this->category->delete($id);

        echo "<script>window.location.href='index.php?page=category'</script>";
        exit;
    }
}