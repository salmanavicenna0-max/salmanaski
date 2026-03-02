<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/models/Mahasiswa.php';
require_once __DIR__ . '/models/Product.php';

$db = getConnection();
$page = $_GET['page'] ?? 'mahasiswa';
$action = $_GET['action'] ?? 'index';

// Routing untuk Mahasiswa
if ($page === 'mahasiswa') {
    $model = new MahasiswaModel($db);
    
    if ($action === 'index') {
        $mahasiswas = $model->getAll();
        include __DIR__ . '/views/Mahasiswa/index.php';
    } 
    elseif ($action === 'create') {
        include __DIR__ . '/views/Mahasiswa/create.php';
    } 
    elseif ($action === 'store') {
        $data = [
            'nim' => $_POST['nim'],
            'nama' => $_POST['nama'],
            'jurusan' => $_POST['jurusan'],
            'email' => $_POST['email']
        ];
        if ($model->create($data)) {
            echo "<script>alert('Data berhasil disimpan!'); window.location='index.php?page=mahasiswa&action=index';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data!'); history.back();</script>";
        }
    } 
    elseif ($action === 'edit') {
        $id = $_GET['id'];
        $mahasiswa = $model->getById($id);
        include __DIR__ . '/views/Mahasiswa/edit.php';
    } 
    elseif ($action === 'update') {
        $data = [
            'id' => $_POST['id'],
            'nim' => $_POST['nim'],
            'nama' => $_POST['nama'],
            'jurusan' => $_POST['jurusan'],
            'email' => $_POST['email']
        ];
        if ($model->update($data)) {
            echo "<script>alert('Data berhasil diupdate!'); window.location='index.php?page=mahasiswa&action=index';</script>";
        } else {
            echo "<script>alert('Gagal update data!'); history.back();</script>";
        }
    } 
    elseif ($action === 'delete') {
        $id = $_GET['id'];
        if ($model->delete($id)) {
            echo "<script>alert('Data berhasil dihapus!'); window.location='index.php?page=mahasiswa&action=index';</script>";
        } else {
            echo "<script>alert('Gagal hapus data!'); history.back();</script>";
        }
    }
}


elseif ($page === 'products') {
    $model = new ProductModel($db);
    
    if ($action === 'index') {
        $products = $model->getAll();
        include __DIR__ . '/views/Products/index.php';
    } 
    elseif ($action === 'create') {
        include __DIR__ . '/views/Products/create.php';
    } 
    elseif ($action === 'store') {
        $data = [
            'nama_product' => $_POST['nama_product'],
            'harga' => $_POST['harga'],
            'stok' => $_POST['stok'],
            'deskripsi' => $_POST['deskripsi']
        ];
        if ($model->create($data)) {
            echo "<script>alert('Product berhasil ditambahkan!'); window.location='index.php?page=products&action=index';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan product!'); history.back();</script>";
        }
    } 
    elseif ($action === 'edit') {
        $id = $_GET['id'];
        $product = $model->getById($id);
        include __DIR__ . '/views/Products/edit.php';
    } 
    elseif ($action === 'update') {
        $data = [
            'id' => $_POST['id'],
            'nama_product' => $_POST['nama_product'],
            'harga' => $_POST['harga'],
            'stok' => $_POST['stok'],
            'deskripsi' => $_POST['deskripsi']
        ];
        if ($model->update($data)) {
            echo "<script>alert('Product berhasil diupdate!'); window.location='index.php?page=products&action=index';</script>";
        } else {
            echo "<script>alert('Gagal update product!'); history.back();</script>";
        }
    } 
    elseif ($action === 'delete') {
        $id = $_GET['id'];
        if ($model->delete($id)) {
            echo "<script>alert('Product berhasil dihapus!'); window.location='index.php?page=products&action=index';</script>";
        } else {
            echo "<script>alert('Gagal hapus product!'); history.back();</script>";
        }
    }
}

$db->close();
?>
