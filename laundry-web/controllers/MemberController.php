<?php
// 1. Fungsi Ambil Semua Member
function getAllMember($conn) {
    return mysqli_query($conn, "SELECT * FROM tb_member ORDER BY id DESC");
}

// 2. FUNGSI PENTING: Ambil 1 Member Berdasarkan ID (Untuk Edit)
function getMemberById($conn, $id) {
    $query = "SELECT * FROM tb_member WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

// 3. Logika Tambah Member
if (isset($_POST['btn_simpan_member'])) {
    $nama   = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $jk     = $_POST['jenis_kelamin']; 
    $tlp    = mysqli_real_escape_string($conn, $_POST['tlp']);

    $query = "INSERT INTO tb_member (nama, alamat, jenis_kelamin, tlp) VALUES ('$nama', '$alamat', '$jk', '$tlp')";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php?page=member&status=sukses");
        exit; // Tambahkan exit setelah header agar script berhenti
    }
}

// 4. LOGIKA UPDATE MEMBER (PENTING UNTUK HALAMAN EDIT)
if (isset($_POST['btn_update_member'])) {
    $id     = $_POST['id'];
    $nama   = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $jk     = $_POST['jenis_kelamin'];
    $tlp    = mysqli_real_escape_string($conn, $_POST['tlp']);

    $query = "UPDATE tb_member SET 
              nama = '$nama', 
              alamat = '$alamat', 
              jenis_kelamin = '$jk', 
              tlp = '$tlp' 
              WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php?page=member&status=update_berhasil");
        exit;
    }
}

// 5. Logika Hapus Member
if (isset($_GET['hapus_member'])) {
    $id = $_GET['hapus_member'];
    mysqli_query($conn, "DELETE FROM tb_member WHERE id = '$id'");
    header("Location: index.php?page=member&status=hapus_berhasil");
    exit;
}
?>