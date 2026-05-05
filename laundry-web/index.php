<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'controllers/AuthController.php';
require_once 'config/database.php';
require_once 'config/functions.php'; // Memanggil fungsi CRUD yang kita buat tadi

// 1. Cek apakah user sudah login
$is_login = isset($_SESSION['status']) && $_SESSION['status'] == 'login';

// 2. Logika Proses Login
if (isset($_POST['btn_login'])) {
    if (login($conn, $_POST['username'], $_POST['password'])) {
        header("Location: index.php?page=dashboard");
    } else {
        header("Location: index.php?pesan=gagal");
    }
    exit;
}

// 3. Jika BELUM login, paksa tampilkan halaman login
if (!$is_login) {
    include 'views/auth/login.php';
    exit;
}

// 4. Tentukan Halaman & Role
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$role = $_SESSION['role']; 

// --- SWITCH 1: KHUSUS PEMANGGILAN CONTROLLER (MESIN) + SECURITY ---
switch ($page) {
    case 'outlet':
    case 'outlet_tambah':
    case 'outlet_edit':
        if (($page == 'outlet_tambah' || $page == 'outlet_edit') && $role !== 'admin') {
            header("Location: index.php?page=outlet&pesan=terlarang");
            exit;
        }
        include_once 'controllers/OutletController.php';
        break;

    case 'member':
    case 'member_tambah':
    case 'member_edit':
        if (($page == 'member_tambah' || $page == 'member_edit') && $role === 'owner') {
            header("Location: index.php?page=member&pesan=terlarang");
            exit;
        }
        include_once 'controllers/MemberController.php';
        break;

    case 'paket':
    case 'paket_tambah':
    case 'paket_edit':
        if (($page == 'paket_tambah' || $page == 'paket_edit') && $role !== 'admin') {
            header("Location: index.php?page=paket&pesan=terlarang");
            exit;
        }
        include_once 'controllers/PaketController.php';
        break;

    case 'transaksi':
    case 'transaksi_tambah':
    case 'transaksi_detail':
        include_once 'controllers/TransaksiController.php';
        break;

        case 'user':
            case 'user_tambah':
            case 'user_edit':
                if ($role !== 'admin') { header("Location: index.php?page=dashboard"); exit; }
                
                // Logika Simpan (Yang tadi sudah dibuat)
                if (isset($_POST['btn_simpan_user'])) {
                    if (tambahUser($conn, $_POST)) {
                        echo "<script>alert('User Berhasil Ditambahkan!'); window.location.href='index.php?page=user';</script>";
                    }
                }
            
                // --- TAMBAHKAN LOGIKA UPDATE DISINI ---
                if (isset($_POST['btn_update_user'])) {
                    if (updateUser($conn, $_POST)) {
                        echo "<script>alert('Data Berhasil Diperbarui!'); window.location.href='index.php?page=user';</script>";
                    } else {
                        echo "<script>alert('Gagal memperbarui data!');</script>";
                    }
                }
        
        // Logika Hapus User (Proses Mesin)
        if (isset($_GET['hapus_user'])) {
            $id_hapus = $_GET['hapus_user'];
            if (hapusUser($conn, $id_hapus)) {
                header("Location: index.php?page=user&pesan=hapus_berhasil");
                exit;
            }
        }
        
        // Cek apakah file controller ada, jika ada panggil
        if(file_exists('controllers/UserController.php')){
            include_once 'controllers/UserController.php';
        }
        break;
}

// 5. Bagian Head & Aset
include 'views/layout/header.php';
?>

<div class="d-flex">
    <?php include 'views/layout/sidebar.php'; ?>

    <div class="main-content flex-grow-1">
        <nav class="top-navbar d-flex justify-content-between align-items-center px-4 py-3 border-bottom shadow-sm bg-white">
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-primary me-3 d-lg-none" id="sidebarToggle" type="button">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <h5 class="mb-0 fw-bold text-uppercase d-none d-sm-block" style="letter-spacing: 1px;">
                    <img src="https://cdn-icons-png.freepik.com/512/4666/4666163.png" class="me-2" width="25" height="25">
                    LaundryKu <span class="text-primary">Website</span>
                </h5>
                <h6 class="mb-0 fw-bold text-uppercase d-sm-none">
                    <i class="bi bi-house-door text-primary me-2"></i>
                    LaundryKu
                </h6>
            </div>
            <div class="dropdown">
                <a href="#" class="text-decoration-none text-dark dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                    <div class="text-end me-2 d-none d-sm-block">
                        <small class="text-muted d-block" style="font-size: 10px;">Login Sebagai</small>
                        <span class="fw-bold text-primary" style="font-size: 13px;"><?php echo strtoupper($role); ?></span>
                    </div>
                    <img src="https://www.w3schools.com/w3images/bandmember.jpg" class="rounded-circle border" width="35" height="35">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 me-3">
                    <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i> Keluar</a></li>
                </ul>
            </div>
        </nav>

        <div class="p-4">
            <div class="card border-0 shadow-sm p-4" style="border-radius: 15px; min-height: 85vh;">
                <?php
                // --- SWITCH 2: TAMPILAN (VIEW) ---
                switch ($page) {
                    case 'dashboard': include 'views/dashboard.php'; break;
                    
                    // Route Outlet
                    case 'outlet': include 'views/outlet/index.php'; break;
                    case 'outlet_tambah': include 'views/outlet/tambah.php'; break;
                    case 'outlet_edit': include 'views/outlet/edit.php'; break;
                    
                    // Route Member
                    case 'member': include 'views/member/index.php'; break;
                    case 'member_tambah': include 'views/member/tambah.php'; break;
                    case 'member_edit': include 'views/member/edit.php'; break;
                    
                    // Route User (Admin Only)
                    case 'user': include 'views/user/index.php'; break;
                    case 'user_tambah': include 'views/user/tambah.php'; break;
                    case 'user_edit': include 'views/user/edit.php'; break;

                    // Route Paket
                    case 'paket': include 'views/paket/index.php'; break;
                    case 'paket_tambah': include 'views/paket/tambah.php'; break;
                    case 'paket_edit': include 'views/paket/edit.php'; break;
                    
                    // Route Transaksi
                    case 'transaksi': include 'views/transaksi/index.php'; break;
                    case 'transaksi_tambah': include 'views/transaksi/tambah.php'; break;
                    case 'transaksi_detail': include 'views/transaksi/detail.php'; break;
                    
                    default: include 'views/dashboard.php'; break;
                }
                ?>
            </div>
        </div>
    </div>
</div> 

<?php include 'views/layout/footer.php'; ?>