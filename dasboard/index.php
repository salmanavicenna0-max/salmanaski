<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Membuat Aplikasi Sederhana Menggunakan PHP OOP, Mysql dan Bootstraps</title>
<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
rel="stylesheet" integrity="sha384-
rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
crossorigin="anonymous">
<!-- menambah css dari datatable bootstrapp -->
<link rel="stylesheet"
href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
</head>
<body>
<?php
require 'layout/header.php';
require_once 'app/ProductController.php';
$productController = new ProductController();
$products = $productController->getProducts();
?>
<div class="container mt-5">
<h1>Latihan PHP OOP, Mysql dan Bootstraps</h1>
<div class="card">
<!-- menambah data card bootstrap -->
<div class="card-header">
<h5>Data Produk</h5>
</div>
<div class="card-body">
<!-- menampilkan button tambah -->
<a href="create-product.php" class="btn btn-primary">+ Create</a>
<table id="products" class="table table-bordered table-striped"
style="width:100%">
<thead>
<tr>
<th width="5%">No</th>
<th>Name</th>
<th>Price</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php $no =1 ?>
<?php foreach ($products as $product) : ?>
<tr>
<td><?= $no++;?></td>
<td><?= $product['name'];?></td>
<td>Rp.<?= number_format($product['price'],0, 
',','.') ;?></td>
<td>
<a href="edit-product.php?id=<?=$product['id'];?>"
class="btn btn-warning">Edit</a>
<button class="btn btn-danger"
onclick="deleteProduct(<?=$product['id'];?>)">Delete</button>
</td>
</tr>
<?php endforeach ?>
</tbody>
</table>
</div>
</div>
</div>
<!-- menambah fungsion baru untuk delete -->
<script>
function deleteProduct(id) {
if(confirm('are you sure want to deleteProduct?')){
window.location.href = 'delete.php?id='+id;
}
}
</script>
<?php
require 'layout/footer.php';
?>