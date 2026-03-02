<?php $title = "Edit Product"; ?>
<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="card shadow-sm">
    <div class="card-body p-4">
        <form action="index.php?page=products&action=update" method="POST">
            <!-- Hidden ID -->
            <input type="hidden" name="id" value="<?= $product['id'] ?>">

            <div class="mb-3">
                <label for="nama_product" class="form-label fw-semibold">Nama Product <span class="text-danger">*</span></label>
                <input type="text" name="nama_product" id="nama_product"
                       class="form-control"
                       value="<?= htmlspecialchars($product['nama_product']) ?>" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="harga" class="form-label fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="harga" id="harga"
                           class="form-control"
                           value="<?= $product['harga'] ?>" min="0" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="stok" class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stok" id="stok"
                           class="form-control"
                           value="<?= $product['stok'] ?>" min="0" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                          class="form-control"><?= htmlspecialchars($product['deskripsi']) ?></textarea>
            </div>
              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i></i>Update
                </button>
                <a href="index.php?page=products&action=index" class="btn btn-outline-secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>