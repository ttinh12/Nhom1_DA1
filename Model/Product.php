<?php
class Product {

    private $_connect;
    private $table = "product"; 

    public function __construct($connect)
    {
        $this->_connect = $connect;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        $sth = $this->_connect->prepare($sql);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Hàm này dùng để thêm một sản phẩm mới cho bảng product
     * @param string $name tên sản phẩm
     * @param int $category_id id của category mà sản phẩm thuộc về
     * @param string $title tiêu đề của sản phẩm
     * @param string $description mô tả của sản phẩm
     * @param float $base_price giá gốc của sản phẩm
     * @param string $images đường dẫn đến hình ảnh của sản phẩm
     * 
    */
    public function insert(string $name, $category_id, $title, $description, $base_price, $images)
    {
        $sql = "INSERT INTO {$this->table} (`name`, `category_id`, `title`, `description`, `base_price`, `images`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP())";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$name, $category_id, $title, $description, $base_price, $images]);
    }


    /**
     * Hàm này dùng để cập nhật thông tin của một sản phẩm đã tồn tại trong bảng product
     * @param int $id id của sản phẩm cần cập nhật
     * @param string $name tên sản phẩm
     * @param string $title tiêu đề của sản phẩm
     * @param string $description mô tả của sản phẩm
     * @param string $images đường dẫn đến hình ảnh của sản phẩm
     * 
    */
    public function update($id, $name, $title, $description, $images){
        $sql = "UPDATE $this->table SET `name` = ?, `title` = ?, `description` = ?, `images` = ? WHERE $this->table.`id` = ?;";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$name, $title, $description, $images, $id]);
    }

    
    /**
     * Hàm này dùng để xóa một sản phẩm đã tồn tại trong bảng product
     * @param int $id id của sản phẩm cần xóa
    */

    public function delete($id){
        $sql = "DELETE FROM $this->table WHERE $this->table.`id` = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
