<?php 
   include __DIR__ . '/../layouts/header.php'; 
?>

<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <?php if (empty($products)): ?>
            <div class="text-center py-5 text-muted">
              <i class="bi bi-inbox fs-1"></i>
              <p class="mt-2">Belum ada data product.</p>
            </div>
          <?php else: ?>
            <div class="table-responsive">
              <table class="table table-hover table-bordered align-middle">
                <thead class="table-primary">
                  <tr>
                    <th width="50">No</th>
                    <th>Nama Product</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                    <th width="160" class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($products as $i => $p): ?>
                    <tr>
                      <td><?= $i + 1 ?></td>
                      <td><?= htmlspecialchars($p['nama_product']) ?></td>
                      <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                      <td><?= htmlspecialchars($p['stok']) ?></td>
                      <td><?= htmlspecialchars($p['deskripsi']) ?></td>
                      <td class="text-center">
                        <a href="index.php?page=products&action=edit&id=<?= $p['id'] ?>"
                           class="btn btn-warning btn-sm">
                          <i></i> Edit
                        </a>
                        <a href="index.php?page=products&action=delete&id=<?= $p['id'] ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin hapus product ini?')">
                          <i></i> Hapus
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
  include __DIR__ . '/../layouts/footer.php'; 
?>
