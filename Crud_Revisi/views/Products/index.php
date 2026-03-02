<?php 
   include __DIR__ . '/../layouts/header.php'; 

   // --- 1. LOGIKA DATA ---
   $year = $_GET['year'] ?? date('Y');
   $month = $_GET['month'] ?? date('m');


   
   // Total Counts
   $totalMhs = $db->query("SELECT count(*) FROM mahasiswa")->fetch_row()[0];
   $totalProd = $db->query("SELECT count(*) FROM products")->fetch_row()[0];

   // Data Chart: Distribusi Harga Produk
   $qHarga = $db->query("SELECT 
        CASE 
            WHEN harga < 50000 THEN '< 50rb'
            WHEN harga BETWEEN 50000 AND 200000 THEN '50rb-200rb'
            WHEN harga BETWEEN 200001 AND 500000 THEN '200rb-500rb'
            ELSE '> 500rb'
        END as range_harga, COUNT(*) as total
        FROM products GROUP BY range_harga");
   
   $hargaLabels = []; $hargaData = [];
   while($row = $qHarga->fetch_assoc()) { $hargaLabels[] = $row['range_harga']; $hargaData[] = $row['total']; }

   // Data Chart: Aktivitas Input Produk
   $qActivity = $db->query("SELECT DATE(created_at) as tgl, COUNT(*) as total 
                            FROM products 
                            WHERE YEAR(created_at) = '$year' AND MONTH(created_at) = '$month' 
                            GROUP BY DATE(created_at)");
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
                <input type="hidden" name="page" value="products">
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

    <div class="row g-3 mb-4">
        <div class="col-md-4"><div class="card p-3 shadow-sm h-100"><h6>Total Mahasiswa</h6><h3><?= $totalMhs ?></h3></div></div>
        <div class="col-md-4"><div class="card p-3 shadow-sm h-100 bg-success text-white"><h6>Total Produk</h6><h3><?= $totalProd ?></h3></div></div>
        <div class="col-md-4"><div class="card p-3 shadow-sm h-100 bg-info text-white"><h6>Total Keseluruhan</h6><h3><?= $totalMhs + $totalProd ?></h3></div></div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6"><div class="card p-3 shadow-sm chart-container"><canvas id="priceChart"></canvas></div></div>
        <div class="col-md-6"><div class="card p-3 shadow-sm chart-container"><canvas id="activityChart"></canvas></div></div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <?php if (empty($products)): ?>
                <div class="text-center py-5 text-muted"><i class="bi bi-inbox fs-1"></i><p>Belum ada data product.</p></div>
            <?php else: ?>
                <div class="table-responsive">
<table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr><th>No</th><th>Nama Product</th><th>Harga</th><th>Stok</th><th>Deskripsi</th><th class="text-center">Aksi</th></tr>
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
                                        <a href="index.php?page=products&action=edit&id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="index.php?page=products&action=delete&id=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
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

    // Chart Harga (Pie/Doughnut)
    new Chart(document.getElementById('priceChart'), {
        type: 'pie',
        data: { 
            labels: <?= json_encode($hargaLabels) ?>, 
            datasets: [{ 
                data: <?= json_encode($hargaData) ?>, 
                backgroundColor: ['#6366f1', '#14b8a6', '#f59e0b', '#f43f5e'],
                borderWidth: 0
            }] 
        },
        options: chartOptions
    });

    // Chart Aktivitas (Line) - Dengan konfigurasi bilangan bulat
    new Chart(document.getElementById('activityChart'), {
        type: 'line',
        data: { 
            labels: <?= json_encode($activityLabels) ?>, 
            datasets: [{ 
                label: 'Input Produk', 
                data: <?= json_encode($activityData) ?>, 
                borderColor: '#14b8a6', 
                backgroundColor: 'rgba(20, 184, 166, 0.1)',
                fill: true, 
                tension: 0.3,
                borderWidth: 2
            }] 
        },
        options: {
            ...chartOptions,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>