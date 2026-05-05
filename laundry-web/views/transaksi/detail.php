<?php
$id = $_GET['id'];
$transaksi = getTransaksiById($conn, $id);
$detail = getDetailTransaksi($conn, $id);
$role = $_SESSION['role'];

// Hitung total bayar
$subtotal_all = 0;
while($d = mysqli_fetch_assoc($detail)){
    $subtotal_all += $d['subtotal'];
}
$diskon_rp = $subtotal_all * ($transaksi['diskon']/100);
$total_bayar = $subtotal_all - $diskon_rp + $transaksi['biaya_tambahan'] + $transaksi['pajak'];
?>

<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="display-6 text-uppercase fw-bold mb-0">Detail <span class="text-info">Transaksi</span></h2>
            <p class="text-muted mb-0">Invoice: <span class="fw-bold"><?= $transaksi['kode_invoice'] ?></span></p>
        </div>
        <a href="index.php?page=transaksi" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left me-2"></i>Kembali
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Info Pelanggan & Transaksi -->
    <div class="col-md-4">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body p-4">
                <h5 class="fw-bold border-bottom pb-2 mb-3">Informasi Pelanggan</h5>
                <p class="mb-1"><span class="text-muted">Nama:</span> <br><span class="fw-semibold"><?= $transaksi['nama_member'] ?></span></p>
                <p class="mb-1"><span class="text-muted">Telepon:</span> <br><?= $transaksi['tlp_member'] ?></p>
                <p class="mb-3"><span class="text-muted">Alamat:</span> <br><?= $transaksi['alamat_member'] ?></p>
                
                <h5 class="fw-bold border-bottom pb-2 mb-3">Informasi Order</h5>
                <p class="mb-1"><span class="text-muted">Outlet:</span> <br><?= $transaksi['nama_outlet'] ?></p>
                <p class="mb-1"><span class="text-muted">Kasir:</span> <br><?= $transaksi['nama_user'] ?></p>
                <p class="mb-1"><span class="text-muted">Tgl Masuk:</span> <br><?= date('d M Y H:i', strtotime($transaksi['tgl'])) ?></p>
                <p class="mb-1"><span class="text-muted">Batas Waktu:</span> <br><?= date('d M Y', strtotime($transaksi['batas_waktu'])) ?></p>
                <p class="mb-1"><span class="text-muted">Tgl Bayar:</span> <br><?= $transaksi['tgl_bayar'] ? date('d M Y H:i', strtotime($transaksi['tgl_bayar'])) : '-' ?></p>
            </div>
        </div>
        
        <?php if($role !== 'owner'): ?>
        <!-- Update Status Form -->
        <div class="card border-0 shadow-sm mt-4 bg-light" style="border-radius: 15px;">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-pencil-square me-2"></i>Update Status</h5>
                <form action="index.php?page=transaksi" method="POST">
                    <input type="hidden" name="id" value="<?= $transaksi['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Status Cucian</label>
                        <select name="status" class="form-select" required>
                            <option value="baru" <?= $transaksi['status'] == 'baru' ? 'selected' : '' ?>>Baru</option>
                            <option value="proses" <?= $transaksi['status'] == 'proses' ? 'selected' : '' ?>>Proses</option>
                            <option value="selesai" <?= $transaksi['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                            <option value="diambil" <?= $transaksi['status'] == 'diambil' ? 'selected' : '' ?>>Diambil</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Status Pembayaran</label>
                        <select name="dibayar" class="form-select" required>
                            <option value="belum_dibayar" <?= $transaksi['dibayar'] == 'belum_dibayar' ? 'selected' : '' ?>>Belum Bayar</option>
                            <option value="dibayar" <?= $transaksi['dibayar'] == 'dibayar' ? 'selected' : '' ?>>Lunas / Dibayar</option>
                        </select>
                    </div>
                    <button type="submit" name="btn_update_status" class="btn btn-primary w-100 rounded-pill">Update Transaksi</button>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Detail Item & Pembayaran -->
    <div class="col-md-8">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body p-4">
                <h5 class="fw-bold border-bottom pb-2 mb-3">Detail Cucian</h5>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Paket</th>
                                <th>Keterangan</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Reset pointer result detail
                            mysqli_data_seek($detail, 0);
                            while($d = mysqli_fetch_assoc($detail)): ?>
                            <tr>
                                <td class="fw-semibold text-primary"><?= $d['nama_paket'] ?></td>
                                <td class="text-muted small"><?= $d['keterangan'] ?></td>
                                <td class="text-center">Rp <?= number_format($d['harga'],0,',','.') ?></td>
                                <td class="text-center"><?= $d['qty'] ?></td>
                                <td class="text-end fw-bold">Rp <?= number_format($d['subtotal'],0,',','.') ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-6 offset-md-6">
                        <table class="table table-sm borderless mb-0">
                            <tr>
                                <td class="text-end text-muted">Subtotal:</td>
                                <td class="text-end fw-semibold">Rp <?= number_format($subtotal_all,0,',','.') ?></td>
                            </tr>
                            <tr>
                                <td class="text-end text-muted">Diskon (<?= $transaksi['diskon'] ?>%):</td>
                                <td class="text-end text-danger">- Rp <?= number_format($diskon_rp,0,',','.') ?></td>
                            </tr>
                            <tr>
                                <td class="text-end text-muted">Biaya Tambahan:</td>
                                <td class="text-end">Rp <?= number_format($transaksi['biaya_tambahan'],0,',','.') ?></td>
                            </tr>
                            <tr>
                                <td class="text-end text-muted border-bottom pb-2">Pajak:</td>
                                <td class="text-end border-bottom pb-2">Rp <?= number_format($transaksi['pajak'],0,',','.') ?></td>
                            </tr>
                            <tr>
                                <td class="text-end fw-bold fs-5 pt-2">Total Bayar:</td>
                                <td class="text-end fw-bold fs-5 pt-2 text-primary">Rp <?= number_format($total_bayar,0,',','.') ?></td>
                            </tr>
                        </table>
                        
                        <?php if($transaksi['dibayar'] == 'dibayar'): ?>
                            <div class="mt-3 text-end">
                                <span class="badge bg-success py-2 px-4 fs-6 rounded-pill"><i class="bi bi-check-circle me-2"></i>LUNAS</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.borderless td, .borderless th {
    border: none;
}
</style>
