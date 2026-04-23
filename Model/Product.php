<?php
class Product
{
    private $_connect;
    private $table = "product";

    public function __construct($connect)
    {
        $this->_connect = $connect;
    }

    // lấy tất cả sản phẩm, mới nhất lên trước
    public function getAll()
    {
        $sql = "SELECT p.*, c.name AS category_name
                FROM product p
                LEFT JOIN categories c ON c.id = p.category_id
                ORDER BY p.id DESC";
        $stmt = $this->_connect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // lấy sản phẩm theo id
    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->_connect->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // lấy sản phẩm kèm tên danh mục
    public function getByIdWithCategory($id)
    {
        $sql = "SELECT p.*, c.name AS category_name
                FROM {$this->table} p
                LEFT JOIN categories c ON c.id = p.category_id
                WHERE p.id = ?";
        $stmt = $this->_connect->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // lấy sản phẩm theo danh mục, mới nhất lên trước
    public function getByCategory($category_id)
    {
        $sql = "SELECT *
                FROM product
                WHERE category_id = ?
                ORDER BY id DESC";
        $stmt = $this->_connect->prepare($sql);
        $stmt->execute([$category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // thêm sản phẩm
    public function insert($name, $category_id, $title, $description, $base_price, $images)
    {
        $sql = "INSERT INTO {$this->table}
                (`name`, `category_id`, `title`, `description`, `base_price`, `images`, `created_at`)
                VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP())";
        $stmt = $this->_connect->prepare($sql);
        $stmt->execute([$name, $category_id, $title, $description, $base_price, $images]);
        return $this->_connect->lastInsertId();
    }

    // cập nhật sản phẩm
    public function update($id, $name, $category_id, $title, $description, $base_price, $images)
    {
        $sql = "UPDATE {$this->table}
                SET `name` = ?, `category_id` = ?, `title` = ?,
                    `description` = ?, `base_price` = ?, `images` = ?
                WHERE `id` = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$name, $category_id, $title, $description, $base_price, $images, $id]);
    }

    // xóa sản phẩm
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$id]);
    }

    // lấy danh mục
    public function getCategories()
    {
        $sql = "SELECT * FROM categories
                WHERE status = 1
                ORDER BY name ASC";
        $stmt = $this->_connect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // lấy biến thể theo sản phẩm
    public function getVariantsByProductId($product_id)
    {
        $sql = "SELECT *
                FROM product_variants
                WHERE product_id = ?
                ORDER BY id ASC";
        $stmt = $this->_connect->prepare($sql);
        $stmt->execute([$product_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // thêm biến thể
    public function insertVariant($product_id, $sku, $price, $stock, $image)
    {
        $sql = "INSERT INTO product_variants
                (`product_id`, `sku`, `price`, `stock`, `image`)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$product_id, $sku, $price, $stock, $image]);
    }

    // cập nhật biến thể
    public function updateVariant($variant_id, $sku, $price, $stock, $image)
    {
        $sql = "UPDATE product_variants
                SET `sku` = ?, `price` = ?, `stock` = ?, `image` = ?
                WHERE id = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$sku, $price, $stock, $image, $variant_id]);
    }

    // xóa biến thể
    public function deleteVariant($variant_id)
    {
        $sql = "DELETE FROM product_variants WHERE id = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$variant_id]);
    }

    // xóa tất cả biến thể của sản phẩm
    public function deleteAllVariants($product_id)
    {
        $sql = "DELETE FROM product_variants WHERE product_id = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$product_id]);
    }

    // sản phẩm liên quan
    public function getRelatedProducts($category_id, $current_id, $limit = 6)
    {
        $sql = "SELECT *
                FROM {$this->table}
                WHERE category_id = ? AND id != ?
                ORDER BY id DESC
                LIMIT {$limit}";
        $stmt = $this->_connect->prepare($sql);
        $stmt->execute([$category_id, $current_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>