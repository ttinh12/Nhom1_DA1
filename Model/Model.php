<?php
require_once "Model/Database.php";
class Model
{
    protected $table= "product";
    protected $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function selectAll()
    {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
