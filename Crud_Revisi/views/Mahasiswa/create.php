<?php $title = "Tambah Mahasiswa"; ?>
<?php require_once __DIR__ . '/../layouts/header.php'; ?>




<div class="card shadow-sm">
    <div class="card-body p-4">
        <form action="index.php?page=mahasiswa&action=store" method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nim" class="form-label fw-semibold">NIM <span class="text-danger">*</span></label>
                    <input type="text" name="nim" id="nim"
                           class="form-control" placeholder="Contoh: 2021001001" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="nama" id="nama"
                           class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jurusan" class="form-label fw-semibold">Jurusan <span class="text-danger">*</span></label>
                    <select name="jurusan" id="jurusan" class="form-select" required>
                        <option value="">Pilih Jurusan</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Teknik Elektro">Teknik Elektro</option>
                        <option value="Teknik Mesin">Teknik Mesin</option>
                        <option value="Teknik Sipil">Teknik Sipil</option>
                        <option value="Manajemen">Manajemen</option>
                        <option value="Akuntansi">Akuntansi</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Pendidikan Teknik">Pendidikan Teknik</option>
                        <option value="Desain Grafis">Desain Grafis</option>
                        <option value="Bisnis dan Perdagangan">Bisnis dan Perdagangan</option>
                        <option value="Administrasi Publik">Administrasi Publik</option>
                        <option value="Hukum">Hukum</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" id="email"
                           class="form-control" placeholder="Contoh: nama@email.com">
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i></i>Simpan
                </button>
                <a href="index.php?page=mahasiswa&action=index" class="btn btn-outline-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>