<?php

// Tambah User
if (isset($_POST['btn_simpan_user'])) {
    $nama      = mysqli_real_escape_string($conn, $_POST['nama']);
    $username  = mysqli_real_escape_string($conn, $_POST['username']);
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $id_outlet = $_POST['id_outlet'];
    $role      = $_POST['role'];

    $query = "INSERT INTO tb_user (nama, username, password, id_outlet, role) 
              VALUES ('$nama', '$username', '$password', '$id_outlet', '$role')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('User berhasil ditambah!'); window.location.href='index.php?page=user';</script>";
        exit;
    }
}

// Hapus User
if (isset($_GET['hapus_user'])) {
    $id = $_GET['hapus_user'];
    // Tambahkan keamanan agar admin tidak hapus diri sendiri
    if($id == $_SESSION['id_user']) { // sesuaikan dengan nama session ID kamu
         echo "<script>alert('Gagal! Anda tidak bisa menghapus akun sendiri.'); window.location.href='index.php?page=user';</script>";
    } else {
        mysqli_query($conn, "DELETE FROM tb_user WHERE id = '$id'");
        header("Location: index.php?page=user&status=hapus_berhasil");
    }
    exit;
}
?>