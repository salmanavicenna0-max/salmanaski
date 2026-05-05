<?php
// 1. Ambil data Statistik (Angka-angka di atas)
$jml_member = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tb_member"));
$jml_outlet = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tb_outlet"));
$jml_user   = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tb_user"));

// 2. Ambil data Tabel (Member & Outlet Terbaru)
$query_member = mysqli_query($conn, "SELECT * FROM tb_member ORDER BY id DESC LIMIT 5");
$query_outlet = mysqli_query($conn, "SELECT * FROM tb_outlet ORDER BY id DESC LIMIT 5");

// Ambil role dari session (karena file ini di-include index.php, variabel $role biasanya sudah ada)
$role_user = $_SESSION['role'];
?>

<div class="container-fluid">
    <div class="row g-4 mb-4">
        <div class="<?= ($role_user === 'admin') ? 'col-md-4' : 'col-md-6' ?>">
            <div class="card border-0 shadow-sm p-3" style="border-left: 5px solid #0d6efd; border-radius: 12px;">
                <div class="d-flex align-items-center">
                    <div>
                        <small class="text-muted d-block fw-bold">TOTAL MEMBER</small>
                        <h3 class="fw-bold mb-0 text-primary"><?= $jml_member; ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="<?= ($role_user === 'admin') ? 'col-md-4' : 'col-md-6' ?>">
            <div class="card border-0 shadow-sm p-3" style="border-left: 5px solid #198754; border-radius: 12px;">
                <div class="d-flex align-items-center">
                    <div>
                        <small class="text-muted d-block fw-bold">TOTAL OUTLET</small>
                        <h3 class="fw-bold mb-0 text-success"><?= $jml_outlet; ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($role_user === 'admin') : ?>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3" style="border-left: 5px solid #ffc107; border-radius: 12px;">
                <div class="d-flex align-items-center">
                    <div>
                        <small class="text-muted d-block fw-bold">TOTAL USER</small>
                        <h3 class="fw-bold mb-0 text-warning"><?= $jml_user; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0"><i class="bi bi-person-check me-2 text-primary"></i> Member Terbaru</h5>
                    <a href="index.php?page=member" class="btn btn-sm btn-outline-primary rounded-pill px-3">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($m = mysqli_fetch_assoc($query_member)): ?>
                            <tr>
                                <td class="fw-bold"><?= $m['nama']; ?></td>
                                <td class="text-muted"><?= $m['tlp']; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 15px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0"><i class="bi bi-geo-alt me-2 text-success"></i> Lokasi Outlet</h5>
                    <a href="index.php?page=outlet" class="btn btn-sm btn-outline-success rounded-pill px-3">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Cabang</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($o = mysqli_fetch_assoc($query_outlet)): ?>
                            <tr>
                                <td class="fw-bold text-success"><?= $o['nama']; ?></td>
                                <td class="text-muted small"><?= $o['alamat']; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>