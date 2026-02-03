<?php
require_once 'app/ProductController.php';
$productController = new ProductController();
$productId =(int) $_GET['id'];
$getProduct = $productController->showProduct($productId);

if (!$getProduct) {
    echo "Product tidak ditemukan." .$productId;
    exit;
}else{
    $productController ->deleteProduct($productId['id'] );
}