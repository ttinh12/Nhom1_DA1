<?php
require_once __DIR__ . '/../../Model/Order.php';

class OrderController
{
    private $orderModel;

    public function __construct($connect)
    {
        $this->orderModel = new Order($connect);
    }

    /**
     * Hiển thị danh sách đơn hàng
     */
    public function listOrder()
    {
        $orders = $this->orderModel->getAll();
        include __DIR__ . '/../View/modules/orders/index.php';
    }

    /**
     * Hiển thị chi tiết 1 đơn hàng
     */
    public function detail($id)
    {
        $order = $this->orderModel->getOne((int)$id);

        if (!$order) {
            header("Location: index.php?act=orders");
            exit;
        }

        $orderDetails = $this->orderModel->getDetailOrder((int)$id);
        include __DIR__ . '/../View/modules/orders/view.php';
    }

    /**
     * Cập nhật trạng thái đơn hàng (POST)
     */
    public function updateStatus()
    {
        $id     = $_POST['id']     ?? 0;
        $status = $_POST['status'] ?? 0;

        $this->orderModel->updateStatus((int)$id, (int)$status);

        header("Location: index.php?act=order-detail&id=" . (int)$id);
        exit;
    }
}
?>