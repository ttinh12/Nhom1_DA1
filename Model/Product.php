<?php
class Product {

    private $_connect;
    private $table = "product"; 

    public function __construct($connect)
    {
        $this->_connect = $connect;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        $sth = $this->_connect->prepare($sql);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>