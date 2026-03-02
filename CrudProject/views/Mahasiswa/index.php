<?php 
   include __DIR__ . '/../layouts/header.php'; 
?>

<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <?php if (empty($mahasiswas)): ?>
            <div class="text-center py-5 text-muted">
              <i class="bi bi-inbox fs-1"></i>
              <p class="mt-2">Belum ada data mahasiswa.</p>
            </div>
          <?php else: ?>
            <div class="table-responsive">
              <table class="table table-hover table-bordered align-middle">
                <thead class="table-primary">
                  <tr>
                    <th width="50">No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Email</th>
                    <th width="160" class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($mahasiswas as $i => $m): ?>
                    <tr>
                      <td><?= $i + 1 ?></td>
                      <td><code><?= htmlspecialchars($m['nim']) ?></code></td>
                      <td><?= htmlspecialchars($m['nama']) ?></td>
                      <td><?= htmlspecialchars($m['jurusan']) ?></td>
                      <td><?= htmlspecialchars($m['email']) ?></td>
                      <td class="text-center">
                        <a href="index.php?page=mahasiswa&action=edit&id=<?= $m['id'] ?>"
                           class="btn btn-warning btn-sm">
                          <i></i> Edit
                        </a>
                        <a href="index.php?page=mahasiswa&action=delete&id=<?= $m['id'] ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin hapus mahasiswa ini?')">
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
