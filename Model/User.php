<?php
class User
{
    private $table = 'users'; // đổi lại
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

    public function getOne(int $id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $sth = $this->_connect->prepare($sql);
        $sth->execute(['id' => $id]);
        return $sth->fetch(PDO::FETCH_ASSOC); // sửa ở đây
    }

    // kiểm tra email tồn tại
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM $this->table WHERE email = :email";
        $sth = $this->_connect->prepare($sql);
        $sth->execute(['email' => $email]);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    // đăng ký
    public function register($name, $email, $password)
    {
        // check email tồn tại
        if ($this->findByEmail($email)) {
            return "Email đã tồn tại";
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO $this->table (name, email, password)
                VALUES (:name, :email, :password)";

        $sth = $this->_connect->prepare($sql);

        $result = $sth->execute([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        return $result ? true : "Đăng ký thất bại";
    }

    // đăng nhập
    public function login($email, $password)
    {
        $user = $this->findByEmail($email);

        if (!$user) {
            return "Email không tồn tại";
        }

        if (!password_verify($password, $user['password'])) {
            return "Sai mật khẩu";
        }

        return $user;
    }
}