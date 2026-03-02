-- Buat Database
CREATE DATABASE IF NOT EXISTS db_project;
USE db_project;

-- Tabel Mahasiswa
CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_product VARCHAR(100) NOT NULL,
    harga INT NOT NULL,
    stok INT NOT NULL,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Data Sample Mahasiswa
INSERT INTO mahasiswa (nim, nama, jurusan, email) VALUES
('2021001001', 'Budi Santoso', 'Teknik Informatika', 'budi@email.com'),
('2021001002', 'Siti Nurhaliza', 'Sistem Informasi', 'siti@email.com'),
('2021001003', 'Ahmad Fauzi', 'Teknik Elektro', 'ahmad@email.com');

-- Data Sample Products
INSERT INTO products (nama_product, harga, stok, deskripsi) VALUES
('Laptop ASUS ROG', 15000000, 10, 'Laptop gaming dengan spesifikasi tinggi'),
('Mouse Logitech', 250000, 50, 'Mouse wireless ergonomis'),
('Keyboard Mechanical', 750000, 30, 'Keyboard mechanical RGB');
