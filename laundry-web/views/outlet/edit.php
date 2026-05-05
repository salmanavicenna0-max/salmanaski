<?php
// Cek role - hanya admin yang boleh edit outlet
$role = $_SESSION['role'];
if ($role !== 'admin') {
    echo "<script>alert('Anda tidak memiliki akses untuk mengedit outlet!'); window.location='index.php?page=outlet';</script>";
    exit;
}

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    echo "<script>alert('ID outlet tidak ditemukan!'); window.location='index.php?page=outlet';</script>";
    exit;
}

$id = $_GET['id'];

// Panggil fungsi dari OutletController untuk mengambil data outlet spesifik ini
// Fungsi getOutletById sudah kita buat di controller sebelumnya
$data = getOutletById($conn, $id);

// Jika data tidak ditemukan, balikkan ke halaman utama outlet
if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='index.php?page=outlet';</script>";
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="index.php?page=outlet" class="text-decoration-none text-muted">Outlet</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
            </ol>
        </nav>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-dark py-3">
                <h5 class="mb-0 fw-bold">Edit Data Outlet: <?= $data['nama']; ?></h5>
            </div>
            <div class="card-body p-4">
                <form action="index.php?page=outlet" method="POST">
                    
                    <input type="hidden" name="id" value="<?= $data['id']; ?>">
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama Outlet</label>
                        <input type="text" name="nama" id="nama" class="form-control" 
                               value="<?= $data['nama']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="tlp" class="form-label fw-bold">Nomor Telepon</label>
                        <input type="number" name="tlp" id="tlp" class="form-control" 
                               value="<?= $data['tlp']; ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="form-label fw-bold">Alamat Lengkap</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="4" required><?= $data['alamat']; ?></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="btn_update_outlet" class="btn btn-dark">
                            Simpan Perubahan
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