<div class="row justify-content-center">
    <div class="col-md-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="index.php?page=member" class="text-decoration-none text-muted">Member</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Member</li>
            </ol>
        </nav>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white py-3">
                <h5 class="mb-0 fw-bold">Daftarkan Pelanggan Baru</h5>
            </div>
            <div class="card-body p-4">
                <form action="index.php?page=member" method="POST">
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama pelanggan..." required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="jenis_kelamin" class="form-label fw-bold">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                                <option value="" selected disabled>-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="tlp" class="form-label fw-bold">No. Telepon</label>
                            <input type="number" name="tlp" id="tlp" class="form-control" placeholder="08xxx" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="form-label fw-bold">Alamat Lengkap</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Alamat pelanggan..." required></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="btn_simpan_member" class="btn btn-primary">
                            Daftarkan Member
                        </button>
                        <a href="index.php?page=member" class="btn btn-outline-secondary">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>