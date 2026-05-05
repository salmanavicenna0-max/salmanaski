<?php
// Cek role - hanya admin yang boleh tambah outlet
$role = $_SESSION['role'];
if ($role !== 'admin') {
    echo "<script>alert('Anda tidak memiliki akses untuk menambah outlet!'); window.location='index.php?page=outlet';</script>";
    exit;
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?page=outlet" class="text-decoration-none">Outlet</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
            </ol>
        </nav>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white py-3">
                <h5 class="mb-0">Form Tambah Outlet Baru</h5>
            </div>
            <div class="card-body p-4">
                <form action="index.php?page=outlet" method="POST">
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama Outlet</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Contoh: Laundry Jatinangor 1" required>
                    </div>

                    <div class="mb-3">
                        <label for="tlp" class="form-label fw-bold">Nomor Telepon</label>
                        <input type="number" name="tlp" id="tlp" class="form-control" placeholder="Contoh: 08123456789" required>
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="form-label fw-bold">Alamat Lengkap</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="4" placeholder="Masukkan alamat lengkap cabang..." required></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="btn_simpan_outlet" class="btn btn-primary">
                            Simpan Data
                        </button>
                        <a href="index.php?page=outlet" class="btn btn-outline-secondary">
                            Batal
                        </a>
                    </div>

                </form>
                </div>
        </div>
    </div>
</div>