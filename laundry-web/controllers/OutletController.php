<?php
// --- Fungsi-fungsi untuk View ---
function getAllOutlet($conn) {
    return mysqli_query($conn, "SELECT * FROM tb_outlet ORDER BY id DESC");
}

function getOutletById($conn, $id) {
    $id = mysqli_real_escape_string($conn, $id);
    $query = "SELECT * FROM tb_outlet WHERE id = '$id'";
    return mysqli_fetch_assoc(mysqli_query($conn, $query));
}

// --- Logika Eksekusi (POST/GET) ---

// 1. Tambah Data
if (isset($_POST['btn_simpan_outlet'])) {
    $nama   = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $tlp    = mysqli_real_escape_string($conn, $_POST['tlp']);

    $query = "INSERT INTO tb_outlet (nama, alamat, tlp) VALUES ('$nama', '$alamat', '$tlp')";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php?page=outlet&status=sukses");
    }
}

// 2. Update Data
if (isset($_POST['btn_update_outlet'])) {
    $id     = $_POST['id'];
    $nama   = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $tlp    = mysqli_real_escape_string($conn, $_POST['tlp']);

    $query = "UPDATE tb_outlet SET nama='$nama', alamat='$alamat', tlp='$tlp' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        header("Location: index.php?page=outlet&status=update_berhasil");
    }
}

// 3. Hapus Data
if (isset($_GET['hapus_outlet'])) {
    $id = $_GET['hapus_outlet'];
    mysqli_query($conn, "DELETE FROM tb_outlet WHERE id = '$id'");
    header("Location: index.php?page=outlet&status=hapus_berhasil");
}
?>