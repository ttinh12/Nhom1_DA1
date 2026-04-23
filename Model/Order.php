<?php
class Order
{
    private $table = 'orders';
    private $_connect;

    public function __construct($connect)
    {
        $this->_connect = $connect;
    }

    /**
     * Lấy tất cả đơn hàng (kèm tên user)
     */
    public function getAll()
    {
        $sql = "SELECT o.*, u.name AS user_name
                FROM {$this->table} o
                LEFT JOIN users u ON u.id = o.user_id
                ORDER BY o.date DESC";
        $sth = $this->_connect->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy 1 đơn hàng theo id (kèm thông tin user)
     * @param int $id
     * @return array|false
     */
    public function getOne(int $id)
    {
        $sql = "SELECT o.*, u.name AS user_name
                FROM {$this->table} o
                LEFT JOIN users u ON u.id = o.user_id
                WHERE o.id = :id";
        $sth = $this->_connect->prepare($sql);
        $sth->execute(['id' => $id]);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy chi tiết các sản phẩm trong 1 đơn hàng
     * @param int $id id đơn hàng
     * @return array
     */
    public function getDetailOrder(int $id)
    {
        $sql = "SELECT od.*, p.images
                FROM orders_details od
                LEFT JOIN product p ON p.id = od.product_id
                WHERE od.order_id = :id";
        $sth = $this->_connect->prepare($sql);
        $sth->execute(['id' => $id]);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Cập nhật trạng thái đơn hàng
     * @param int $id
     * @param int $status
     * @return bool
     */
    public function updateStatus(int $id, int $status)
    {
        $sql = "UPDATE {$this->table} SET status = ? WHERE id = ?";
        $sth = $this->_connect->prepare($sql);
        return $sth->execute([$status, $id]);
    }

    /**
     * Tạo đơn hàng mới — trả về ID vừa tạo
     */
    public function createOrder(int $user_id, string $name, string $email, string $phone, string $address, string $note, float $total): int
    {
        $sql = "INSERT INTO {$this->table} (user_id, name, email, phone, address, note, date, status, total)
                VALUES (?, ?, ?, ?, ?, ?, NOW(), 0, ?)";
        $sth = $this->_connect->prepare($sql);
        $sth->execute([$user_id, $name, $email, $phone, $address, $note, $total]);
        return (int) $this->_connect->lastInsertId();
    }

    /**
     * Thêm 1 dòng chi tiết đơn hàng
     */
    public function createOrderDetail(int $order_id, int $product_id, int $qty, string $title, float $price): bool
    {
        $sql = "INSERT INTO orders_details (order_id, product_id, quantily, title, price)
                VALUES (?, ?, ?, ?, ?)";
        $sth = $this->_connect->prepare($sql);
        return $sth->execute([$order_id, $product_id, $qty, $title, $price]);
    }

    /**
     * Đếm số đơn hàng theo trạng thái
     * @param int $status
     * @return int
     */
    public function countByStatus(int $status)
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE status = ?";
        $sth = $this->_connect->prepare($sql);
        $sth->execute([$status]);
        return (int) $sth->fetchColumn();
    }
}
?>