 <!DOCTYPE html>
<html lang="id">
<head>
  <title>LaundryKu</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="public/css/style.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  <!-- <script src="script.js"></script> -->
  <style>
/* Sidebar Default */
#sidebar {
    min-width: 250px;
    max-width: 250px;
    transition: all 0.3s ease;
    z-index: 1000;
}

/* Kondisi Sidebar Tertutup di HP */
@media (max-width: 991.98px) {
    #sidebar {
        margin-left: -250px; /* Sembunyi ke kiri */
        position: fixed;
        height: 100%;
    }
    
    /* Saat class 'active' muncul (diklik tombol), sidebar slide ke kanan */
    #sidebar.active {
        margin-left: 0;
    }
}

/* Main Content agar fleksibel */
.main-content {
    width: 100%;
    transition: all 0.3s ease;
}
</style>
 
  <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.freepik.com/512/4666/4666163.png">

</head>
<body>
<!-- 
  <nav class="top-navbar d-flex justify-content-between align-items-center px-4 border-bottom shadow-sm">
    <div class="d-flex align-items-center"> -->
       
        </button>
<!--         
        <h5 class="mb-0 fw-bold text-uppercase" style="letter-spacing: 1px;">
            <i class="bi bi-grid-1x2-fill me-3 text-primary d-none d-lg-inline"></i> 
            LaundryKu <span class="text-primary">System</span>
        </h5> -->
    </div>
</nav>

  <!-- <nav class="top-navbar d-flex justify-content-between align-items-center px-4">
    <div class="d-flex align-items-center">

            <i class="bi bi-list"></i>
        </button>
         -->
        <!-- <h5 class="mb-0 fw-bold text-uppercase" style="letter-spacing: 1px;">
            <i class="bi bi-grid-1x2-fill me-3 text-primary d-none d-lg-inline"></i> 
            LaundryKu <span class="text-primary">System</span>
        </h5> -->
    </div>
    </nav>