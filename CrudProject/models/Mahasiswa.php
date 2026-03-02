<?php
require_once __DIR__ . '/../config/database.php';

class MahasiswaModel {
    private $db;

    // Kita masukkan koneksi database saat Class ini dipanggil
    public function __construct($db) {
        $this->db = $db;
    }

    // Fungsi untuk menambah data
    public function create($data) {
        $sql = "INSERT INTO mahasiswa (nim, nama, jurusan, email) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        
        // 'ssss' artinya semua input adalah string
        $stmt->bind_param("ssss", $data['nim'], $data['nama'], $data['jurusan'], $data['email']);
        
        return $stmt->execute();
    }

    // Fungsi untuk ambil semua data
    public function getAll() {
        $result = $this->db->query("SELECT * FROM mahasiswa");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Fungsi untuk ambil data berdasarkan ID
    public function getById($id) {
        $sql = "SELECT * FROM mahasiswa WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Fungsi untuk update data
    public function update($data) {
        $sql = "UPDATE mahasiswa SET nim = ?, nama = ?, jurusan = ?, email = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssssi", $data['nim'], $data['nama'], $data['jurusan'], $data['email'], $data['id']);
        return $stmt->execute();
    }

    // Fungsi untuk hapus data
    public function delete($id) {
        $sql = "DELETE FROM mahasiswa WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}