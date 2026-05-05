<?php
$id = $_GET['id'];
$data = getPaketById($conn, $id);
?>

<div class="row mb-4">
    <div class="col-12">
        <h2 class="display-6 text-uppercase fw-bold mb-0">Edit <span class="text-primary">Paket</span></h2>
        <p class="text-muted mb-0">Ubah detail layanan paket cucian.</p>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 15px;">
    <div class="card-body p-4">
        <form action="index.php?page=paket" method="POST">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Outlet</label>
                    <select name="id_outlet" class="form-select" required>
                        <option value="">-- Pilih Outlet --</option>
                        <?php 
                        $outlets = mysqli_query($conn, "SELECT * FROM tb_outlet");
                        while($o = mysqli_fetch_assoc($outlets)): ?>
                            <option value="<?= $o['id'] ?>" <?= ($data['id_outlet'] == $o['id']) ? 'selected' : '' ?>><?= $o['nama'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Jenis Paket</label>
                    <select name="jenis" class="form-select" required>
                        <option value="kiloan" <?= ($data['jenis'] == 'kiloan') ? 'selected' : '' ?>>Kiloan</option>
                        <option value="selimut" <?= ($data['jenis'] == 'selimut') ? 'selected' : '' ?>>Selimut</option>
                        <option value="bed_cover" <?= ($data['jenis'] == 'bed_cover') ? 'selected' : '' ?>>Bed Cover</option>
                        <option value="kaos" <?= ($data['jenis'] == 'kaos') ? 'selected' : '' ?>>Kaos</option>
                        <option value="kain" <?= ($data['jenis'] == 'kain') ? 'selected' : '' ?>>Kain</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nama Paket</label>
                    <input type="text" name="nama_paket" class="form-control" required value="<?= $data['nama_paket'] ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Harga</label>
                    <input type="number" name="harga" class="form-control" required value="<?= $data['harga'] ?>">
                </div>
            </div>
            
            <div class="mt-4">
                <button type="submit" name="btn_update_paket" class="btn btn-primary px-4 shadow-sm rounded-pill">Update Paket</button>
                <a href="index.php?page=paket" class="btn btn-light px-4 border rounded-pill ms-2">Batal</a>
            </div>
        </form>
    </div>
</div>
