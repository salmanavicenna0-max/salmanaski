<?php 
// Ambil data user menggunakan fungsi yang ada di functions.php
$data_user = getAllUser($conn); 
?>

<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="display-6 text-uppercase fw-bold mb-0">Data <span class="text-primary">Pengguna</span></h2>
        <p class="text-muted mb-0">Manajemen akun staff</p>
    </div>
    <div class="col-md-6 text-end">
        <a href="index.php?page=user_tambah" class="btn btn-dark shadow-sm px-4 rounded-pill">
             <i class="bi bi-person-plus-fill me-2"></i>Tambah User
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table id="tabelUser" class="table table-hover align-middle mb-0">
                <thead class="table-dark small">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="py-3">Nama</th>
                        <th class="py-3">Username</th>
                        <th class="py-3">Role</th>
                        <th class="py-3">Outlet</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while($row = mysqli_fetch_assoc($data_user)) : 
                    ?>
                    <tr>
                        <td class="px-4 text-muted fw-bold"><?= $no++; ?></td>
                        <td class="fw-semibold"><?= $row['nama']; ?></td>
                        <td><code class="text-primary"><?= $row['username']; ?></code></td>
                        <td>
                            <span class="badge rounded-pill bg-opacity-10 <?= $row['role'] == 'admin' ? 'bg-danger text-danger' : 'bg-success text-success' ?> px-3">
                                <?= strtoupper($row['role']); ?>
                            </span>
                        </td>
                        <td>
                            <i class="bi bi-geo-alt me-1 text-muted"></i>
                            <?= $row['nama_outlet'] ? $row['nama_outlet'] : '<span class="text-muted small italic">Semua Outlet</span>'; ?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                                <a href="index.php?page=user_edit&id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-warning border-0 px-3">Edit</a>
                                <a href="index.php?page=user&hapus_user=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger border-0 px-3" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    if ($.fn.DataTable.isDataTable('#tabelUser')) {
        $('#tabelUser').DataTable().destroy();
    }
    $('#tabelUser').DataTable({
        "pageLength": 10,
        "language": {
            "search": "Cari Pengguna:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "zeroRecords": "Data tidak ditemukan",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ user",
            "paginate": { "next": "Lanjut", "previous": "Balik" }
        },
        "columnDefs": [ { "orderable": false, "targets": 5 } ]
    });
});
</script>