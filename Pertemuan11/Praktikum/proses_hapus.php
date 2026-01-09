<?php 
// File: proses_hapus.php 
// Fungsi: Menghapus data mahasiswa dari database 
 
include "koneksi.php"; 
 
// Ambil NIM dari URL 
$nim = $_GET['nim']; 
 
try {
    // Query DELETE untuk menghapus data 
    $query = "DELETE FROM mahasiswa WHERE nim = :nim"; 
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nim', $nim);
    
    // Eksekusi query 
    if ($stmt->execute()) { 
        echo "<script> 
                alert('Data berhasil dihapus!'); 
                window.location.href='tampil_data.php'; 
              </script>"; 
    }
} catch(PDOException $e) {
    echo "<script> 
            alert('Gagal menghapus data: " . $e->getMessage() . "'); 
            window.location.href='tampil_data.php'; 
          </script>"; 
}
?> 