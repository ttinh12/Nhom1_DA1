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
                    $_SESSION['user'] = $result;
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
        unset($_SESSION['user']);
        session_destroy();

        header("Location: index.php?page=home");
        exit;
    }
}