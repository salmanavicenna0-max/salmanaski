<?php
// Logika Tambah Transaksi
if (isset($_POST['btn_simpan_transaksi'])) {
    if (tambahTransaksi($conn, $_POST)) {
        echo "<script>alert('Transaksi Berhasil Dibuat!'); window.location.href='index.php?page=transaksi';</script>";
    } else {
        echo "<script>alert('Gagal membuat transaksi!');</script>";
    }
}

// Logika Update Status
if (isset($_POST['btn_update_status'])) {
    $id      = $_POST['id'];
    $status  = $_POST['status'];
    $dibayar = $_POST['dibayar'];
    
    if (updateStatusTransaksi($conn, $id, $status, $dibayar)) {
        echo "<script>alert('Status Berhasil Diperbarui!'); window.location.href='index.php?page=transaksi_detail&id=$id';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui status!');</script>";
    }
}

// Logika Hapus Transaksi
if (isset($_GET['hapus_transaksi'])) {
    if ($role !== 'admin') {
        header("Location: index.php?page=transaksi&pesan=terlarang");
        exit;
    }
    $id_hapus = $_GET['hapus_transaksi'];
    if (hapusTransaksi($conn, $id_hapus)) {
        header("Location: index.php?page=transaksi&pesan=hapus_berhasil");
        exit;
    }
}
?>
