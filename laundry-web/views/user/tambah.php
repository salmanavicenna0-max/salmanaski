<?php
// Proteksi Admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php?page=dashboard");
    exit;
}

// Ambil data outlet untuk dropdown
$query_outlet = mysqli_query($conn, "SELECT * FROM tb_outlet");
?>

<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="display-6 text-uppercase fw-bold mb-0">Tambah <span class="text-primary">User</span></h2>
        <p class="text-muted">Dafrarkan staf atau admin baru ke sistem.</p>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 15px;">
    <div class="card-body p-4">
        <form action="index.php?page=user_tambah" method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control px-3" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" name="username" class="form-control px-3" placeholder="Masukkan username" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Password</label>
                    <input type="password" name="password" class="form-control px-3" placeholder="Gunakan Password kuat '*1@.['" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Role / Hak Akses</label>
                    <select name="role" class="form-select px-3" required>
                        <option value="" selected disabled>-- Pilih Role --</option>
                        <option value="admin">Admin</option>
                        <option value="kasir">Kasir</option>
                        <option value="owner">Owner</option>
                    </select>
                </div>
                <div class="col-md-12 mb-4">
                    <label class="form-label fw-bold">Tempat Tugas (Outlet)</label>
                    <select name="id_outlet" class="form-select px-3" required>
                        <option value="" selected disabled>-- Pilih Outlet --</option>
                        <?php while($ot = mysqli_fetch_assoc($query_outlet)): ?>
                            <option value="<?= $ot['id'] ?>"><?= $ot['nama'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>

            <div class="mt-2">
                <button type="submit" name="btn_simpan_user" class="btn btn-primary px-4 rounded-pill shadow-sm">
                    <i class="bi bi-save me-2"></i>Simpan Data
                </button>
                <a href="index.php?page=user" class="btn btn-light px-4 rounded-pill border ms-2">Batal</a>
            </div>
        </form>
    </div>
</div>