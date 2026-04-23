<?php
class User
{
    private $table = 'users';
    private $_connect;

    public function __construct($connect)
    {
        $this->_connect = $connect;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM $this->table ORDER BY id DESC";
        $sth = $this->_connect->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne(int $id)
    {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $sth = $this->_connect->prepare($sql);
        $sth->execute(['id' => $id]);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM $this->table WHERE email = :email";
        $sth = $this->_connect->prepare($sql);
        $sth->execute(['email' => $email]);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function register($name, $email, $password)
    {
        if ($this->findByEmail($email)) {
            return "Email đã tồn tại";
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO $this->table (name, email, password, role, created_at)
                VALUES (:name, :email, :password, 'user', NOW())";

        $sth = $this->_connect->prepare($sql);

        $result = $sth->execute([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        return $result ? true : "Đăng ký thất bại";
    }

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

    public function create($name, $email, $password, $role = 'user')
    {
        if ($this->findByEmail($email)) {
            return "Email đã tồn tại";
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO $this->table (name, email, password, role, created_at)
                VALUES (:name, :email, :password, :role, NOW())";

        $sth = $this->_connect->prepare($sql);

        return $sth->execute([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role
        ]);
    }

    public function update($id, $name, $email, $role)
    {
        $sql = "UPDATE $this->table 
                SET name = :name, email = :email, role = :role
                WHERE id = :id";

        $sth = $this->_connect->prepare($sql);

        return $sth->execute([
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'role' => $role
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $sth = $this->_connect->prepare($sql);
        return $sth->execute(['id' => $id]);
    }
}