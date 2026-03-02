<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');       // ganti sesuai username MySQL kamu
define('DB_PASS', '');           // ganti sesuai password MySQL kamu
define('DB_NAME', 'db_project'); // ganti sesuai nama database kamu

function getConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $conn->set_charset("utf8");
    return $conn;
}
