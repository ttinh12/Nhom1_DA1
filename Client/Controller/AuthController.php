<?php
require_once "Model/User.php";

class AuthController
{
    private $user;

    // 👉 KHỞI TẠO MODEL
    public function __construct($connect)
    {
        $this->user = new User($connect);
    }

    // ================= LOGIN =================
    public function login()
    {
        // 👉 KIỂM TRA FORM SUBMIT
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // 👉 LẤY DỮ LIỆU TỪ FORM
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            // 👉 VALIDATE
            if (empty($email) || empty($password)) {
                $error = "Vui lòng nhập đầy đủ thông tin";
            } else {

                // 👉 GỌI MODEL CHECK LOGIN
                $result = $this->user->login($email, $password);

                // 👉 NẾU ĐÚNG → LƯU SESSION
                if (is_array($result)) {
                    $_SESSION['user'] = $result;

                    // 👉 CHUYỂN TRANG
                    header("Location: index.php?page=home");
                    exit;
                } else {
                    $error = $result;
                }
            }
        }

        // 👉 LOAD VIEW
        include "Client/View/Pages/Auth/login.php";
    }

    // ================= REGISTER =================
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $confirm = trim($_POST['confirm_password'] ?? '');

            // 👉 VALIDATE
            if (empty($name) || empty($email) || empty($password)) {
                $error = "Vui lòng nhập đầy đủ thông tin";
            } elseif ($password !== $confirm) {
                $error = "Mật khẩu nhập lại không khớp";
            } else {

                // 👉 GỌI MODEL REGISTER
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

    // ================= LOGOUT =================
    public function logout()
    {
        // 👉 CHỈ XÓA USER (QUAN TRỌNG)
        unset($_SESSION['user']);

        // ❌ KHÔNG DÙNG session_destroy()
        // vì sẽ mất luôn giỏ hàng (cart)

        header("Location: index.php?page=home");
        exit;
    }
}