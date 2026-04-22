<?php
require_once __DIR__ . '/../../Model/Category.php';

class CategoryController
{
    private $category;

    public function __construct($connect)
    {
        $this->category = new Category($connect);
    }

    // danh sách
    public function index()
    {
        return $this->category->getAll();
    }

    // thêm
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = $_POST['name'] ?? '';
            $status = $_POST['status'] ?? 1;
            $content = $_POST['content'] ?? '';

            $this->category->insert($name, $status, '', $content);

            header("Location: index.php?act=category");
            exit;
        }
    }

    // lấy 1 danh mục
    public function getById($id)
    {
        return $this->category->getById($id);
    }

    // cập nhật
    public function update()
    {
        $id = $_GET['id'] ?? 0;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = $_POST['name'] ?? '';
            $status = $_POST['status'] ?? 1;
            $content = $_POST['content'] ?? '';

            $this->category->update($id, $name, $status, '', $content);

            header("Location: index.php?act=category");
            exit;
        }
    }

    // xóa
    public function delete()
    {
        $id = $_GET['id'] ?? 0;

        $this->category->delete($id);

        header("Location: index.php?act=category");
        exit;
    }
}