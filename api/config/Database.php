<?php

class Database {
    private $host = 'localhost';
    private $dbname = 'currency_converter';
    private $username = 'root';
    private $password = 'root';
    public $conn;

    public function getConnection() {
        $this->conn = new mysqli("localhost", "root", "root", "currency_converter");
        return $this->conn;
    }

}

?>