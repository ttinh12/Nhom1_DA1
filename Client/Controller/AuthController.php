<?php
require_once "Model/User.php";

class AuthController
{
    private $user;

    public function __construct($connect)
    {
        $this->user = new User($connect);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) {
                $error = "Vui lòng nhập đầy đủ thông tin";
            } else {

                $result = $this->user->login($email, $password);

                if (is_array($result)) {

                    // lưu user
                    $_SESSION['user'] = $result;

                    // lấy lại giỏ hàng theo user
                    if (isset($_SESSION['user_cart'][$result['id']])) {
                        $_SESSION['cart'] = $_SESSION['user_cart'][$result['id']];
                    } else {
                        $_SESSION['cart'] = [];
                    }

                    header("Location: index.php?page=home");
                    exit;
                } else {
                    $error = $result;
                }
            }
        }

        include "Client/View/Pages/Auth/login.php";
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $confirm = trim($_POST['confirm_password'] ?? '');

            if (empty($name) || empty($email) || empty($password)) {
                $error = "Vui lòng nhập đầy đủ thông tin";
            } elseif ($password !== $confirm) {
                $error = "Mật khẩu nhập lại không khớp";
            } else {

                $result = $this->user->register($name, $email, $password);

                if ($result === true) {
                    header("Location: index.php?page=login");
                    exit;
                } else {
                    $error = $result;
                }
            }
        }

        include "Client/View/Pages/Auth/register.php";
    }

    public function logout()
    {
        // lưu giỏ theo user trước khi logout
        if (isset($_SESSION['user']) && isset($_SESSION['cart'])) {
            $_SESSION['user_cart'][$_SESSION['user']['id']] = $_SESSION['cart'];
        }

        // xóa user
        unset($_SESSION['user']);

        // xóa giỏ hiện tại (chỉ để ẩn)
        unset($_SESSION['cart']);

        header("Location: index.php?page=home");
        exit;
    }
}