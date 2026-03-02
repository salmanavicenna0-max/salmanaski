<?php
require_once '../models/ProductModel.php';
require_once '../config/database.php'; // Sesuaikan lokasi file koneksimu

class ProductController {
    private $model;

    public function __construct($db) {
        $this->model = new ProductModel($db);
    }

    public function tambahData() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = [
                'nama_product' => $_POST['nama_product'],
                'harga'        => $_POST['harga'],
                'stok'         => $_POST['stok'],
                'deskripsi'    => $_POST['deskripsi']
            ];

            if ($this->model->create($data)) {
                echo "<script>alert('Produk Berhasil Ditambahkan!'); window.location='../views/products/index.php';</script>";
            } else {
                echo "<script>alert('Gagal menambah produk.');</script>";
            }
        }
    }
}