<?php
session_start();

function login($conn, $username, $password) {
    // 1. Cari user berdasarkan username
    $query = "SELECT * FROM tb_user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // 2. Cek Password (Gunakan password_verify jika dipassword_hash, 
        // atau cek langsung jika masih plain text/biasa)
        if ($password == $user['password']) {
            // 3. Simpan data user ke dalam SESSION
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['nama_user'] = $user['nama'];
            $_SESSION['role']      = $user['role'];
            $_SESSION['id_outlet'] = $user['id_outlet'];
            $_SESSION['status']    = 'login';

            return true;
        }
    }
    return false;
}

// Logika Logout
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: index.php");
    exit;
}