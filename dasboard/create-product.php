<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">

</head>
<body>
<?php
require 'layout/header.php';
require_once 'app/ProductController.php';
$controller = new ProductController();  
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller->createProduct($_POST);
}
?>
<div class="container mt-5">
    <h1>Create New Product</h1>
    <div class="card">
        <div class="card-header">
            <h5>New Product Form</h5>
        </div>
        <div class="card-body">
            <form action="" method="post" id="createProduct">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="name" class="form-control" name="name" id="name" required>

                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" name="price" id="price" required min="0">
                </div>
            </form>
                <div class="float-end">
                    <a href="index.php" class="btn btn-secondary">Back</a>
                    <button type="submit" form="createProduct" class="btn btn-primary" name="submit">Submit</button>
                </div>
        </div>
    </div>
</div>
<?php
require 'layout/footer.php';
?>

</body>
</html>