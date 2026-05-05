<?php
$data_transaksi = getAllTransaksi($conn);
$role = $_SESSION['role'];
?>

<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="display-6 text-uppercase fw-bold mb-0">Data <span class="text-primary">Transaksi</span></h2>
        <p class="text-muted mb-0">Daftar riwayat transaksi laundry.</p>
    </div>
    <div class="col-md-6 text-end">
        <?php if($role !== 'owner'): ?>
        <a href="index.php?page=transaksi_tambah" class="btn btn-dark shadow-sm px-4 rounded-pill">
             <i class="bi bi-plus-circle me-2"></i>Buat Transaksi Baru
        </a>
        <?php endif; ?>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table id="tabelTransaksi" class="table table-hover align-middle mb-0">
                <thead class="table-dark small text-uppercase">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="py-3">Invoice</th>
                        <th class="py-3">Member</th>
                        <th class="py-3">Tgl Masuk</th>
                        <th class="py-3">Status</th>
                        <th class="py-3">Pembayaran</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if(mysqli_num_rows($data_transaksi) > 0) :
                        while($row = mysqli_fetch_assoc($data_transaksi)) : 
                    ?>
                    <tr>
                        <td class="px-4 text-muted fw-bold"><?= $no++; ?></td>
                        <td class="fw-bold text-primary"><?= $row['kode_invoice']; ?></td>
                        <td class="fw-semibold"><?= $row['nama_member']; ?></td>
                        <td class="text-muted small"><?= date('d M Y H:i', strtotime($row['tgl'])); ?></td>
                        <td>
                            <?php if($row['status'] == 'baru'): ?>
                                <span class="badge bg-secondary">Baru</span>
                            <?php elseif($row['status'] == 'proses'): ?>
                                <span class="badge bg-warning text-dark">Proses</span>
                            <?php elseif($row['status'] == 'selesai'): ?>
                                <span class="badge bg-success">Selesai</span>
                            <?php elseif($row['status'] == 'diambil'): ?>
                                <span class="badge bg-primary">Diambil</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($row['dibayar'] == 'dibayar'): ?>
                                <span class="badge bg-success">Lunas</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Belum Bayar</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                                <a href="index.php?page=transaksi_detail&id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-info border-0 px-3">
                                    Detail
                                </a>
                                <?php if($role === 'admin'): ?>
                                <a href="index.php?page=transaksi&hapus_transaksi=<?= $row['id']; ?>"
                                   class="btn btn-sm btn-outline-danger border-0 px-3"
                                   onclick="return confirm('Hapus transaksi ini?')">
                                    Hapus
                                </a>
                                <?php endif; ?>
                            </div>
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
    $('#tabelTransaksi').DataTable({
        "paging": false,
        "searching": false,
        "info": false,
        "columnDefs": [
            { "orderable": false, "targets": 6 }
        ]
    });
});
</script>
