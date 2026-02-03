<?php

require_once 'Database.php';  // Perbaiki path relatif

class ProductController {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getProducts() {
        $result = mysqli_query($this->db, "SELECT * FROM products");
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        return $products;
    }

    public function updateProduct($data, $id) {
        $name = $this->filter($data['name']);
        $price = $this->filter($data['price']);
        
        $sql = $this->db->prepare("UPDATE products SET name=?, price=? WHERE id=?");
        $sql->bind_param("sii", $name, $price, $id);
        if ($sql->execute()) {
            if ($sql->affected_rows > 0) {
                echo "<script>alert('Product updated successfully'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Failed to update product! " . $sql->error . "'); window.location.href='edit-product.php?id=" . $id . "';</script>";
            }
        }
        $sql->close();
    }

    public function createProduct($data) {
        $name = $this->filter($data['name']);
        $price = $this->filter($data['price']);
        
        $sql = $this->db->prepare("INSERT INTO products (name, price) VALUES (?, ?)");
        $sql->bind_param("si", $name, $price);
        if ($sql->execute()) {
            echo "<script>alert('Product created successfully!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Failed to create product! " . $sql->error . "'); window.location.href='create-product.php';</script>";
        }
        $sql->close();
    }

    public function deleteProduct($id) {
        $sql = $this->db->prepare("DELETE FROM products WHERE id=?");
        $sql->bind_param("i", $id);
        if ($sql->execute()) {
            echo "<script>alert('Product deleted successfully!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Failed to delete product! " . $sql->error . "'); window.location.href='index.php';</script>";
        }
        $sql->close();
    }

    public function showProduct($id) {  // Perbaiki nama method dari showProducts
        $sql = $this->db->prepare("SELECT * FROM products WHERE id=?");
        $sql->bind_param("i", $id);
        $sql->execute();
        $result = $sql->get_result();
        $product = $result->fetch_assoc();
        $sql->close();
        return $product;
    }

    private function filter($input) {
        return htmlspecialchars(strip_tags($input));
    }
}