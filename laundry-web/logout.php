<?php
// 1. Mulai session agar PHP tahu session mana yang mau dihapus
session_start();

// 2. Hapus semua variabel session (nama, role, status login, dll)
session_unset();

// 3. Hancurkan session secara total dari server
session_destroy();

// 4. Arahkan user kembali ke halaman login atau index
header("Location: index.php");
exit;
?>