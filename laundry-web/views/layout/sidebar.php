<?php $role = $_SESSION['role']; ?>
<div id="sidebar" class="bg-dark text-white p-3 d-flex flex-column">
    <div class="sidebar-header px-4 py-2">
        <h4 class="fw-bold text-primary mb-0">Laundry<span class="text-white">Ku</span></h4>
    </div>
    
    <ul class="nav nav-pills flex-column mb-auto mt-3">
        <li class="nav-item">
            <a href="index.php?page=dashboard" class="nav-link <?= ($page == 'dashboard') ? 'active' : '' ?> text-white">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="index.php?page=transaksi" class="nav-link <?= ($page == 'transaksi') ? 'active' : '' ?> text-white">
                <i class="bi bi-speedometer2 me-2"></i> Transaksi
            </a>
        </li>

        <hr class="mx-3 my-2 border-secondary opacity-25">
        <small class="px-4 text-uppercase text-muted" style="font-size: 0.7rem;">Data Master</small>

        <li>
            <a href="index.php?page=outlet" class="nav-link <?= (strpos($page, 'outlet') !== false) ? 'active' : '' ?> text-white">
                <i class="bi bi-shop me-2"></i> Data Outlet
            </a>
        </li>

        <li>
            <a href="index.php?page=paket" class="nav-link <?= (strpos($page, 'paket') !== false) ? 'active' : '' ?> text-white">
                <i class="bi bi-box-seam me-2"></i> Data Paket
            </a>
        </li>

        <li>
            <a href="index.php?page=member" class="nav-link <?= (strpos($page, 'member') !== false) ? 'active' : '' ?> text-white">
                <i class="bi bi-people me-2"></i> Data Member
            </a>
        </li>
        <?php if($_SESSION['role'] === 'admin'): ?>
    <hr class="mx-3 my-2 border-secondary opacity-25">
    <small class="px-4 text-uppercase text-muted" style="font-size: 0.7rem;">Administrator</small>
    <li>
        <a href="index.php?page=user" class="nav-link <?= (strpos($page, 'user') !== false) ? 'active' : '' ?> text-white">
            <i class="bi bi-person-badge-fill me-2"></i> Data Pengguna
        </a>
    </li>
<?php endif; ?>
    </ul>
</div>