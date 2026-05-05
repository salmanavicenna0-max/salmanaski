<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | LaundryKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* GRADIEN BIRU PREMIUM */
        .gradient-custom-2 {
            background: #0d6efd;
            background: -webkit-linear-gradient(to right, #0d6efd, #0a58ca, #084298, #052c65);
            background: linear-gradient(to right, #0d6efd, #0a58ca, #084298, #052c65);
        }

        @media (min-width: 768px) {
            .gradient-form { height: 100vh !important; }
        }
        
        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #e3e6f0;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            border-color: #0d6efd;
        }

        .btn-login {
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4) !important;
        }
    </style>
</head>
<body>

<section class="h-100 gradient-form" style="background-color: #f8f9fc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-4 border-0 shadow-lg text-black overflow-hidden">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center mb-5">
                  <h3 class="fw-800 text-uppercase" style="letter-spacing: 2px;">
                    Laundry<span class="text-primary">Ku</span>
                  </h3>
                  <div class="mx-auto mt-2" style="width: 40px; height: 4px; background: #0d6efd; border-radius: 10px;"></div>
                </div>

                <form action="index.php" method="POST">
                  <h5 class="mb-1 fw-bold">Selamat Datang!</h5>
                  <p class="text-muted mb-4 small">Silakan login untuk mengelola operasional.</p>

                  <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'gagal') : ?>
                    <div class="alert alert-danger py-2 small shadow-sm border-0 mb-4" style="border-radius: 10px;">
                        <i class="bi bi-exclamation-circle me-2"></i> Username atau password salah!
                    </div>
                  <?php endif; ?>

                  <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">Username</label>
                    <input type="text" name="username" id="username" class="form-control"
                      placeholder="Masukkan username" required />
                  </div>

                  <div class="mb-4">
                    <label class="form-label small fw-bold text-muted">Password</label>
                    <input type="password" name="password" id="password" class="form-control" 
                    placeholder="Masukkan password" required />
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1 d-grid gap-2">
                    <button name="btn_login" class="btn btn-primary btn-login gradient-custom-2 border-0 shadow" type="submit">
                        Masuk
                    </button>
                  </div>

                  <div class="d-flex align-items-center justify-content-center">
                    <p class="mb-0 small text-muted opacity-50">© 2026 LaundryKu</p>
                  </div>
                </form>

              </div>
            </div>

            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4 text-center text-lg-start">
                <h2 class="mb-4 fw-bold">More than just a laundry</h2>
                <p class="lead mb-0 opacity-75" style="font-size: 1rem; line-height: 1.8;">
                    Kelola operasional laundry dengan lebih mudah. 
                    Mulai dari pencatatan member, manajemen outlet, pengganti buku manual!
                </p>
                
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>