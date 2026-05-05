<?php
$data_paket = getAllPaket($conn);
$role = $_SESSION['role'];
?>

<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="display-6 text-uppercase fw-bold mb-0">Data <span class="text-primary">Paket</span></h2>
        <p class="text-muted mb-0">Daftar layanan cucian (Paket) yang tersedia.</p>
    </div>
    <div class="col-md-6 text-end">
        <?php if($role === 'admin'): ?>
        <a href="index.php?page=paket_tambah" class="btn btn-dark shadow-sm px-4 rounded-pill">
             <i class="bi bi-plus-circle me-2"></i>Tambah Paket Baru
        </a>
        <?php endif; ?>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table id="tabelPaket" class="table table-hover align-middle mb-0">
                <thead class="table-dark small text-uppercase">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="py-3">Outlet</th>
                        <th class="py-3">Nama Paket</th>
                        <th class="py-3">Jenis</th>
                        <th class="py-3">Harga</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if(mysqli_num_rows($data_paket) > 0) :
                        while($row = mysqli_fetch_assoc($data_paket)) : 
                    ?>
                    <tr>
                        <td class="px-4 text-muted fw-bold"><?= $no++; ?></td>
                        <td class="text-muted"><?= $row['nama_outlet']; ?></td>
                        <td class="fw-semibold text-primary"><?= $row['nama_paket']; ?></td>
                        <td><span class="badge bg-secondary text-capitalize"><?= str_replace('_', ' ', $row['jenis']); ?></span></td>
                        <td class="fw-bold">Rp <?= number_format($row['harga'],0,',','.'); ?></td>
                        <td class="text-center">
                            <?php if($role === 'admin'): ?>
                            <div class="btn-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                                <a href="index.php?page=paket_edit&id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-warning border-0 px-3">
                                    Edit
                                </a>
                                <a href="index.php?page=paket&hapus_paket=<?= $row['id']; ?>"
                                   class="btn btn-sm btn-outline-danger border-0 px-3"
                                   onclick="return confirm('Hapus paket ini?')">
                                    Hapus
                                </a>
                            </div>
                            <?php else: ?>
                                <span class="badge bg-light text-muted fw-normal border">View Only</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php 
                        endwhile; 
                    endif; 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#tabelPaket').DataTable({
        "paging": false,
        "searching": false,
        "info": false,
        "columnDefs": [
            { "orderable": false, "targets": 5 }
        ]
    });
});
</script>
