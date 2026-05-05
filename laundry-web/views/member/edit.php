<?php 
// Cek role - owner tidak boleh edit member
$role = $_SESSION['role'];
if ($role === 'owner') {
    echo "<script>alert('Anda tidak memiliki akses untuk mengedit member!'); window.location='index.php?page=member';</script>";
    exit;
}

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    echo "<script>alert('ID member tidak ditemukan!'); window.location='index.php?page=member';</script>";
    exit;
}

$id = $_GET['id'];

// Pastikan fungsi getMemberById sudah ada di MemberController kamu
$data = getMemberById($conn, $id);

// Jika data tidak ditemukan, balikkan ke halaman utama member
if (!$data) {
    echo "<script>alert('Data member tidak ditemukan!'); window.location='index.php?page=member';</script>";
    exit;
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="index.php?page=member" class="text-decoration-none text-muted">Member</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Profil Pelanggan</li>
            </ol>
        </nav>

        <div class="card shadow-sm border-0" style="border-radius: 15px; overflow: hidden;">
            <div class="card-header bg-primary text-white py-3 border-0">
                <h5 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Data Member: <?= $data['nama']; ?></h5>
            </div>
            
            <div class="card-body p-4">
                <form action="index.php?page=member" method="POST">
                    
                    <input type="hidden" name="id" value="<?= $data['id']; ?>">
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold small text-muted text-uppercase">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="form-control shadow-sm" 
                               value="<?= $data['nama']; ?>" placeholder="Masukkan nama pelanggan" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted text-uppercase">Jenis Kelamin</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="L" <?= ($data['jenis_kelamin'] == 'L') ? 'checked' : ''; ?> required>
                                <label class="form-check-label" for="laki">Laki-laki</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="P" <?= ($data['jenis_kelamin'] == 'P') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tlp" class="form-label fw-bold small text-muted text-uppercase">Nomor Telepon</label>
                        <input type="number" name="tlp" id="tlp" class="form-control shadow-sm" 
                               value="<?= $data['tlp']; ?>" placeholder="Contoh: 0812345678" required>
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="form-label fw-bold small text-muted text-uppercase">Alamat Lengkap</label>
                        <textarea name="alamat" id="alamat" class="form-control shadow-sm" rows="3" placeholder="Masukkan alamat lengkap" required><?= $data['alamat']; ?></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="btn_update_member" class="btn btn-primary py-2 fw-bold shadow-sm" style="border-radius: 10px;">
                            Simpan Perubahan
                        </button>
                        <a href="index.php?page=member" class="btn btn-light py-2 text-muted" style="border-radius: 10px;">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Tambahan style agar input lebih cantik mirip outlet */
    .form-control {
        border-radius: 10px;
        border: 1px solid #e3e6f0;
        padding: 10px 15px;
    }
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.1);
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
    }
</style>