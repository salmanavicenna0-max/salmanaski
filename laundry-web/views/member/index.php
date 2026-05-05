<?php 
$data_member = getAllMember($conn); 
$role = $_SESSION['role'];
?>

<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="display-6 text-uppercase fw-bold mb-0">Data <span class="text-primary">Member</span></h2>
        <p class="text-muted mb-0">Daftar pelanggan LaundryKu.</p>
    </div>
    <div class="col-md-6 text-end">
        <?php if($role === 'admin' || $role === 'kasir'): ?>
        <a href="index.php?page=member_tambah" class="btn btn-dark shadow-sm px-4 rounded-pill">
             <i class="bi bi-person-plus-fill me-2"></i>Daftarkan Member Baru
        </a>
        <?php endif; ?>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
    <div class="card-body p-4"> 
        <div class="table-responsive">
            <table id="tabelMember" class="table table-hover align-middle mb-0">
                <thead class="table-dark small">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="py-3">Nama Pelanggan</th>
                        <th class="py-3">L/P</th>
                        <th class="py-3">Telepon</th>
                        <th class="py-3">Alamat</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    while($row = mysqli_fetch_assoc($data_member)) : 
                    ?>
                    <tr>
                        <td class="px-4 text-muted fw-bold"><?= $no++; ?></td>
                        <td class="fw-semibold"><?= $row['nama']; ?></td>
                        <td>
                            <span class="badge rounded-pill <?= $row['jenis_kelamin'] == 'L' ? 'bg-info text-dark' : 'bg-danger' ?>" style="font-size: 11px;">
                                <?= $row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?>
                            </span>
                        </td>
                        <td><?= $row['tlp']; ?></td>
                        <td class="text-muted small"><?= $row['alamat']; ?></td>
                        <td class="text-center">
                            <?php if($role !== 'owner'): ?>
                            <div class="btn-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                                <a href="index.php?page=member_edit&id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-warning border-0 px-3">Edit</a>
                                
                                <a href="index.php?page=member&hapus_member=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger border-0 px-3" onclick="return confirm('Hapus member ini?')">Hapus</a>
                            </div>
                            <?php else: ?>
                                <span class="badge bg-light text-muted fw-normal border">View Only</span>
                            <?php endif; ?>
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
    if ($.fn.DataTable.isDataTable('#tabelMember')) {
        $('#tabelMember').DataTable().destroy();
    }

    $('#tabelMember').DataTable({
        "retrieve": true,
        "language": {
            "search": "Search:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "zeroRecords": "Member tidak ditemukan",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ member",
            "infoEmpty": "Data kosong",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Lanjut",
                "previous": "Balik"
            }
        },
        "pageLength": 10,
        "columnDefs": [
            { "orderable": false, "targets": 5 }
        ]
    });
});
</script>

<style>
    .dataTables_filter { margin-bottom: 25px; }
    .dataTables_filter input {
        border-radius: 30px;
        padding: 7px 20px;
        border: 1px solid #e3e6f0;
        min-width: 250px;
        transition: all 0.3s;
    }
    .dataTables_filter input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 8px rgba(13, 110, 253, 0.2);
        outline: none;
    }
    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    .pagination .page-link {
        border-radius: 5px !important;
        margin: 0 2px;
    }
</style>