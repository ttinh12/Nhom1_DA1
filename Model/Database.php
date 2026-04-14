<?php
class Database {

    private $dbhost = "onehost-webhn072403.000nethost.com";
    private $dbname = "qklafoychosting_dbduan1"; 
    private $dbuser = "qklafoychosting_dbduan1";
    private $dbpass = "wn|w4WM=3&~j9/["; 

    private $dbconnection;

    public function connect()
    {
        $this->dbconnection = new PDO(
            "mysql:host={$this->dbhost};dbname={$this->dbname};charset=utf8",
            $this->dbuser,
            $this->dbpass
        );

        $this->dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $this->dbconnection;
    }
}
?>