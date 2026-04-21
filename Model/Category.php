<?php
class Category
{
    private $table = 'categories';
    private $_connect;

    public function __construct($connect)
    {
        $this->_connect = $connect;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->_connect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = $this->_connect->prepare($sql);
        $stmt->execute(['id'=> $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // ✅ sửa ở đây
    }

    /**
     * Hàm này dùng để thêm một danh mục mới cho bảng danh mục
     * @param string $name tên danh mục
     * @param int $status trạng thái của danh mục
     * @param string $image đường dẫn đến hình ảnh của danh mục
     * @param string $content nội dung mô tả của danh mục
     * @return bool trả về true nếu thêm danh mục thành công, ngược lại trả về false
    */
    public function insert($name, $status, $image, $content){
        $sql = "INSERT INTO $this->table (`name`, `status`, `created_at`, `image`, `content`) VALUES (?, ?, current_timestamp(), ?, ?)";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$name, $status, $image, $content]);
    }

    /**
     * Hàm này dùng để cập nhật thông tin của một danh mục dựa vào id của nó
     * @param int $id id của danh mục cần cập nhật
     * @param string $name tên danh mục
     * @param int $status trạng thái của danh mục
     * @param string $image đường dẫn đến hình ảnh của danh mục
     * @param string $content nội dung mô tả của danh mục
     * @return bool trả về true nếu cập nhật danh mục thành công, ngược lại trả về false
    */

    public function update($id, $name, $status, $image, $content){
        $sql = "UPDATE $this->table SET `name` = ?, `status` = ?, `image` = ?, `content` = ? WHERE `id` = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$name, $status, $image, $content, $id]);
    }

    /**
     * Hàm này dùng để xóa một danh mục dựa vào id của nó
     * @param int $id id của danh mục cần xóa
     * @return bool trả về true nếu xóa danh mục thành công, ngược lại trả về false
     */

    public function delete($id){
        $sql = "DELETE FROM $this->table WHERE `id` = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$id]);
    }
}