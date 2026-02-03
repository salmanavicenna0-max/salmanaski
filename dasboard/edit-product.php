<?php
require_once 'app/ProductController.php';

$controller = new ProductController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller->updateProduct($_POST, $_GET['id']);
}

$product = null;
if (isset($_GET['id'])) {
    $product = $controller->showProduct($_GET['id']);
}

if (!$product) {
    echo "<script>alert('Product not found!'); window.location.href='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-container { max-width: 400px; margin: 0 auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #218838; }
        .back-link { display: inline-block; margin-bottom: 20px; color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="form-container">
        <a href="index.php" class="back-link">← Back to Products</a>
        <h2>Edit Product</h2>
        
        <form method="POST">
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" value="<?= $product['price'] ?>" step="0.01" required>
            </div>
            
            <button type="submit">Update Product</button>
        </form>
    </div>
</body>
</html>