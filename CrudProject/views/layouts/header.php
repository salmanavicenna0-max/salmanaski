<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="/CrudProject/css/style.css">
</head>
<body>


 <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
      
      </a>
 <a class="navbar-brand">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTriHAC_xDv9_UHhW9miNvgQYh-_MpGauE57Q&s" alt="" width="30" height="24" class="d-inline-block align-text-top">
      
    </a>
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="index.php?page=mahasiswa&action=index" class="nav-link">Mahasiswa</a></li>
        <li class="nav-item"><a href="index.php?page=products&action=index" class="nav-link">Products</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i></i> Tambah Data
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?page=mahasiswa&action=create"><i></i> Tambah Mahasiswa</a></li>
            <li><a class="dropdown-item" href="index.php?page=products&action=create"><i></i> Tambah Product</a></li>
          </ul>
        </li>
      </ul>
    </header>
  </div>