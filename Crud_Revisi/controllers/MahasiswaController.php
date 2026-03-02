<?php
require_once '../models/MahasiswaModel.php';
require_once '../config/database.php'; // Sesuaikan lokasi file koneksimu

class MahasiswaController {
    private $model;

    public function __construct($db) {
        $this->model = new MahasiswaModel($db);
    }

    public function tambahData() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Bungkus data dari form
            $data = [
                'nim'     => $_POST['nim'],
                'nama'    => $_POST['nama'],
                'jurusan' => $_POST['jurusan'],
                'email'   => $_POST['email']
            ];

            // Panggil fungsi create di model
            if ($this->model->create($data)) {
                echo "<script>alert('Data Mahasiswa Berhasil Disimpan!'); window.location='../views/mahasiswa/index.php';</script>";
            } else {
                echo "<script>alert('Gagal menyimpan data.');</script>";
            }
        }
    }
}