<?php
// Proteksi Admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php?page=dashboard");
    exit;
}

// Ambil ID dari URL
$id = $_GET['id'];
$user = getUserById($conn, $id); // Fungsi ini sudah kita buat di functions.php

// Ambil data outlet untuk dropdown
$query_outlet = mysqli_query($conn, "SELECT * FROM tb_outlet");
?>

<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="display-6 text-uppercase fw-bold mb-0">Edit <span class="text-warning">User</span></h2>
        <p class="text-muted">Perbarui informasi akun staf atau administrator.</p>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 15px;">
    <div class="card-body p-4">
        <form action="index.php?page=user_edit&id=<?= $id ?>" method="POST">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control px-3" value="<?= $user['nama'] ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" name="username" class="form-control px-3" value="<?= $user['username'] ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Password Baru</label>
                    <input type="password" name="password" class="form-control px-3" placeholder="Kosongkan jika tidak ingin ganti password">
                    <small class="text-muted italic text-danger">*Isi kalo mau ubah Password.</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Role / Hak Akses</label>
                    <select name="role" class="form-select px-3" required>
                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="kasir" <?= $user['role'] == 'kasir' ? 'selected' : '' ?>>Kasir</option>
                        <option value="owner" <?= $user['role'] == 'owner' ? 'selected' : '' ?>>Owner</option>
                    </select>
                </div>
                <div class="col-md-12 mb-4">
                    <label class="form-label fw-bold">Tempat Tugas (Outlet)</label>
                    <select name="id_outlet" class="form-select px-3" required>
                        <?php while($ot = mysqli_fetch_assoc($query_outlet)): ?>
                            <option value="<?= $ot['id'] ?>" <?= $user['id_outlet'] == $ot['id'] ? 'selected' : '' ?>>
                                <?= $ot['nama'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>

            <div class="mt-2">
                <button type="submit" name="btn_update_user" class="btn btn-warning px-4 rounded-pill shadow-sm fw-bold">
                    <i class="bi bi-pencil-square me-2"></i>Update Data
                </button>
                <a href="index.php?page=user" class="btn btn-light px-4 rounded-pill border ms-2">Batal</a>
            </div>
        </form>
    </div>
</div>