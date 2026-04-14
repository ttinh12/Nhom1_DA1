<?php
class Order
{
    private $table = 'orders';
    private $_connect;

    public function __construct($connect)
    {
        $this->_connect = $connect;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        $sth = $this->_connect->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Đây là phương thức lấy 1 dữ liệu
     * @param int $id
     * 
     * @return array
     */
    public function getOne(int $id)
    {
        $sql = "SELECT * FROM $this->table
            JOIN `users` ON `users`.`id` = orders.`customer_id`
            WHERE orders.`id` = :idDonHang";

        $sth = $this->_connect->prepare($sql);
        $sth->execute(['idDonHang' => $id]);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Lấy 1 chi tiết đơn hàng
     * @param int $id id đơn hàng
     * 
     * @return array
     */
    public function getDetailOrder(int $id)
    {
        $sql = "SELECT * FROM `order_details`
            JOIN `products` ON `products`.`id` = order_details.`product_id`
            WHERE order_details.`order_id` = :idDonHang";

        $sth = $this->_connect->prepare($sql);
        $sth->execute(['idDonHang' => $id]);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
