<?php
// File: insert_sample_data.php
// Fungsi: Insert data sample mahasiswa untuk testing

include "koneksi.php";

try {
    // Data sample mahasiswa
    $sample_data = [
        ['2311104029', 'Noven', 'Teknik Informatika', 'noven@example.com', '2003-05-15'],
        ['2311104030', 'Benedictus Qosta', 'Sistem Informasi', 'benedictus@example.com', '2003-08-20'],
        ['2311104031', 'Ahmad Rizki', 'Teknik Informatika', 'ahmad@example.com', '2003-03-10'],
        ['2311104032', 'Siti Rahayu', 'Teknologi Informasi', 'siti@example.com', '2003-12-25'],
        ['2311104033', 'Budi Santoso', 'Ilmu Komputer', 'budi@example.com', '2003-07-08']
    ];
    
    $query = "INSERT OR IGNORE INTO mahasiswa (nim, nama, jurusan, email, tanggal_lahir) 
              VALUES (:nim, :nama, :jurusan, :email, :tanggal_lahir)";
    
    $stmt = $conn->prepare($query);
    
    $success_count = 0;
    foreach ($sample_data as $data) {
        $stmt->bindParam(':nim', $data[0]);
        $stmt->bindParam(':nama', $data[1]);
        $stmt->bindParam(':jurusan', $data[2]);
        $stmt->bindParam(':email', $data[3]);
        $stmt->bindParam(':tanggal_lahir', $data[4]);
        
        if ($stmt->execute()) {
            $success_count++;
        }
    }
    
    echo "<h2>✅ Data Sample Berhasil Ditambahkan!</h2>";
    echo "<p>Total data ditambahkan: <strong>$success_count</strong></p>";
    echo "<p><a href='tampil_data.php'>Lihat Data Mahasiswa</a></p>";
    
} catch(PDOException $e) {
    echo "<h2>❌ Gagal Insert Data</h2>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
?>
