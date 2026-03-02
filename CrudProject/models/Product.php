<?php
require_once __DIR__ . '/../config/database.php';

class ProductModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($data) {
        $sql = "INSERT INTO products (nama_product, harga, stok, deskripsi) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        
        // 'siss' = string, integer, integer, string
        // Sesuaikan jika tipe datanya beda (misal harga/stok pakai float)
        $stmt->bind_param("siss", $data['nama_product'], $data['harga'], $data['stok'], $data['deskripsi']);
        
        return $stmt->execute();
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM products");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($data) {
        $sql = "UPDATE products SET nama_product = ?, harga = ?, stok = ?, deskripsi = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("siisi", $data['nama_product'], $data['harga'], $data['stok'], $data['deskripsi'], $data['id']);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}