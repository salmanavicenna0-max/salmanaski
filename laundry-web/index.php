<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php
// Panggil koneksi database
require_once 'config/database.php';

// Ambil bagian Header
include 'views/layout/header.php';

// Logika Routing Sederhana
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

echo '<div class="container mt-4">'; // Bungkus konten dalam kontainer Bootstrap

switch ($page) {
    case 'outlet':
        include 'views/outlet/index.php';
        break;
    case 'user':
        include 'views/login/index.php';
        break;
    case 'transaksi':
        include 'views/transaksi/index.php';
        break;
    default:
       ?>
        <!-- <style>
            .hero-section {
                display: flex;
                align-items: center;
                gap: 40px;
                margin-bottom: 60px;
            }
            .hero-text {
                flex: 1;
            }
            .hero-text h1 {
                font-size: 3em;
                font-weight: bold;
                margin-bottom: 20px;
                color: #333;
            }
            .hero-text p {
                font-size: 1.1em;
                line-height: 1.6;
                color: #666;
            }
            .hero-carousel {
                flex: 1;
            }
        </style> -->

        <div class="hero-section">
            <!-- Text Content -->
            <div class="hero-text">
                <h1>LaundryKu Premium</h1>
                <p>Selamat datang di LaundryKu, platform manajemen laundry terbaik untuk bisnis Anda. Kami menyediakan solusi lengkap untuk mengelola outlet, pengguna, dan transaksi keuangan dengan mudah dan efisien.</p>
                <p><strong>Kebersihan adalah prioritas kami.</strong> Dengan teknologi terdepan dan sistem yang terpercaya, kami siap membantu Anda mengembangkan bisnis laundry ke level berikutnya.</p>
            </div>

            <!-- Carousel -->
            <div class="hero-carousel">
                <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://as1.ftcdn.net/jpg/04/63/41/18/1000_F_463411850_Grl9sQmrcwA53riQdVuQ5npHaBCkGqSn.jpg" class="d-block w-100" alt="New York" style="border-radius: 10px;">
                            <div class="carousel-caption">
                                <h3>LaundryKu Premium</h3>
                                <p>Kebersihan adalah prioritas kami.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://www.housedigest.com/img/gallery/10-laundry-practices-from-around-the-world-to-try-and-which-are-best-to-skip/try-north-america-self-service-laundromats-1733399025.jpg" class="d-block w-100" alt="Chicago" style="border-radius: 10px;">
                            <div class="carousel-caption">
                                <h3>Cepat & Bersih</h3>
                                <p>Pakaian rapi dalam sekejap.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="container text-center">
            <h3>KAMI ADALAH PROFESIONAL</h3>
            <p><em>We love cleanliness!</em></p>
            <p>Aplikasi Laundry pengelolaan data terbaik untuk outlet Anda.</p>
            <div class="row">
                <div class="col-sm-4">
                    <p><strong>Admin</strong></p>
                    <img src="https://www.w3schools.com/w3images/bandmember.jpg" class="rounded-circle person" alt="Admin">
                </div>
                <div class="col-sm-4">
                    <p><strong>Kasir</strong></p>
                    <img src="https://www.w3schools.com/w3images/bandmember.jpg" class="rounded-circle person" alt="Kasir">
                </div>
                <div class="col-sm-4">
                    <p><strong>Owner</strong></p>
                    <img src="https://www.w3schools.com/w3images/bandmember.jpg" class="rounded-circle person" alt="Owner">
                </div>
            </div>
        </div>

                

        <?php
        
        break;
}

echo '</div>'; // Tutup kontainer

// Ambil bagian Footer
include 'views/layout/footer.php';
?>