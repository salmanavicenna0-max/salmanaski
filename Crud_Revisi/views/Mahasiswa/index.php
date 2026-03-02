<?php 
   include __DIR__ . '/../layouts/header.php'; 

   // --- 1. LOGIKA DATA & TREND ---
   $m = date('m'); 
   $y = date('Y');
   $year = $_GET['year'] ?? $y;
   $month = $_GET['month'] ?? $m;

   function getCountByMonth($db, $table, $month, $year) {
       $res = $db->query("SELECT COUNT(*) FROM $table WHERE MONTH(created_at) = $month AND YEAR(created_at) = $year");
       return $res ? $res->fetch_row()[0] : 0;
   }

   // Data Trend Mahasiswa
   $thisMonthMhs = getCountByMonth($db, 'mahasiswa', $m, $y);
   $prevMonth = ($m == 1) ? 12 : $m - 1;
   $prevYear = ($m == 1) ? $y - 1 : $y;
   $prevMonthMhs = getCountByMonth($db, 'mahasiswa', $prevMonth, $prevYear);
   
   $diff = $thisMonthMhs - $prevMonthMhs;
   $percent = ($prevMonthMhs > 0) ? round(($diff / $prevMonthMhs) * 100, 1) : 0;
   $trendColor = ($diff >= 0) ? 'text-success' : 'text-danger';
   $trendIcon = ($diff >= 0) ? 'bi-arrow-up-right' : 'bi-arrow-down-right';


   
   // Data Total
   $totalMhs = $db->query("SELECT count(*) FROM mahasiswa")->fetch_row()[0];
   $totalProd = $db->query("SELECT count(*) FROM products")->fetch_row()[0];

   // Query Chart
   $qJurusan = $db->query("SELECT jurusan, COUNT(*) as total FROM mahasiswa GROUP BY jurusan");
   $jurusanLabels = []; $jurusanData = [];
   while($row = $qJurusan->fetch_assoc()) { $jurusanLabels[] = $row['jurusan']; $jurusanData[] = $row['total']; }

   $qActivity = $db->query("SELECT DATE(created_at) as tgl, COUNT(*) as total FROM mahasiswa WHERE YEAR(created_at) = '$year' AND MONTH(created_at) = '$month' GROUP BY DATE(created_at)");
   $activityLabels = []; $activityData = [];
   while($row = $qActivity->fetch_assoc()) { $activityLabels[] = $row['tgl']; $activityData[] = $row['total']; }
?>

<style>
    .card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
    .chart-container { height: 300px; position: relative; }
</style>

<div class="container-fluid mb-4">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-center">
                <input type="hidden" name="page" value="mahasiswa">
                <div class="col-auto"><strong>Filter Analytics:</strong></div>
                <div class="col-auto">
                    <select name="year" class="form-select">
                        <?php for($i=date('Y'); $i>=2020; $i--): ?>
                            <option value="<?= $i ?>" <?= $year == $i ? 'selected':'' ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-auto">
                    <select name="month" class="form-select">
                        <?php for($i=1; $i<=12; $i++): ?>
                            <option value="<?= $i ?>" <?= $month == $i ? 'selected':'' ?>><?= date('F', mktime(0,0,0,$i,1)) ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-auto"><button type="submit" class="btn btn-primary">Terapkan</button></div>
            </form>
        </div>
    </div>
    

    <!-- <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card p-3 shadow-sm h-100">
                <div class="d-flex justify-content-between">
                    <div><h6 class="text-muted">Total Mahasiswa</h6><h3><?= $totalMhs ?></h3></div>
                    <div class="text-end">
                        <span class="<?= $trendColor ?> fw-bold"><i class="bi <?= $trendIcon ?>"></i> <?= abs($percent) ?>%</span>
                        <p class="text-muted small mb-0">vs bulan lalu</p>
                    </div>
                </div>
            </div> -->
        <div class="row g-3 mb-4">
        <div class="col-md-4"><div class="card p-3 shadow-sm h-100"><h6>Total Mahasiswa</h6><h3><?= $totalMhs ?></h3></div></div>
        <div class="col-md-4"><div class="card p-3 shadow-sm h-100 bg-success text-white"><h6>Total Produk</h6><h3><?= $totalProd ?></h3></div></div>
        <div class="col-md-4"><div class="card p-3 shadow-sm h-100 bg-info text-white"><h6>Total Keseluruhan</h6><h3><?= $totalMhs + $totalProd ?></h3></div></div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6"><div class="card p-3 shadow-sm chart-container"><canvas id="jurusanChart"></canvas></div></div>
        <div class="col-md-6"><div class="card p-3 shadow-sm chart-container"><canvas id="activityChart"></canvas></div></div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <?php if (empty($mahasiswas)): ?>
                <div class="text-center py-5 text-muted"><i class="bi bi-inbox fs-1"></i><p>Belum ada data mahasiswa.</p></div>
            <?php else: ?>
                <div class="table-responsive">
<table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr><th width="50">No</th><th>NIM</th><th>Nama</th><th>Jurusan</th><th>Email</th><th width="160" class="text-center">Aksi</th></tr>
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
                                        <a href="index.php?page=mahasiswa&action=edit&id=<?= $m['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="index.php?page=mahasiswa&action=delete&id=<?= $m['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   // Config dasar untuk semua chart
    const chartOptions = { 
        responsive: true, 
        maintainAspectRatio: false, 
        plugins: { legend: { position: 'right' } } 
    };

    // Chart Jurusan (Doughnut)
    new Chart(document.getElementById('jurusanChart'), {
        type: 'doughnut',
        data: { 
            labels: <?= json_encode($jurusanLabels) ?>, 
            datasets: [{ data: <?= json_encode($jurusanData) ?>, backgroundColor: ['#0d6efd', '#20c997', '#ffc107', '#dc3545'] }] 
        },
        options: chartOptions
    });


    
    // Chart Aktivitas (Line) - Dengan tambahan konfigurasi bilangan bulat
    new Chart(document.getElementById('activityChart'), {
        type: 'line',
        data: { 
            labels: <?= json_encode($activityLabels) ?>, 
            datasets: [{ label: 'Input Mahasiswa', data: <?= json_encode($activityData) ?>, borderColor: '#0d6efd', fill: true, tension: 0.3 }] 
        },
        options: {
            ...chartOptions, // Mengambil setting responsive dari chartOptions
            scales: {
                y: {
                    beginAtZero: true, // Memulai dari 0
                    ticks: {
                        precision: 0, // Tidak ada angka di belakang koma
                        stepSize: 1   // Melompat per 1 angka
                    }
                }
            }
        }
    });
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>