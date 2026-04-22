<?php
class Product
{

    private $_connect;
    private $table = "product";

    public function __construct($connect)
    {
        $this->_connect = $connect;
    }

    public function getAll()
    {
        $sql = "SELECT p.*, c.name AS category_name 
                FROM product p
                LEFT JOIN categories c ON c.id = p.category_id";

        $stmt = $this->_connect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $sth = $this->_connect->prepare($sql);
        $sth->execute([$id]);

        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function insert(string $name, $category_id, $title, $description, $base_price, $images)
    {
        $sql = "INSERT INTO {$this->table} (`name`, `category_id`, `title`, `description`, `base_price`, `images`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP())";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$name, $category_id, $title, $description, $base_price, $images]);
    }

    public function update($id, $name, $title, $description, $images)
    {
        $sql = "UPDATE $this->table SET `name` = ?, `title` = ?, `description` = ?, `images` = ? WHERE $this->table.`id` = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$name, $title, $description, $images, $id]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE $this->table.`id` = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getcategories()
    {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        $stmt = $this->_connect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVariantsByProductId($product_id)
    {
        $sql = "SELECT * FROM product_variants WHERE product_id = ? ORDER BY id ASC";
        $sth = $this->_connect->prepare($sql);
        $sth->execute([$product_id]);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertVariant($product_id, $sku, $price, $stock, $image)
    {
        $sql = "INSERT INTO product_variants (`product_id`, `sku`, `price`, `stock`, `image`) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$product_id, $sku, $price, $stock, $image]);
    }

    public function updateVariant($variant_id, $sku, $price, $stock, $image)
    {
        $sql = "UPDATE product_variants 
                SET `sku` = ?, `price` = ?, `stock` = ?, `image` = ? 
                WHERE `id` = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$sku, $price, $stock, $image, $variant_id]);
    }

    public function deleteVariant($variant_id)
    {
        $sql = "DELETE FROM product_variants WHERE `id` = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$variant_id]);
    }

    public function deleteAllVariants($product_id)
    {
        $sql = "DELETE FROM product_variants WHERE `product_id` = ?";
        $stmt = $this->_connect->prepare($sql);
        return $stmt->execute([$product_id]);
    }

    public function getByIdWithCategory($id)
    {
        $sql = "SELECT p.*, c.name AS category_name 
            FROM {$this->table} p
            LEFT JOIN categories c ON c.id = p.category_id
            WHERE p.id = ?";

        $sth = $this->_connect->prepare($sql);
        $sth->execute([$id]);

        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function getRelatedProducts($category_id, $current_id, $limit = 6)
    {
        $sql = "SELECT * FROM {$this->table} 
            WHERE category_id = ? 
            AND id != ? 
            ORDER BY id DESC 
            LIMIT $limit";

        $stmt = $this->_connect->prepare($sql);
        $stmt->execute([$category_id, $current_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}