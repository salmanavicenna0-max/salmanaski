<div class="row mb-4">
    <div class="col-12">
        <h2 class="display-6 text-uppercase fw-bold mb-0">Buat <span class="text-primary">Transaksi</span></h2>
        <p class="text-muted mb-0">Formulir untuk membuat transaksi baru.</p>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 15px;">
    <div class="card-body p-4">
        <form action="index.php?page=transaksi" method="POST">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Member (Pelanggan)</label>
                    <select name="id_member" class="form-select" required>
                        <option value="">-- Pilih Member --</option>
                        <?php 
                        $members = mysqli_query($conn, "SELECT id, nama, tlp FROM tb_member");
                        while($m = mysqli_fetch_assoc($members)): ?>
                            <option value="<?= $m['id'] ?>"><?= $m['nama'] ?> (<?= $m['tlp'] ?>)</option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Batas Waktu</label>
                    <input type="date" name="batas_waktu" class="form-control" required min="<?= date('Y-m-d') ?>">
                </div>
                
                <div class="col-12 mt-4">
                    <h5 class="fw-bold border-bottom pb-2">Detail Cucian</h5>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Paket Cucian</label>
                    <select name="id_paket" class="form-select" required>
                        <option value="">-- Pilih Paket --</option>
                        <?php 
                        $pakets = mysqli_query($conn, "SELECT p.*, o.nama as outlet_nama FROM tb_paket p LEFT JOIN tb_outlet o ON p.id_outlet = o.id");
                        while($p = mysqli_fetch_assoc($pakets)): ?>
                            <option value="<?= $p['id'] ?>"><?= $p['nama_paket'] ?> - Rp <?= number_format($p['harga'],0,',','.') ?> (<?= $p['outlet_nama'] ?>)</option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label class="form-label fw-bold">Qty (Berat/Pcs)</label>
                    <input type="number" step="0.1" name="qty" class="form-control" required placeholder="0.0">
                </div>
                
                <div class="col-md-4">
                    <label class="form-label fw-bold">Biaya Tambahan</label>
                    <input type="number" name="biaya_tambahan" class="form-control" placeholder="0" value="0">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Diskon (%)</label>
                    <input type="number" name="diskon" class="form-control" placeholder="0" value="0">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label fw-bold">Pajak (Rp)</label>
                    <input type="number" name="pajak" class="form-control" placeholder="0" value="0">
                </div>
                
                <div class="col-12">
                    <label class="form-label fw-bold">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="2" placeholder="Catatan tambahan (opsional)"></textarea>
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" name="btn_simpan_transaksi" class="btn btn-primary px-4 shadow-sm rounded-pill">Simpan Transaksi</button>
                <a href="index.php?page=transaksi" class="btn btn-light px-4 border rounded-pill ms-2">Batal</a>
            </div>
        </form>
    </div>
</div>
