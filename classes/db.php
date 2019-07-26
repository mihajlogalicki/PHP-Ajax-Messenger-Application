<?php

class db {

    private $host = "localhost";
    private $dbname = "messenger";
    private $username = "root";
    private $password = "";
    public $conn;

    public function __construct(){
        try {
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->username, $this->password);
        } catch (Exception $e) {
            echo "Database connection problem : " . $e->getMessage();
        }
    }
}

?>