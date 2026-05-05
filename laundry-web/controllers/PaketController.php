<?php
// Logika Hapus Paket
if (isset($_GET['hapus_paket'])) {
    if ($role !== 'admin') {
        header("Location: index.php?page=paket&pesan=terlarang");
        exit;
    }
    $id_hapus = $_GET['hapus_paket'];
    if (hapusPaket($conn, $id_hapus)) {
        header("Location: index.php?page=paket&pesan=hapus_berhasil");
        exit;
    }
}

// Logika Simpan
if (isset($_POST['btn_simpan_paket'])) {
    if ($role !== 'admin') {
        header("Location: index.php?page=paket&pesan=terlarang");
        exit;
    }
    if (tambahPaket($conn, $_POST)) {
        echo "<script>alert('Paket Berhasil Ditambahkan!'); window.location.href='index.php?page=paket';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan paket!');</script>";
    }
}

// Logika Update
if (isset($_POST['btn_update_paket'])) {
    if ($role !== 'admin') {
        header("Location: index.php?page=paket&pesan=terlarang");
        exit;
    }
    if (updatePaket($conn, $_POST)) {
        echo "<script>alert('Paket Berhasil Diperbarui!'); window.location.href='index.php?page=paket';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui paket!');</script>";
    }
}
?>
