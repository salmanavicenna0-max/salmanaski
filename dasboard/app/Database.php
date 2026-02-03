<?php
class Database {
    private static $instance = null;  // Ubah ke static, sesuai penggunaan di getInstance()
    private $connection;
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'php_oop';

    private function __construct() {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->connection->connect_error) {  // Perbaiki pengecekan error
            die("Database connection failed: " . $this->connection->connect_error);
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}