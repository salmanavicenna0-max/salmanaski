<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require "../config.php";

// Hanya admin yg boleh masuk
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin/dashboard.php");
    exit;
}

// Ambil semua artikel (tanpa join dulu)
$articles = mysqli_query($conn, "SELECT * FROM articles ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef1f5;
            margin: 0;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 230px;
            background: #2e7dff;
            height: 100vh;
            color: white;
            padding: 20px;
            position: fixed;
        }

        .sidebar h2 {
            margin-top: 0;
            margin-bottom: 30px;
            text-align: center;
        }

        .sidebar a {
            display: block;
            padding: 12px;
            color: white;
            text-decoration: none;
            margin-bottom: 10px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #1f5ed5;
        }

        /* Main area */
        .main {
            margin-left: 250px;
            padding: 30px;
            width: calc(100% - 250px);
        }

        h1 {
            margin-top: 0;
        }

        .btn-add {
            display: inline-block;
            padding: 10px 18px;
            background: #27ae60;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
        }

        .btn-add:hover {
            background: #1e8e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            border-bottom: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #2e7dff;
            color: white;
        }

        .btn-edit {
            padding: 6px 12px;
            background: orange;
            color: white;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-delete {
            padding: 6px 12px;
            background: red;
            color: white;
            border-radius: 4px;
            text-decoration: none;
        }

        tr:hover {
            background: #f5f7ff;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>ADMIN</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="add_article.php">Tambah Artikel</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main">
        <h1>Daftar Artikel</h1>

        <a class="btn-add" href="add_article.php">+ Tambah Artikel</a>

        <table>
            <tr>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($articles)): ?>
            <tr>
                <td><?= $row['title'] ?></td>
                <td><?= $row['created_at'] ?></td>
                <td>
                    <a class="btn-edit" href="edit_article.php?id=<?= $row['id'] ?>">Edit</a>
                    <a class="btn-delete" 
                       href="delete_article.php?id=<?= $row['id'] ?>"
                       onclick="return confirm('Yakin mau dihapus?')">
                       Hapus
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

    </div>

</body>
</html>
