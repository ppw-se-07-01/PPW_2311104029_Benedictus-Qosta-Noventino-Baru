<?php 
// Fungsi: Membuat koneksi ke database SQLite 
// Path database SQLite (file akan dibuat otomatis jika belum ada)
$db_path = __DIR__ . '/akademik.db';

// Membuat koneksi ke SQLite
try {
    $conn = new PDO("sqlite:$db_path");
    // Set error mode ke exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Buat tabel mahasiswa jika belum ada
    $create_table = "CREATE TABLE IF NOT EXISTS mahasiswa (
        nim VARCHAR(10) PRIMARY KEY,
        nama VARCHAR(50) NOT NULL,
        jurusan VARCHAR(50) NOT NULL,
        email VARCHAR(50),
        tanggal_lahir DATE
    )";
    
    $conn->exec($create_table);
    
} catch(PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>