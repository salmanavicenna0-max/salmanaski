<?php $title = "Edit Mahasiswa"; ?>
<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="card shadow-sm">
    <div class="card-body p-4">
        <form action="index.php?page=mahasiswa&action=update" method="POST">
            <!-- Hidden ID -->
            <input type="hidden" name="id" value="<?= $mahasiswa['id'] ?>">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nim" class="form-label fw-semibold">NIM <span class="text-danger">*</span></label>
                    <input type="text" name="nim" id="nim"
                           class="form-control"
                           value="<?= htmlspecialchars($mahasiswa['nim']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="nama" id="nama"
                           class="form-control"
                           value="<?= htmlspecialchars($mahasiswa['nama']) ?>" required>
                </div>
            </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jurusan" class="form-label fw-semibold">Jurusan <span class="text-danger">*</span></label>
                    <select name="jurusan" id="jurusan" class="form-select" required>
                        <option value="">-- Pilih Jurusan --</option>
                        <option value="Teknik Informatika" <?= $mahasiswa['jurusan'] == 'Teknik Informatika' ? 'selected' : '' ?>>Teknik Informatika</option>
                        <option value="Teknik Elektro" <?= $mahasiswa['jurusan'] == 'Teknik Elektro' ? 'selected' : '' ?>>Teknik Elektro</option>
                        <option value="Teknik Mesin" <?= $mahasiswa['jurusan'] == 'Teknik Mesin' ? 'selected' : '' ?>>Teknik Mesin</option>
                        <option value="Teknik Sipil" <?= $mahasiswa['jurusan'] == 'Teknik Sipil' ? 'selected' : '' ?>>Teknik Sipil</option>
                        <option value="Manajemen" <?= $mahasiswa['jurusan'] == 'Manajemen' ? 'selected' : '' ?>>Manajemen</option>
                        <option value="Akuntansi" <?= $mahasiswa['jurusan'] == 'Akuntansi' ? 'selected' : '' ?>>Akuntansi</option>
                        <option value="Sistem Informasi" <?= $mahasiswa['jurusan'] == 'Sistem Informasi' ? 'selected' : '' ?>>Sistem Informasi</option>
                        <option value="Pendidikan Teknik" <?= $mahasiswa['jurusan'] == 'Pendidikan Teknik' ? 'selected' : '' ?>>Pendidikan Teknik</option>
                        <option value="Desain Grafis" <?= $mahasiswa['jurusan'] == 'Desain Grafis' ? 'selected' : '' ?>>Desain Grafis</option>
                        <option value="Bisnis dan Perdagangan" <?= $mahasiswa['jurusan'] == 'Bisnis dan Perdagangan' ? 'selected' : '' ?>>Bisnis dan Perdagangan</option>
                        <option value="Administrasi Publik" <?= $mahasiswa['jurusan'] == 'Administrasi Publik' ? 'selected' : '' ?>>Administrasi Publik</option>
                        <option value="Hukum" <?= $mahasiswa['jurusan'] == 'Hukum' ? 'selected' : '' ?>>Hukum</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" id="email"
                           class="form-control"
                           value="<?= htmlspecialchars($mahasiswa['email']) ?>">
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i></i>Update
                </button>
                <a href="index.php?page=mahasiswa&action=index" class="btn btn-outline-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>